<?php

class NewsOrganization extends AppModel {
	
	public $belongsTo = [
		'Organisation' => [
			'className' => 'Organisation',
			'foreignKey' => 'NewsOrganization.organization_id'
		]
	];

}
