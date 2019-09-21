<?php

class Tag extends AppModel {
    
	public $hasMany = ['ProviderService','SeekerRequirement'];

	 //    public $belongsTo = [
		//      'SeekerRequirement' => [
		//         'className' => 'SeekerRequirement',
		//         // 'foreignKey' => 'category_id'
		//     ]
		// ];
}
