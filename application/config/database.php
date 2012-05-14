<?php defined('SYSPATH') or die('No direct access allowed.');

if (Kohana::$environment == Kohana::DEVELOPMENT) {
  return array
  (
    'default' => array
    (
      'connection' => array(
        'hostname'   => 'localhost',
        'database'   => 'database',
        'username'   => 'root',
      )
    )
  );
} elseif (Kohana::$environment == Kohana::TESTING) {
  return array
  (
    'default' => array
    (
      'connection' => array(
        'hostname'   => 'localhost',
        'database'   => 'database',
        'username'   => 'root',
      )
    )
  );
} else {
  return array
  (
    'default' => array
    (
      'connection' => array(
        'hostname'   => 'localhost',
        'database'   => 'database',
        'username'   => 'root',
      )
    )
  );
}
