<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Exception extends Kohana_Kohana_Exception {
 
  public static function handler(Exception $e)
  {
    if (Kohana::$environment === Kohana::DEVELOPMENT) {
      parent::handler($e);
    } else {
      try {
        Kohana::$log->add(Log::ERROR, parent::text($e));
        $params = array(
          'action'  => 500,
          'message' => rawurlencode($e->getMessage())
        );

        if ($e instanceof HTTP_Exception) {
            $params['action'] = $e->getCode();
        }

        // Error sub-request.
        echo Request::factory(Route::get('error')->uri($params))
            ->execute()
            ->send_headers()
            ->body();
      } catch (Exception $e) {
        // Clean the output buffer if one exists
        ob_get_level() and ob_clean();

        // Display the exception text
        echo parent::text($e);

        // Exit with an error status
        exit(1);
      }
    }
  }
}
