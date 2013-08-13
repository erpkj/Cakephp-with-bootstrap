<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $theme = "Cakestrap";
    public $components = array('DebugKit.Toolbar',
	'Session',
	'Auth' => array(
	    'loginAction' => array(
		'admin' => false,
		'controller' => 'users',
		'action' => 'login'
	    ),
	    'authError' => 'Your session has ended due to inactivity.  Please login to continue.',
	    'authenticate' => array(
		'Form' => array(
		    'fields' => array('username' => 'username')
		),
		'all' => array(
		    'userModel' => 'User',
		    'scope' => array('User.status' => array('active', 'inactive'))
		)
	    )
	)
    );

    public function beforeFilter() {
	sleep(1);
	parent::beforeFilter();
	$this->disableCache();
	
	//tell Auth to call the isAuthorized function before allowing access
	$this->Auth->authorize = array('Controller');
	
	//allow all non-logged in users access to items without a prefix
	if (!isset($this->params['prefix'])){
	    $this->Auth->allow('*');
	}
	
	// Function to allow the non login pages
	$this->_checkAuth();
    }

    public function isAuthorized() {
	return true;
    }

    private function _checkAuth() {
	$exception_array = array(
	    'users/login',
	    'users/register',
	    'users/logout'
	);
	$cur_page = $this->params['controller'] . '/' . $this->params['action'];
	if (!in_array($cur_page, $exception_array)) {
	    if (!$this->Auth->user('id')) {
		$is_admin = false;
		if (isset($this->params['prefix']) and $this->params['prefix'] == 'admin') {
		    $this->redirect(array(
			'controller' => 'users',
			'action' => 'login', 'admin' => false
		    ));
		}
		$this->redirect(array(
		    'controller' => 'users',
		    'action' => 'login',
		    'f' => base64_encode($this->params->url)
		));
	    }
	} else {
	    $this->Auth->allow();
	}
    }

}
