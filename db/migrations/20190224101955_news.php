<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;
class News extends AbstractMigration
{

    public function up() {
        $exists  = $this->hasTable('news');
        if(!$exists) {
            $this->table('news')
            ->addColumn('title', 'string', [ 'limit' => 255 ])
            ->addColumn('description', 'text')
            ->addColumn('number','string', ['limit'=>10])
            ->addColumn('created_at','timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update'=>'CURRENT_TIMESTAMP'])
            ->addColumn('type','enum', ['values'=>['video','audio', 'image']])
            ->addColumn('file', 'string', [ 'limit' => 255 ])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1 ] )
            ->addIndex('title')
            ->addIndex('number')
            ->create();
        }

    }

    public function down() {

    }
}
