<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
* 
*/
class VendorsController extends AppController
{
	
	public $uses = array('User','EmailTemplate');
	public $components = array('Session','Paginator','RequestHandler');
	public $hepler = array('Session','Paginator');
	public $layout = 'vendors_layout';
	public function beforeFilter()
	{
		parent::beforeFilter();
		/*if($this->Session->read('Auth.User.type') != '1'){
			$this->Flash->error(__('Are you sure, you are authorize here!!!'));
			$this->redirect('/Vendors/profile');
		}*/
		
		$this->Auth->allow('login');
	}

	public function login()
	{	
		$this->layout = '';
		if($this->Auth->user('id'))
		{
			$this->redirect('/users/dashboard');
		}

		if ($this->request->is('post')) {
			
	        if ($this->Auth->login()) {
	        	if($this->Session->read('Auth.User.type') != 1){
	        		$this->Flash->error(__('Your are not vendor,Please signup as vendor.'));
	        		$this->redirect('/Vendors/logout');
	        	}else
	            	$this->redirect('/Vendors/profile');

	        }
	        $this->Flash->error(__('Invalid username or password, try again'));
	    }
		
	}

	public function logout() {
		$this->Auth->logout();
	    return $this->redirect('/Vendors');
	}
	public function profile()
	{
		$this->layout = 'vendors_layout';
		$user = $this->User->findById($this->Auth->user('id'));

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','user'));
	}

	public function update_profile()
	{

		if( $this->request->is('post') )
		{
			$user = $this->request->data;
			$user['User']['id'] = $this->Auth->user('id');
			$validator = $this->User->validator();
            unset($validator['terms'],$validator['password'],$validator['confirm_password'],$validator['phone']);
			if($this->User->save($user))
			{
				$this->Session->setFlash('Profile Updated successfully.');

				$this->redirect($this->referer());
			}
		}
		$this->redirect('/');
	}

    public function delete($model = null, $id = null)
    {
    	if($this->$model->delete($id))
    		$this->Flash->error(__('Data deleted successfully.'));
    	else
    		$this->Flash->error(__('Error in deleting data, Please contact admin.'));
    	$this->redirect($this->referer());
    }

    private function sendForgotPasswordEmail($user)
    {
    	//pr($user);die;
        $emailTemplate = $this->EmailTemplate->findBySlug('forgot-password');
        if( !empty($emailTemplate) )
        {
            $password = $user['password'];
            $body = str_replace( ['{name}', '{password}'], [$user['first_name'].' '.$user['last_name'], $password], $emailTemplate['EmailTemplate']['body'] );

            $param['email'] = $user['email'];
            $param['body'] = $body;

            return $this->mail($emailTemplate, $param);    
        }
        return false;
    }

    public function updateUserPassword($id = null){
    	if(!empty($id)){

            $postData = $this->User->findById($id); 
            $pass = mt_rand(1000,100000);
                   
            $postData['User']['password'] = $pass;  
            $this->User->save($postData, false);     
            $this->sendForgotPasswordEmail($postData['User']);
            $this->Flash->error(__("Password sent to user's email."));
                    
        }
        $this->redirect($this->referer());
    }

    private function mail($emailTemplate, $param=[])
    { 
        $Email = new CakeEmail('gmail');
        $Email->emailFormat('both');
        $Email->from($emailTemplate['EmailTemplate']['from']);
        $Email->to($param['email']);
        $Email->bcc('mpgledev@gmail.com');
        $Email->subject($emailTemplate['EmailTemplate']['subject']);
        return $Email->send($param['body']); 
    }
    private function sendEmail($user , $slug)
    {
        $emailTemplate = $this->EmailTemplate->findBySlug($slug);
        if( !empty($emailTemplate) )
        {
            
            $body = str_replace(['{name}'], [$user['first_name'].' '.$user['last_name']], $emailTemplate['EmailTemplate']['body']);
            $param['body'] = $body;
            $param['email'] = $user['email'];

            $this->mail($emailTemplate, $param);
        }
        return false;
    }

    public function changePassword(){
    	if($this->request->is('post')){
    		$user = $this->request->data;
    		//pr($user);die;
			$userData = $this->User->findById($this->Auth->user('id'));
			//pr($userData);die;
			$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password = $passwordHasher->hash($user['User']['current_password']);
			if($userData['User']['password'] != $password){
				$this->Flash->error(__("Please enter correct current password."));
				$this->redirect($this->referer());
			}

			unset($user['User']['current_password']);
			$validator = $this->User->validator();
            unset($validator['terms'],$validator['phone'],$validator['country_code']);
            $userData['User']['password'] = $user['User']['password'];
            $userData['User']['confirm_password'] = $user['User']['confirm_password'];
			if($this->User->save($userData))
			{
				$this->Session->setFlash('Password Updated successfully.');

				$this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Password does not match.');

				$this->redirect($this->referer());
			}
    	}
    }
}