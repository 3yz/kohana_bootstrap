<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User {

  public static function get_password_validation($values)
  {
    return Validation::factory($values)
      ->rule('password', 'min_length', array(':value', 8))
      ->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
  }

  function roles_to_s(){
    $roles = array();

    foreach ($this->roles->find_all() as $role) {
      $roles[] = $role->name;
    }

    return implode(', ', $roles);
  }

} // End User Model