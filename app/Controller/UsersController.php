<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

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
	if (!$this->User->exists($id)) {
	    throw new NotFoundException(__('Invalid user'));
	}
	$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
	$this->set('user', $this->User->find('first', $options));
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
		$this->Session->setFlash(__('The user has been saved'), 'flash/success');
		$this->redirect(array('action' => 'index'));
	    } else {
		$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error');
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
	if (!$this->User->exists($id)) {
	    throw new NotFoundException(__('Invalid user'));
	}
	if ($this->request->is('post') || $this->request->is('put')) {
	    if ($this->User->save($this->request->data)) {
		$this->Session->setFlash(__('The user has been saved'), 'flash/success');
		$this->redirect(array('action' => 'index'));
	    } else {
		$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error');
	    }
	} else {
	    $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
	    $this->request->data = $this->User->find('first', $options);
	}
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
	$this->User->id = $id;
	if (!$this->User->exists()) {
	    throw new NotFoundException(__('Invalid user'));
	}
	$this->request->onlyAllow('post', 'delete');
	if ($this->User->delete()) {
	    $this->Session->setFlash(__('User deleted'), 'flash/success');
	    $this->redirect(array('action' => 'index'));
	}
	$this->Session->setFlash(__('User was not deleted'), 'flash/error');
	$this->redirect(array('action' => 'index'));
    }

    /**
     * login method
     * @copyright (c) 2013
     * @author Pankaj Kumar Jha <pankajkumarjha@xyz.com>
     * @param string $f Previous Enycripted URL 
     * @uses To login as a Admin user
     */
    public function login($f = null) {
	$this->set('title_for_layout', 'Login');
	if ($this->request->is('post')) {
	    $ff = false;
	    if (!empty($this->request->params['named']['f'])) {
		$ff = base64_decode($this->request->params['named']['f']);
	    }
	    $this->User->set($this->request->data['User']);
	    unset($this->User->validate['username']['isUnique']);
	    if ($this->User->validates()) {
		if ($this->Auth->login()) {
		    /* Redirect user accordingly based on account status */
		    $AccountStatus = $this->Auth->user('status');
		    if (!empty($ff)) {
			$this->redirect(Router::url('admin/', true) . $ff);
		    }

		    $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
		} else {

		    $this->Session->setFlash(__('Email or Password is incorrect'), 'default');
		}
	    }
	}
    }

    
    /**
     * admin_logout method
     * @copyright (c) 2013
     * @author Pankaj Kumar Jha <pankajkumarjha@xyz.com>
     * @uses To logout form admin
     */
    
    public function admin_logout() {
	$this->redirect($this->Auth->logout());
    } 
    
    
    /**
     * register method
     * @copyright (c) 2013
     * @author Pankaj Kumar Jha <pankajkumarjha@xyz.com>
     * @uses To register user
     */
    public function register() {
	$this->set('title_for_layout', 'Registration');
	if ($this->request->is('post')) {
	    $this->User->create();
	    if ($this->User->save($this->request->data)) {
		$this->Session->setFlash(__('The user has been saved'), 'flash/success');
		$this->redirect(array('action' => 'index'));
	    } else {
		$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error');
	    }
	}
    }

    /**
     * admin_dashboard method
     * @copyright (c) 2013
     * @author Pankaj Kumar Jha <pankajkumarjha@xyz.com>
     * @uses Dashboard of admin
     */
    public function admin_dashboard() {
	$this->set('title_for_layout', 'Dashboard');
    }

}
