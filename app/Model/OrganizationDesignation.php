<?php

class OrganizationDesignation extends AppModel {
	public  $belongsTo = array(
			'Organisation' => array('className' => 'Organisation',
								'foreignKey' => 'organization_id',
								'fields' => array( 'name' )
			)
		);
}
