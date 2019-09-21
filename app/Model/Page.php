<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
* 
*/
class Page extends AppModel {
	
	public $validate = array(
        'title' => [
        		'rule' => 'notBlank',
        		'required' => true,
        		'message' => 'Title is required.'
        	],
        'description' => [
                'rule' => 'notBlank',
                'required' => true,
                'message' => 'Description is required.'
            ],

    );

   

}
