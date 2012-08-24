<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
  'title' => 'Manager',
  'menu'  => array(
    array(
      'title' => 'Dashboard',
      'controller' => 'dashboard',
      'url'   => 'manager/dashboard',
      'itens' => array(),
      'roles' => array()
    ),
    array(
      'title' => 'Usuários',
      'controller' => 'users',
      'url'   => 'manager/users',
      'itens' => array(),
      'roles' => array('admin')
    )
    // array(
    //   'title' => 'Perguntas',
    //   'controller' => 'questions',
    //   'itens' => array(
    //     array(
    //       'title' => 'Aguardando Resposta',
    //       'url'   => 'manager/questions?type=waiting'
    //     ),
    //     array(
    //       'title' => 'Respondidas',
    //       'url'   => 'manager/questions?type=answered'
    //     ),
    //     array(
    //       'title' => 'Inválidas',
    //       'url'   => 'manager/questions?type=invalid'
    //     ),
    //   ),
    //   'roles' => array()
    // )
  )
);
