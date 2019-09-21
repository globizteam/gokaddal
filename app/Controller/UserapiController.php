<?php
header("Access-Control-Allow-Origin: *");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
require_once VENDORS."gumlet/php-image-resize/lib/ImageResize.php";
use \Gumlet\ImageResize;

class UserapiController extends AppController
{
	public $components = array('RequestHandler');
	public $uses = ['User','EmailTemplate', 'Page', 'Category','Store', 'News','NewsLike','NewsViewCount', 'UserNews'];
	
	public function beforeFilter()
    {
    	if($this->request->prefix != 'admin')
    	{
    		$this->Auth->allow('signUp','contact','login','getplan','getSubCategories', 'forgotPassword','createStoreParams', 'privacypolicy','uploadImage', 'createStore', 'createStoreFinalStep', 'uploadImageStore','getStoreInformation', 'get_news', 'getNewsInformation', 'getCategories', 'addLike', 'getRecentViewedNews','changePassword', 'newsView', 'getNotifications', 'clearNotifications','about_us', 'terms', 'readNews');
    	}
    }

	  public function signUp() {
        $message = '';
        $status = false;
        $error = 'sdsadsad';
        if( $this->request->is('post') )
        {
            $postData  = $this->request->input('json_decode' , true);
            //$error=$postData;
            $this->User->create();
            $postData['status'] = '1';
            $postData['type'] = '2';
            $this->User->set($postData);
            
            if ($this->User->save()) {
                $message = 'Your account is created please login';
                $status = false;
                $this->sendEmail($postData , 'signup');
                
            
            } else {
                $error = $this->validateErrors($this->User);
                
                $message = 'One or more fields are having error, please check.';
                $status = false;
            }    
        }
        
        $this->set(array(
            'data' => [
            	'msg' => $message,
            	'status' => $status ,
            	'error' => $error
            ],
            '_serialize' => array('data')
        ));
    }
    
    public function getplan() {
        $this->loadModel('Plan');
        $message = '';
        $status = false;
        $error = '';
       $categories =  $this->Plan->find('all');
        $this->set(array(
            'data' => [
            	'msg' => $message,
            	'status' => $status ,
            	'error' => $error,
                'data' => $categories
            ],
            '_serialize' => array('data')
        ));
    }
    
