<?php defined('SYSPATH') or die('No direct access allowed.');

if (Kohana::$environment == Kohana::DEVELOPMENT) {
  $dsn = 'mysql://root:@127.0.0.1/kohana_bootstrap';
} elseif (Kohana::$environment == Kohana::TESTING) {
  $dsn = 'mysql://root:@127.0.0.1/kohana_bootstrap';
} else {
  $dsn = 'mysql://root:@127.0.0.1/kohana_bootstrap';
}

return array
(
	'dsn' => $dsn,
	'model' => APPPATH.'classes/model'
);
