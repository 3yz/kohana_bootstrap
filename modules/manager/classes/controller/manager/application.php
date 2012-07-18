<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_Application extends Controller_Template {
  
  public $template = 'manager/templates/manager';
  public $view = null;
  public $title = '';
  
  public function before(){
    parent::before();

    if (!Auth::instance()->logged_in() && ($this->request->controller() != 'sessions' && $this->request->action() != 'new')) {
      return $this->request->redirect('manager/login');
    }
    
    $this->config = Kohana::$config->load('manager');
    $this->title = Kohana::$config->load('manager.title');

    if ($this->auto_render) {
      $this->template->styles = array();
      $this->template->scripts = array();
    }
    $this->template->title = $this->title;
  }
  
  public function after(){
    if ($this->auto_render) {
      // assets
      $styles = array(
    		'assets/css/jquery-ui/aristo/aristo.css',
        'assets/css/jquery.wysiwyg/jquery.wysiwyg.css',
        'assets/css/jquery.wysiwyg/jquery.wysiwyg.modal.css',
        'assets/css/bootstrap.min.css',
    		'assets/css/style.css',
    	);

    	$scripts = array(
    		'assets/js/jquery-1.7.2.min.js',
    		'assets/js/jquery-ui-1.8.16.min.js',
        'assets/js/jquery.wysiwyg.js',
        'assets/js/wysiwyg.link.js',
        'assets/js/wysiwyg.table.js',
        'assets/js/wysiwyg.image.js',
        'assets/js/bootstrap.min.js',
    		'assets/js/plugins.js',
    		'assets/js/application.js'
    	);
    	$this->template->styles = array_merge( $this->template->styles, $styles );
    	$this->template->scripts = array_merge( $this->template->scripts, $scripts );
    }
    parent::after();
  }
  

} // End Application
