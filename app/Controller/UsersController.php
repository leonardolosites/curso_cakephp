<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    /**
     * Antes de filtrar a requisição
     */
    public function beforeFilter() {
        // Libera o acesso às actions de login e logout
        $this->Auth->allow('login', 'logout');

        return parent::beforeFilter();
    }

    /**
     * Login
     */
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl(array('controller' => 'posts', 'action' => 'index')));
            } else {
                $this->Flash->error('Usuário e/ou senha incorreto(s)');
            }
        }
    }

    /**
     * Logout
     */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Usuário cadastrado com sucesso!'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Não foi possível salvar este usuário. Tente novamente.'));
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário Inválido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Dados do usuário atualizados com sucesso!'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Não foi possível atualizar os deste usuário. Tente novamente!'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->seccess(__('Usuário deletado.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Não foi possível deletar este usuário'));
        $this->redirect(array('action' => 'index'));
    }
}
