<?php

class Category extends AppModel {
    
	public $hasMany = ['ProviderService','SeekerRequirement'];

	 //    public $belongsTo = [
		//      'SeekerRequirement' => [
		//         'className' => 'SeekerRequirement',
		//     ]
		// ];

}
