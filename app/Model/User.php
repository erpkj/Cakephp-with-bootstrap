<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class User extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
	'name' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
		'message' => 'Please enter Name'
	    ),
	    'alphaValidation' => array(
		'rule' => array('custom', '/^[a-zA-Z][a-zA-Z\- ]*$/'),
		'message' => 'Name must contain only letters',
	    ),
	),
	'email' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
		'message' => 'Please enter Email',
		'required' => false
	    ),
	    'email' => array(
		'rule' => array('email'),
		'message' => 'Please enter a valid Email'
	    ),
	    'isUnique' => array(
		'rule' => array('isUnique'),
		'message' => 'Email already exist'
	    ),
	),
	'password' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
		'message' => 'Please enter Password'
	    ),
	    'between' => array(
		'rule' => array('between', 6, 25),
		'message' => 'Password should be between 6 to 25 characters'
	    ),
	),
	'repassword' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
		'message' => 'Please enter Confirm Password'
	    ),
	    'between' => array(
		'rule' => array('between', 6, 25),
		'message' => 'Confirm Password should be between 7 to 25 characters'
	    ),
	    'isSameAs' => array(
		'rule' => array('isSameAs', 'password'), //custom validation see AppModel
		'message' => 'Confirm Password must be same as Password',
	    ),
	),
	'username' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
		'message' => 'Please enter Username'
	    ),
	    'between' => array(
		'rule' => array('between', 6, 25),
		'message' => 'Username should be between 6 to 25 characters'
	    ),
	    'isUnique' => array(
		'rule' => array('isUnique'),
		'message' => 'Username already exist',
	    ),
	),
	'phone' => array(
	    'rule' => array('isValidUSPhoneFormat')
	),
    );

    public function beforeSave($options = array()) {
	if (isset($this->data['User']['password'])) {
	    $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
	    return true;
	}
    }

    /**
     * isSameAs method
     * @copyright (c) 2013
     * @author Pankaj Kumar Jha <pankajkumarjha@xyz.com>
     * @see 	http://book.cakephp.org/2.0/en/models/data-validation.html#adding-your-own-validation-methods
     * @uses To check if they are same
     * @example $this->User->find('fulllist');
     */
    public function isSameAs($check, $field) {
	$value = array_values($check);
	$value = $value[0];
	return $value == $this->data[$this->alias][$field];
    }

    /**
     * isValidUSPhoneFormat method
     * @copyright (c) 2013
     * @author Pankaj Kumar Jha <pankajkumarjha@xyz.com>
     * @param  Int $phone
     * @uses Custom method to validate US Phone Number
     */
    public function isValidUSPhoneFormat($phone) {
	$phone_no = $phone['phone'];
	$errors = array();
	if (empty($phone_no)) {
	    $errors [] = "Please enter Phone Number";
	} else if (!preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s.]{0,1}[0-9]{3}[-\s.]{0,1}[0-9]{4}$/', $phone_no)) {
	    $errors [] = "Please enter valid US Phone Number";
	}

	if (!empty($errors))
	    return implode("\n", $errors);

	return true;
    }

}
