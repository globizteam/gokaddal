<?php
class News extends AppModel {
	public $actsAs = array('Containable');
	public $name = 'New';
	public $virtualFields =['thumbnail'=>'CONCAT("'.URL_HOST.'","/img/news/",News.thumbnail)']; 
	public $hasMany = [
		'NewsCategory' => [
			'className' => 'NewsCategory',
			'foreignKey' => 'news_id'
		],
		'NewsDesignation'=> [
			'className' => 'NewsDesignation'
		],
		'NewsDepartment'=> [
			'className' => 'NewsDepartment'
		],
		'NewsOrganization'=> [
				'className' => 'NewsOrganization',
				'foreignKey' => 'news_id'
			]
	];

	
	
}
?>