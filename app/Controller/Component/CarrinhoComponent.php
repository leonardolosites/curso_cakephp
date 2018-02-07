<?php
App::uses('Component', 'Controller/Component');

class CarrinhoComponent extends Component {

    /**
     *  Componentes
     */
    public $components = array('Session');

    /**
     *  Lista de produtos
     */
    protected $_carrinho = array();

    /**
     *  Inicializa o componente
     */
    public function startup(Controller $controller){
        $this->Controller = $controller;
        $this->_populaCarrinho();
    }

    /**
     *  Popula o carrinho
     */
    protected function _populaCarrinho(){
        $this->_carrinho = $this->Session->read('carrinho');

        if(!is_array($this->_carrinho)){
            $this->_carrinho = array();
        }
    }


    /**
     *  Persiste o carrinho
     */
    protected function _persisteCarrinho(){
        $this->Session->write('carrinho', $this->_carrinho);
    }

    /**
     *  Adiciona produtos no carrinho
     */
    public function adiciona($id, $quantidade = 1){
        // Se não existir o produto no carrinho
        if(!isset($this->_carrinho[$id])){
            $this->_carrinho[$id] = 0;
        }

        // Incrementa a quantidade
        $this->_carrinho[$id] += $quantidade;

        $this->_persisteCarrinho();

        return ($this->_carrinho[$id] > 0);
    }

    /**
     *  Remove produtos do carrinho
     */
    public function remove($id){
        // Remove o produto
        if(isset($this->_carrinho[$id])){
            unset($this->_carrinho[$id]);
        }

        // Persiste os dados
        $this->_persisteCarrinho();


        return (!isset($this->_carrinho[$id]));
    }

    /**
     *  Busca os produtos no carrinho
     */
    public function findProducts($type = 'all', $params = array()){
        $this->Controller->loadModel('Product');

        $params = Set::merge(array(
            'conditions' => array(
                'Product.id' => array_keys($this->_carrinho)
            )
        ));

        $products = $this->Controller->Product->find($type, $params);

        foreach ($products as &$product) {
            $id = $product['Product']['id'];
            $product['Product']['quantity'] = $this->_carrinho[$id];
        }

        return $products;
    }

}