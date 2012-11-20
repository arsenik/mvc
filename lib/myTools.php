<?php
class myTools extends myObject {
  
  static public function stripslashes_deep($value)
  {
      $value = is_array($value) ?
                  array_map(array('myTools', 'stripslashes_deep'), $value) :
                  stripslashes($value);

      return $value;
  }
  
  
  /**
   * Debug function
   */
  public static function dump($var, $name = 'var', $die = false, $return_buffer = false)
  {
    ob_start();
    print('<br/><pre>'. $name . (is_object($var) ? ' ('. get_class($var). ')' : ''). ' :'. PHP_EOL);
    print_r($var);
    print('</pre>');
    $buffer = ob_get_contents();
    ob_end_clean();

    $backtrace = debug_backtrace();
    $dieMsg = '<pre>';
    if ($die)
    {
      $dieMsg .= '<b>Process stopped by myTools:dump()</b>'. PHP_EOL;
    }
    $dieMsg .= isset($backtrace[0]['file']) ?     '&raquo; file     : <b>'.
      $backtrace[0]['file'] .'</b>'. PHP_EOL : '';
    $dieMsg .= isset($backtrace[0]['line']) ?     '&raquo; line     : <b>'.
      $backtrace[0]['line'] .'</b>'. PHP_EOL : '';
    $dieMsg .= isset($backtrace[1]['class']) ?    '&raquo; class    : <b>'.
      $backtrace[1]['class'] .'</b>'. PHP_EOL : '';
    $dieMsg .= isset($backtrace[1]['function']) ? '&raquo; function : <b>'.
      $backtrace[1]['function'] .'</b>'. PHP_EOL : '';
    $dieMsg .= '</pre>';

    if($return_buffer)
    {
      return $buffer;
    }
    else
    {
      print($buffer);
    }

    if ($die == true)
    {
      die($dieMsg);
    }
    else
    {
      print($dieMsg);
    }
  }

}