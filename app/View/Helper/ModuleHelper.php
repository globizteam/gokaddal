<?php
App::uses('AppHelper', 'View/Helper');
App::uses('Module', 'Model');
App::uses('Hash', 'Utility');

class ModuleHelper extends AppHelper {

    public function getModules($userId) {
    	$Module = new Module;
    	
    	$modules = $Module->findAllByUserId($userId);
        $modulesNames = Hash::combine($modules, '{n}.Module.module_name', '{n}.Module.id');
        return $modulesNames;
    }
}