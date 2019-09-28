<?php 
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
//App::import('Vendor', 'payu');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::uses('Xml', 'Utility');
App::uses('Hash', 'Utility');
// ob_start();


class HomeController extends AppController
{
    public $helpers = array('Session','Html','Js','Form','Paginator','Flash','Module');
    public $uses = array('Category','User','EmailTemplate','ProviderService', 'RateNReview','Favourite','Tag','SeekerRequirement','SubmitQuote');
	public $components = array(
						'Session','Email','RequestHandler','Cookie','Paginator','Flash', 
						'Auth' => array(
							'loginAction' => array('controller'=>'home', 'action'=>'login'),
							'loginRedirect' => array('controller' => 'home', 'action' => 'dashboard'),
							'logoutRedirect' => array('controller' => 'home', 'action' => 'index'),
							'authenticate' => array(
							    'Form' => array(
							    	'fields' => array(
							    		'username' => 'email',
							    		'password' => 'password'
							    	),
							        'passwordHasher' => array(
							        	'className' => 'Simple',
							        	'hashType' 	=> 'sha256'
							        ),
							        // 'scope' => [
							        //     'User.type' => ['0','2']
							        // ]
							    )
							),
							// 'authenticate' => array('all' => array('scope' => array('User.status' => 1)),
							// 'Form' => array('fields' => array('email' => 'email')),
							'authError' => "You can't access that page",
							'authorize' => array('Controller')
							),
						);

	
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
		$this->Auth->allow('index','login','signup','provider_list','seeker_list','provider_solution_view','provider_details','provider_all_solutions','validate_user','forgot_password','update_user','change_password','list_favourite_solution','myaccount','seeker_requirement_view','submit_quote','my_requirement_detail');

		$this->loadModel('User');

		// this data available to each view
		$categories = $this->Category->find('list',array(
        'conditions' => array('Category.parent' => 0) ));

		$id = $this->Auth->user('id');
		// getting selected categories for provider
		if(AuthComponent::user('type') == 1)
		{
			$this->Paginator->settings = array(
			        'limit' => 10,
			        'conditions' => array('ProviderService.user_id' => $id ),
			        'order' => 'ProviderService.id desc'
			);


			$seeker_solutions = $this->Paginator->paginate('ProviderService');

			$seeker_cat_ids = [];

			foreach ($seeker_solutions as $key => $seeker) {
				// echo "<pre>";
				$seeker_cat_ids[] = $seeker['ProviderService']['category_id']; 
			}


		 	$cat_names = $this->Category->find('all', array('conditions' => array('Category.id' => $seeker_cat_ids ) ) );
		 // 	echo "<pre>";
			// print_r($cat_names);
		 // 	echo "</pre>";
		 // 	die();

		 	$cat_count = count($cat_names);

			$this->set(compact('cat_names','cat_count'));


		 	// pr($cat_names);die();

		}

		// provide overall rating of the particular provider(Company)
		$rating_all_records = $this->RateNReview->find('all');

		$this->set(compact('categories','rating_all_records'));


		/*Seeker notifications count unread notifications*/
		$this->Paginator->settings = array(
		        'limit' => 10,
		        'conditions' => array('SubmitQuote.quote_to' => $id, 'SubmitQuote.read_status' => 0),
		        'order' => 'SubmitQuote.id desc'
		  );


		$quote_list = $this->Paginator->paginate('SubmitQuote');
		$quote_count = count($quote_list);
		$this->set(compact('quote_list','quote_count'));

