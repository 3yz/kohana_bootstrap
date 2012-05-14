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

  public static function recursive_list($list)
  {
    if (is_array($list)) {
      echo '<ul>';
      foreach ($list as $key => $value) {
        if (is_array($value)) 
        {
          echo "<li class='folder'><span class='before'></span><span>".$key;
          echo "</span>";
          self::recursive_list($value);
          echo "</li>";
        }
        else
        {
          if (preg_match('/\.pdf/', $value)) 
          {
            $arr_path = explode('/', $value);
            $file_name = end($arr_path);
            $path = substr($value, strpos($value, 'public/'));

            echo "<li class='file'><a target='_blank' href='".Url::base(TRUE).$path."'><span class='before'></span>" . $file_name . '</a></li>';  
          }
          else
          {
            echo "<li>" . $value . '</li>';
          }
        }
      }
      echo '</ul>';
    }
  }

} // End HTML