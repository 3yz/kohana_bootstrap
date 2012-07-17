<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_Sessions extends Controller_Manager_Application {
  
  public function action_new()
  {
    //if already logged in, redirect to dashboard
    if(Auth::instance()->logged_in()){
      $this->request->redirect('manager');
    }
    
    $view = View::factory('manager/sessions/new');
    
    $view->title = 'Login - '.$this->title;
    if($this->request->method() == Request::POST){
      if(Auth::instance()->login($this->request->post('username'), Auth::instance()->hash($this->request->post('password')))){
        $this->request->redirect('manager');
      } else {
        Notice::add(Notice::ERROR, 'Usuário e/ou senha inválidos');
      }
    }
    
    $this->template->content = $view;
  }
  
  public function action_destroy()
  {
    $this->auto_render = FALSE;
    Auth::instance()->logout();
    return $this->request->redirect('manager/');
  }
  
} // End Sessions
