<?php
class Wishlist extends AppModel {

	public $belongsTo = [
		'Product' => [
			'className' => 'Product',
			'type' => 'INNER'
		],
		'User'=> [
			'className' => 'User'
		]
	];
	
}
?>