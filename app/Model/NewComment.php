<?php
class NewComment extends AppModel {
    
	public $belongsTo = [
		'User' => [
			'className' => 'User'
		]
	];

}