<section>
  <header class="page-header">
    <h1>Usuários</h1>    
  </header>

  <?php echo View::factory('notice/base')->set('notices', Notice::render()); ?>

  <?php echo Html::anchor('manager/users/new','Adicionar', array('class' => 'add btn btn-primary')) ?>  
  
  <?php echo Form::open('manager/users/bulk_action', array('method' => 'post', 'id' => 'bulk_action')) ?>
    <?php echo Form::hidden('action') ?>
    <table class="table table-striped">
      <thead>
        <th class="select"><input type="checkbox" id='check_all'></th>
        <th class="id">#</th>
        <th class="name">Nome</th>
        <th class="username">Usuário</th>
        <th class="E-mail">E-mail</th>
        <th class="actions">&nbsp;</th>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr class="link" data-link="<?php echo Url::site('manager/users/edit/'.$user->id) ?>">
            <td class="select"><?php echo Form::checkbox('id[]', $user->id) ?></td>
            <td class="id"><?php echo $user->id ?></td>
            <td class="name"><?php echo $user->name ?></td>
            <td class="username"><?php echo $user->username ?></td>
            <td class="email"><?php echo $user->email ?></td>
            <td class="actions">
              <?php //echo Html::anchor('manager/users/show/'.$user->id, Html::image('assets/imgs/show-24.png', array('alt' => 'visualizar'))) ?>
              <?php 
                echo Html::anchor(
                  'manager/users/edit/'.$user->id, 
                  '<i class="icon-edit"></i>',
                  array(
                    'class' => 'btn btn-small',
                    'title' => 'Alterar'
                  )
                ) 
              ?>
              <?php 
                echo Html::anchor(
                  'manager/users/delete/'.$user->id, 
                  '<i class="icon-remove"></i>', 
                  array(
                    'class' => 'delete btn btn-small',
                    'title' => 'Excluir'
                  )
                ) 
              ?>
            </td>
          </tr>  
        <?php endforeach ?>
      </tbody>
    </table>
    <button type='submit' class='delete btn btn-danger' id='delete_selecteds'>Excluir selecionados</button>
  <?php echo Form::close() ?>
</section>
