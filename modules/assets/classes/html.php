<?php defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML {

  public static function style($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
  {
    $file = self::convert_file_name($file, '.css');
    return parent::style($file, $attributes, $protocol, $index);
  }

  public static function script($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
  {
    $file = self::convert_file_name($file, '.js');
    return parent::script($file, $attributes, $protocol, $index);
  }

  protected static function convert_file_name($file, $extension){
    $paths = explode('/', $file);
    $file_name = end($paths); 
    $file_path = DOCROOT . $file;

    if (file_exists($file_path)) 
    {
      $new_file_name = str_replace($extension, '.'.filemtime($file_path).$extension, $file);
      $file = $new_file_name;
    }
    return $file;
  }

} // End HTML
