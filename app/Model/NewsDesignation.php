<?php

class NewsDesignation extends AppModel {
    
	public $virtualFields = [ 'name' => "SELECT designations.name FROM designations WHERE designations.id = NewsDesignation.designation_id" ];

}
