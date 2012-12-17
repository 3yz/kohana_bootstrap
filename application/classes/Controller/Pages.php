<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pages extends Controller_App {

  public function action_index()
  {
    $view = View::factory('pages/index');
    $this->template->content = $view;
  }

} // End Pages