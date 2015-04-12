<?php
// app/Controller/UsersController.php
class UsersController extends AppController {
	
		public $components = array('Session');
	
    public function beforeFilter() {
        $this->Auth->allow('login', 'logout');
    }
	    
    public function login() {
    	if ($this->request->is('post')) {
	    	if ($this->Auth->login()) {
	    		$this->redirect($this->Auth->redirect());
	    	} else {
	    		$this->Session->setFlash(__('Invalid username or password, try again'));
	    	}
    	}
    }
        
    public function logout() {
    	$this->Auth->logout();
    	$this->redirect('/');
    }
    
}