<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
* 
*/
class User extends AppModel {
	
    public $hasMany = [

            'ProviderService' => [
                'className' => 'ProviderService',
            ],
            'RateNReview' => [
                'className' => 'RateNReview',
            ],
            'Favourite' => [
                'className' => 'Favourite',
            ],
            'SeekerRequirement' => [
                'className' => 'SeekerRequirement',
            ]
    ];
    
    // Gokaddal validation
    public $validate = array(
                    'name' => [
                        "rule" => "alphaNumeric",
                        "required" => true,
                        "message" => "Name is required",
                        'rule' => 'notBlank'
                    ],

                    "email" => [
                        'email' => [
                            "rule" => "email",
                            "required" => true,
                            "message" => "Please enter a valid email address.",
                            'rule' => 'notBlank'
                        ],
                        'isUnique' => [
                            'rule' => 'isUnique',
                             'required' => 'create',
                            'message' => 'This email has already been taken.'
                        ]
                    ],
                    'contact' =>  [
                            'numeric' =>
                            [ 
                                'rule' => 'numeric',
                                'required' => true,
                                'message' => 'Not a valid number.',
                                'rule' => 'notBlank'
                            ],
                            'minLength' => [
                                'rule' => array('minLength', 7),
                                'required' => false,
                                'message' => 'Must be atleast of 7 digit.'
                            ]
                        ],
                    "password" => [
                        // "rule" => "alphaNumeric",
                        "required" => true,
                        "message" => "Password should not be empty",
                        'rule' => 'notBlank'

                    ],
                );

	// public $validate = array(
 //        'first_name' => [
 //        		'rule' => 'alphaNumeric',
 //        		'required' => true,
 //        		'message' => 'First name is required.'
 //        	],
 //        /*'last_name' => [
 //        		'rule' => 'alphaNumeric',
 //        		'required' => true,
 //        		'message' => 'Last name is required.'
 //        	],*/
 //        'email' => [
 //            'email' => [
 //                'rule' => 'email',
 //                'required' => true,
 //                'message' => 'Please enter a valid email address.'
 //            ],
 //            'isUnique' => [
 //                'rule' => 'isUnique',
 //                 'required' => 'create',
 //                'message' => 'This email has already been taken.'
 //            ]
 //        ] ,
 //        'password' =>  [
 //        		'rule' => 'alphaNumeric',
 //        		'required' => true,
 //        		'message' => 'Password is required.'
 //        	],
 //        'phone' =>  [
 //        		'numeric' =>
 //        		[ 
 //        			'rule' => 'numeric',
 //        			'required' => true,
 //        			'message' => 'Not a valid number.'
 //        		],
 //        		'minLength' => [
 //        			'rule' => array('minLength', 7),
 //        			'required' => true,
 //        			'message' => 'Must be of 7 digit.'
 //        		]
 //        	],
 //            'confirm_password' => [
 //                'rule' => 'checkConfirmPassword',
 //                'required' => 'create',
 //                'message' => 'Password does not match.'  
 //            ],
 //            'terms' => [
 //                'rule' => ['boolean'],
 //                'required' => 'create',
 //                'message' => 'Please accept terms and condition'  
 //            ],
 //            'country_code' => [
 //                'rule' => 'numeric',
 //                'required' => 'create',
 //                'message' => 'Please select country code.'  
 //            ]

 //    );

    public function checkConfirmPassword($data)
    {
        return ($this->data['User']['password'] == $data['confirm_password']);
        // return true;
    }

    public function beforeSave($options = array()) {

        // pr('i am in beforeSave');die();

        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));

            if (!empty($this->data[$this->alias]['password'])) 
            {
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
        
        return true;
    }

}
