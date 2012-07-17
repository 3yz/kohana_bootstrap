<?php defined('SYSPATH') or die('No direct script access.');

// Static file serving (CSS, JS, images)
Route::set('assets', 'assets(/<folder>(/<file>))', array('file' => '.+'))
	->defaults(array(
		'controller' => 'assets',
		'action'     => 'index',
		'file'       => NULL,
	));
	
// Manager
Route::set('manager/login', 'manager/login')
	->defaults(array(
	  'directory' => 'manager',
		'controller' => 'sessions',
		'action'     => 'new',
	));
	
Route::set('manager/logout', 'manager/logout')
	->defaults(array(
	  'directory' => 'manager',
		'controller' => 'sessions',
		'action'     => 'destroy',
	));
	 
Route::set(
	'manager', 
	'manager(/<controller>(/<action>(/<id>)))'
)
	->defaults(array(
	  'directory' => 'manager',
		'controller' => 'dashboard',
		'action'     => 'index',
	));