<?php

class SubmitQuote extends AppModel {
    
	// public $hasMany = ['ProviderService','SeekerRequirement'];

	    public $belongsTo = [
		     'SeekerRequirement' => [
		        'className' => 'SeekerRequirement',
		    ]
		];

}
