<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Application extends Controller_Template {

  public $template = 'common/layout';
  public $benchmark = null;

  public function before()
  {
    parent::before();
    
  }

  public function after()
  {
    parent::after();
  }

}
