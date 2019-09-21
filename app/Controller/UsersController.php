<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('Hash', 'Utility');
require_once VENDORS."gumlet/php-image-resize/lib/ImageResize.php";
use \Gumlet\ImageResize;
/**
* 
*/
class UsersController extends AppController
{
	
	public $uses = array('User','EmailTemplate','Product', 'ReportedAd', 'Organisation', 'Department', 'Designation','Category','DesignationCategory', 'OrganizationDepartment' ,'OrganizationDesignation', 'CountryCode', 'Module');
	public $components = array('Session','Paginator','RequestHandler');
	public $hepler = array('Session','Paginator');
	public $layout = 'admin_dashboard';
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('admin_login','admin_forgotPassword', 'open_app', 'admin_addUser');
	}

	public function admin_login()
	{	
		$this->layout = 'admin_login';
	
		if ($this->request->is('post')) {
        // pr($this->request->data);die();
	        if ($this->Auth->login()) {
	            return $this->redirect('/admin/users/dashboard');
	        }
	        $this->Flash->error(__('Invalid username or password, try again'));
	    }
            // $this->Flash->error(__('No admin present to login'));
		
	}

	public function admin_logout() {
		$this->Auth->logout();
        $this->redirect(array('controller' => 'Users', 'action' => 'login'));
	    // return $this->redirect('/admin');
	}

	public function admin_dashboard()
	{
		$this->layout = 'admin_dashboard';
		$user = $this->User->findById($this->Auth->user('id'));
        
		$totalUsers = $this->User->find('count');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$element = 'js/chart';
		$elementData = '';
		$this->set(compact('thirdparty_js','user','totalUsers',  'elementData'));
		
		//@14-08-2019
  		// By Gurpreet
  		 $this->loadModel('users');
         $this->loadModel('ProviderService');
         $this->loadModel('Category');
         // $orders = $this->orders->find('count');
         $user = $this->users->find('count');
         // $courses = $this->news->find('count');
         $conditions = array('Category.parent' => '0');
         $catcount = $this->Category->find('count', array('conditions' => $conditions  ) );
         $servicecount = $this->ProviderService->find('count');

         // pr($courses);die();
         $this->set(compact('user','catcount','servicecount'));
  	
	}
	public function admin_profile()
	{
		$this->layout = 'admin_dashboard';
		$user = $this->User->findById($this->Auth->user('id'));

        // pr($user);die();

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','user'));
	}
	public function admin_userList()
	{

		$conditions = [];
		$conditions = array(
						'User.id !=' => 1
					); 

		if(!empty($_GET['search_value'])) {
			$conditions[] = array('OR' =>array(
									array('User.name LIKE' => '%'.$_GET['search_value'].'%' ),
									array('User.email LIKE' => '%'.$_GET['search_value'].'%' )
								)
							);
		}

		 $this->Paginator->settings = array(
		        'limit' => 10,
		        'conditions' => $conditions,
		        'order' => 'User.id desc'
		  );

    	$users = $this->Paginator->paginate('User');

		
		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];
        $element = 'js/user_list';
        // pr($element);die();

        $elementData='';
		$this->set(compact('thirdparty_js','users','element', 'elementData'));

	}
	

	public function admin_update_profile()
	{

		if( $this->request->is('post') )
		{
			$user = $this->request->data;

            if( !empty($_FILES['file']) )
            {
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $imgName = time().mt_rand().'-img.'.$ext;
                $destination = WWW_ROOT;
                $destination2 = WWW_ROOT. '/img/user/300/';
                move_uploaded_file($_FILES['file']['tmp_name'],$destination.$imgName);

                $user['User']['profile_pic'] = $imgName; 
                $this->Session->write('Auth.User.profile_pic', $imgName);
            }else{

                unset($user['User']['profile_pic']);
            }
           
			$user['User']['id'] = $this->Auth->user('id');
			$validator = $this->User->validator();


            unset($validator['password'],$validator['contact']);
            // pr($user);die();
			if($this->User->save($user))
			{
				$this->Session->setFlash('Profile Updated successfully.');

				$this->redirect($this->referer());
			}
		}
		$this->redirect('/');
	}

  
    public function admin_addUser($userId='')
    {
     $this->layout = 'admin_dashboard';

       $thirdparty_js = [
           'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js',
           'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'
       ];  
       $element = 'js/add_user';
       $elementData='';
        $this->set(compact('thirdparty_js', 'element', 'elementData'));

        if ($userId) {
            $this->set('edit', 'edituser');
            $user = $this->User->findById($userId);
 
            if(!$this->request->data)

                $this->request->data = $user;

        }
        

        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            $postData['User']['status'] = '1';

            if ($postData['User']['type'] == 'provider') 
                $postData['User']['type'] = '1';
            else
                $postData['User']['type'] = '2';


            $pass = mt_rand(1000,100000);
            if(empty($postData['User']['id'])){
                $postData['User']['password'] = $pass;
            }
            //pr($postData);die;

            $imgName =  $_FILES['file']['name']; 

            $postData['User']['profile_pic'] = $imgName;
            
            if(!empty($imgName)){


                    $imgNameNew = time().'-'.$imgName;

                    $destination = WWW_ROOT;

                    if(move_uploaded_file($_FILES['file']['tmp_name'],$destination.$imgName)) {
                        echo "The file ".$imgName. " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        die();
                    }

            }

            // pr($postData);die();

            // $validator = $this->User->validator();

            // unset($validator['terms'],$validator['name'],$validator['confirm_password'],$validator['password']);
            $this->User->set($postData);


            if ($this->User->save()) 
            {
                $userId = $this->User->id;
                if(empty($postData['User']['id'])){
                    $this->sendForgotPasswordEmail($postData['User']);
                    
                }
                if ( isset($this->request->data['edit'])) 
                    $this->Flash->success(__('The user updated successfully'));
                else
                    $this->Flash->success(__('The user created successfully'));
                

                $this->redirect('userList');
            
            }
        }

    }



    public function addModules($userId, $modules) {
        $this->Module->deleteAll([ 'Module.user_id' => $userId ]);
        $moduleArray=[];
        foreach ($modules as $module) {
            $moduleArray[]['Module'] = [ 'module_name' => $module, 'user_id' => $userId ];
        }
        $this->Module->saveMany($moduleArray);
    }

    public function admin_delete($model = null, $id = null)
    {
    	if($this->$model->delete($id))
    		$this->Flash->error(__('Data deleted successfully.'));
    	else
    		$this->Flash->error(__('Error in deleting data, Please contact admin.'));
    	$this->redirect($this->referer());
    }

    private function sendForgotPasswordEmail($user)
    {
        $emailTemplate = $this->EmailTemplate->findBySlug('forgot-password');
    	// pr($emailTemplate);die;
        if( !empty($emailTemplate) )
        {
            $password = $user['password'];
            $body = str_replace( ['{name}', '{password}'], [$user['name'], $password], $emailTemplate['EmailTemplate']['body'] );

            $param['email'] = $user['email'];
            $param['body'] = $body;

            $this->mail($emailTemplate, $param);    

            $this->Flash->success(__('Reset password email sent successfully'));
            $this->redirect('login');

        }
        return false;
    }

    public function admin_updateUserPassword($id = null){
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
    public function admin_updateStatus($model = null, $id = null){
        // pr($id); die();
    	$this->loadModel($model);
    	if( !empty($id) && !empty($model) ){

            $data = $this->$model->findById($id);
            if($data[$model]['status'] == 0)
                $data[$model]['status'] = 1;
            else
            	$data[$model]['status'] = 0;
            //pr($data);die;
            unset($data[$model]['password']);
           $this->Flash->error(__("Status updated successfully."));
            $this->$model->save($data,false);
        }
        $this->redirect($this->referer());
    }

    public function admin_changePassword(){

    	if($this->request->is('post')){
    		$user = $this->request->data;
			$userData = $this->User->findById($this->Auth->user('id'));
			$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password = $passwordHasher->hash($user['User']['current_password']);

			if($userData['User']['password'] != $password){
				$this->Flash->error(__("Please enter correct current password."));
				$this->redirect($this->referer());
			}

            if ($user['User']['password'] != $user['User']['confirm_password']) {
                
                $this->Session->setFlash('Password does not match.');
                $this->redirect($this->referer());
            }


			$validator = $this->User->validator();
            unset($validator['name'],$validator['email'],$validator['contact']);

            $userData['User']['update'] = 'update';
            $user['User']['id'] = $userData['User']['id'];
			if($this->User->save($user))
			{
				$this->Session->setFlash('Password Updated successfully');

                $this->redirect('userList');
			}

    	}
    }

    public function admin_organisationList()
	{

		$this->Paginator->settings = array(
		        'limit' => 25,
		        'order' => 'id desc'
		    );
    	$users = $this->Paginator->paginate('Organisation');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','users'));
	}
	public function admin_addOrganisation($organisationId = null) {
		$this->layout = 'admin_dashboard';
	    $this->loadModel('OrganizationCategory');

		if(!empty($organisationId)){
	        $user = $this->Organisation->find('first',['conditions'=>['Organisation.id'=>$organisationId]]);
	        
	        $selectedCategories = Hash::extract($user['OrganizationCategory'],'{n}.category_id');
	        $selectedDepartments = Hash::extract($user['OrganizationDepartment'],'{n}.department_id');
	        $selectedDesignations = Hash::extract($user['OrganizationDesignation'],'{n}.designation_id');
	        $this->set(compact('selectedCategories','selectedDepartments','selectedDesignations'));
	      
	        if(!$this->request->data)
	        	$this->request->data = $user;
    	}
        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;

            if(!empty($_FILES['logo']['tmp_name'])) {
	            	$imgName = time().'-'.$_FILES['logo']['name'];

	            	$destination = realpath('../webroot/img/organisationlogo/'). '/';
	            	move_uploaded_file($_FILES['logo']['tmp_name'],$destination.$imgName);
	            	$postData['Organisation']['logo'] = $imgName;
	           
        	}
        	$designations = $postData['Organisation']['designations'];
        	$departments = $postData['Organisation']['departments'];
        	$categories = $postData['DesignationCategory']['category_id'];
        	unset($postData['Organisation']['designations'], $postData['Organisation']['departments'], $postData['DesignationCategory']['category_id']);
        	$this->Organisation->set($postData);
        	$this->loadModel('OrganizationDesignation');
        	$this->loadModel('OrganizationDepartment');
        	$this->loadModel('OrganizationCategory');
            if ($this->Organisation->save()) 
            {
            	$organizationId = $this->Organisation->id;
            	$this->OrganizationCategory->deleteAll([ 'OrganizationCategory.organization_id'=> $organizationId ]);
            	$organizationCategories = [];
            	foreach ($categories as $key =>$categoryId) {
            		$organizationCategories[$key]['OrganizationCategory']['organization_id'] =  $organizationId;
            		$organizationCategories[$key]['OrganizationCategory']['category_id'] =  $categoryId;
            	}
            	$this->OrganizationCategory->saveMany($organizationCategories);
            	
            	$this->OrganizationDesignation->deleteAll([ 'OrganizationDesignation.organization_id'=> $organizationId ]);
            	$OrganizationDesignations = [];
            	foreach ($designations as $key =>$designation) {
            		$OrganizationDesignations[$key]['OrganizationDesignation']['organization_id'] =  $organizationId;
            		$OrganizationDesignations[$key]['OrganizationDesignation']['designation_id'] =  $designation;
            	}
            	$this->OrganizationDesignation->saveMany($OrganizationDesignations);
            	
            	$this->OrganizationDepartment->deleteAll([ 'OrganizationDepartment.organization_id'=> $organizationId ]);
            	$OrganizationDepartments = [];
            	foreach ($departments as $key =>$department) {
            		$OrganizationDepartments[$key]['OrganizationDepartment']['organization_id'] =  $organizationId;
            		$OrganizationDepartments[$key]['OrganizationDepartment']['department_id'] =  $department;
            	
            	}

            	$this->OrganizationDepartment->saveMany($OrganizationDepartments);
            	$this->redirect('organisationList');
            
            }
        }
        $this->Category->bindModel(['hasMany'=> [
    		'Subcategory' => [
    			'className' => 'Category',
    			'foreignKey' => 'parent'
    		]
    	] ]);
    	$categories = $this->Category->find('all',['conditions'=>['parent'=>'0']]);

    	$departments = $this->Department->find('list',['fields' => ['Department.id','Department.name'] ]);
    	$designations = $this->Designation->find('list',['fields' => ['Designation.id','Designation.name'] ]);
    	$thirdparty_js = [
    		'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js',
    		'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'
    	];	
    	$element = 'js/organization';
    	$elementData='';
       $this->set( compact('categories','departments','designations', 'thirdparty_js', 'element', 'elementData') );
    }
    public function admin_departmentList()
	{

		$this->Paginator->settings = array(
		        'limit' => 25,
		        'order' => 'Department.id desc'
		    );
    	$users = $this->Paginator->paginate('Department');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','users'));
	}
	public function admin_addDepartment($departmentId = null) {
		$this->layout = 'admin_dashboard';
		$codes = $this->Organisation->find('list',array('conditions'=>array('status'=>'1'),'fields'=>array('name')));
		if(!empty($departmentId)){
	        $user = $this->Department->findById($departmentId);
	        if(!$this->request->data)
	        	$this->request->data = $user;
    	}
    	$this->set(compact('codes'));
        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
        	$this->Department->set($postData);
            if ($this->Department->save()) 
            {
            		
            	$this->redirect('departmentList');
            
            }
        }
        
       
    }
    public function admin_designationList()
	{

		$this->Paginator->settings = array(
		        'limit' => 25,
		        'order' => 'Designation.id desc'
		    );
    	$users = $this->Paginator->paginate('Designation');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','users'));
	}
	public function admin_addDesignation($designationId = null) {
		$this->layout = 'admin_dashboard';

		$codes = $this->Organisation->find('list',array('conditions'=>array('status'=>'1'),'fields'=>array('name')));

		if(!empty($designationId)){
	        $user = $this->Designation->find('first',['conditions'=>['Designation.id'=>$designationId] ]);
	        // $selectedCategories = Hash::extract($user['DesignationCategory'],'{n}.category_id');
	        // $this->set(compact('selectedCategories'));
	        // $depart = $this->Department->find('list',array('conditions'=>array('organisation_id' => $user['Designation']['organisation_id']),'fields'=>array('name')));
	        if(!$this->request->data)
	        	$this->request->data = $user;
    	}
    	/*$this->Category->bindModel(['hasMany'=> [
    		'Subcategory' => [
    			'className' => 'Category',
    			'foreignKey' => 'parent'
    		]
    	] ]);
    	$categories = $this->Category->find('all',['conditions'=>['parent'=>'0']]);*/
    	
    	$this->set(compact('codes','depart'));

        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
        	$this->Designation->set($postData);
            if ($this->Designation->save()) 
            {
            	$designationId = $this->Designation->id;
            	$designation_categories = [];
            	/*$this->DesignationCategory->deleteAll([ 'designation_id'=> $designationId]);
            	foreach ($postData['DesignationCategory']['category_id'] as $key => $category) {
            		$designation_categories['DesignationCategory']['category_id'] = $category;
            		$designation_categories['DesignationCategory']['designation_id'] = $designationId;
            		$this->DesignationCategory->create();
            		$this->DesignationCategory->save($designation_categories);
            	}*/
            	$this->redirect('designationList');
            
            }
        }
        
       
    }
    public function admin_getDeparment($organisationId = null) {
        $this->OrganizationDepartment->virtualFields['name'] = "SELECT name FROM departments WHERE departments.id=OrganizationDepartment.department_id";
        $departments = $this->OrganizationDepartment->find('all',[
            'conditions' => [
                'OrganizationDepartment.organization_id' => $organisationId
            ]

        ]);
       

        $this->OrganizationDesignation->virtualFields['name'] = "SELECT name FROM designations WHERE designations.id=OrganizationDesignation.designation_id";
        $designations = $this->OrganizationDesignation->findAllByOrganizationId($organisationId);
        $resp = [];
		//pr($departments);die;
		$options = '<option value="">Select Department</option>';
		if(!empty($departments)){
			$resp['status'] = true;
			$options = '<option value="">Select Department</option>';
			foreach($departments as $dep) {
				$options.='<option value="'.$dep['OrganizationDepartment']['department_id'].'">'.$dep['OrganizationDepartment']['name'].'</option>';
			}
			$resp['data'] = $options;
            $options_desinations = '<option value="">Select Designation</option>';
            foreach($designations as $designation){
                $options_desinations.='<option value="'.$designation['OrganizationDesignation']['designation_id'].'">'.$designation['OrganizationDesignation']['name'].'</option>';
            }
            $resp['designation'] = $options_desinations;

		}else{
			$resp['status'] = false;
			$resp['msg'] = 'No department found';
			$resp['data'] = $options;
            $resp['designation'] = [];
		}
		echo json_encode($resp);die;
    }

    public function admin_getDesignation($departmentId = null) {
		$designations = $this->Designation->findAllByDepartmentId($departmentId);
		$resp = [];
		$options = '<option value="">Select Designation</option>';
		if(!empty($designations)){
			$resp['status'] = true;
			
			foreach($designations as $dep){
				$options.='<option value="'.$dep['Designation']['id'].'">'.$dep['Designation']['name'].'</option>';
			}
			$resp['data'] = $options;
		}else{
			$resp['status'] = false;
			$resp['msg'] = 'No designation found';
			$resp['data'] = $options;
		}
		echo json_encode($resp);die;
    }

    public function admin_countryList()
    {

        $this->Paginator->settings = array(
                'limit' => 25,
                'order' => 'CountryCode.id desc'
            );
        $countries = $this->Paginator->paginate('CountryCode');
      
        $thirdparty_js = [
            'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
        ];

        $this->set(compact('thirdparty_js','countries'));
    }
    public function admin_addCountry($countryId = null) {
        $this->layout = 'admin_dashboard';
        
        if(!empty($countryId)){
            $user = $this->CountryCode->findById($countryId);
            if(!$this->request->data)
                $this->request->data = $user;
        }
        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            $this->CountryCode->set($postData);
            if ($this->CountryCode->save()) 
            {
                $this->redirect('countryList');
            }
        }
        $element = 'js/add_country';
        $elementData='';
        $thirdparty_js = [
            'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
        ];
        $this->set(compact('element', 'elementData', 'thirdparty_js'));
    }

    public function admin_forgotPassword() {
        if( $this->request->is('post') ) {

            if(!empty($this->request->data['User']['email'])) {
                $this->User->recursive = -1;
                $userInfo = $this->User->findByEmail($this->request->data['User']['email']);
                App::uses('CakeText', 'Utility');
                mt_srand(mktime());
                $userInfo['User']['password'] = mt_rand();
                // $userInfo['User']['code'] = CakeText::uuid();
                $this->User->save($userInfo);
                $this->sendForgotPasswordEmail($userInfo['User']);
                $this->Flash->success(__("Email Sent."));
                $this->redirect('/admin');
            }
        
        }
    }

