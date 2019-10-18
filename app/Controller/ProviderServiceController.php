<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
/**
* 
*/
class ProviderServiceController extends AppController
{
	
	public $uses = array('User','Product', 'ProductImage', 'Category', 'ProductType', 'ProviderService', 'Tag');
	public $components = array('Session','Paginator');
	public $hepler = array('Session','Paginator', 'Form');
	public $layout = 'admin_dashboard';
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('admin_login','admin_serviceList');
	}

	public function admin_serviceList($userId='')
	{

				$conditions = [];
				// $userData = $this->ProviderService->findById($userId);
				// $conditions[] = ['ProviderService.id' => $userId];
				if(!empty($_GET['search_value'])){
		// pr($userId);die();
					$conditions[] = array('OR' =>array(
											array('ProviderService.title LIKE' => '%'.$_GET['search_value'].'%' ),
											array('ProviderService.description LIKE' => '%'.$_GET['search_value'].'%' )
										)
									);

					}
				 
				 $this->Paginator->settings = array(
				        'limit' => 100,
				        'conditions' => $conditions,
				        'order' => 'ProviderService.id desc'
				    );
				
		    	$services = $this->Paginator->paginate('ProviderService');

		    		// pr($services);die();
		    	if (isset($_GET['search_value']) ) {
		    	}
				

				$thirdparty_js = [
					'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
				];

				$this->set(compact('thirdparty_js','services'));







		// pr('hello all');die();

		// $this->Paginator->settings = array(
		//        'limit' => 25,
		//        // 'conditions' => $conditions,
		//        'order' => 'ProviderService.id desc'
		//    );

  //   	$services = $this->Paginator->paginate('ProviderService');

		// $thirdparty_js = [
		// 	'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		// ];

		// $this->set(compact('thirdparty_js','services'));
	}



	public function admin_productList($userId = null)
	{

		$conditions = [];
		$userData = $this->User->findById($userId);
		$conditions[] = ['Product.user_id' => $userId];
		if(!empty($_GET['search_value'])){
			$conditions[] = array('OR' =>array(
									array('Product.title LIKE' => '%'.$_GET['search_value'].'%' ),
									array('Product.description LIKE' => '%'.$_GET['search_value'].'%' )
								)
							);
		}
		 $this->Paginator->settings = array(
		        'limit' => 25,
		        'conditions' => $conditions,
		        'order' => 'Product.id desc'
		    );
    	$products = $this->Paginator->paginate('Product');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','products','userId','userData'));
	}

	public function admin_addService($serviceid='')
	{

		$this->layout = 'admin_dashboard';
		$this->loadModule = 'News';

		$allcatrecords = $this->Category->find('all',array('fields'=>'id,title'));
		$users = $this->User->find('all', array('conditions' => array('User.id !=' => 1, 'User.type' => 1 )));
		// pr($users);die();
	    $tags = $this->Tag->find('all');
	    // pr($tags);die();
	    // $this->set(compact('tags'));
		$this->set(compact('allcatrecords','users','tags'));

		  $thirdparty_js = [
		      'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js',
		      'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'
		  ];  
		  $element = 'js/add_user';
		  $elementData='';
		   $this->set(compact('thirdparty_js', 'element', 'elementData'));

		   // editing service
		   if (!empty($serviceid)) {
			   	$this->set('editservice', 'editservice');
		       $user = $this->ProviderService->findById($serviceid);
		       // $modules = $this->Module->findAllByUserId($userId);
		       // pr($modules);die();
		       // $modulesNames = Hash::combine($modules, '{n}.Module.module_name', '{n}.Module.id');

		       if(!$this->request->data)

		           $this->request->data = $user;
		       $this->set('service', $user);

		   }

		// adding new service
		if ($this->request->is(['post','put'])) {


			$postData = $this->request->data;
			// pr($postData);die();
			
			$imgName =  $_FILES['file']['name']; 

			$postData['ProviderService']['image'] = $imgName;
			$postData['ProviderService']['tag_id'] = $postData['tagid'];
			$postData['ProviderService']['category_id'] = $postData['catid'];
			$postData['ProviderService']['user_id'] = $postData['userid'];

            if(!empty($imgName)){


	            	$imgNameNew = time().'-'.$imgName;

	            	$destination = WWW_ROOT;

	            	if(move_uploaded_file($_FILES['file']['tmp_name'],$destination.$imgName)) {
				        echo "The file ".$imgNameNew. " has been uploaded.";
				    } else {
				        echo "Sorry, there was an error uploading your file.";
						die();
				    }

        	}

				$validator = $this->ProviderService->validator();

			    unset($validator['file']);

			    $this->Paginator->settings = array(
			           'limit' => 25,
			           'conditions' => ['User.id !=' => 1],
			           'order' => 'id desc'
			       );


			if ($this->ProviderService->saveAll($postData)) {

				if ( isset($this->request->data['editservice'])) 
					$this->Flash->success(__('Service updated successfully'));
				else
					$this->Flash->success(__('New service added successfully'));

				$this->redirect('serviceList');
			}
				$this->Flash->error(__('Error while saving'));
		}
	}


	public function admin_addProduct($userId = null , $productId = null) {
		$categories = $this->Category->find('list',array('fields'=>'title'));

		$productTypes = $this->ProductType->find('list',array('fields'=>'title'));

		if(!empty($productId)){
        	$product = $this->Product->findById($productId);

        	if(!$this->request->data)
        		$this->request->data = $product;

		}
		//pr($categories);die;
        $this->set(compact('userId','categories','productTypes'));

        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            // pr($_FILES);

            if(!empty($_FILES['image']['tmp_name']['0'])){
            	$len = count($_FILES['image']['tmp_name']);
	            for ($i = 0; $i < $len; $i++) {
	            	$imgName = time().'-'.$_FILES['image']['name'][$i];

	            	$destination = realpath('../webroot/img/product/'). '/';
	            	move_uploaded_file($_FILES['image']['tmp_name'][$i],$destination.$imgName);
	            	$postData['ProductImage'][$i]['image'] = $imgName;
	            }
        	}
        	$validator = $this->Product->validator();

            unset($validator['contact']);
            $postData['Product']['status'] = '1';
            $postData['Product']['expiry'] = $postData['Product']['expiry']['year'].'-'.$postData['Product']['expiry']['month'].'-'.$postData['Product']['expiry']['day']; 
            if(empty($post['Product']['id'])){
            	$postData['Product']['created_ip'] = $_SERVER['REMOTE_ADDR'];
            	$postData['Product']['created_at'] = date('Y-m-d H:i:s');
        	}
            if ($this->Product->saveAll($postData,array('deep' => true))) 
            {
            	if(empty($postData['Product']['id']))
            		$this->Flash->error(__('Ad saved successfully.'));
            	else
            		$this->Flash->error(__('Ad updated successfully.'));
            	$this->redirect('productList/'.$userId);
            
            }

        }
        
    }

    public function admin_delete($model = null, $id = null)
    {
    	$images = $this->ProductImage->findAllByProductId($id);
    	foreach ($images as $img) {
    		$destination = realpath('../webroot/img/product/'). '/'.$img['ProductImage']['image'];

    		unlink($destination);
    	}
    	if($this->$model->delete($id))
    		$this->Flash->error(__('Data deleted successfully.'));
    	else
    		$this->Flash->error(__('Error in deleting data, Please contact admin.'));
    	$this->redirect($this->referer());
    }

    public function deleteImage($proImageId = null){
    	echo $destination = realpath('../webroot/img/product/'). '/'.$_GET['imgName'];
    	unlink($destination);
    	if($this->ProductImage->delete($proImageId))
    		$this->Flash->error(__('Data deleted successfully.'));
    	else
    		$this->Flash->error(__('Error in deleting data, Please contact admin.'));
    	$this->redirect($this->referer());

    }

    public function admin_categoryList()
	{

		$conditions = ['parent'=>'0'];
		if(!empty($_GET['search_value'])){
			$conditions[] = array('OR' =>array(
									array('Category.title LIKE' => '%'.$_GET['search_value'].'%' ),
									array('Category.description LIKE' => '%'.$_GET['search_value'].'%' )
								)
							);
		}
		 $this->Paginator->settings = array(
		        'limit' => 25,
		        'conditions' => $conditions,
		        'order' => 'id desc'
		    );
		 $this->Category->virtualFields['total_subcategories'] = "SELECT count(categories.id) FROM categories WHERE categories.parent=Category.id";
    	$categories = $this->Paginator->paginate('Category');

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','categories'));
	}
	public function admin_addCategory($categoryId = null) {

		if(!empty($categoryId)){
        	$category = $this->Category->findById($categoryId);

        	if(!$this->request->data)
        		$this->request->data = $category;

		}

        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
           	$postData['Category']['image'] = $postData['image'];
            if ($this->Category->saveAll($postData)) 
            {
            	$category = $this->Category->findById($postData['Category']['id']);
				// pr($postData['Category']['id']);die();
            	
            	if( empty($category['Category']['parent']) )
            		$this->redirect('categoryList');
            	else
            		$this->redirect(['action'=>'sub_category_list','admin'=>true,$category['Category']['parent']]);
            } 
        }
        
    }

	public function admin_deleteCategory($model = null, $categoryId = null){
    	$destination = realpath('../webroot/img/category/'). '/'.$_GET['catName'];
    	unlink($destination);
    	if($this->$model->delete($categoryId))
    		$this->Flash->error(__('Data deleted successfully.'));
    	else
    		$this->Flash->error(__('Error in deleting data, Please contact admin.'));
    	$this->redirect($this->referer());

    }


    public function admin_productTypeList()
	{

		$conditions = [];
		if(!empty($_GET['search_value'])){
			$conditions[] = array('OR' =>array(
					array('ProductType.title LIKE' => '%'.$_GET['search_value'].'%' ),
					array('ProductType.description LIKE' => '%'.$_GET['search_value'].'%' )
				)
			);
		}
		 $this->Paginator->settings = array(
		        'limit' => 25,
		        'conditions' => $conditions,
		        'order' => 'id desc'
		    );
    	$categories = $this->Paginator->paginate('ProductType');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','categories'));
	}
	public function admin_addProductType($productTypeId = null) {

		if(!empty($productTypeId)){
        	$category = $this->ProductType->findById($productTypeId);

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
	        	$postData['ProductType']['image'] = $imgName;
        	}
            if ($this->ProductType->saveAll($postData)) 
            {
            	$this->redirect('productTypeList');
            
            } 
        }
        
    }

    public function admin_reportedProductList()
	{

		$conditions = [];
		
		$conditions[] = [ '(SELECT count(reported_ads.id) FROM reported_ads WHERE reported_ads.product_id=Product.id) >'=> 0 ];
		if(!empty($_GET['search_value'])){
			$conditions[] = array('OR' =>array(
									array('Product.title LIKE' => '%'.$_GET['search_value'].'%' ),
									array('Product.description LIKE' => '%'.$_GET['search_value'].'%' )
								)
							);
		}
		 $this->Paginator->settings = array(
		        'limit' => 25,
		        'conditions' => $conditions,
		        'order' => 'Product.id desc'
		    );
    	$products = $this->Paginator->paginate('Product');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','products','userData'));
	}

	public function admin_products()
	{

		$conditions = [];
	
		if(!empty($_GET['search_value'])){
			$conditions[] = array('OR' =>array(
									array('Product.title LIKE' => '%'.$_GET['search_value'].'%' ),
									array('Product.description LIKE' => '%'.$_GET['search_value'].'%' )
								)
							);
		}
		 $this->Paginator->settings = array(
		        'limit' => 25,
		        'conditions' => $conditions,
		        'order' => 'Product.id desc'
		    );
    	$products = $this->Paginator->paginate('Product');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','products'));
	}

	public function admin_sub_category_list($category_id) {
		$categoryInformation = $this->Category->findById($category_id);
		// pr($categoryInformation);die();

		$conditions = ['parent' => $category_id];
		if(!empty($_GET['search_value'])){
			$conditions[] = array('OR' =>array(
									array('Category.title LIKE' => '%'.$_GET['search_value'].'%' ),
									array('Category.description LIKE' => '%'.$_GET['search_value'].'%' )
								)
							);
		}
		 $this->Paginator->settings = array(
		        'limit' => 25,
		        'conditions' => $conditions,
		        'order' => 'Category.id desc'
		    );
    	$categories = $this->Paginator->paginate('Category');
		

		$thirdparty_js = [
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js'
		];

		$this->set(compact('thirdparty_js','categories','category_id', 'categoryInformation'));
	}

	public function admin_add_subcategoy( $category_id ) {
		if(!empty($categoryId)){
        	$category = $this->Category->findById($categoryId);

        	if(!$this->request->data)
        		$this->request->data = $category;

		}

        if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            $postData['Category']['image'] = $postData['image'];
            if ($this->Category->saveAll($postData)) 
            {
            	$this->redirect(['action'=>'sub_category_list','admin'=>true,$category_id]);
            
            } 
        }
		$this->set(compact('category_id'));
	}
}