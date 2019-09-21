<?php
	class Product extends AppModel {
	
		public $name = 'Product';
		// public  = false;
		public $hasMany = array(
	        'ProductImage' => array(
	            'className' => 'ProductImage',
	            'dependent' => true
	        )
	    );
	    public $belongsTo = array(
	        'Category' => array(
	            'className' => 'Category',
	            'counterCache' => true,
	        ),
	        'ProductType' => array(
	            'className' => 'ProductType',
	            'counterCache' => true,
	        ),
	        'User' => array(
	        	'className' => 'User'
	        )
	    );
		public $validate = [
			'title' => [
				'rule' => 'alphanumeric',
				'required' => 'create',
				'allowempty' => false,
				'message' => 'Title is required'
			],
			/*'description' => [
				'rule' => 'alphanumeric',
				'required' => 'create',
				'message' => 'Description is required'
			],*/
			'price' => [
				'rule' => 'numeric',
				'required' => 'create',
				'allowempty' => false,
				'message' => 'Invalid Price'
			],
			'category_id' => [
				'rule' => 'numeric',
				'required' => 'create',
				'allowempty' => false,
				'message' => 'Category is required'
			],
			'product_type_id' => [
				'rule' => 'numeric',
				'required' => 'create',
				'allowempty' => false,
				'message' => 'Product Type is required'
			],
			'contact' => [
				'rule' => 'alphanumeric',
				'allowempty' => false,
				'message' => 'This field is required'
			],
			'expiry' => [
				'rule' => array('date', 'ymd'),
		        'message' => 'Enter a valid date in YY-MM-DD format.'
			],
			'created_ip' => [
				'rule' => 'ip',
				'message' => 'Please supply valid ip address'
			]
		];
	}
	
