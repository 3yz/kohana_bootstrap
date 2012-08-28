<?php defined('SYSPATH') or die('No direct script access.');

class Form extends Kohana_Form{

  public static function select_from_model($name, array $collection, array $config = null , $selected = NULL, array $attributes = NULL)
  {

    $base_config = array(
      'empty' => false,
      'value' => 'id',
      'text'  => 'name'
    );

    $config = array_merge(
      $base_config,
      $config
    );

    if($config['empty']){
      $options[''] = $config['empty'];
    }

    foreach ($collection as $option) {
      $options[$option->$config['value']] = $option->$config['text'];
      if($base_config['value'] != 'id' && $options[$option->$config['value']] == $selected){
        $selected = $options['id'];
      }
    }

    return Form::select($name, $options, $selected, $attributes);

  }

} // End form
