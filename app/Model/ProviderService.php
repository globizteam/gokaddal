<?php
class ProviderService extends AppModel {
    // public $useTable = 'provider_services';

    public $belongsTo = [
	     'User' => [
	        'className' => 'User',
	        // 'foreignKey' => 'user_id'
	    ],
	     'Category' => [
	        'className' => 'Category',
	    ],
		'Tag' => [
		    'className' => 'Tag',
		],
	];

	public $hasMany = [
		'Favourite' => [
		    'className' => 'Favourite',
		],
	];
}
