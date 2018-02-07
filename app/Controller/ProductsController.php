<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Carrinho');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Product->recursive = 0;
        $this->set('products', $this->Paginator->paginate());

        $this->set('carrinho', $this->Carrinho->findProducts());
    }

    /**
     * Adiciona um produto no carrinho
     */
    public function adicionar_carrinho($id = null){
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }

        if($this->Carrinho->adiciona($id)){
            $this->Flash->success('Produto adicionado ao carrinho!');
            $this->redirect($this->referer());
        }
    }

    /**
     * Remover um produto do carrinho
     */
    public function remover_carrinho($id = null){
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }

        if($this->Carrinho->remove($id)){
            $this->Flash->success('Produto revovido do carrinho!');
            $this->redirect($this->referer());
        }
    }

    /**
     * Atualiza o carrinho
     */
    public function atualiza_carrinho(){
        if ($this->request->is('post')) {
            foreach ($this->request->data['Carrinho'] as $key => $produto) {
                $this->Carrinho->remove($produto['id']);

                if($produto['quantity'] > 0){
                    $this->Carrinho->adiciona($produto['id'], $produto['quantity']);
                }
            }
        }

        $this->Flash->success('O carrinho foi atualizado com sucesso!');
        $this->redirect($this->referer());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
        $this->set('product', $this->Product->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $this->request->data = $this->Product->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Product->delete()) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
