<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Arm Auth User Token Model.
 *
 * @package    Arm Auth
 * @author     Devi Mandiri <devi.mandiri@gmail.com>
 * @copyright  (c) 2011 Devi Mandiri
 * @license    MIT
 */
class UserToken extends Arm {

	static $belongs_to = array('user');
	
	static $before_save = array('create_token');
	
	public function create_token()
	{
		$this->token = sha1(uniqid(Text::random('alnum', 32), TRUE));
		$this->created = time();
	}
	
	// field token and created will have those fields automatically updated upon model creation and model updates.
	static $validates_presence_of = array(
		array('user_id'),
		array('user_agent'),
		array('expires')
	);
	
	/**
	 * Handles garbage collection and deleting of expired objects.
	 *
	 * @return  void
	 */	
	public function __construct(array $attributes=array(), $guard_attributes=true, $instantiating_via_find=false, $new_record=true)
	{
		parent::__construct($attributes, $guard_attributes, $instantiating_via_find, $new_record);

		if (mt_rand(1, 100) === 1)
		{
			$this->delete_expired();
		}

		if ($this->expires < time() AND $this->loaded())
		{
			$this->delete();
		}
	}

	/**
	 * Deletes all expired tokens.
	 *
	 * @return  Arm
	 */
	public function delete_expired()
	{
		static::delete_all(array('conditions' => array('expires < ?', time())));

		return $this;
	}

} 
