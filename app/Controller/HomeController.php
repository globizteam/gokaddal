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
    public $uses = array('Category','User','EmailTemplate','ProviderService', 'RateNReview','Favourite','Tag','SeekerRequirement');
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
		$this->Auth->allow('index','login','signup','provider_list','seeker_list','provider_solution_view','provider_details','provider_all_solutions','validate_user');

		// this data available to each view
		$categories = $this->Category->find('list',array(
        'conditions' => array('Category.parent' => 0) ));


		// provide overall rating of the particular provider(Company)
		$rating_all_records = $this->RateNReview->find('all');

		$this->set(compact('categories','rating_all_records'));

		// pr($rating_all_records); die();
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
	 	if ($userType ==  2 )  
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

	 public function provider_all_solutions($id='')
	 {
	 	if ($id) {

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
	 	// pr('i am in myaccount');die();
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
	 public function view_requirement($id='')
	 {
	 	pr('i am view_requirement');die();
	 
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


	 public function seeker_list($value='')
	 {

	 }

	 // private function sendForgotPasswordEmail($user)
	 // {
	 // 	//pr($user);die;
	 // 	$Email = new CakeEmail();
	 // 	$Email->config('default');
	 // 	$Email->from(array('hardeep_singh4u@yahoo.co.in' => 'My Site'));
	 // 	$Email->to('hardeep_singh4u@yahoo.co.in');
	 // 	$Email->subject('About');
	 // 	$Email->send('My message');
	 //     return true;
	 // }
} 
?>