// Plans
 public function admin_planlist()
    {
    //   $this->layout = "admin_dashboard";
    //   $this->loadModel('User');
    //   $this->loadModel('plans');
    //   //$this->loadModel('categories');
    //   //$specials2 = $this->categories->findAllByStatus(0);
    //   $this->Paginator->settings = array('plans' => array('limit' => 15,'recursive' => 2,'order' => array('Order.id' => 'DESC')));
    //   $specials = $this->paginate('plans');
    //   $this->set(compact('specials'));
    //   if($this->request->is('post'))
    //   {
    //     $data = $this->data;
    //     //echo "<pre>";print_r($data);print_r($_FILES);die;    
    //     $this->Session->write('success-msg','Content Updated!');
    //     $this->redirect(array('action' => 'adverts'));   
    //   }
    $this->layout = "admin_dashboard";
      $this->loadModel('plans');
      //$specials = $this->Course->findAllByStatus(0);
     $this->Paginator->settings = array('plans' => array('limit' => 100));
      $specials=$this->paginate('plans');
      $this->set(compact('specials'));
    }
 public function admin_plans($id=null)
    {
      $this->layout = "admin_dashboard";
    //   $this->loadModel("User");
      $this->loadModel("plans");
    //   $this->loadModel('Course');
    //   $user_list=$this->User->findAllByType(1);
    //   $this->set(compact('user_list'));
    //   $specials2 = $this->Course->findAllByStatus(0);
      $id = base64_decode($id);
    //   echo $id; die();
      $content = $this->plans->findById($id);
        $this->set(compact('content'));
      if($this->request->is('post'))
      {
        $data = $this->data;
        $data['plans']['id'] = $id;
        $data['plans']['name'] = $data['name'];
        $data['plans']['description'] = $data['desc'];
        $data['plans']['updated_date'] = date("Y-m-d");
        // $data['plans']['sell_name']=$data['User'];
        $data['plans']['price']=$data['price'];
        $data['plans']['max_days']=$data['max_days'];
        $this->plans->save($data);
        $this->Session->write('success-msg','Course Content Updated!');
        $this->redirect(array('action' => 'planlist')); 
      }
    }

    public function deleteAll($modal=null,$id=null){
      $id = base64_decode($id);
      $this->loadModel($modal);
      $this->$modal->delete($id);
    		$this->Flash->error(__('Data deleted successfully.'));
      $this->redirect($this->referer());
    }
    public function open_app(){
        $this->layout = false;
    }
}