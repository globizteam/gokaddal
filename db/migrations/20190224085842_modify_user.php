<?php

use Phinx\Db\Adapter\MysqlAdapter;

use Phinx\Migration\AbstractMigration;

class ModifyUser extends AbstractMigration
{

    public function up() {
        $exists  = $this->hasTable('users');
        if($exists) {
            if( !$this->table('users')->hasColumn('code') )
            {
                $this->table('users')
                    ->addColumn('code', 'text', [ 'limit' => MysqlAdapter::TEXT_TINY, 'after' => 'password' , 'length' => 500 ])
                    ->addIndex('code')
                    ->update();    
            }
            
        }

    }

    public function down() {

    }
}
