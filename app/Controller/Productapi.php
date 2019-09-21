<?php
header("Access-Control-Allow-Origin: *");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class Productapi extends AppController
{
	public $components = array('RequestHandler');
	public $uses = ['User','EmailTemplate', 'Category', 'ProductType'];

	public function beforeFilter()
    {
    	if($this->request->prefix != 'admin')
    	{
    		$this->Auth->allow('signUp','login', 'forgotPassword');
    	}
    }

    public function saveAd()
    {
    	$message = "INVALID REQUEST";
    	$status = false;
    	$error = 1022;
    	if ($this->request->is('post')) {
    		
    	}

    	 $this->set(array(
            'data' => [
            	'msg' => $message,
            	'status' => $status ,
            	'error' => $error,
            	'data' => ''
            ],
            '_serialize' => array('data')
        ));
    }

    public function getData()
    {
    	$productTypes = [];
    	$categories = [];
    	$status = false;
    	$message = 'Result not found';
    	$error='';
    	
    	if ( $this->request->is('ajax') ) {
    		$productTypes = $this->ProductType->find('all');
    		$categories = $this->Category->find('all');
    		$data = [
    			'productTypes' => $productTypes,
    			'categories' => $categories
    		];

    		$message = '';
    		$status = true;
    	}

    	$this->set(array(
            'data' => [
            	'msg' => $message,
            	'status' => $status ,
            	'error' => $error,
            	'data' => $data
            ],
            '_serialize' => array('data')
        ));
    }
}
?>