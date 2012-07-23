<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $title ?></title>
  <meta name="author" content="3yz.com">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <base href="<?php echo URL::base(true) ?>">
  <!-- <base href="<?php echo URL::base(true) ?>"> -->
  <?php foreach ($styles as $file) echo HTML::style($file), PHP_EOL ?>
  <?php echo Html::script('assets/js/modernizr-2.0.6.min.js') ?>
</head>
<body class="<?php echo Request::current()->controller() ?>" data-controller='<?php echo Request::current()->controller() ?>' data-action='<?php echo Request::current()->action() ?>'>
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <?php echo Html::anchor('manager', Kohana::$config->load('manager.title'), array('class' => 'brand')) ?>
        <?php if(Auth::instance()->logged_in()): ?>
        <ul class="nav">          
          <?php foreach(Kohana::$config->load('manager.menu') as $item): ?>
          <?php if(count($item['roles']) == 0 || (count($item['roles']) > 0 && Auth::instance()->logged_in($item['roles']))): ?>
          <li class="<?php echo (count($item['itens']) > 0) ? 'dropdown' : '' ?> <?php echo Request::current()->controller() == $item['controller'] ? 'active' : '' ?>">
            <?php if(count($item['itens']) > 0 ): ?>
              <?php echo Html::anchor('#', $item['title'] . '<b class= "caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')); ?>
              <ul class="dropdown-menu">
                <?php foreach($item['itens'] as $subitem): ?>
                  <li><?php echo Html::anchor($subitem['url'], $subitem['title']); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <?php echo Html::anchor($item['url'], $item['title']); ?>
            <?php endif; ?>
          </li>
          <?php endif; ?>
          <?php endforeach; ?>
        </ul>
        <ul class="nav pull-right">
          <li><?php echo Html::anchor('manager/logout', 'Sair') ?></li>
        </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div id="main" class="container">
    <div class="row">
    <?php echo $content ?>
    </div>
  </div> <!--! end of #container -->
  <!-- JavaScript at the bottom for fast page loading -->
  <?php foreach ($scripts as $file) echo HTML::script($file), PHP_EOL ?>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>
