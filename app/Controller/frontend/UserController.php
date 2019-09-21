<?php 
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
//App::import('Vendor', 'payu');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::uses('Xml', 'Utility');
App::uses('Hash', 'Utility');
// ob_start();


class UserController extends AppController
{
    public $helpers = array('Session','Html','Js','Form','Paginator','Flash');
    public $uses = array('Category','User','EmailTemplate');
	// public $components = array(
	// 					'Session','Email','RequestHandler','Cookie','Paginator','Flash', 
	// 					'Auth' => array(
	// 						'loginAction' => array('controller'=>'home', 'action'=>'index'),
	// 						'loginRedirect' => array('controller' => 'home', 'action' => 'dashboard'),
	// 						'logoutRedirect' => array('controller' => 'home', 'action' => 'index'),
	// 						'authenticate' => array(
	// 						      'Form' => array(
	// 						          'passwordHasher' => 'SimplePasswordHasher'
	// 						      )
	// 						  ),

	// 						// 'authenticate' => array('all' => array('scope' => array('User.status' => 1)),
	// 						'Form' => array('fields' => array('username' => 'email')),
	// 						'authError' => "You can't access that page",
	// 						'authorize' => array('Controller')
	// 						),
	// 					);

	
	public $layout = 'frontend';

	// logged in users access to 
	public function isAuthorized($user)
	{
	 return true;
	}


	public function beforeFilter()
	{
		parent::beforeFilter();
		// give access to non logged in users
		$this->Auth->allow('index','login','signup','');

		// this data available to each view
		$categories = $this->Category->find('list',array(
        'conditions' => array('Category.parent' => 0) ));

		$this->set(compact('categories'));

		// pr($categories); die();
	}


	// public function isAuthorized($user)
	// {
	// 	return true;
	// }

	// showing categories listing
	public function index()
	{
		$this->layout = 'frontend';

	}

	public function login() {
		$this->layout = 'frontend';

	    	// pr('Out of login post request');die();
	    if ($this->request->is('post')) {

	    	// pr($this->Auth);die();

	    	// if ($this->Auth->login())  //getting session user id
	    	// {
	    	// 	$this->redirect('dashboard');
	     //    	$this->Flash->success(__('User logged in successfully'));
	    	// }

	        if ($this->Auth->login()) {
	    			// pr('User is authenticated');die();
	        	$this->Flash->success(__('Logged in successfully'));
	            $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->Flash->error(__('Invalid username or password, try again'));
	    }
		
	}

	public function logout() {
	    $this->redirect($this->Auth->logout());
	}

	public function dashboard($value='')
	{
		pr('i am in dashboard');die();
	}

	// Login page 
	// public function login()
	// {
	// 	$this->layout = 'frontend';
	// 	// pr('i am in login'); die();
	// 	// $this->layout = 'frontend';
	// 	# code...
	// }
	// Signup page 
	// public function signup()
	// {
	// 	$this->layout = 'frontend';
	// 	// pr('i am signup'); die();
	// 	// $this->layout = 'frontend';
	// 	# code...
	// }
	 
	 public function signup() {
		$this->layout = 'frontend';

	     if ($this->request->is('post')) {
	         $this->User->create();
	         if ($this->User->save($this->request->data)) {

	         	// Email send code

	         	// parent:: sendEmail($user , $slug);
	         	$postData = $this->request->data;
	         	// pr($postData);die();
	         	// $postData['User']['password'] = $pass;  
	         	// $this->User->save($postData, false);     
	         	$this->sendForgotPasswordEmail($postData['User']);


	             $this->Flash->success(__('Email sent, please click on link to verify'));
	             return $this->redirect(array('action' => 'signup'));
	         }


	         $this->Flash->error(
	             __('The user could not be saved. Please, try again.')
	         );
	     }
	 }




	 private function sendForgotPasswordEmail($user)
	 {
	 	//pr($user);die;
	 	$Email = new CakeEmail();
	 	$Email->config('default');
	 	$Email->from(array('hardeep_singh4u@yahoo.co.in' => 'My Site'));
	 	$Email->to('hardeep_singh4u@yahoo.co.in');
	 	$Email->subject('About');
	 	$Email->send('My message');
	     return true;
	 }
} 
?>