		// pr($quote_list); die();
	}


	// showing categories listing
	public function index()
	{
		$this->loadModel('User');

	}

	public function login() {

		if ($this->request->is('post')) 
		{
			$email = $this->request->data['User']['email'];

	        $userfind = $this->User->find('all', array('conditions' => array('User.email' => $email,'User.status' => 1 ) ));

	        // pr(count($userfind));die();
	        if (count($userfind) > 0 ) 
	        {
		        if ($this->Auth->login()) 
		        {
		            $this->redirect(array('action' => 'index'));
		        }
		        $this->Flash->error(__('Invalid username or password, try again'));
	        }else{
		        $this->Flash->error(__('User activation failed'));

	        }

	    }


  	}

	public function logout() {
	    if($this->Auth->logout())
	    	$this->redirect('index');
	}

	public function dashboard($value='')
	{
		// pr('i am in dashboard');die();
	}

	public function validate_user($id='')
	{
		$new_regist_user_id = $this->request->query['id'];

		// Update user status so that he can use his login credentials.
		$this->User->updateAll(array('status'=>1),array("id"=>$new_regist_user_id));

		$this->Flash->success(__('User Validated successfully, You can login now.'));
		return $this->redirect('login');
	}
	 
	 public function signup() {
		$this->loadModel('User');

	     if ($this->request->is('post')) {

	     	$user = $this->request->data;

	     	$this->User->data['name'] = $this->request->data['name'];
	     	$this->User->set($this->request->data);


	         if ($this->User->save()) {


	         	    $emailTemplate = $this->EmailTemplate->findBySlug('signup');
	         		// pr($emailTemplate);die;
	         	    if( !empty($emailTemplate) )
	         	    {
	         	        $password = $user['password'];
	         	        $lastid = $this->User->id;
	         	        $link = "http://globizdevserver.com/gokaddal-staging/home/validate_user?id=".$lastid;
	         	        $body = str_replace( ['{name}', '{link}'], [$user['name'], $link], $emailTemplate['EmailTemplate']['body'] );

	         	        $param['email'] = $user['email'];
	         	        $param['body'] = $body;

	         	        $this->mail($emailTemplate, $param);    

	         	        // $this->Flash->success(__('Reset password email sent successfully'));
	         	        // $this->redirect('login');
			             $this->Flash->success(__('Email sent, please verify your email to login.'));
			             return $this->redirect(array('action' => 'signup'));

	         	    }
	         	    return false;

	         }


	         $this->Flash->error(__('The user could not be saved. Please, try again.'));
	     }
	 }


	 public function provider_list($id='')
	 {




	 	// Getting User type
	 	$userType = $this->Auth->user('type');

	 	/*If user type is seeker(User.type = 2) then fetch Providers*/
	 	if ( $userType == 2 )  
	 	{

		 	$userid = $this->Auth->user('id');

		 	$user = $this->User->findById($userid);
		 	$seeker_requirement = $user['SeekerRequirement'];

		 	foreach ($seeker_requirement as $key => $requirement) 
		 		$cat_ids[] = $requirement['category_id'];
		 	
	 		$provider_with_req_cat = $this->ProviderService->find('all', array('conditions' => array('ProviderService.category_id' => $cat_ids ) ));


	 		foreach ($provider_with_req_cat as $key => $provider)
	 		{ 
	 			$ids[] = $provider['ProviderService']['user_id'];
	 		}

	 		$user_ids = array_unique($ids);

			$this->Paginator->settings = array(
			        'limit' => 10,
			        'conditions' => array('User.id ' => $user_ids),
			        'order' => 'User.id desc'
			  );

	 	/*If user type is seeker(User.type = 1) then fetch Seekers*/
	 	} elseif ($userType ==  1) {

			$this->Paginator->settings = array(
			        'limit' => 10,
			        'conditions' => array('User.id != ' => 1,'User.type ' => 2 ),
			        'order' => 'User.id desc'
			  );

	 	/*If user is not logged in*/
	 	}else{

			$this->Paginator->settings = array(
			        'limit' => 10,
			        'conditions' => array('User.id != ' => 1, 'User.type ' => 1),
			        'order' => 'User.id desc'
			  );

	 	}

			$user_list = $this->Paginator->paginate('User');
			$count = count($user_list);
			$this->set(compact('user_list','count'));

	 }

	 public function provider_details($id='')
	 {

	 	/*Already given rating to this company*/

	 	// Getting user id of logged in user
	 	$login_id = $this->Auth->user('id');
	 	$check_rating = $this->RateNReview->find('all',array('conditions' => array('RateNReview.user_id' => $login_id) ));


 		$this->set(compact('check_rating'));

	 	if ($id) {
	 		$provider = $this->User->findById($id);
	 		$this->set(compact('provider'));
	 	}
	 }


	 public function show_selected_category($id='')
	 {

	 	 	if ($id) 
	 	 	{

	 			$this->Paginator->settings = array(
	 			        'limit' => 10,
	 			        'conditions' => array('ProviderService.id' => $id ),
	 			        'order' => 'ProviderService.id desc'
	 			  );

	 			$provider_all_solution = $this->Paginator->paginate('ProviderService');
	 			$solution_count = count($provider_all_solution);
	 			// pr($solution_count);die();

	 	 		$this->set(compact('provider_all_solution','solution_count'));

	 	 		$this->redirect('provider_all_solutions');
	 	 	}

	 }


	 public function provider_all_solutions($id='')
	 {


			/*List all solutions based on category selected*/
		 	if ($this->request->query) 
		 	{
		 		$id = $this->request->query['id'];
	 		// pr($this->request->query);die();

	 			$this->Paginator->settings = array(
	 			        'limit' => 10,
	 			        'conditions' => array('ProviderService.category_id' => $id ),
	 			        'order' => 'ProviderService.id desc'
	 			);


	 			$provider_all_solution = $this->Paginator->paginate('ProviderService');
	 			// pr($provider_all_solution);die();
	 			$solution_count = count($provider_all_solution);

	 	 		$this->set(compact('provider_all_solution','solution_count'));

	 	 		// $this->redirect('provider_all_solutions');

		 	}else
		 	{

				/*List all solutions based on company selected*/
			 	if ($id) 
			 	{

					$this->Paginator->settings = array(
					        'limit' => 10,
					        'conditions' => array('User.id' => $id ),
					        'order' => 'ProviderService.id desc'
					  );

					$provider_all_solution = $this->Paginator->paginate('ProviderService');
					$solution_count = count($provider_all_solution);

			 		$this->set(compact('provider_all_solution','solution_count'));
			 	}
	 		}
	 }

	 /*when provider is logged in*/
	 public function seeker_selected_category($value='')
	 {

	 	if ($this->request->query) 
	 	{
	 		$catid = $this->request->query['id'];
 		// pr($this->request->query);die();

	 		// $this->SeekerRequirement->find('all', array('conditions' => array('SeekerRequirement.category_id' => $catid ) ) );

 			$this->Paginator->settings = array(
 			        'limit' => 10,
 			        'conditions' => array('SeekerRequirement.category_id' => $catid ),
 			        'order' => 'SeekerRequirement.id desc'
 			);


 			$seeker_requirements = $this->Paginator->paginate('SeekerRequirement');
 			// pr($seeker_requirements);die();
 			$seeker_req_count = count($seeker_requirements);

 	 		$this->set(compact('seeker_requirements','seeker_req_count'));

 	 		// $this->redirect('provider_all_solutions');

	 	}


	 // 	$id = $this->Auth->user('id');

		// $this->Paginator->settings = array(
		//         'limit' => 10,
		//         'conditions' => array('ProviderService.user_id' => $id ),
		//         'order' => 'ProviderService.id desc'
		// );

		// $seeker_solutions = $this->Paginator->paginate('ProviderService');
	 	
	 	// pr($seeker_solutions);die();
	 	# code...
	 }

	 public function rating_n_reviews($value='')
	 {

	 	$this->loadModel('RateNReview');
	 	if ($this->request->is('post')) {
	 		
	 		$this->request->data['user_id'] = $this->Auth->user('id'); 

	 		if($this->RateNReview->save($this->request->data)) 
	 		{
	 			$this->Flash->success(__('Thank for rating'));
	 		    $this->redirect($this->referer());
	 		}

	 		$this->Flash->error(__('Problem while giving rating, Please try again'));
	 	 	$this->redirect($this->referer());
	 	}

	 }

	 public function provider_solution_view($id='')
	 {
	 	if ($id) {
	 		$providerservice = $this->ProviderService->findById($id);
	 		$this->set(compact('providerservice'));
	 	}

	 }

	 public function save_to_favourites($value='')
	 {

	 	$user_id = $this->Auth->user('id');
	 	$provider_service_id = $this->request->query['provider_service_id'];
	 	$company_id = $this->request->query['company_id'];

	 	$rating_exists = $this->Favourite->find('all',array('conditions' => array(
	 							'Favourite.user_id' => $user_id,
	 							'Favourite.provider_service_id' => $provider_service_id,
	 							'Favourite.company_id' => $company_id
	 						)));

	 	if (count($rating_exists) > 0 ) 
	 	{ 
	 		$this->Flash->error(__('Already in your favourite list'));
	 	 	$this->redirect($this->referer());
	 	}

	 	$this->set(compact('rating_exists'));
	 	// pr($rating_exists);die();

	 	$this->Favourite->data['provider_service_id'] = $provider_service_id;
	 	$this->Favourite->data['company_id'] = $company_id;
	 	$this->Favourite->data['user_id'] = $user_id;

	 	if ($this->Favourite->save($this->Favourite->data)) {
	 			$this->Flash->success(__('Saved to Favourite successfully'));
	 		    $this->redirect($this->referer());
	 	}
	 		$this->Flash->error(__('Problem saving favourite'));
	 	 	$this->redirect($this->referer());
	 }

	 public function myaccount($value='')
	 {
	 	$id = $this->Auth->user('id');
	 	$userdata = $this->User->findById($id);

	 	$this->set(compact('userdata'));

	 	// pr($userdata);die();
	 }

	 public function post_requirement($id='')
	 {
	 	$login_id = $this->Auth->user('id');
 	 	$tags = $this->Tag->find('all');
 	 	// $userdata = $this->User->find($login_id);
 	 	$this->set(compact('tags'));

 	 	if ($id) {
 	 		$editrequirement = $this->SeekerRequirement->findById($id);
 	 		$this->set(compact('editrequirement'));


 			// $this->Flash->success(__('Your requirement is updated successfully'));
 		    // $this->redirect('post_requirement');
 	 	}



	 	if ($this->request->is('post','put')) {

	 		$this->request->data['user_id'] = $login_id;

	 		if ($this->SeekerRequirement->save($this->request->data)) {
			
				if (isset($this->request->data['id'])) {
					$this->Flash->success(__('Requirement updated successfully'));
				    $this->redirect($this->referer());
					
				}
				$this->Flash->success(__('Requirement added successfully'));
			    $this->redirect($this->referer());
 			}
 				$this->Flash->error(__('Problem saving requirement'));
 			 	$this->redirect($this->referer());

	 	}
	 }


	 public function post_solution($value='')
	 {
	 	# code...
	 }

	 public function my_requirement($value='')
	 {

	 	/*showing logged user requirements he posted*/
	 	$current_user_id = $this->Auth->user('id');


		$this->Paginator->settings = array(
		        'limit' => 10,
		        'conditions' => array('SeekerRequirement.user_id' => $current_user_id ),
		        'order' => 'SeekerRequirement.id desc'
		  );

		$userdata = $this->Paginator->paginate('SeekerRequirement');

		$count = count($userdata);
	 	$this->set(compact('userdata','count'));

	 	// pr($userdata);die();
	 }

	 /*view single requirement of seeker*/
	 public function my_requirement_detail($id='')
	 {
	 	 	// $tags = $this->Tag->find('all');
	 	 	// $this->set(compact('tags'));

	 	 	if ($id) {
	 	 		$requirement = $this->SeekerRequirement->findById($id);

				$userids = [];
	 	 		foreach ($requirement['SubmitQuote'] as $key => $quote_contact) {
	 	 			$userids[] =  $quote_contact['user_id'];
	 	 		}

	 	 		$users = $this->User->find('all', array('conditions' => array('User.id' => $userids ) ) );

	 	 		$onlyusers = [];

	 	 		foreach ($users as $key => $user) {
	 	 			$onlyusers[] =  $user['User'];
	 	 		}

	 	 		// $usercontacts = 
	 	 		// pr($onlyusers);die();

				 	 		// die();
	 	 		$this->set(compact('requirement','onlyusers'));

	 	 		// pr($requirement);die();


	 			// $this->Flash->success(__('Your requirement is updated successfully'));
	 		    // $this->redirect('post_requirement');
	 	 	}
	 
	 }

	 /*edit single requirement of seeker*/
	 public function edit_requirement($id='')
	 {
	 	// $login_id = $this->Auth->user('id');
	 	$tags = $this->Tag->find('all');
	 	$this->set(compact('tags'));

	 	if ($id) {
	 		$editdata = $this->SeekerRequirement->findById($id);
	 		$this->set(compact('editdata'));

			$this->Flash->success(__('Your requirement is updated successfully'));
		    $this->redirect('post_requirement');
	 	}

	 	// if ($this->request->is('post')) 
	 	// {
	 	// 	$this->request->data['user_id'] = $login_id;
	 	// 	// pr($this->request->data);die();

	 	// 	if ($this->SeekerRequirement->save($this->request->data)) 
	 	// 	{
			
			// 	$this->Flash->success(__('Requirement added successfully'));
			//     $this->redirect($this->referer());
 		// 	}
 		// 		$this->Flash->error(__('Problem saving requirement'));
 		// 	 	$this->redirect($this->referer());

	 	// }
	 
	 }

	 /*delete single requirement of seeker*/
	 public function delete_requirement($id='')
	 {
	 	if($this->SeekerRequirement->delete($id))
	 		$this->Flash->error(__('Requirement deleted successfully.'));
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

	/*send forgot password email starting code here*/
	public function forgot_password() 
	 {
	     if( $this->request->is('post') ) 
	     {
	         if(!empty($this->request->data['email'])) 
	         {
	 			// pr($this->request->data); die();

	             $this->User->recursive = -1;
	             $userInfo = $this->User->findByEmail($this->request->data['email']);

	             if (count($userInfo) < 1 ) {
		             $this->Flash->success(__("Your email is not matching with our records, try again"));
		             $this->redirect('login');
	             	# code...
	             }
	         	// pr($userInfo);die();

	             App::uses('CakeText', 'Utility');
	             mt_srand(mktime());
	             $userInfo['User']['password'] = mt_rand();
	             // $userInfo['User']['code'] = CakeText::uuid();
	             $this->User->save($userInfo);
	             $this->sendForgotPasswordEmail($userInfo['User']);
	         }
	     
	     }
	 }


	public function update_user($data='')
	{

		// pr($data);die();

		// $this->loadModel('User');
		// unset($this->request->data['User']['email']);
		// $userdata['User'] = $this->Auth->user();
		// unset($userdata['User']['password'] = );

		
		$user = $this->request->data;

		unset($this->User->validate['password'],$this->User->validate['email'], $this->User->validate['type']);
		// pr($user);die();
		// $user['User']['id'] = $this->Auth->user('id');
		// // $validator = $this->User->validator();

		// $user['User']['name'] = $this->request->data['User']['name'];

		// unset($user['User']['password']);
		// $user1['User']['id'] = $this->request->data['User']['id'];

			// pr($user1);die();

        // unset($validator['password'],$validator['contact']);
		if($this->request->is('post'))
		{
				// pr($this->request->data);die();
			if ( $this->User->save($user) ) 
			{
				$this->Flash->success(__('User Information updated successfully'));
				$this->redirect($this->referer());
			}


			// debug($this->User->validationErrors); //show validationErrors

			// echo 'i am in between';

			// debug($this->User->getDataSource()->getLog(false, false)); //show last sql query
			// die();


			$this->Flash->success(__('Some error occur in updation, please try'));
			$this->redirect($this->referer());
		}

	}

	public function change_password($value='')
	{
		    	if($this->request->is('post'))
		    	{

		    		$user = $this->request->data;
					$userData = $this->User->findById($this->Auth->user('id'));
		    		// pr($user);die();
					$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
		            $password = $passwordHasher->hash($user['User']['current_password']);

					/*Checking if current password is matching with user table password*/
					if($userData['User']['password'] != $password){
						$this->Flash->error(__("Please enter correct current password."));
						$this->redirect($this->referer());
					}


					/*Checking if new_password is matching with confirm_password password*/
		            if ($user['User']['new_password'] != $user['User']['confirm_password']) {
		                
		                $this->Session->setFlash('Password does not match.');
		                $this->redirect($this->referer());
		            }


		    		unset($this->User->validate['email'],$this->User->validate['name'], $this->User->validate['type'], $this->User->validate['contact']);

		            $user['id'] = $userData['User']['id'];
		            $user['password'] = $user['User']['new_password'];

		    		unset($user['User']['current_password'],$user['User']['new_password'],$user['User']['confirm_password']);

					if($this->User->save($user))
					{
						$this->Session->setFlash('Password Updated successfully');

		                $this->redirect('change_password');
					}

					// debug($this->User->validationErrors); //show validationErrors

					// debug($this->User->getDataSource()->getLog(false, false)); //show last sql query
					// die();


						$this->Session->setFlash('Password Not Updated');

		                $this->redirect('change_password');

		    	}
	}

	/*list favourite solutions of seeker in myaccount*/	
	public function list_favourite_solution($value='')
	{
		$userdata = $this->User->findById($this->Auth->user('id'));
		// $userdata['Favourite'];
		$fav_prov_list_ids = [];

		foreach ($userdata['Favourite'] as $key => $service) 
			$fav_prov_list_ids[] = $service['provider_service_id'];


				$this->Paginator->settings = array(
				        'limit' => 10,
				        'conditions' => array('ProviderService.id ' => $fav_prov_list_ids),
				        'order' => 'ProviderService.id desc'
				  );


				$fav_services = $this->Paginator->paginate('ProviderService');
				$service_count = count($fav_services);

		$this->set(compact('fav_services','service_count'));

		// echo "<pre>";
		// print_r($fav_providers);die();
		// echo "</pre>";

	}

	/*delete single requirement of seeker*/
	public function delete_favourite_solution($id='')
	{

		if($this->Favourite->delete($id))
			$this->Flash->error(__('Service deleted successfully.'));
		else
			$this->Flash->error(__('Error in deleting service, Please contact admin.'));
		$this->redirect($this->referer());

	
	}

	 public function seeker_list($value='')
	 {

	 	if (!$this->Auth->loggedIn()) {
 			$this->Paginator->settings = array(
 			        'limit' => 10,
 			        // 'conditions' => array('SeekerRequirement. ' => $cat_ids),
 			        'order' => 'SeekerRequirement.id desc'
 			  );
				
				$seeker_list = $this->Paginator->paginate('SeekerRequirement');
				// pr($seeker_list);die();
				$count = count($seeker_list);
				$this->set(compact('seeker_list','count'));

	 	}else{

 		 	$userid = $this->Auth->user('id');


 		 	$user = $this->User->findById($userid);
 		 	$provider_dealsin = $user['ProviderService'];

 		 	$cat_ids = [];

 		 	// got the categories in which provider deals, now we need to find in seeker_requiements tables for the same category
 		 	foreach ($provider_dealsin as $key => $provider) 
 		 		$cat_ids[] = $provider['category_id'];

 		 		$cat_ids = array_unique($cat_ids);

 		 	// pr('provider deals in following categories');
 		 	// print_r($cat_ids);
 		 	// echo "<br><br><br>";


 		 	/*if no category found in provider_services table for the logged in provider*/
 		 	if (count($cat_ids) < 1 ) {
 		 		$seeker_list = 0;
 		 		$this->set(compact('seeker_list'));
 		 	}else{

	 			$this->Paginator->settings = array(
	 			        'limit' => 10,
	 			        'conditions' => array('SeekerRequirement.category_id ' => $cat_ids),
	 			        'order' => 'SeekerRequirement.id desc'
	 			  );
 				
 				$seeker_list = $this->Paginator->paginate('SeekerRequirement');
 				// pr($seeker_list);die();
 				$count = count($seeker_list);
 				$this->set(compact('seeker_list','count'));
 		 		
			}

	 	} //logged in end
	 		 		/*category records in which logged in provider deals*/
		 	 		// $seeker_services = $this->ProviderService->find('all', array('conditions' => array('ProviderService.category_id' => $cat_ids ) ));

		 	 		/*we have got the categories of provider, now we need to check same category in which seeker deals in seeker_requiements table*/

		 	 		// foreach ($seeker_services as $key => $provider)
		 	 		// { 
		 	 		// 	$ids[] = $provider['ProviderService']['user_id'];
		 	 		// }

		 	 		// /**/
		 	 		// $user_ids = array_unique($ids);
		 		 	// pr($ids);die();


	 	// $data = $this->Auth->user('id');

	 	// $this->Paginator->settings = array(
	 	//         'limit' => 10,
	 	//         'conditions' => array('User.id !=' => 1,'User.type ' => 2 ),
	 	//         'order' => 'User.id desc'
	 	//   );


	 	// pr($seeker_list);die();
	 	// $count = count($seeker_list);
	 	// $this->set(compact('seeker_list','count'));

	 }

	 /*showing each requirement of seeker as per request*/
	public function seeker_requirement_view($id='')
	{
		if($id) 
		{
			$seeker_req = $this->SeekerRequirement->findById($id);
			// pr($seeker_req);die();
			$this->set(compact('seeker_req'));
		}

	}

	public function submit_quote($id='')
	{
		// pr($this->request->data['SubmitQuote']['user_id']);die();
		$userid = $this->request->data['SubmitQuote']['user_id'];
		$quoteto = $this->request->data['SubmitQuote']['quote_to'];
		$seekerrequirementid = $this->request->data['SubmitQuote']['seeker_requirement_id'];

		/*check if provider already submitted code to the particular Seeker requirement*/
		$check_quote = $this->SubmitQuote->find('all', array('conditions' => array(
																		'SubmitQuote.user_id' => $userid, 
																		'SubmitQuote.quote_to' => $quoteto, 
																		'SubmitQuote.seeker_requirement_id' => $seekerrequirementid, 
																	)));
		if ( count($check_quote) > 0 ) {
			$this->Flash->error('You already submitted quotation for this requirement');
			// $this->redirect($this->referer());
			
		}else{
			$this->SubmitQuote->save($this->request->data);
			$this->Flash->success(__('Quotation submitted successfully'));
		}
		
		$this->redirect($this->referer());
	}

	// seeker quotation notification count and messages
	public function seeker_notification($value='')
	{

		$id = $this->Auth->user('id');
		$this->Paginator->settings = array(
		        'limit' => 10,
		        'conditions' => array('SubmitQuote.quote_to' => $id),
		        'order' => 'SubmitQuote.id desc'
		  );


		$quote_list = $this->Paginator->paginate('SubmitQuote');
		$count = count($quote_list);
		$this->set(compact('quote_list','count'));

		// pr($quote_list);die();


		/*Mark each notifications as read*/
		foreach ($quote_list as $key => $quote) {

			// updating each record as read
			$update_record['SubmitQuote']['id'] = $quote['SubmitQuote']['id'];
			$update_record['SubmitQuote']['read_status'] = $quote['SubmitQuote']['read_status'] = 1;
			$this->SubmitQuote->save($update_record);
		}
		// die();
		// $quote_count = count($quote_list);
	

	}

} 
?>

