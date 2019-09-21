<?php
header("Access-Control-Allow-Origin: *");
App::uses('AppController', 'Controller');

class DepartmentController  extends AppController {

	public $uses = array( 'Department' );
	public $components = array('Session','Paginator','RequestHandler');
	public $hepler = array('Session','Paginator');

	public function admin_index()
	{
		$this->layout = 'admin_dashboard';
		$conditions = [];
		$this->Paginator->settings = array(
		        'limit' => 25,
		        'conditions' => $conditions,
		        'order' => 'id desc'
		    );
    	$departments = $this->Paginator->paginate('Department');
	}

	public function admin_addDepartment() 
	{
		$this->layout = 'admin_dashboard';
	}
}