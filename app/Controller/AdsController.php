<?php
header("Access-Control-Allow-Origin: *");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class AdsController  extends AppController
{
	public $components = array('RequestHandler');
	public $uses = ['User','EmailTemplate', 'Category', 'ProductType'];

	public function beforeFilter()
    {
    	if($this->request->prefix != 'admin')
    	{
    		$this->Auth->allow( 'saveAd');
    	}
    }
	public function saveAd()
	{
		pr($_FILES);exit;
	}
}