    public function contact() {
        $this->loadModel('Contact');
        $message = '';
        $status = false;
        $error = '';
        if( $this->request->is('post') )
        {
            $postData  = $this->request->input('json_decode' , true);
            //$error=$postData;
            $this->Contact->create();
            $error = $this->validateErrors($this->Contact);
            $this->Contact->set($postData);
            
            if ($this->Contact->save()) {
                $message = 'Your message sent successfully.';
                $status = true;
                //$this->sendEmail($postData , 'signup');
                
            
            } else {
                $error = $this->validateErrors($this->Contact);
                
                $message = 'One or more fields are having error, please check.';
                $status = false;
            }    
        }
        
        $this->set(array(
            'data' => [
            	'msg' => $message,
            	'status' => $status ,
            	'error' => $error
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
                // $this->User->virtualFields['path_image'] = "CONCAT('".URL_HOST."/img/user/',profile_pic)";
                $user = $this->User->find('first',[
                        'conditions' => [
                                'email' => $postData['email'],
                                'password' => $password
                        ]
                    ]);
                
                if(empty($user)) {
                    $status = false;
                    $message = 'Wrong Email Id/Password';
                } else {
                    if($user['User']['status'] != '1') {
                        $status = false;
                        $message = 'User is inactive. Please contact administrator';
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
            $message = 'Please enter a valid email address';

            $email = $this->request->input('json_decode', true);
            if(!empty($email['email']))
            {
                $checkEmail = $this->User->find('first', [
                    'conditions' => [ 'email' => $email['email'] ]
                ]);
                
                if(!empty($checkEmail) && $checkEmail['User']['status'] == '1' )
                {
                    $pass = mt_rand(10000,100000);
                   
                    $checkEmail['User']['password'] = $pass;
                    // $checkEmail['User']['status'] = '1';
                    $this->User->save($checkEmail['User'] , false);
                    
                    $checkEmail['User']['password'] = $pass;
                    if( $this->sendForgotPasswordEmail($checkEmail['User']) )
                    {
                        $message = 'Password sent to your email ID.Please check it';
                        $status = true;
                    } else {
                        $message = 'Error Occured during email send';
                        $status = false;
                    }
                } else {
                    $message = 'No Record Found';
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

    public function createStoreParams()
    {
        $data['storeTypes'] = $this->StoreType->find('all',[
            'conditions' => [
                'status' => '1'
            ]
        ]);

        $data['categories'] = $this->Category->find('all');

         $this->set(array(
            'data' => [
                'status' => true ,
                'errors' => [],
                'message' => '',
                'data' => $data
            ],
            '_serialize' => array('data')
        ));
    }

    public function uploadImage($productId) 
    {
        if( !empty($_FILES['file']['name']) )
        {
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $imgName = time().mt_rand().'-img-.'.$ext;
            $this->log($_FILES['file']['tmp_name']); 
            $destination = WWW_ROOT. '/img/product/';
            $destination2 = WWW_ROOT. '/img/product_120/';
            $destination3 = WWW_ROOT. '/img/product_300/';
            move_uploaded_file($_FILES['file']['tmp_name'],$destination.$imgName);
            $image = new ImageResize($destination.$imgName);
            $image->resizeToWidth(120);
            $image->save($destination2.$imgName);
            $image->resizeToWidth(300);
            $image->save($destination3.$imgName);
            $this->ProductImage->create();
            $productImage['ProductImage']['product_id'] = $productId; 
            $productImage['ProductImage']['image'] = $imgName;
            
            if( $this->ProductImage->save($productImage) )
            {
                $this->set(array(
                    'data' => [
                        'msg' => 'Uploaded successfully',
                        'status' => true ,
                        'error' => [],
                        'data' => [
                            'imageId' => $this->ProductImage->getLastInsertID()
                        ],
                        'code' => ''
                    ],
                    '_serialize' => array('data')
                ));
            } else {
                $this->set(array(
                    'data' => [
                        'msg' => 'Error Occured',
                        'status' => false ,
                        'error' => [],
                        'data' => [],
                        'code' => 1002
                    ],
                    '_serialize' => array('data')
                ));
            }    
        }
    }

  

    public function get_news( $offset = 0 ) {
        $news = [];
        if( $this->request->is('post') ) {
            $postData = $this->request->data;
            $imgUrl = 'https://globizdevserver.com/toyk';
            $user_id = isset($postData['user_id'])?$postData['user_id']:0;
            $this->News->virtualFields['total_read'] = "SELECT count(user_news.id) FROM user_news WHERE user_news.news_id=News.id AND user_news.user_id={$user_id}";
            $totalUnreadNews = $this->News->find('count',['conditions'=>['total_read'=>0]]);

            $this->News->virtualFields['file'] ='CONCAT("'.$imgUrl.'","/img/news/",News.file)'; 
            
            $this->News->virtualFields['isLike'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='1' and news_likes.user_id=$user_id";
            $this->News->virtualFields['total_likes'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='1' ";
            $this->News->virtualFields['isUnLike'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='2'  and news_likes.user_id=$user_id";
            $this->News->virtualFields['total_dislikes'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='2'";
            $this->News->virtualFields['view_count'] = "SELECT count(news_view_counts.id) FROM news_view_counts WHERE news_view_counts.news_id = News.id ";
            

            $conditions = [
                'News.status' => '1'
            ];
            $query = 0;

            if( !empty($postData['search_type']) ) {
                switch ($postData['search_type']) {
                    case 'day':
                        $cond = date('Y-m-d', strtotime('-1 day'));
                        $conditions = array_merge($conditions,[
                            'News.created_at >' =>  $cond
                        ]);

                        break;
                    
                    case 'month':
                        $cond = date('Y-m-d', strtotime('-1 month'));
                        $conditions = array_merge($conditions,[
                            'News.created_at >' =>  $cond
                        ]);

                        break;
                    case 'year':
                        $cond = date('Y-m-d', strtotime('-1 year'));
                        $conditions = array_merge($conditions,[
                            'News.created_at >' =>  $cond
                        ]);
                        break;
                    case 'custom':

                        if(!empty($postData['from'])) {
                            $conditions = array_merge($conditions,[
                                'News.created_at >=' =>  $postData['from']
                            ]);
                        }
                        if(!empty($postData['to'])) {
                            $conditions = array_merge($conditions,[
                                'News.created_at <=' =>  $postData['to']
                            ]);
                        }
                        
                        break;
                    
                    default:
                        // code...
                        break;
                }
            }

            if(!empty($postData['category_id'])) {
                $categories = explode(',', $postData['category_id']);
                
                $categorySearch=[];
                $queryArr = [];
                foreach ($categories as $category_id) {
                    $queryArr[] = "FIND_IN_SET($category_id,(SELECT GROUP_CONCAT(news_categories.category_id SEPARATOR ',') FROM news_categories WHERE news_categories.news_id = News.id))";

                }

                $query = implode(' OR ', $queryArr);

                $conditions = array_merge($conditions, [
                        'cat_ids >' => 0    
                    ]);
            }

            if(!empty($postData['keyword'])) { 
                $conditions = array_merge($conditions, [
                        'News.title LIKE' => "%{$postData['keyword']}%"    
                ]);   
            }
            $this->News->virtualFields['cat_ids'] = $query;

            $news = $this->News->find('all', [ 'conditions' => $conditions,'limit' => 6, 'offset' => $offset, 'order' => 'News.id DESC', 'recursive' => 2]);
            
        }
        
        //echo '<pre>';print_r($news);die;
        $this->set(array(
            'data' => [
                'msg' => '',
                'status' => true ,
                'error' => [],
                'data' => [ 'news' => $news, 'totalUnreadNews'=> $totalUnreadNews]
            ],
            '_serialize' => array('data')
        )); 
    }

    public function getNewsInformation($id) {
        $imgUrl = URL_HOST;
         $user_id = isset($this->request->query['user_id'])?$this->request->query['user_id']:0;
        $this->News->virtualFields['file'] ='CONCAT("'.$imgUrl.'","/img/news/",News.file)'; 
         $this->News->virtualFields['isLike'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='1' and news_likes.user_id=$user_id";
        $this->News->virtualFields['total_likes'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='1' ";
        $this->News->virtualFields['isUnLike'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='2'  and news_likes.user_id=$user_id";
        $this->News->virtualFields['total_dislikes'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='2'";
        $this->News->virtualFields['view_count'] = "SELECT count(news_view_counts.id) FROM news_view_counts WHERE news_view_counts.news_id = News.id ";

        $this->News->bindModel([
            'hasOne' => [
                'NewComment' => [
                    'className' => 'NewComment',
                    'foreignKey' => 'news_id'
                ]
            ]
        ]);
        $news = $this->News->find('first', [ 'conditions' => ['News.id' => $id],'recursive' => 2]);
        $newsExist=0;
        if(!empty($user_id)) {
            $newsCount['NewsViewCount']['user_id'] = $user_id;
            $newsCount['NewsViewCount']['news_id'] = $id;
            $newsExist = $this->NewsViewCount->find('count',['conditions'=> ['NewsViewCount.user_id' => $user_id, 'NewsViewCount.news_id' => $id ] ]);

            if($newsExist == 0) {
                $this->NewsViewCount->save($newsCount);
            }
        }

        $this->set(array(
            'data' => [
                'msg' => '',
                'status' => true ,
                'error' => [],
                'data' => $news
            ],
            '_serialize' => array('data')
        )); 
    }

    public function getCategories() {
         $this->Category->bindModel(['hasMany'=> [
            'Subcategory' => [
                'className' => 'Category',
                'foreignKey' => 'parent'
            ]
        ] ]);
        $categories =  $this->Category->find('all',['conditions' => ['Category.parent' => '0'] ]);
         $this->set(array(
            'data' => [
                'msg' => '',
                'status' => true ,
                'error' => [],
                'data' => $categories
            ],
            '_serialize' => array('data')
        )); 
    }
    
    public function getSubCategories($id) {
         $this->Category->bindModel(['hasMany'=> [
            'Subcategory' => [
                'className' => 'Category',
                'foreignKey' => 'parent'
            ]
        ] ]);
        $categories =  $this->Category->find('all',['conditions' => ['Category.id' => $id] ]);
         $this->set(array(
            'data' => [
                'msg' => '',
                'status' => true ,
                'error' => [],
                'data' => $categories
            ],
            '_serialize' => array('data')
        )); 
    }

    protected function getNewsInf($id,$user_id){

        $imgUrl = URL_HOST;
        $this->News->virtualFields['file'] ='CONCAT("'.$imgUrl.'","/img/news/",News.file)'; 
         $this->News->virtualFields['isLike'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='1' and news_likes.user_id=$user_id";
        $this->News->virtualFields['total_likes'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='1' ";
        $this->News->virtualFields['isUnLike'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='2'  and news_likes.user_id=$user_id";
        $this->News->virtualFields['total_dislikes'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='2'";
        $this->News->virtualFields['view_count'] = "SELECT count(news_view_counts.id) FROM news_view_counts WHERE news_view_counts.news_id = News.id ";

        $this->News->bindModel([
            'hasOne' => [
                'NewComment' => [
                    'className' => 'NewComment',
                    'foreignKey' => 'news_id'
                ]
            ]
        ]);
        $news = $this->News->find('first', [ 'conditions' => ['News.id' => $id],'recursive' => 2]);
        return $news;
    }

    public function addLike() {
        if( $this->request->is('post') ) {
            $data = $this->request->data;

            if ( isset($data['user_id']) && isset($data['news_id'])) {
                $news['NewsLike']['user_id'] = $data['user_id']; 
                $news['NewsLike']['news_id'] = $data['news_id']; 
                $status = $data['status']; 

                $findOne = $this->NewsLike->find('first',['conditions' => [
                    'user_id' => $data['user_id'], 
                    'news_id' => $data['news_id']
                ]]);

                if( !empty($findOne) ) {
                    
                    if($status == $findOne['NewsLike']['status'])
                        $status=0;

                    $this->NewsLike->id = $findOne['NewsLike']['id'];

                    $this->NewsLike->updateAll(['status' => "$status"], ['NewsLike.id' => $findOne['NewsLike']['id'] ]);
                    
                } else {
                    $this->NewsLike->save($news);
                }

                $this->set(array(
                    'data' => [
                        'msg' => '',
                        'status' => true ,
                        'error' => [],
                        'data' => ['status' => $status, 'news'=>$this->getNewsInf($data['news_id'],$data['user_id'])]
                    ],
                    '_serialize' => array('data')
                )); 
            }
        } else {
            $this->set(array(
                    'data' => [
                        'msg' => '',
                        'status' => false ,
                        'error' => [],
                        'data' => ['status' => 0]
                    ],
                    '_serialize' => array('data')
                )); 
        }
        
    }

    public function getRecentViewedNews($offset=0) {

        $news = [];
        if( $this->request->is('post') ) {
            $postData = $this->request->data;
            $imgUrl = URL_HOST;
            $user_id = isset($postData['user_id'])?$postData['user_id']:0;
          
            $this->News->virtualFields['file'] ='CONCAT("'.$imgUrl.'","/img/news/",News.file)'; 
            $this->News->virtualFields['isLike'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='1' and news_likes.user_id=$user_id";
            $this->News->virtualFields['total_likes'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='1' ";
            $this->News->virtualFields['isUnLike'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='2'  and news_likes.user_id=$user_id";
            $this->News->virtualFields['total_dislikes'] = "SELECT count(news_likes.id) FROM news_likes WHERE news_likes.news_id = News.id and news_likes.status='2'";
            $this->News->virtualFields['view_count'] = "SELECT count(news_view_counts.id) FROM news_view_counts WHERE news_view_counts.news_id = News.id ";
            

            $conditions = [
                'News.status' => '1',
                'NewsViewCount.user_id' => $user_id
            ];
            $query = 0;

            if( !empty($postData['search_type']) ) {
                switch ($postData['search_type']) {
                    case 'day':
                        $cond = date('Y-m-d', strtotime('-1 day'));
                        $conditions = array_merge($conditions,[
                            'News.created_at >' =>  $cond
                        ]);

                        break;
                    
                    case 'month':
                        $cond = date('Y-m-d', strtotime('-1 month'));
                        $conditions = array_merge($conditions,[
                            'News.created_at >' =>  $cond
                        ]);

                        break;
                    case 'year':
                        $cond = date('Y-m-d', strtotime('-1 year'));
                        $conditions = array_merge($conditions,[
                            'News.created_at >' =>  $cond
                        ]);
                        break;
                    case 'custom':

                        if(!empty($postData['from'])) {
                            $conditions = array_merge($conditions,[
                                'News.created_at >=' =>  $postData['from']
                            ]);
                        }
                        if(!empty($postData['to'])) {
                            $conditions = array_merge($conditions,[
                                'News.created_at <=' =>  $postData['to']
                            ]);
                        }
                        
                        break;
                    
                    default:
                        // code...
                        break;
                }
            }
            if(!empty($postData['category_id'])) {
                $categories = explode(',', $postData['category_id']);
                
                $categorySearch=[];
                $queryArr = [];
                foreach ($categories as $category_id) {
                    $queryArr[] = "FIND_IN_SET($category_id,(SELECT GROUP_CONCAT(news_categories.category_id SEPARATOR ',') FROM news_categories WHERE news_categories.news_id = News.id))";

                }

                $query = implode(' OR ', $queryArr);

                $conditions = array_merge($conditions, [
                        'cat_ids >' => 0    
                    ]);
            }
            $this->News->virtualFields['cat_ids'] = $query;
            $this->News->bindModel([
                'hasOne' => array(
                    'NewsViewCount'=> [
                        'className' => 'NewsViewCount',
                        'foreignKey' => 'news_id'
                    ]
                )
            ]);
            $news = $this->News->find('all', [ 'conditions' => $conditions,'limit' => 10, 'offset' => $offset, 'order' => 'NewsViewCount.id DESC', 'recursive' => 2]);

        }
        
        $this->set(array(
            'data' => [
                'msg' => '',
                'status' => true ,
                'error' => [],
                'data' => $news
            ],
            '_serialize' => array('data')
        )); 
    }

    public function changePassword() {

        $status = true;
        $errors = '';
        $message='';
        if( $this->request->is('post') )
        {
            $postData  = $this->request->input('json_decode' , true);
            
            $validator=$this->User->validator();
            unset($validator['first_name'],$validator['last_name'],$validator['phone']);
            $validator->remove('email');
            $validator->remove('isUnique');
            $validator->remove('terms');
            $validator->remove('country_code');
            
            $this->User->set($postData);
            if(!$this->User->validates(['fieldList' => array('password', 'confirm_password')]))
            {
                $errors = $this->validateErrors($this->User);
                $status = false;
            } else {
                // $this->User->virtualFields['path_image'] = "CONCAT('".URL_HOST."/img/user/',profile_pic)";
                $user = $this->User->find('first',[
                        'conditions' => [
                                'User.id' => $postData['id']
                        ]
                    ]);
                if(!empty($user)) {
                     $user['User']['password'] = $postData['password'];
                    $this->User->save($user['User']); 
                    $status = true;
                    $message = 'Password updated successfully';
                } else {
                    $status = false;
                    $message = 'Invalid Request';    
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

    public function newsView()
    {

        $status = true;
        $errors = '';
        $message='';
        $data = [];
        echo $userId = @$_GET['userId'];
        echo $newsId = @$_GET['newsId'];
        if(empty($userId)){
            $status = false;
            $errors = 'User id is required.';
            $message = 'User id is required.';
        }else if(empty($newsId)){
            $status = false;
            $errors = 'News id is required.';
            $message = 'News id is required.';
        }else{
            $newsview['user_id'] = $userId;
            $newsview['news_id'] = $newsId;
            $newsview['created_date'] = date('Y-m-d H:i:s');
            $this->UserNews->save($newsview);
            $message = 'User viewed news successfully.';
        }

        $this->set(array(
            'data' => [
                'status' => true ,
                'errors' => $errors,
                'message' => $message,
                'data' => $data
            ],
            '_serialize' => array('data')
        ));
    }

    public function getNotifications($offset=0){

        $news = [];
        if( $this->request->is('post') ) {

            $postData = $this->request->data;
            $imgUrl = URL_HOST;
            $userId=$user_id = isset($postData['user_id'])?$postData['user_id']:0;
          
            $this->News->virtualFields['file'] ='CONCAT("'.$imgUrl.'","/img/news/",News.file)'; 
            $conditions = [
                'News.status' => '1',
                'check_news' => '0'
            ];
            
            $this->News->virtualFields['read'] = "SELECT count(user_news.id) FROM user_news WHERE  user_news.news_id=News.id AND user_news.user_id={$userId}";
            $this->News->virtualFields['check_news'] = "SELECT count(user_news.id) FROM user_news WHERE user_news.status='0' AND user_news.news_id=News.id AND user_news.user_id={$userId}";
            $news = $this->News->find('all', [ 'conditions' => $conditions,'limit' => 10, 'offset' => $offset, 'order' => 'News.id DESC', 'recursive' => 2]);
            
            $this->News->virtualFields['total_read'] = "SELECT count(user_news.id) FROM user_news WHERE user_news.news_id=News.id AND user_news.user_id={$userId}";
            // $totalUnreadNews = $this->News->find('list',['conditions'=>['total_read'=>0]]);
            // $this->markRead($totalUnreadNews, $userId);

        }
        
        $this->set(array(
            'data' => [
                'msg' => '',
                'status' => true ,
                'error' => [],
                'data' => $news
            ],
            '_serialize' => array('data')
        )); 
    
    }

    public function readNews() {
        if ($this->request->is('post')) {
            $postData = $this->request->data;
            $UserNews['user_id'] = $postData['user_id'];
            $UserNews['news_id'] = $postData['news_id'];
            $newsInformation = $this->UserNews->findByUserIdAndNewsId($UserNews['user_id'], $UserNews['news_id']);
            if (!empty($newsInformation)) {
                $UserNews['id'] = $newsInformation['UserNews']['id'];
            }else {
                $this->UserNews->create();
            }
            $this->UserNews->save($UserNews);
            $this->set(array(
                'data' => [
                    'msg' => '',
                    'status' => true ,
                    'error' => [],
                    'data' => []
                ],
                '_serialize' => array('data')
            ));
        }
    }
    public function markRead($news, $userId) {
        $userNews=[];
        foreach ($news as $newsId => $value) {
            $userNews[]['UserNews'] = ['news_id'=>$newsId,'user_id' => $userId];    
        }

        $this->UserNews->saveMany($userNews);
    }

    public function clearNotifications() {
        if( $this->request->is('post') ) {
            $postData = $this->request->data;
            $userId = $postData['user_id'] ;
            
            $this->UserNews->updateAll(['UserNews.status'=>'0'],['UserNews.user_id' => $userId]);
            $this->set(array(
                'data' => [
                    'msg' => '',
                    'status' => true ,
                    'error' => [],
                    'data' => []
                ],
                '_serialize' => array('data')
            ));
        }
    }

    public function getUnreadNotifications() {
        
        if( $this->request->is('post') ) {
            $postData = $this->request->data;
            $userId = $postData['user_id'] ;

            $this->News->virtualFields['total_read'] = "SELECT count(user_news.id) FROM user_news WHERE user_news.news_id=News.id AND user_news.user_id={$userId}";
            $totalUnreadNews = $this->News->find('count',['conditions'=>['total_read'=>0]]);
            $this->set(array(
                'data' => [
                    'msg' => '',
                    'status' => true ,
                    'error' => [],
                    'data' => ['total_unread'=>$totalUnreadNews]
                ],
                '_serialize' => array('data')
            ));
        }
    }

    public function about_us() {
        $page = $this->Page->findBySlug('about-us');
        $this->set(array(
                'data' => [
                    'msg' => '',
                    'status' => true ,
                    'error' => [],
                    'data' =>$page
                ],
                '_serialize' => array('data')
            ));
    }
    
    public function privacypolicy() {
        $page = $this->Page->findBySlug('privacy-policy');
        $this->set(array(
                'data' => [
                    'msg' => '',
                    'status' => true ,
                    'error' => [],
                    'data' =>$page
                ],
                '_serialize' => array('data')
            ));
    }

    public function terms() {
        $page = $this->Page->findBySlug('terms-conditions');
        $this->set(array(
                'data' => [
                    'msg' => '',
                    'status' => true ,
                    'error' => [],
                    'data' =>$page
                ],
                '_serialize' => array('data')
            ));
    }
}