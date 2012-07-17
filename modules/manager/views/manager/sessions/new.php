<div class="span4 offset4">
  <h1>Login</h1>
  <?php echo Form::open('manager/login', array('class' => 'well')) ?>
    <?php echo View::factory('notice/base')->set('notices', Notice::render()); ?>
    <label for="user_username">E-mail ou usuário</label>
    <?php echo Form::input('username', null, array('id' => 'user_username')) ?>
    <label for="user_password">Senha</label>
    <?php echo Form::password('password', null, array('id' => 'user_password')) ?>
    <button type='submit' class='btn btn-primary'>Logar</button>
  <?php echo Form::close() ?>
</div>  