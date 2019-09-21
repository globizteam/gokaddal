<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class NewsCategories extends AbstractMigration
{

    public function up() {
        $exists  = $this->hasTable('news_categories');
        if(!$exists) {
            $this->table('news_categories')
            ->addColumn('news_id', 'integer', [ 'limit' => 11 ])
            ->addColumn('category_id', 'integer', [ 'limit' => 11 ])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1 ] )
            ->addForeignKey('news_id', 'news', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
        }

    }

    public function down() {
        
    }
}
