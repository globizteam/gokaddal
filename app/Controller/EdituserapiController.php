<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class EdituserapiController extends AppController
{
	public $components = array('RequestHandler');
	public $uses = ['User','EmailTemplate'];
	
	public function beforeFilter()
    {
    	if($this->request->prefix != 'admin')
    	{
    		$this->Auth->allow('editUser','login', 'forgotPassword');
    	}
    }

	public function editUser() {
        $message = '';
        $status = false;
        $error = '';
        $data=[];
        if( $this->request->is('post') )
        {
            
            $postData  = $this->request->data;
            if(!empty($_FILES['file']['tmp_name'])){
                $imgName = time().'-'.$_FILES['file']['name'];
                $destination = WWW_ROOT. '/img/user/';
                move_uploaded_file($_FILES['file']['tmp_name'],$destination.$imgName);
                $postData['profile_pic'] = $imgName; 
                $data['path_image'] = URL_HOST.'/img/user/'.$imgName;

            }
            if(!is_numeric($postData['lat'])){
                unset($postData['lat']);
            }
            if(!is_numeric($postData['long'])){
                unset($postData['long']);
            }

            
          
            $this->User->set($postData);
            $validator=$this->User->validator();
            unset($validator['last_name'],$validator['password'],$validator['confirm_password'],$validator['email'],$validator['country_code'],$validator['terms']);
            if ($this->User->save()) {

                $this->User->virtualFields['path_image'] = "CONCAT('".URL_HOST."/img/user/',profile_pic)";

                $userInfo= $this->User->findById($postData['id']);
                $data=$userInfo['User'];
                $message = 'Details updated successfully.';
                $status = true;
            
            } else {
                $error = $this->validateErrors($this->User);
                
                $message = 'All fields are required';
                $status = false;
            }    
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


    public function login() {
        $status = true;
        $errors = '';
    	$message='';
    	if( $this->request->is('post') )
    	{
    		$postData  = $this->request->input('json_decode' , true);
            
            $validator=$this->User->validator();
            unset($validator['first_name'],$validator['last_name'],$validator['phone'],$validator['confirm_password']);
            $validator->remove('email','isUnique');
            $this->User->set($postData);
            if(!$this->User->validates(['fieldList' => array('email', 'password')]))
            {
                $errors = $this->validateErrors($this->User);
                $status = false;
            } else {
                $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                $password = $passwordHasher->hash($postData['password']);
                $user = $this->User->find('first',[
                        'conditions' => [
                                'email' => $postData['email'],
                                'password' => $password
                        ]
                    ]);
                if(empty($user)) {
                    $status = false;
                    $message = 'User not found';
                } else {
                    if($user['User']['status'] != '1') {
                        $status = false;
                        $message = 'Account not activated';
                    }    
                }

                

            }
            
    	}

    	$this->set(array(
            'data' => [
            	'status' => $status ,
                'errors' => $errors,
                'message' => $message,
                'user' => isset($user['User'])?$user['User']:''
            ],
            '_serialize' => array('data')
        ));
    }

    public function forgotPassword()
    {
        if($this->request->is('post'))
        {
            $status = false;
            $errors = '';
            $message = 'Please enter valid email Id.';

            $email = $this->request->input('json_decode', true);
            if(!empty($email['email']))
            {
                $checkEmail = $this->User->find('first', [
                    'conditions' => [ 'email' => $email['email'] ]
                ]);
                
                if(!empty($checkEmail) && $checkEmail['User']['status'] == '1' )
                {
                    $pass = mt_rand(1000,100000);
                   
                    $checkEmail['User']['password'] = $pass;
                    // $checkEmail['User']['status'] = '1';
                    $this->User->save($checkEmail['User'] , false);
                    
                    $checkEmail['User']['password'] = $pass;
                    if( $this->sendForgotPasswordEmail($checkEmail['User']) )
                    {
                        $message = 'Password sent to your email ID.Please check it.';
                        $status = true;
                    } else {
                        $message = 'Error Occured during email send.';
                        $status = false;
                    }
                } else {
                    $message = 'No Record Found.';
                    $status = false;
                }
            }    

            

            $this->set(array(
            'data' => [
                'status' => $status ,
                'errors' => $errors,
                'message' => $message
            ],
            '_serialize' => array('data')
        ));
        }
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

    private function sendForgotPasswordEmail($user)
    {
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
}