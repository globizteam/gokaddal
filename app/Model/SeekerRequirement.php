<?php

class SeekerRequirement extends AppModel {
    
	public $hasMany = 'SubmitQuote';

	    public $belongsTo = [
		     'User' => [
		        'className' => 'User',
		        'foreignKey' => 'user_id'
		    ],
		     'Category' => [
		        'className' => 'Category',
		        'foreignKey' => 'category_id'
		    ],
		     'Tag' => [
		        'className' => 'Tag',
		        'foreignKey' => 'tag_id'
		    ]
		];

}
