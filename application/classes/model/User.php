<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Arm Auth User Model.
 *
 * @package    Arm Auth
 * @author     Devi Mandiri <devi.mandiri@gmail.com>
 * @copyright  (c) 2011 Devi Mandiri
 * @license    MIT
 */
class User extends Arm {

  static $has_many = array(
    array('user_tokens'),
    array('roles_users'),   
    array('roles', 'through' => 'roles_users')    
  );  
  
  static $validates_presence_of = array(
    array('name'),
    array('username'),
    array('email'),
    array('password')
  );
  
  static $validates_size_of = array(
    array('name', 'maximum' => 255),
    array('username', 'within' => array(4,32)),
    array('email', 'within' => array(4,127)),
    array('password', 'minimum' => 8)
  );
  
  static $validates_format_of = array(
    array('username', 'with' => '/^[-\pL\pN_.]++$/uD'),
    array('email', 'with' => '/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD')
  );
    
  static $validates_uniqueness_of = array(
    array('username'),
    array('email')
  );  
  
  static $after_validation = array('filters');
  
  public function filters()
  {
    if ($this->is_dirty() AND array_key_exists('password', $this->dirty_attributes())){
      $this->password = Auth::instance()->hash($this->password);
    }
  } 
  
  /**
   * Get unique key based on value.
   * 
   * @param mixed $value  Key value for match
   * @return string   Unique key name to attempt to match against
   */
  public static function unique_key($value)
  {
    if (Valid::email($value))
    {
      return 'email';
    } 
    elseif (is_string($value))
    {
      return 'username';
    }
    return 'id';
  }
  
  /**
   * Update password.
   * 
   * @param string $old Current/Old password
   * @param string $new New password
   * @param mixed $key  Key value for match
   * @return boolean
   */
  public function update_password($old, $new, $key)
  {
    if ($old === NULL OR $new === NULL)
      return FALSE;   
    
    $user = User::find(array(
      static::unique_key($key) => $key,
      'password' => Auth::instance()->hash($old)
    ));
    
    if (! is_object($user))
    {
      return FALSE;
    }
    
    return $user->update_attribute('password', Auth::instance()->hash($new));
  }

  /**
   * Check for unique key existence.
   * 
   * @param mixed Key value for match
   * @return boolean
   */
  public function unique_key_exists($value)
  {
    return User::exists(array(static::unique_key($value) => $value));
  }

  /**
   * Complete the login for a user by incrementing the logins and saving login timestamp.
   *
   * @param   object   user model object
   * @return  void
   */
  public function complete_login()
  {
    if (! $this->loaded())
    {
      return;
    }
    
    $this->update_attribute('logins', $this->logins + 1); // TODO
    $this->update_attribute('last_login', time());    
  }

  /**
   * Check if user has a particular role.
   * 
   * @param mixed $role   Role to test for, can be Role object, string role name of integer role id
   * @return bool     Whether or not the user has the requested role
   */
  public function has_role($role)
  {
    if ($role instanceof Role)
    {
      $key = 'id';
      $val = $role->id;
    }
    elseif (is_string($role))
    {
      $key = 'name';
      $val = $role;
    }
    else
    {
      $key = 'id';
      $val = (int) $role;
    }
    
    foreach ($this->roles as $user_role)
    {
      if ($user_role->{$key} === $val)
      {
        return TRUE;
      }
    }
    
    return FALSE;
  }
  
  /*
   * @var  string  Virtual field for password confirm
   */
  public $password_confirm;
  
  /*
   * Custom validation to match between password and password confirm.
   * 
   */
  public function validate()
  {
    //if ($this->attribute_is_dirty('password')) // don't know why it's not working in my box
    
    if ($this->is_dirty() AND array_key_exists('password', $this->dirty_attributes()))
    {
      if ($this->password !== $this->password_confirm)
      {
        $this->errors->add('password', "must be the same as Password Confirm.");
      }
    }
  }
  
  /**
   * Helper function to create user account (with validation).
   * 
   * @param string  username
   * @param string  plaintext password
   * @param string  email
   * @param string  role user
   * @return  mixed Model if success, Array if validation failed.
   */
  public static function create_user($name, $username, $password, $password_confirm, $email, $role = NULL, $activate = TRUE)
  {
    $user = User::create(array(
      'name' => $name,
      'username' => $username,
      'password' => $password,
      'email' => $email,
      'password_confirm' => $password_confirm
    ));

    if ($user AND $user->loaded()) {
      $role = Role::find_by_name($role);
      if ($role) {
        RolesUser::create(array('role_id' => $role->id,'user_id' => $user->id));
      }

      if ($activate === TRUE) {
        $role = Role::find_by_name('login');
        if ($role) {
          RolesUser::create(array('role_id' => $activate,'user_id' => $user->id));
        }
      }
      
    }

    return $user;
  }

  public static function update_user($id, $name, $username, $password, $password_confirm, $email, $role = NULL, $activate = TRUE)
  {
    $user = User::find($id);
    $user->name = $name;
    $user->username = $username;
    $user->email = $email;
    if (!empty($password)){
      $user->password = $password;
      $user->password_confirm = $password_confirm;
    }

    RolesUser::table()->delete(array('user_id' => $user->id));

    $role = Role::find_by_name($role);
    if ($role) {
      RolesUser::create(array('role_id' => $role->id,'user_id' => $user->id));
    }

    if ($activate === TRUE) {
      $role = Role::find_by_name('login');
      if ($role) {
        RolesUser::create(array('role_id' => $activate,'user_id' => $user->id));
      }
    }

    $user->save();

    return $user;
  }
}
