<?php
header("Access-Control-Allow-Origin: *");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

require_once VENDORS."gumlet/php-image-resize/lib/ImageResize.php";
// App::import('vendors','autoload');

use \Gumlet\ImageResize;

class ProductapiController  extends AppController
{
    public $components = array('RequestHandler');
    public $uses = ['User','EmailTemplate', 'Category', 'ProductType', 'ProductImage', 'Product', 'Dynamic', 'Wishlist','ReportedAd', 'RecentSearch'];

    public function beforeFilter()
    {
        if($this->request->prefix != 'admin')
        {
            $this->Auth->allow('signUp','login', 'forgotPassword','getData', 'saveAd','getAds','incrementView','getCateogryList', 'removeImage','getUserAds','getUserSaveList', 'updateUserWishList', 'homePage', 'uploadImage', 'markProductSold','wishlists', 'getProductInfo','markProductCancel', 'getAdsMap','getUserAdsMap', 'reportAd','recentSearch', 'saveBarcode');
        }
    }

    public function saveAd()
    {
        // Configure::write('debug', 0);

        $message = "INVALID REQUEST";
        $status = false;
        $error = 1022;
        $data=[];
        if ($this->request->is('post')) {
            $postData['Product']  = $this->request->data;
            $postData['Product']['lng'] = $postData['Product']['long'];
            $postData['Product']['expiry']  = date('Y-m-d',strtotime($this->request->data['expiry']));
            
            if(!empty($postData['Product']['title'])) {
                $this->Product->validator()->remove('title');
            }
            if(!empty($postData['Product']['contact'])) {
                $this->Product->validator()->remove('contact');
            }

            $postData['Product']['created_ip'] = $_SERVER['REMOTE_ADDR'];
            if ($this->Product->saveAll($postData,array('deep' => true)))  {
                $message = 'Saved';
                $status = true;
                $data=[
                    'id' => $this->Product->getLastInsertID()
                ];
            } else {
                $error = $this->validateErrors($this->Product);
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

    public function getData()
    {
        $productTypes = [];
        $categories = [];
        $status = false;
        $message = 'Result not found';
        $error='';
        $data =[];

        if ( $this->request->is('get') ) {
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

    public function getAds()
    {
        $message='Parameter missing';
        $status=false;
        $error='Parameter missing';
        $ads = [];
        if( $this->request->is('post') )
        {
            $data = $this->request->data;
            $offset = isset($data['offset'])?$data['offset']:0; 
            $limit = isset($data['limit'])?$data['limit']:10; 
            unset($data['offset']);
            
            $conditions=[];
            
            $order = 'DESC';
            $column = 'Product.id';    
            if(!empty($data['order']) && $data['order'] == 'price_desc') 
            {
                $order = 'DESC';
                $column = 'price';
                unset($data['order']); 
            }

            if(!empty($data['order']) && $data['order'] == 'price_asc') 
            {
                $order = 'ASC';
                $column = 'price';
                unset($data['order']); 
            }

            if(!empty($data['order']) && $data['order'] == 'expiry_asc') 
            {
                $order = 'ASC';
                $column = 'expiry';
                unset($data['order']); 
            }

            if(!empty($data['user_id'])) 
            {
                $conditions = ['user_id' => $data['user_id']]; 
            }

            if(!empty($data['product_type'])) 
            {
                $conditions = array_merge($conditions, ['product_type_id' => $data['product_type']]); 
            }

            if(!empty($data['category'])) 
            {
                $conditions = array_merge($conditions, ['category_id' => $data['category']]); 
            }
            $lat=0;
            $long=0;
            if(!empty($data['price'])) 
            {
                $priceRange = explode('-', $data['price']);
                $conditions = array_merge($conditions, ['price >' => $priceRange[0], 'price <=' => $priceRange[1] ]); 
            }
            if( !empty($data['lat']) && $data['lat']!='undefined' ) 
            {
                $lat = $data['lat']; 
            }
             if( !empty($data['long']) && $data['long']!='undefined' ) 
            {
                $long = $data['long']; 
            }

            if(!empty($data['distance'])) 
            {
                $conditions = array_merge($conditions, ['distance <' => $data['distance'] ]); 
            }

            $this->Product->virtualFields['distance'] = "60*1.1515*1.609344 *
    DEGREES(ACOS(COS(RADIANS(Product.lat))
         * COS(RADIANS(".$lat."))
         * COS(RADIANS(Product.lng - ".$long."))
         + SIN(RADIANS(Product.lat))
         * SIN(RADIANS(".$lat."))))";

         $this->Product->virtualFields['wishlist_status'] = "0";
         
            $ads = $this->Product->find('all', [
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset,
                'order' => [$column=>$order]
            ]);

            $message='';
            $status=true;
            $error='';
        }
        // $ads['path'] =  FULL_BASE_URL.'/img/product/';
        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $error,
                'data' => $ads
            ],
            '_serialize' => array('data')
        ));
    }

    public function getAdsMap()
    {
        $message='Parameter missing';
        $status=false;
        $error='Parameter missing';
        $ads = [];
        if( $this->request->is('post') )
        {
            $data = $this->request->data;
            $offset = isset($data['offset'])?$data['offset']:0; 
            $limit = isset($data['limit'])?$data['limit']:10; 
            unset($data['offset']);
            
            $conditions=[];
            
            $order = 'DESC';
            $column = 'Product.id';    
            if(!empty($data['order']) && $data['order'] == 'price_desc') 
            {
                $order = 'DESC';
                $column = 'price';
                unset($data['order']); 
            }

            if(!empty($data['order']) && $data['order'] == 'price_asc') 
            {
                $order = 'ASC';
                $column = 'price';
                unset($data['order']); 
            }

            if(!empty($data['order']) && $data['order'] == 'expiry_asc') 
            {
                $order = 'ASC';
                $column = 'expiry';
                unset($data['order']); 
            }

            if(!empty($data['user_id'])) 
            {
                $conditions = ['user_id' => $data['user_id']]; 
            }

            if(!empty($data['product_type'])) 
            {
                $conditions = array_merge($conditions, ['product_type_id' => $data['product_type']]); 
            }

            if(!empty($data['category'])) 
            {
                $conditions = array_merge($conditions, ['category_id' => $data['category']]); 
            }
            $lat=0;
            $long=0;
            if(!empty($data['price'])) 
            {
                $priceRange = explode('-', $data['price']);
                $conditions = array_merge($conditions, ['price >' => $priceRange[0], 'price <=' => $priceRange[1] ]); 
            }
            if( !empty($data['lat']) && $data['lat']!='undefined' ) 
            {
                $lat = $data['lat']; 
            }
             if( !empty($data['long']) && $data['long']!='undefined' ) 
            {
                $long = $data['long']; 
            }

            if(!empty($data['distance'])) 
            {
                $conditions = array_merge($conditions, ['distance <' => $data['distance'] ]); 
            }

            $this->Product->virtualFields['distance'] = "60*1.1515*1.609344 *
    DEGREES(ACOS(COS(RADIANS(Product.lat))
         * COS(RADIANS(".$lat."))
         * COS(RADIANS(Product.lng - ".$long."))
         + SIN(RADIANS(Product.lat))
         * SIN(RADIANS(".$lat."))))";

            $this->Product->virtualFields['wishlist_status'] = "0";
            $ads=[];
            $mapAds = $this->Product->find('all', [
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset,
                'order' => [$column=>$order]
            ]);

            foreach ($mapAds as $mapAd) {
                $key = $mapAd['Product']['lat'].'-'.$mapAd['Product']['lng'];
                $ads[$key][]=$mapAd;
               
            }
            $message='';
            $status=true;
            $error='';
        }
        // $ads['path'] =  FULL_BASE_URL.'/img/product/';
        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $error,
                'data' => $ads
            ],
            '_serialize' => array('data')
        ));
    }

    public function getUserAds()
    {
        $message='Parameter missing';
        $status=false;
        $error='Parameter missing';
        $ads = [];
        if( $this->request->is('post') )
        {
            $data = $this->request->data;
            $offset = isset($data['offset'])?$data['offset']:0; 
            unset($data['offset']);
            $order = 'ASC';
            $column = 'distance';
            $conditions=[
                'status' => '1'
            ];
            
            $order = 'DESC';
            $column = 'Product.id';    
            if(!empty($data['order']) && $data['order'] == 'price_desc') 
            {
                $order = 'DESC';
                $column = 'price';
                unset($data['order']); 
            }

            if(!empty($data['order']) && $data['order'] == 'price_asc') 
            {
                $order = 'ASC';
                $column = 'price';
                unset($data['order']); 
            }

            if(!empty($data['order']) && $data['order'] == 'expiry_asc') 
            {
                $order = 'ASC';
                $column = 'expiry';
                unset($data['order']); 
            }

            $user_id = 0;
            if(!empty($data['user_id'])) 
            {
                $user_id = $data['user_id'];
            }
            $conditions = [ 'Product.user_id !=' => $user_id, 'Product.status'=>'1' ]; 

            if(!empty($data['product_type'])) 
            {
                $conditions = array_merge($conditions, ['product_type_id' => $data['product_type']]); 
            }

            if(!empty($data['category'])) 
            {
                $conditions = array_merge($conditions, ['category_id' => $data['category']]); 
            }


            if(!empty($data['title'])) 
            {
                $conditions = array_merge($conditions, ['Product.title LIKE' =>  "%{$data['title']}%" ]); 
                if( $user_id )
                {
                	$recentSearchRes = $this->RecentSearch->findByUserId($user_id);
                	$recentSearch = ['conditions' => json_encode(['Product.title LIKE' =>  "%{$data['title']}%"]) ,'user_id' => $user_id];
                	
                	if( !empty( $recentSearchRes ) )
                		$recentSearch['RecentSearch']['id'] = $recentSearchRes['RecentSearch']['id'];

               		 $this->RecentSearch->save($recentSearch);
                }
                
            }
          
            if(!empty($data['price'])) 
            {
                $priceRange = explode('-', $data['price']);
                $conditions = array_merge($conditions, ['price >' => $priceRange[0], 'price <=' => $priceRange[1] ]); 
            }


            if(!empty($data['distance'])) 
            {
                $conditions = array_merge($conditions, ['distance <' => $data['distance'] ]); 
            }
            
            $lat=0;
            $long=0;
            if( !empty($data['lat']) && $data['lat']!='undefined' ) 
            {
                $lat = $data['lat']; 
            }
            
            if( !empty($data['long']) && $data['long']!='undefined' ) 
            {
                $long = $data['long']; 
            }

            $limit = 10;
            if( !empty($data['limit'])  ) 
            {
                $limit = $data['limit']; 
            }

            $this->Product->virtualFields['distance'] = "60*1.1515*1.609344 *
    DEGREES(ACOS(COS(RADIANS(Product.lat))
         * COS(RADIANS(".$lat."))
         * COS(RADIANS(Product.lng - ".$long."))
         + SIN(RADIANS(Product.lat))
         * SIN(RADIANS(".$lat."))))";

            $this->Product->virtualFields['wishlist_status'] = "IFNULL((SELECT status FROM wishlists WHERE Product.id=wishlists.product_id AND  wishlists.user_id=".$user_id." LIMIT 1),0)";

            $ads = $this->Product->find('all', [
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset,
                'order' => [$column=>$order]
            ]);

            $message='';
            $status=true;
            $error='';
        }
        // $ads['path'] =  FULL_BASE_URL.'/img/product/';
        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $error,
                'data' => $ads
            ],
            '_serialize' => array('data')
        ));
    }

    public function getUserAdsMap()
    {
        $message='Parameter missing';
        $status=false;
        $error='Parameter missing';
        $ads = [];
        if( $this->request->is('post') )
        {
            $data = $this->request->data;
            $offset = isset($data['offset'])?$data['offset']:0; 
            unset($data['offset']);
            $order = 'ASC';
            $column = 'distance';
           
            
            $order = 'DESC';
            $column = 'Product.id';    
            if(!empty($data['order']) && $data['order'] == 'price_desc') 
            {
                $order = 'DESC';
                $column = 'price';
                unset($data['order']); 
            }

            if(!empty($data['order']) && $data['order'] == 'price_asc') 
            {
                $order = 'ASC';
                $column = 'price';
                unset($data['order']); 
            }

            if(!empty($data['order']) && $data['order'] == 'expiry_asc') 
            {
                $order = 'ASC';
                $column = 'expiry';
                unset($data['order']); 
            }

            $user_id = 0;
            if(!empty($data['user_id'])) 
            {
                $user_id = $data['user_id'];
            }
            $conditions = [ 'Product.user_id !=' => $user_id,  'Product.status' => '1' ]; 

            if(!empty($data['product_type'])) 
            {
                $conditions = array_merge($conditions, ['product_type_id' => $data['product_type']]); 
            }

            if(!empty($data['category'])) 
            {
                $conditions = array_merge($conditions, ['category_id' => $data['category']]); 
            }


            if(!empty($data['title'])) 
            {
                $conditions = array_merge($conditions, ['Product.title LIKE' =>  "%{$data['title']}%" ]); 
            }
          
            if(!empty($data['price'])) 
            {
                $priceRange = explode('-', $data['price']);
                $conditions = array_merge($conditions, ['price >' => $priceRange[0], 'price <=' => $priceRange[1] ]); 
            }


            if(!empty($data['distance'])) 
            {
                $conditions = array_merge($conditions, ['distance <' => $data['distance'] ]); 
            }

            $lat=0;
            $long=0;
            if( !empty($data['lat']) && $data['lat']!='undefined' ) 
            {
                $lat = $data['lat']; 
            }
            
            if( !empty($data['long']) && $data['long']!='undefined' ) 
            {
                $long = $data['long']; 
            }

            $limit = 10;
            if( !empty($data['limit'])  ) 
            {
                $limit = $data['limit']; 
            }

            $this->Product->virtualFields['distance'] = "60*1.1515*1.609344 *
    DEGREES(ACOS(COS(RADIANS(Product.lat))
         * COS(RADIANS(".$lat."))
         * COS(RADIANS(Product.lng - ".$long."))
         + SIN(RADIANS(Product.lat))
         * SIN(RADIANS(".$lat."))))";

            $this->Product->virtualFields['wishlist_status'] = "IFNULL((SELECT status FROM wishlists WHERE Product.id=wishlists.product_id AND  wishlists.user_id=".$user_id." LIMIT 1),0)";

            $mapAds = $this->Product->find('all', [
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset,
                'order' => [$column=>$order]
            ]);

            foreach ($mapAds as $mapAd) {
                $key = $mapAd['Product']['lat'].'-'.$mapAd['Product']['lng'];
                $ads[$key][]=$mapAd;
               
            }
            $message='';
            $status=true;
            $error='';
        }
        // $ads['path'] =  FULL_BASE_URL.'/img/product/';
        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $error,
                'data' => $ads
            ],
            '_serialize' => array('data')
        ));
    }

    public function incrementView()
    {
        $message = 'Invalid data';
        $status = false;
        $error = '';
        $data=[];
        if ($this->request->is('post')) {
            $productId = $this->request->data['product_id'];
            
            $this->Product->recursive = -1;
            $product = $this->Product->find('first',[
                'conditions' => [
                    'id' => $productId
                ],
                'fields' => ['total_views','id']
            ] );

            $product['Product']['total_views'] = $product['Product']['total_views']+1;
            if ( $this->Product->save($product['Product'],false) ) {
                $message = 'Total view update successfully';
                $status = true;
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

    public function getCateogryList()
    {
        $data['cat'] = $this->Category->find('all');
        $data['productType'] = $this->ProductType->find('all');
        $this->set(array(
            'data' => [
                'msg' => '',
                'status' => true ,
                'error' => '',
                'data' => $data
            ],
            '_serialize' => array('data')
        ));
    }

    public function removeImage() {

        $status = false;
        $message = "Invalid Data";
        $error = "";
        if($this->request->is('post'))
        {
            $imageId = $this->request->data['imageId'];
            if($this->ProductImage->delete($imageId))
            {
                $status = true;
                $message = "Image deleted successfully.";

            }
        }

         $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => '',
                'data' => []
            ],
            '_serialize' => array('data')
        ));
    }

    public function getUserSaveList()
    {
        $errors ="";
        $message = "Not a valid request";
        $status = false;
        $data = [];
        $code = 1001;

        if ( $this->request->is('post') ) 
        {
            $user_id = $this->request->data['user_id'];

            $this->Dyanmic->validator()
                ->add('user_id','required',[
                    'rule' => 'notBlank',
                    'message' => 'Please pass a valid user id'
                ]);

            if(!$this->Dyanmic->validates())
            {
                $code = 1002;
                $errors = $this->Dyanmic->validateErrors;
            } else {
                $checkUser =  $this->User->findById( $user_id );

                if(empty($checkUser)) {
                    $message = "User does not exist";
                    $status = false;
                } else {
                    $status = true;
                    $message = "Success";
                    $data = $this->Wishlist->find('all', [
                        'conditions' => [
                            'user_id' => $user_id
                        ]
                    ]);

                }
            }    
        }

        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $errors,
                'data' => $data,
                'code' => $code
            ],
            '_serialize' => array('data')
        ));
    }

    public function updateUserWishList() 
    {
        $message = "Not a authorized access";
        $status = false;
        $errors = $data =[];
        if( $this->request->is('post') )
        {
            $data = $this->request->data;
            $this->loadModel('Wishlist');
            $this->Wishlist->set($data);

            $this->Wishlist->validator()
            ->add('user_id', 'required', [
                'rule' => 'notBlank',
                'required' => 'create',
                'message' => 'User id is required.'
            ])->add('product_id', 'required', [
                'rule' => 'notBlank',
                'required' => 'create',
                'message' => 'Product id is required.'
            ]);

            if( !$this->Wishlist->validates() )
            {
                $status=false;
                $message = "Validation failed";
                $errors = $this->Wishlist->validationErrors;
            } else {

                $status=true;
                $checkList = $this->Wishlist->find('first',[
                    'conditions' => [
                        'Wishlist.user_id' => $data['user_id'],
                        'Wishlist.product_id' => $data['product_id']
                    ]
                ]);

                if( !empty($checkList) )
                {

                    if( $checkList['Wishlist']['status'] == '1' )
                    {
                        $checkList['Wishlist']['status'] = "0";
                        $message = "Removed from wishlist successfully";
                    } else {
                        $checkList['Wishlist']['status'] = "1";
                        $message = "Added in wishlist successfully";
                    } 
                    
                    if($this->Wishlist->save($checkList['Wishlist'],false))
                    {
                        $status = true;
                        $data = $checkList['Wishlist'];
                    }

                } else {
                    if($this->Wishlist->save())
                    {
                        $data = $data;

                        if(!isset($data['status']))
                            $data['status']=1; 
                        
                        $status = true;
                        $message = "Added to wishlist";
                    }    
                }
            }

        }

        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $errors,
                'data' => $data
            ],
            '_serialize' => array('data')
        ));
    }

    public function homePage()
    {   
        $errors ="";
        $message = "Not a valid request";
        $status = false;
        $data = [];
        $code = 1001;

        if ( $this->request->is('post') ) 
        {
            $user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;

            // $this->Product->virtualFields['distance'] = "0";
            $conditions = ['Product.status'=>'1'];
            $data['savedAds'] = [];

            if(!empty($user_id))
            {
                $conditions = array_merge($conditions, ['user_id !=' => $user_id]);

                $this->Wishlist->virtualFields['path'] = 'SELECT CONCAT("'.URL_HOST.'/img/product_120/",image) FROM product_images WHERE product_id=Wishlist.product_id order by id desc LIMIT 1';
                $data['savedAds'] = $this->Wishlist->find('all', [
                    'conditions' => [
                        'Wishlist.user_id' => $user_id,
                        'Wishlist.status' => '1'
                    ],
                    'limit' => 4
                ]);


            } 

            $data['ads'] = $this->Product->find('all', [
                'conditions' => $conditions,
                'limit' => 5,
                'offset' => 0,
                'order' => ['Product.id'=> 'DESC']
            ]);
            $this->loadModel('ScannedBarcode');
            $data['barcodes'] = $this->ScannedBarcode->find('all',[
                'limit' => 4,
                'order' => ['ScannedBarcode.id DESC']
            ]);
            $status = true;
            $message = "Success";
                
        }

        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $errors,
                'data' => $data,
                'code' => $code
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

    public function markProductSold() 
    {
        $errors ="";
        $message = "Not a valid request";
        $status = false;
        $data = [];
        $code = 1001;

        if ($this->request->is('post')) 
        {
            $productId = $this->request->data['productId'];
            $product['Product']['id'] = $productId;
            $product['Product']['status'] = 2;

            if( $this->Product->save($product['Product'], false) )
            {
                $data = [
                    'status' => $product['Product']['status'],
                    'productId' => $product['Product']['id']
                ];
                $status = true;
                $message = "Product Marked as sold.";

            }            
        }
        $this->set(array(
                'data' => [
                    'msg' => $message,
                    'status' => $status ,
                    'error' => [],
                    'data' => $data,
                    'code' => 0
                ],
                '_serialize' => array('data')
            ));        
    }

    public function markProductCancel() 
    {
        $errors ="";
        $message = "Not a valid request";
        $status = false;
        $data = [];
        $code = 1001;

        if ($this->request->is('post')) 
        {
            $productId = $this->request->data['productId'];
            $product['Product']['id'] = $productId;
            $product['Product']['status'] = $this->request->data['status'];

            if( $this->Product->save($product['Product'], false) )
            {
                $status = true;
                if($product['Product']['status'] == 1) 
                    $message = "Product activated.";
                else 
                    $message = "Product cancelled successfully.";

                 $data = [
                    'status' => $product['Product']['status'],
                    'productId' => $product['Product']['id']
                ];

            }            
        }
        $this->set(array(
                'data' => [
                    'msg' => $message,
                    'status' => $status ,
                    'error' => [],
                    'data' => $data,
                    'code' => 0
                ],
                '_serialize' => array('data')
            ));        
    }


    public function wishlists()
    {   
        $errors ="";
        $message = "Not a valid request";
        $status = false;
        $data = [];
        $code = 1001;

        if ( $this->request->is('post') ) 
        {
            $user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;

            // $this->Product->virtualFields['distance'] = "0";
            $conditions = [];
            $data['savedAds'] = [];
            $offset = isset($this->request->data['offset'])?$this->request->data['offset']:0; 
            if(!empty($user_id))
            {
                $conditions = array_merge($conditions, ['user_id !=' => $user_id]);

                $lat=0;
            $long=0;
            if( !empty($this->request->data['lat']) && $this->request->data['lat']!='undefined' ) 
            {
                $lat = $this->request->data['lat']; 
            }
             if( !empty($this->request->data['long']) && $this->request->data['long']!='undefined' ) 
            {
                $long = $this->request->data['long']; 
            }
            $this->Product->virtualFields['distance'] = "60*1.1515*1.609344 *
    DEGREES(ACOS(COS(RADIANS(Product.lat))
         * COS(RADIANS(".$lat."))
         * COS(RADIANS(Product.lng - ".$long."))
         + SIN(RADIANS(Product.lat))
         * SIN(RADIANS(".$lat."))))";

          $this->Product->virtualFields['days'] = 'DATEDIFF(expiry, CURDATE())';
                $this->Wishlist->virtualFields['path'] = 'SELECT CONCAT("'.URL_HOST.'/img/product_120/",image) FROM product_images WHERE product_id=Wishlist.product_id order by id desc LIMIT 1';
                $data['savedAds'] = $this->Wishlist->find('all', [
                    'conditions' => [
                        'Wishlist.user_id' => $user_id,
                        'Wishlist.status' => '1'
                    ],
                    'recursive' => 2,
                    'limit' => 10,
                    'offset' => $offset
                ]);


            }
            

            $status = true;
            $message = "Success";
                
        }

        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $errors,
                'data' => $data,
                'code' => $code
            ],
            '_serialize' => array('data')
        ));
          
    }

    public function getProductInfo() 
    {
        $errors ="";
        $message = "Not a valid request";
        $status = false;
        $data = [];
        $code = 1001;

        if ( $this->request->is('post') ) 
        {
            $postId = $this->request->data['productId'];
            $userId = isset($this->request->data['userId'])?$this->request->data['userId']:0;
             $lat=0;
            $long=0;
            if( !empty($this->request->data['lat']) && $this->request->data['lat']!='undefined' ) 
            {
                $lat = $this->request->data['lat']; 
            }
             if( !empty($this->request->data['long']) && $this->request->data['long']!='undefined' ) 
            {
                $long = $this->request->data['long']; 
            }

            $this->Product->virtualFields['reportAd'] = "SELECT count(reported_ads.id) FROM reported_ads WHERE reported_ads.product_id=Product.id AND reported_ads.user_id=$userId";
            $this->Product->virtualFields['distance'] = "60*1.1515*1.609344 *
    DEGREES(ACOS(COS(RADIANS(Product.lat))
         * COS(RADIANS(".$lat."))
         * COS(RADIANS(Product.lng - ".$long."))
         + SIN(RADIANS(Product.lat))
         * SIN(RADIANS(".$lat."))))";
            $data['product'] = $this->Product->findById($postId);
             $status = true;
            $message = "Success";
        }

        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $errors,
                'data' => $data,
                'code' => $code
            ],
            '_serialize' => array('data')
        ));
    }

    public function reportAd() 
    {
        $errors ="";
        $message = "Not a valid request";
        $status = false;
        $data = [];
        $code = 1001;

        if ( $this->request->is('post') ) 
        {
            $postData = $this->request->data;
            if( !empty($postData['userId']) && !empty($postData['productId']) )
            {
                $data['ReportedAd']['user_id'] = $postData['userId'];
                $data['ReportedAd']['product_id'] = $postData['productId'];

                $check = $this->ReportedAd->find('first', [
                    'conditions' => [
                        'ReportedAd.user_id' => $data['ReportedAd']['user_id'],
                        'ReportedAd.user_id' => $data['ReportedAd']['product_id'],
                    ]
                ]);

                if( !empty($check) )
                {
                    $check['ReportedAd']['status'] = '1';
                    // $this->ReportedAd->save($check);   
                } else{
                    if ( $this->ReportedAd->save($data)) {
                        $status = true;
                        $data = $this->ReportedAd;
                        $message = "Report sent to admin";
                    }
                }
                
            }
        }

        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $errors,
                'data' => $data,
                'code' => $code
            ],
            '_serialize' => array('data')
        ));
    }

    public function recentSearch() {

        $message='Parameter missing';
        $status=false;
        $error='Parameter missing';
        $ads = [];
        if( $this->request->is('post') )
        {
            $data = $this->request->data;
            $offset = isset($data['offset'])?$data['offset']:0; 
            unset($data['offset']);
            $order = 'ASC';
            $column = 'distance';
            $conditions=[
                'status' => '1'
            ];
            
            $order = 'DESC';
            $column = 'Product.id';    

            $user_id = 0;
            if(!empty($data['user_id'])) 
            {
                $user_id = $data['user_id'];
            }
            $conditions = [ 'Product.user_id !=' => $user_id, 'Product.status'=>'1' ]; 

            $recentSearchRes = $this->RecentSearch->findByUserId($user_id);

            $message='';
            $status=true;
            $error='';
            
            if(empty($recentSearchRes)) {

            	$ads = [];
            	$this->set(array(
		            'data' => [
		                'msg' => $message,
		                'status' => $status ,
		                'error' => $error,
		                'data' => $ads
		            ],
		            '_serialize' => array('data')
		        ));

            } else {

            	$lat=0;
	            $long=0;

	            $searchConditions = json_decode($recentSearchRes['RecentSearch']['conditions'], true);
	            $conditions= array_merge( $searchConditions, $conditions);

	            if( !empty($data['lat']) && $data['lat']!='undefined' ) 
	            {
	                $lat = $data['lat']; 
	            }
	            
	            if( !empty($data['long']) && $data['long']!='undefined' ) 
	            {
	                $long = $data['long']; 
	            }

	            $limit = 10;
	            if( !empty($data['limit'])  ) 
	            {
	                $limit = $data['limit']; 
	            }

	            $this->Product->virtualFields['distance'] = "60*1.1515*1.609344 *
	    DEGREES(ACOS(COS(RADIANS(Product.lat))
	         * COS(RADIANS(".$lat."))
	         * COS(RADIANS(Product.lng - ".$long."))
	         + SIN(RADIANS(Product.lat))
	         * SIN(RADIANS(".$lat."))))";

	            $this->Product->virtualFields['wishlist_status'] = "IFNULL((SELECT status FROM wishlists WHERE Product.id=wishlists.product_id AND  wishlists.user_id=".$user_id." LIMIT 1),0)";

	            $ads = $this->Product->find('all', [
	                'conditions' => $conditions,
	                'limit' => $limit,
	                'offset' => $offset,
	                'order' => [$column=>$order]
	            ]);
            }
          
            

           
        }
        // $ads['path'] =  FULL_BASE_URL.'/img/product/';
        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $error,
                'data' => $ads
            ],
            '_serialize' => array('data')
        ));
    
    }

    public function saveBarcode() {
         $errors ="";
        $message = "Not a valid request";
        $status = false;
        $data = [];
        $code = 1001;
        $this->loadModel('ScannedBarcode');
        if ( $this->request->is('post') ) 
        {
            $postData = $this->request->data;
            if( !empty($postData['barcode'])  )
            {
                $status = true;
                $code = 200;
               $this->ScannedBarcode->save(['barcode' => $postData['barcode']]);
            }
        }

        $this->set(array(
            'data' => [
                'msg' => $message,
                'status' => $status ,
                'error' => $errors,
                'data' => $data,
                'code' => $code
            ],
            '_serialize' => array('data')
        ));
    }
}
?>