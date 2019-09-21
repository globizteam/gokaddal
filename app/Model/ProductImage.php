<?php

class ProductImage extends AppModel {

	public $virtualFields =  [ 'path' => 'CONCAT("'.FULL_BASE_URL.'/barcodescanner/img/product/",image)','path_300' => 'CONCAT("'.FULL_BASE_URL.'/barcodescanner/img/product_300/",image)'];
	
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'counterCache' => true,
        )
    );


}
