<?php defined('SYSPATH') or die('No direct script access.');

Route::set('default', '(<controller>(/<action>(/<id>)))')
    ->defaults(array(
      'controller' => 'home',
      'action'     => 'index',
    ));