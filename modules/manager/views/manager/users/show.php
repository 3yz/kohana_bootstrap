<div class="navigation">
  <ul class='clearfix'>
    <li><?php echo Html::anchor('manager', 'Dashboard') ?></li>
    <li><?php echo Html::anchor('manager/news', 'Notícias') ?></li>
    <li class='active'><?php echo Html::anchor('manager/news/show/'.$news->id, $news->title) ?></li>
  </ul>
</div>

<section>
  <header>
    <div class="control">
      <?php echo Html::anchor('manager/news/edit/'.$news->id, Html::image('assets/imgs/edit.png') . ' Editar', array('class' => 'edit button')) ?>
      <?php echo Html::anchor('manager/news/delete/'.$news->id, Html::image('assets/imgs/cross.png') . ' Excluir', array('class' => 'delete button')) ?>
    </div>
    <h2>Visualizar notícia</h2>
  </header>
  
  <?php echo Notice::render() ?>
  
  <div class="fieldset">
    <h4>Notícia</h4>
    
    <div class="field ">
      <p class="label">Publicar em</p>
      <div class="value"><?php echo $news->published_at() ?></div>
    </div>
    
    <div class="field">
      <p class="label">Título</p>
      <div class="value"><?php echo $news->title ?></div>
    </div>
    
    <div class="field">
      <p class="label">Conteúdo</p>
      <div class="value"><?php echo $news->content ?></div>
    </div>
    
    <div class="field">
      <p class="label">Autor</p>
      <div class="value"><?php echo Html::anchor('manager/users/show/'.$news->user->id, $news->user->name) ?></div>
    </div>
    
  </div>
  
</section>