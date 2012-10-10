<?php
App::uses('AppModel', 'Model');
/**
 * Option Model
 *
 */
class Option extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'target_path' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'This field can not be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'db_user' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can not be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'db_pass' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can not be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'backup_key' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can not be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
