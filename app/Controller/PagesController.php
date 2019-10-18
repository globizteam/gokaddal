<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('User','Product', 'ProductImage', 'Category', 'ProductType', 'Page');
	public $components = array('Session','Paginator');
	public $hepler = array('Session','Paginator', 'Form');
	public $layout = 'admin_dashboard';
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		
		$this->Auth->allow('admin_login');
	}


	public function admin_about_us() 
	{
		if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            //pr($postData);die;
            $validator = $this->Page->validator();
            
            $this->Page->set($postData);
            
            if ($this->Page->save()) 
            {
                $this->Flash->set('The page information saved successfully.');
            	$this->redirect(['action'=>'about_us','admin'=> true]);
            
            }
                $this->Flash->set('Error Occureds.');            
          
        }

        $this->request->data = $this->Page->findBySlug('about-us');


	}

	public function admin_privacy_policy() 
	{
		if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            //pr($postData);die;
            $validator = $this->Page->validator();
            
            $this->Page->set($postData);
            
            if ($this->Page->save()) 
            {
                $this->Flash->set('The page information saved successfully.');
            	$this->redirect(['action'=>'privacy_policy','admin'=> true]);
            
            }
                $this->Flash->set('Error Occureds.');            
          
        }

        $this->request->data = $this->Page->findBySlug('privacy-policy');
	}

  public function admin_newsletterlist($value='')
  {
    $this->layout = "admin_dashboard";
    $this->loadModel('Newsletter');

    $this->Paginator->settings = array(
            'limit'   => 10,
            'order'   => 'Newsletter.id desc'
      );


    // $rating_all_records = $this->RateNReview->find('all', array('order'=> array('RateNReview.rating DESC') ) );

    
    $newsletter = $this->Paginator->paginate('Newsletter');

    // $newsletter = $this->Newsletter->find('all');

    $this->set(compact('newsletter'));
    // pr($newsletter);die();
  }

	public function admin_faq() 
	{
     $this->layout = "admin_dashboard";
     $this->loadModel('faq');
     //$specials = $this->Course->findAllByStatus(0);
    $this->Paginator->settings = array('faq' => array('limit' => 100));
     $specials=$this->paginate('faq');
     $this->set(compact('specials'));

		if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            //pr($postData);die;
            $validator = $this->Page->validator();
            
            $this->Page->set($postData);
            
            if ($this->Page->save()) 
            {
                $this->Flash->set('The page information saved successfully.');
            	$this->redirect(['action'=>'faq','admin'=> true]);
            
            }
                $this->Flash->set('Error Occureds.');            
          
        }

        $this->request->data = $this->Page->findBySlug('faq');
	}


 public function admin_addfaq($id=null)
    {
        // pr($this->request->data);die();
      $this->layout = "admin_dashboard";
      $this->loadModel('faq');

      if (!empty($id)) 
      {
        $record = $this->faq->findById($id);
        // pr($record);die();
        $this->set(compact('record')); 
      }
      // $id = base64_decode($id);
    
      //echo "<pre>";print_r($content);print_r($content1);print_r($content2);die;      

      if($this->request->is('post'))
      {
        $data = $this->data;
        // pr($data);die();
        $data['faq']['id'] = $data['id'];
        //echo "<pre>";print_r($data);die;
        $data['faq']['ques'] = $data['ques'];
        $data['faq']['ans'] = $data['ans'];
        // $data['faq']['status'] = 1;
        if ($this->faq->save($data)) 
        {
          if (!empty($data['id'])) 
            $this->Flash->success(__('Faq Content Successfully Updated!'));
          else
            $this->Flash->success(__('Faq Added Successfully!'));

          $this->redirect('faq'); 
          # code...
        }

        $this->Flash->error(__('Error adding Faq, Try again!'));

      }
    }
    
    // public function admin_faq()
    // {
    //   $this->layout = "admin_dashboard";
    //   $this->loadModel('faq');
    //   //$specials = $this->Course->findAllByStatus(0);
    //  $this->Paginator->settings = array('faq' => array('limit' => 100));
    //   $specials=$this->paginate('faq');
    //   $this->set(compact('specials'));
    // } 

     public function admin_updatestatus($id=null)
     {
        $this->loadModel('faq');
        $data = $this->faq->find('first', array('conditions' => array('faq.id' => $id)));
        if($data['faq']['status'] == 0){
            $this->faq->id = $id;
            $this->faq->savefield('status',1);
            $this->Flash->success(__('Status updated successfully.')); 
        }else{
            $this->faq->id = $id;
            $this->faq->savefield('status',0); 
            $this->Flash->success(__('Status updated successfully.'));
        } 
        
        $this->redirect($this->referer());
    }
	
		public function admin_terms_conditions() 
	{
		if( $this->request->is(array('post', 'put')) )
        {
            $postData  = $this->request->data;
            //pr($postData);die;
            $validator = $this->Page->validator();
            
            $this->Page->set($postData);
            
            if ($this->Page->save()) 
            {
                $this->Flash->set('The page information saved successfully.');
            	$this->redirect(['action'=>'terms_conditions','admin'=> true]);
            
            }
                $this->Flash->set('Error Occureds.');            
          
        }

        $this->request->data = $this->Page->findBySlug('terms-conditions');
	}

    public function admin_contactus()
    {
        $this->layout = "admin_dashboard";
        $this->loadModel('Contact');
        $this->loadModel('Content');

        $this->Paginator->settings = array(
                'limit'   => 10,
                // 'conditions'=> array('User.id != ' => 1,'User.type ' => 1,'User.status ' => 1 ),
                'order'   => 'Contact.id desc'
          );


        // $rating_all_records = $this->RateNReview->find('all', array('order'=> array('RateNReview.rating DESC') ) );

        
        $people = $this->Paginator->paginate('Contact');

        // $people = $this->Contact->find('all', array('order' => array('Contact.id' => 'desc')));
        // pr($people);die();
        $data['address'] = $this->Content->findById(4);
        $data['fax'] = $this->Content->findById(5);
        $data['email'] = $this->Content->findById(6);
        $data['enquiry'] = $this->Content->findById(7);
        //echo "<pre>";print_r($people);die;
        $this->set(compact('people','data'));
    }

    public function admin_changestatus($id=null)
    {
      $this->layout = null;
       $this->loadModel('Contact');
       // $id = base64_decode($id);
       $data = $this->Contact->findById($id);
       // pr($data);die();
       $dat['Contact']['id'] = $id;
      if($data['Contact']['status'] == 0)
            $dat['Contact']['status'] = 1;
      else
            $dat['Contact']['status'] = 0; 

      if ($this->Contact->save($dat)) 
      {
        $this->Flash->success(__('Status updated successfully.'));
        $this->redirect($this->referer());
      }
        $this->Flash->error(__('Problem updating status.'));
        $this->redirect($this->referer());
    }

    public function admin_listaddresses($value='')
    {
      $this->layout = "admin_dashboard";
      $this->loadModel('OfficeAddress');

      $getaddresses = $this->OfficeAddress->find('all');

      $this->set(compact('getaddresses'));
      // pr($getaddresses);die();
    }

    /*Add new address*/
    public function admin_addaddresses($id='')
    {
      $this->layout = "admin_dashboard";
      $this->loadModel('OfficeAddress');

      if (!empty($id)) 
      {
        $record = $this->OfficeAddress->findById($id);
        // pr($record);die();
        $this->set(compact('record'));
      }
      
      if ($this->request->is(array('post','put'))) 
      {

        if ($this->OfficeAddress->save($this->request->data)) 
        {
            if (!empty($this->request->data['id'])) 
            {
              $this->Flash->success(__('Address updated successfully.'));
              $this->redirect('listaddresses');
            }

            $this->Flash->success(__('Address addeded successfully.'));
            $this->redirect('listaddresses');
        }
            $this->Flash->error(__('Problem updating address.'));
            $this->redirect('listaddresses');
      }

    }

    /*Change status of address display 1 or 0*/
    public function admin_statusaddresses($id='')
    {
      $this->layout = null;
       $this->loadModel('OfficeAddress');
       $data = $this->OfficeAddress->findById($id);
       // pr($data);die();
       $dat['OfficeAddress']['id'] = $id;
      if($data['OfficeAddress']['status'] == 0)
            $dat['OfficeAddress']['status'] = 1;
      else
            $dat['OfficeAddress']['status'] = 0; 

      if ($this->OfficeAddress->save($dat)) 
      {
        $this->Flash->success(__('Status updated successfully.'));
        $this->redirect($this->referer());
      }
        $this->Flash->error(__('Problem updating status.'));
        $this->redirect($this->referer());
    }

    public function admin_deletefaq($id='')
    {
      
      $this->layout = null;
      $this->loadModel('Faq');

      if($this->Faq->delete($id))
        $this->Flash->success(__('Faq deleted successfully.'));
      else
        $this->Flash->error(__('Error in deleting Faq.'));
      $this->redirect($this->referer());
    }

    public function admin_deleteaddresses($id='')
    {
      
      $this->layout = null;
      $this->loadModel('OfficeAddress');

      if($this->OfficeAddress->delete($id))
        $this->Flash->success(__('Address deleted successfully.'));
      else
        $this->Flash->error(__('Error in deleting address.'));
      $this->redirect($this->referer());
    }

    public function admin_deletenewsletter($id='')
    {
      
      $this->layout = null;
      $this->loadModel('Newsletter');

      if($this->Newsletter->delete($id))
        $this->Flash->success(__('Newsletter deleted successfully.'));
      else
        $this->Flash->error(__('Error in deleting newsletter.'));
      $this->redirect($this->referer());
    }

    public function admin_listblog($value='')
    {
       $this->layout = "admin_dashboard";
       $this->loadModel('Blog');
       //$specials = $this->Course->findAllByStatus(0);
       $this->Paginator->settings = array(
               'limit'   => 10,
               // 'conditions'=> array('User.id != ' => 1,'User.type ' => 1,'User.status ' => 1 ),
               'order'   => 'Blog.id desc'
         );
      // $this->Paginator->settings = array('Blog' => array('limit' => 100));
       $blog = $this->paginate('Blog');
       pr($blog);die();
       $this->set(compact('blog'));
    }


    public function admin_deletecontact($id=null)
    {

      $this->layout = null;
      $this->loadModel('Contact');

      if($this->Contact->delete($id))
        $this->Flash->success(__('Contact deleted successfully.'));
      else
        $this->Flash->error(__('Error in deleting contact.'));
      $this->redirect($this->referer());
    }

    public function admin_contactaddress()
    {
      if($this->request->is('post'))
      {
        $this->loadModel('Content');
        $data = $this->data;
        //echo "<pre>";print_r($data);die;
        $add['Content']['id'] = 4;
        $add['Content']['content'] = $data['content'];
        $add['Content']['updated date'] = date("Y-m-d");
        $this->Content->save($add);
        $stuff['Content']['id'] = 5;
        $stuff['Content']['content'] = $data['fax'];
        $stuff['Content']['updated date'] = date("Y-m-d");
        $this->Content->save($stuff);
        $stuff['Content']['id'] = 6;
        $stuff['Content']['content'] = $data['email'];
        $stuff['Content']['updated date'] = date("Y-m-d");
        $this->Content->save($stuff);
        $stuff['Content']['id'] = 7;
        $stuff['Content']['content'] = $data['enquiry'];
        $stuff['Content']['updated date'] = date("Y-m-d");
        $this->Content->save($stuff);
        $this->Session->write('success-msg','Content Updated');
        $this->redirect($this->referer());
      }
    }
         public function admin_addblog($id=null)
    {
      $this->layout = "admin_dashboard";
      $this->loadModel('blog');
      $id = base64_decode($id);
      $content = $this->blog->findById($id);
      
      //echo "<pre>";print_r($content);print_r($content1);print_r($content2);die;      
      $this->set(compact('content'));
      if($this->request->is('post'))
      {
        $data = $this->data;
         if (!empty($_FILES)) {
                if (is_uploaded_file($_FILES['DishImage']['tmp_name'])) {
                    $allowed =  array('gif','png' ,'jpg');
                    $filename = $_FILES['DishImage']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if(!in_array($ext,$allowed) ) {
                        //$this->set('popular', 'dasdasdsadsad');
                        $this->Session->write('success-msg','Not a allowed image format!');
                        $this->redirect($this->referer());
                    }
                    
                    //print_r($_FILES);die;
                  $image = $this->Components->load('resize');
                  //$image1 = $this->Components->load('resize');  
                  $destination1 = realpath('../webroot/img/profile') . '/';
                  $filename = time().'-'.$_FILES['DishImage']['name'];
                  $image->resize($_FILES['DishImage']['tmp_name'],$destination1.$filename,'aspect_fit',200,200,0,0,0,0);
                  $data['blog']['images'] = $filename;
                }      
              }
        $data['blog']['id'] = $id;
        //echo "<pre>";print_r($data);die;
        $data['blog']['ques'] = $data['title'];
        $data['blog']['ans'] = $data['descr'];
        $data['blog']['cat'] = $data['cat'];
        $data['blog']['status'] = 1;
        $this->blog->save($data);
        print_r($data); die();
        $this->Session->write('success-msg','Blog Content Updated!');
        $this->redirect(array('action' => 'blog')); 
      }
    }
      public function admin_blog()
    {
      $this->layout = "admin_dashboard";
      $this->loadModel('blog');
      //$specials = $this->Course->findAllByStatus(0);
     $this->Paginator->settings = array('blog' => array('limit' => 100));
      $specials=$this->paginate('blog');
      $this->set(compact('specials'));
    }
        public function admin_update_blog($id=null){
        $this->loadModel('blog');
        $data = $this->blog->find('first', array('conditions' => array('blog.id' => $id)));
        if($data['blog']['status'] == '0'){
            $this->blog->id = $id;
            $this->blog->savefield('status',1); 
        }else{
            $this->blog->id = $id;
            $this->blog->savefield('status',0); 
        } 
        
        $this->redirect($this->referer());
    }
     public function update_faq($id=null){
        $this->loadModel('faq');
        $data = $this->faq->find('first', array('conditions' => array('faq.id' => $id)));
        if($data['faq']['status'] == '0'){
            $this->faq->id = $id;
            $this->faq->savefield('status',1); 
        }else{
            $this->faq->id = $id;
            $this->faq->savefield('status',0); 
        } 
        
        $this->redirect($this->referer());
    }

    public function admin_deleteblog($id='')
    {
      
      $this->layout = null;
      $this->loadModel('blog');

      if($this->blog->delete($id))
        $this->Flash->success(__('Blog deleted successfully.'));
      else
        $this->Flash->error(__('Error in deleting Blog.'));
      $this->redirect($this->referer());
    }
	public function display() {
		$this->layout='';
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
