<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_Users extends Controller_Manager_Application {
  
  public function before(){
    parent::before();

    $this->template->title .= ' - Usuários';
    if(!Auth::instance()->logged_in('admin'))
    {
      $this->request->redirect('manager/dashboard');
    }
  }
  
  public function action_index() {
    $view = View::factory('manager/users/index');
    $view->users = User::find('all');
    
    $this->template->content = $view;

  }
  
  public function action_show(){
    $view = View::factory('manager/users/show');
    $view->user = ORM::factory('user', $this->request->param('id'));
    
    $this->template->content = $view;
  }
  
  public function action_new(){
    $this->template->title .= ' - novo';

    $user = new User();

    $db_roles = Role::find('all', array('conditions' => array('name<>?','login')));
    $roles = array('' => 'selecione');

    foreach($db_roles as $role){
      $roles[$role->name] = $role->description;
    }

    $view = View::factory('manager/users/new');
    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);
    
    $this->template->content = $view;
  }
  
  public function action_create(){
    $user = new User();

    $db_roles = Role::find('all', array('conditions' => array('name<>?','login')));
    $roles = array('' => 'selecione');

    foreach($db_roles as $role){
      $roles[$role->name] = $role->description;
    }


    $this->template->title .= ' - novo';
    $view = View::factory('manager/users/new');
    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);
      
    if($this->request->method() == Request::POST)
    {
      $user = $user->create_user(
        $this->request->post('name'),
        $this->request->post('username'),
        $this->request->post('password'),
        $this->request->post('password_confirm'),
        $this->request->post('email'),
        $this->request->post('role')
      );

      if($user->is_valid()){
        Notice::add(Notice::SUCCESS, 'Usuário adicionado com sucesso');
        if(!is_null($this->request->post('save_and_add_other'))){
          $this->request->redirect('manager/users/new');  
        } else {
          $this->request->redirect('manager/users');  
        }
      } else {
        Notice::add(Notice::ERROR, 'Confira os campos obrigatórios antes de continuar');
      }
    }

    $this->template->content = $view;
  }
  
  public function action_edit(){
    $user = User::find($this->request->param('id'));
    
    $db_roles = Role::find('all', array('conditions' => array('name<>?','login')));
    $roles = array('' => 'selecione');

    foreach($db_roles as $role){
      $roles[$role->name] = $role->description;
    }

    $view = View::factory('manager/users/edit');
    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);

    $this->template->title .= ' - '.$user->username;
    $this->template->content = $view;
  }
  
  public function action_update(){
    $user = User::find($this->request->param('id'));

    $db_roles = Role::find('all', array('conditions' => array('name<>?','login')));
    $roles = array('' => 'selecione');

    foreach($db_roles as $role){
      $roles[$role->name] = $role->description;
    }

    $view = View::factory('manager/users/edit');
    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);
    
    if($this->request->method() == Request::POST)
    {
      $user = $user->update_user(
        $this->request->param('id'),
        $this->request->post('name'),
        $this->request->post('username'),
        $this->request->post('password'),
        $this->request->post('password_confirm'),
        $this->request->post('email'),
        $this->request->post('role')
      );

      if($user->is_valid()){
        Notice::add(Notice::SUCCESS, 'Usuário atualizado com sucesso');
        if(!is_null($this->request->post('save_and_add_other'))){
          $this->request->redirect('manager/users/new');  
        } else {
          $this->request->redirect('manager/users');  
        }
      } else {
        Notice::add(Notice::ERROR, 'Confira os campos obrigatórios antes de continuar');
      }
    }
    
    $this->template->title .= ' - '.$user->username;
    $this->template->content = $view;
  }
  
  public function action_delete(){
    $user = User::find($this->request->param('id'));
    if($user->delete()){
      Notice::add(Notice::INFO, 'Item excluído com sucesso');
    }

    $this->request->redirect('manager/users');
  }

  //bulk action
  public function action_bulk_action(){
    if($this->request->post('action') == 'delete'){
      if($ids = $this->request->post('id'))
      {
        User::table()->delete(array('id' => $ids));
        Notice::add(Notice::INFO, count($ids) . ' item(s) excluído(s) com sucesso');
      }
    }
    $this->request->redirect('manager/users');
  }

} // End Manager users
