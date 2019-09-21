<?php

class NewsCategory extends AppModel {
    
	public $virtualFields = ['name' => "SELECT categories.title FROM categories WHERE categories.id = NewsCategory.category_id", "parent_id" => "SELECT categories.parent FROM categories WHERE categories.id = NewsCategory.category_id"];

}
