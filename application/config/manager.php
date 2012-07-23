<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
  'title' => 'website title',
  'menu'  => array(
    array(
      'title'      => 'Teste 1',
      'controller' => 'controller',
      'url'   => 'teste/teste',
      'itens' => array()
    ),
    array(
      'title' => 'Teste 2',
      'controller' => 'controller',
      'url'   => 'teste/teste',
      'itens' => array()
    ),
    array(
      'title' => 'Submenu',
      'controller' => 'controller',
      'itens' => array(
        array(
          'title' => 'Teste 2',
          'url'   => 'teste/teste',
        ),
        array(
          'title' => 'Teste 2',
          'url'   => 'teste/teste',
        )
      )
    )
  )
);
