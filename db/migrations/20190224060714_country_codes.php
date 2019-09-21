<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CountryCodes extends AbstractMigration
{

    public function up() {
        $exists  = $this->hasTable('country_codes');
        if(!$exists) {
            $this->table('country_codes')
            ->addColumn('name', 'string', [ 'limit' => 255 ])
            ->addColumn('code','string', ['limit'=>10])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1 ] )
            ->addIndex('name')
            ->addIndex('code')
            ->create();
        }

    }

    public function down() {

    }
}
