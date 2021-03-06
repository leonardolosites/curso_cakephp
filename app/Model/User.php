<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {
    /**
     * Behaviors
     * */
//    public $actsAs = array('Acl' => array('type' => 'requester')); // ARO

    /**
     * Informa pro ACL quem é o pai (grupo)
     */
//    public function parentNode(){
//        if(!$this->id && empty($this->data)){
//            return null;
//        }
//
//        /*Usa o $this->data ou busca a informação no banco*/
//        if(isset($this->data[$this->alias]['group_id'])){
//            $groupId = $this->data[$this->alias]['group_id'];
//        }else{
//            $groupId = $this->field('group_id');
//        }
//
//        /*Retorna as informações pro ACL*/
//        return $groupId ? array('Group' => array('id' => (int)$groupId)) : null;
//    }

    /**
     * Vincula as permissões do usuário ao seu grupo
     * */
//    public function bindNode($user){
//        return array(
//            'model' => 'Group',
//            'foreign_key' => $user[$this->alias]['group_id']
//        );
//    }
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'group_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Selecione um grupo para este usuário!',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Informe um nome para o novo usuário',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Informe um endereço de e-mail',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Informe uma senha!',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
    );
    /**
     * Antes de salvar o registro
     */
    public function beforeSave($options = array()) {
        // Está salvando com senha..
        if (isset($this->data[$this->alias]['password'])) {
            // .. e a senha não está vazia
            if (!empty($this->data[$this->alias]['password'])) {
                // Gera o hash da senha
                $password = &$this->data[$this->alias]['password'];
                $password = AuthComponent::password($password);
            } else {
                unset($this->data[$this->alias]['password']);
            }
        }

        return parent::beforeSave($options);
    }
    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
