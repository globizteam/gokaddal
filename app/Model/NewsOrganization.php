<?php

class NewsOrganization extends AppModel {

	public $belongsTo = [
		'Organisation' => [
			'className' => 'Organisation',
			'foreignKey' => 'organization_id'
		]
	];

}
