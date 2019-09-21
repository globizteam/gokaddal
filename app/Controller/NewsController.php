<?php

/**
 * summary
 */
class NewsController extends AppController
{
    public $uses = array('User','EmailTemplate','Organisation', 'Department', 'Designation','Category','DesignationCategory','New','NewsCategory', 'NewsDepartment', 'NewsDesignation','NewsOrganization','NewComment');
    public $components = array('Session','Paginator','RequestHandler');
    public $hepler = array('Session','Paginator');
    public $layout = 'admin_dashboard';
    

    public function admin_manage_news() {
    	
        $this->Paginator->settings = array(
                'limit' => 25,
                'order' => 'New.id desc'
            );
        $news = $this->Paginator->paginate('New');

        $thirdparty_js = [
            'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
        ];

        $this->set(compact('thirdparty_js','news'));
    }

    public function admin_deleteNew($model = null, $categoryId = null){
        $destination = realpath('../webroot/img/news/'). '/'.$_GET['catName'];
        unlink($destination);
        if($this->$model->delete($categoryId))
            $this->Flash->error(__('Data deleted successfully.'));
        else
            $this->Flash->error(__('Error in deleting data, Please contact admin.'));
        $this->redirect($this->referer());

    }

    public function admin_addNew($categoryId = null) {

        if(!empty($categoryId)){
            $category = $this->Category->findById($categoryId);

            if(!$this->request->data)
                $this->request->data = $category;

        }

        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            $imgName = time().'-'.$_FILES['image']['name'];
            if(!empty($_FILES['image']['tmp_name'])){
                $destination = realpath('../webroot/img/category/'). '/';
                move_uploaded_file($_FILES['image']['tmp_name'],$destination.$imgName);
                $postData['Category']['image'] = $imgName;
            }
            if ($this->New->saveAll($postData)) 
            {
                
            } 
        }
        
    }

 public function admin_add_news($newsId = null) {
        App::uses('Hash', 'Utility');

        $this->layout = 'admin_dashboard';
        $this->loadModel('News');
        $this->loadModel('users');
        //Users
        
        $conditions = [];
		$conditions = array(
						'User.id !=' => 1
					);
	
		 
    	$users = $this->Paginator->paginate('User');
		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];
        $element1 = 'js/user_list';
        $elementData1='';
		$this->set(compact('thirdparty_js','users','element1', 'elementData1'));

        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            // echo $postData['users']; die();
            if(!empty($_FILES['file']['tmp_name'])) {
                    $imgName = time().'-'.$_FILES['file']['name'];
                    $path = WWW_ROOT.'img/news';
                    if(!is_dir($path)) {
                        mkdir($path,0777);
                    }
                    $destination = $path. '/';
                    move_uploaded_file($_FILES['file']['tmp_name'],$destination.$imgName);
                    $postData['New']['file'] = $imgName;
               
            }
            if(!empty($_FILES['thumbnail']['tmp_name'])) {
                    $imgName_thumbnail = time().'-thumbnail-'.$_FILES['thumbnail']['name'];
                    $path = WWW_ROOT.'img/news';
                    if(!is_dir($path)) {
                        mkdir($path,0777);
                    }
                    $destination = $path. '/';
                    move_uploaded_file($_FILES['thumbnail']['tmp_name'],$destination.$imgName_thumbnail);
                    $postData['New']['thumbnail'] = $imgName_thumbnail;
               
            }
            $selectedCategories =$postData['DesignationCategory']['category_id'] ;
            unset($postData['DesignationCategory']['category_id'], $postData['New']['departments'], $postData['New']['designations'], $postData['New']['organizations'] );
                $postData['New']['users'] =$postData['users'];
            //print_r($postData);die;
            if( $this->New->save($postData) ) {
                $newsId =  $this->New->id;
                $newsCategory = [];
         
                $this->NewsCategory->deleteAll(['news_id' => $newsId]);
                foreach ($selectedCategories as $key => $categ) {
                    $newsCategory[$key]['category_id'] = $categ;
                    $newsCategory[$key]['news_id'] = $newsId;
                }
                $this->NewsCategory->saveMany($newsCategory);

                $this->redirect(['action'=>'manage_news', 'admin' => true ]);
            }
        }

        if( !empty($newsId) ) {
            $news= $this->News->find('first', [
                'conditions' => [
                    'News.id' => $newsId
                ],
                'recursive' => 2
            ]);
            $this->request->data['New'] = $news['News'];

            $selectedCategories = Hash::extract($news['NewsCategory'],'{n}.category_id');
            $selectedDepartments = Hash::extract($news['NewsDepartment'],'{n}.department_id');
            $selectedDesignations = Hash::extract($news['NewsDesignation'],'{n}.designation_id');
            $selectedOrganizations = Hash::extract($news['NewsOrganization'],'{n}.organization_id');
             
            $this->set(compact('selectedCategories','selectedDepartments','selectedDesignations', 'selectedOrganizations'));
        }
        $designations = $this->Designation->find('list');
        $departments = $this->Department->find('list');
        $this->Category->bindModel(['hasMany'=> [
            'Subcategory' => [
                'className' => 'Category',
                'foreignKey' => 'parent'
            ]
        ] ]);
        $categories = $this->Category->find('all',['conditions'=>['parent'=>'0']]);
        $organizations =  $this->Organisation->find('list');
          
        $thirdparty_js = [
            'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js',
            'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'
        ];  
        
        $element = 'js/add_news';
        $elementData='';
        $this->set(compact('designations', 'departments', 'categories', 'thirdparty_js', 'element', 'elementData', 'organizations'));

        
    }
    
    public function admin_post_list()
    {
      $this->layout = "admin_dashboard";
      $this->loadModel('posts');
      //$specials = $this->Course->findAllByStatus(0);
     $this->Paginator->settings = array('posts' => array('limit' => 100));
      $specials=$this->paginate('posts');
      $this->set(compact('specials'));
    }
          
    
   public function admin_add_post($id=null)
    {
      $this->layout = "admin_dashboard";
      $this->loadModel('posts');
      $this->loadModel('categories');
    //   $this->loadModel('sub_cats');
      $this->loadModel("users");
      $user_list=$this->users->findAllByStatus(1);
      $this->set(compact('user_list'));
    //   $specials1=$this->User->findAllByStatus(0);
      $specials2 = $this->categories->findById();
    //   $subcategory = $this->sub_cats->findAllByStatus(0);
    //   $this->set(compact('sub_cat'));
      $id = base64_decode($id);
      $content = $this->posts->findById($id);
      
      //echo "<pre>";print_r($content);print_r($content1);print_r($content2);die;      
      $this->set(compact('content','specials2'));
      if($this->request->is('post'))
      {
        $data = $this->data;
        $data['posts']['id'] = $id;
        //echo "<pre>";print_r($_FILES['image']);
        
 if (!empty($_FILES['image']['name'])) {
 $total = count($_FILES['image']['name']);

  for($i=0; $i<count($_FILES['image']['name']); $i++) {
  $tmpFilePath = realpath('../webroot/img/Ads/').'/';
  if ($tmpFilePath != ""){
      
   $newFilePath = $tmpFilePath.$_FILES['image']['name'][$i];
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
 $data['posts']['image'] = $_FILES['image']['name'];
//  echo $data['Advertisement']['image'] ; die();
} 
  }
 
}

}
        //echo "<pre>";print_r($data);die;
        $data['posts']['title'] = $data['title'];
        $data['posts']['descr'] = $data['desc'];
        // $data['Advertisement']['type'] = $data['cont2'];
        $data['posts']['courseid'] = $data['cont3'];
      //  $data['posts']['subcat'] = $data['sub_category'];
        $data['posts']['updated_date'] = date("Y-m-d");
        // $data['Advertisement']['sell_name'] = $data['sell_name'];
        $data['posts']['sell_name']=$data['User'];
        $data['posts']['price']=$data['price'];
        $name=$data['posts']['sell_name'];
    //   $type=  $this->User->find('', array(
    //                     'select' =>'type',
    //                     'conditions' => array(
    //                         'User.name' => $name,
    //                         // 'Account.password' => $password
    //                     )
    //                 ));
//   $type= $this->User->find()->select('type')->where(['name'=>'$name']);
//         echo $type; die();
        $this->posts->save($data);
        $this->Session->write('success-msg','Course Content Updated!');
        $this->redirect(array('action' => 'advertslist')); 
      }
    } 
   

    public function admin_addComment($newsId = null){
        $userId = $this->Auth->user('id');
        $comment = $this->NewComment->findByNewsIdAndUserId($newsId,$userId);
        $comment['NewComment']['user_id'] = $userId;
        $comment['NewComment']['news_id'] = $newsId;
        //pr($comment);die;
        if(!$this->request->data)
            $this->request->data = $comment;
        if($this->request->is(array('post','put'))){
            $data = $this->data;
            //pr($data);die;
            $this->NewComment->save($data);
            $this->Flash->error(__('Comment added successfully.'));
            $this->redirect('manage_news');
        }

    }
}