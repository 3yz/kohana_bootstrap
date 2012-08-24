<fieldset>
  <div class="control-group <?php echo (!is_null($user->errors) && !is_null($user->errors->on('name'))) ? 'error' : ''; ?>">
    <label for="user_name">Nome</label>
    <?php echo Form::input('name', $user->name, array('id' => 'user_name', 'class' => 'input-xlarge')) ?>
    <span class="help-block">Campo obrigatório. Máx. 255 caracteres</span>
  </div>

  <div class="control-group <?php echo (!is_null($user->errors) && !is_null($user->errors->on('email'))) ? 'error' : ''; ?>">
    <label for="user_email">E-mail</label>
    <?php echo Form::input('email', $user->email, array('id' => 'user_email', 'class' => 'input-xlarge')) ?>
    <span class="help-block">Campo obrigatório. Máx. 255 caracteres</span>
  </div>

  <div class="control-group <?php echo (!is_null($user->errors) && !is_null($user->errors->on('username'))) ? 'error' : ''; ?>">
    <label for="user_username">Usuário</label>
    <?php echo Form::input('username', $user->username, array('id' => 'user_username')) ?>
    <span class="help-block">Campo obrigatório. Máx. 255 caracteres</span>
  </div>

  <div class="control-group <?php echo (!is_null($user->errors) && !is_null($user->errors->on('password'))) ? 'error' : ''; ?>">
    <label for="user_password">Senha</label>
    <?php echo Form::password('password', null, array('id' => 'user_name', 'class' => 'input-medium')) ?>
    <span class="help-block">Campo obrigatório. Mínimo 8 caracteres</span>  
  </div>

  <div class="control-group <?php echo (!is_null($user->errors) && !is_null($user->errors->on('password'))) ? 'error' : ''; ?>">
    <label for="user_password_confirm">Confirmação da senha</label>
    <?php echo Form::password('password_confirm', null, array('id' => 'user_password_confirm', 'class' => 'input-medium')) ?>
    <span class="help-block">Campo obrigatório.</span>
  </div>

  <div class="control-group <?php echo (!is_null($user->errors) && !is_null($user->errors->on('level'))) ? 'error' : ''; ?>">
    <label for="user_role">Permissão</label>
    <?php echo Form::select('role', $roles, ($user->loaded() ? $user->roles[count($user->roles) -1]->name : null), array('id' => 'user_role')) ?>
    <span class="help-block">Campo obrigatório.</span>
  </div>
  
</fieldset>

<div class="form-actions">
  <?php echo Form::button('save', 'Salvar', array('type' => 'submit', 'class' => 'btn btn-success')) ?>
  <?php echo Form::button('save_and_add_other', 'Salvar e adicionar outro', array('type' => 'submit', 'class' => 'btn btn-success')) ?>
  ou <?php echo Html::anchor('manager/users', 'cancelar') ?>
</div>