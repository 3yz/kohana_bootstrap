<section>
  <header class="page-header">
    <h1>Usuários <small>Adicionar</small></h1>
  </header>
  
  <?php echo View::factory('notice/base')->set('notices', Notice::render()); ?>
  
  <?php echo Form::open('manager/users/create', array('class' => 'well', 'enctype' => 'multipart/form-data')) ?>
    <?php 
      echo View::factory('manager/users/_form')
        ->set('user', $user) 
        ->set('roles', $roles) 
        ->set('errors', $errors) 
    ?>
  <?php echo Form::close() ?>
  
</section>