<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Arm Auth Role Model.
 *
 * @package    Arm Auth
 * @author     Devi Mandiri <devi.mandiri@gmail.com>
 * @copyright  (c) 2011 Devi Mandiri
 * @license    MIT
 */
class Role extends Arm {

	static $has_many = array(
		array('roles_users'),
		array('users', 'through' => 'roles_users')
	);

	static $validates_presence_of = array(
		array('name'),
		array('description'),
	);
	
	static $validates_size_of = array(
		array('name', 'within' => array(4,32)),
		array('description', 'maximum' => 255),
	);	
	
}
