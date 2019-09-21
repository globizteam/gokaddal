<?php
header("Access-Control-Allow-Origin: *");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

require_once VENDORS."gumlet/php-image-resize/lib/ImageResize.php";

use \Gumlet\ImageResize;

class StoreApiController  extends AppController
{
    public $components = array('RequestHandler');
    public $uses = ['User','EmailTemplate', 'Category', 'ProductType', 'ProductImage', 'Product', 'Store', 'Wishlist'];

    public function beforeFilter()
    {
        if($this->request->prefix != 'admin')
        {
            $this->Auth->allow('store_list','store');
        }
    }

    public function store_list() 
    {
    	$message = "INVALID REQUEST";
        $status = false;
        $error = 1022;
        $data=[];

    	if ($this->request->is('post')) 
    	{
    		
    		$postData = $this->request->data;
    		$lat = isset($postData['lat'])?$postData['lat']:0;
    		$long = isset($postData['lng'])?$postData['lng']:0;
    		$offet = isset($postData['offset'])?$postData['offset']:0;
            $conditions =[];
    		// if( !empty($postData['user_id']) )
    		// {
    			$message = "success";
        		$status = true;

    			// $conditions = ['user_id' => $postData['user_id'] ];
    			$this->Store->virtualFields=['distance'=> "60*1.1515*1.609344 *
    DEGREES(ACOS(COS(RADIANS(Store.lat))
         * COS(RADIANS(".$lat."))
         * COS(RADIANS(Store.lng - ".$long."))
         + SIN(RADIANS(Store.lat))
         * SIN(RADIANS(".$lat."))))", 
         			'image_path' => "CONCAT('".URL_HOST."/img/store/org/',Store.image)"
     		];

    			

    			$data = $this->Store->find('all', [
		    		'conditions' => $conditions,
		    		'limit' => 10,
		    		'offset' => $offet
		    	]);
    		// }
    		

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

    public function store() {
    	$message = "INVALID REQUEST";
        $status = false;
        $error = 1022;
        $data=[];

    	if ($this->request->is('post')) 
    	{
    		
    		$postData = $this->request->data;
    		$lat = isset($postData['lat'])?$postData['lat']:0;
    		$long = isset($postData['lng'])?$postData['lng']:0;
    		if( !empty($postData['store_id']) )
    		{
    			$message = "success";
        		$status = true;

    			$conditions = ['Store.id' => $postData['store_id'] ];
    			$this->Store->virtualFields=['distance'=> "60*1.1515*1.609344 *
    DEGREES(ACOS(COS(RADIANS(Store.lat))
         * COS(RADIANS(".$lat."))
         * COS(RADIANS(Store.lng - ".$long."))
         + SIN(RADIANS(Store.lat))
         * SIN(RADIANS(".$lat."))))", 
         			'image_path' => "CONCAT('".URL_HOST."/img/store/120/',Store.image)"
     		];

    			

    			$data = $this->Store->find('first', [
		    		'conditions' => $conditions
		    	]);
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
}