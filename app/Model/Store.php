<?php
	class Store extends AppModel {
	
		public $name = 'Store';
		// public  = false;
		public $hasMany = array(
	        'StoreOpenHour' => array(
	            'className' => 'StoreOpenHour',
	            'dependent' => true
	        )
	    );
	    public $belongsTo = array(
	        'Category' => array(
	            'className' => 'Category',
	            'counterCache' => true,
	        ),
	        'StoreType' => array(
	            'className' => 'StoreType',
	            'counterCache' => true,
	        ),
	        'User' => array(
	        	'className' => 'User'
	        )
	    );
		public $validate = [
			'store_name' => [
				'rule' => array('lengthBetween', 1, 15),
				'required' => 'create',
				'allowempty' => false,
				'message' => 'Store name is required and must be less than 15 characters'
			],
			/*'description' => [
				'rule' => 'alphanumeric',
				'required' => 'create',
				'message' => 'Description is required'
			],*/
			'image' => [
				'rule' => array(
		            'extension',
		            array('gif', 'jpeg', 'png', 'jpg')
		        ),
				'required' => 'create',
				'allowempty' => false,
				'message' => 'Please supply valid image.'
			],
			'category_id' => [
				'rule' => 'numeric',
				'required' => 'create',
				'allowempty' => false,
				'message' => 'Category is required'
			],
			'store_type_id' => [
				'rule' => 'numeric',
				'required' => 'create',
				'allowempty' => false,
				'message' => 'Product Type is required'
			],
			'location' => [
				'rule' => 'notBlank',
				'allowempty' => false,
				'required' => false,
				'message' => 'Please select location from map.'
			]
		];
	}
	
