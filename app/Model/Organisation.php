<?php

class Organisation extends AppModel {
	public  $hasMany = array(
			'OrganizationCategory' => array('className' => 'OrganizationCategory',
								'foreignKey' => 'organization_id',
								
			),
			'OrganizationDesignation' => array('className' => 'OrganizationDesignation',
								'foreignKey' => 'organization_id',
								
			),
			'OrganizationDepartment' => array('className' => 'OrganizationDepartment',
								'foreignKey' => 'organization_id',
								
			)
		);
}
