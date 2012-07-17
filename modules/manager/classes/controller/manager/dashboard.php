<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_Dashboard extends Controller_Manager_Application {
  
  public function before(){
    parent::before();
    $this->template->title .= ' - Dashboard'; 
  }
  
  public function action_index(){
    
    $this->template->content = View::factory('manager/dashboard/index');
  }
  
} // End Dashboard
