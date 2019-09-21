<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array('Module');

	public $components = array('Flash','Session','Paginator',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'user',
                'action' => 'dashboard',
                'admin' => true
            ),
            'logoutRedirect' => array(
                'controller' => 'user',
                'action' => 'login',
                'admin' => true
            ),
            'authError' => 'You cant access that page',
            'authorize' => array('Controller' ),
            'authenticate' => array(
                'Form' => array(
                	'fields' => array(
                		'username' => 'email',
                		'password' => 'password'
                	),
                    'passwordHasher' => array(
                    	'className' => 'Simple',
                    	'hashType' 	=> 'sha256'
                    )

                )
            )
        )
    );

	// logged in users access to 
	public function isAuthorized($user)
	{
	 return true;
	}


    public function beforeFilter()
    {
        
    	if($this->request->prefix != 'admin')
    	{
    		$this->Auth->allow('*');
    	}
    }

    public function mail($emailTemplate, $param=[])
    { 
        $Email = new CakeEmail('gmail');
        $Email->emailFormat('both');
        $Email->from($emailTemplate['EmailTemplate']['from']);
        $Email->to($param['email']);
        $Email->bcc('mpgledev@gmail.com');
        $Email->subject($emailTemplate['EmailTemplate']['subject']);
        return $Email->send($param['body']); 
    }
    
    public function sendEmail($user , $slug)
    {
        $emailTemplate = $this->EmailTemplate->findBySlug($slug);
        if( !empty($emailTemplate) )
        {
            
            $body = str_replace(['{name}'], [$user['first_name'].' '.$user['last_name']], $emailTemplate['EmailTemplate']['body']);
            $param['body'] = $body;
            $param['email'] = $user['email'];

            $this->mail($emailTemplate, $param);
        }
        return false;
    }
}
