<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Nucleus_Sales_Utility
{
  private $list_view_data = array();
  
  function __construct()
  {
    $CI =& get_instance();
  }

  public function password_generator($length = 5)
  {
    $stacks = "";
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for ($i=0; $i < $length; $i++) { 
      $stacks.=substr($chars, rand(0, strlen($chars)), 1);
    }

    return $stacks;
  }

  public function alphabet_generator($length = 1)
  {
    $stacks = "";
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    for ($i=0; $i < $length; $i++) { 
      $stacks.=substr($chars, rand(0, strlen($chars)), 1);
    }
    
    return $stacks;
  }

  public function date_formatter($date_string, $format)
  {
    $date_object = date_create($date_string);
    $formatted_date = date_format($date_object, $format);
    return $formatted_date;
  }

  public function time_id_generator($prefix = NULL)
  {
    $micro_time = microtime();
    $ex_mt = explode(' ', $micro_time);
    $sbstr_mt = substr($ex_mt[0], 5, 3);
    $id = date('ymdHis') . '-' . $sbstr_mt;
    
    if ( ! is_null($prefix)) {
      $id = $prefix . '-' . date('ymdHis') . '-' . $sbstr_mt;
    }

    return $id;
  }

  public function digit_id_generator($digits = 4, $prefix = NULL)
  {
    $id = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
    if (! is_null($prefix)) {
      $id = $prefix . $id;
    }
    return "$id";
  }

  public function letter_number_generator($prefix = NULL)
  {
    $micro_time = microtime();
    $ex_mt = explode(' ', $micro_time);
    $sbstr_mt = substr($ex_mt[0], 5, 3);
    $id = $sbstr_mt . '-' . date('m-Y');
    
    if ( ! is_null($prefix)) {
      $id = $prefix . '-' . $sbstr_mt . '-' . date('m-Y');
    }

    return $id;
  }

  public function zerofill_generator($max_digit = 4, $value)
  {
    $incremented_val = $value + 1;
    $val_length = strlen($incremented_val);
    $allowed_digits = $max_digit - $val_length;
    for ($i=0; $i < $allowed_digits; $i++) { 
      $zerofill .= '0';
    }

    return $zerofill . $incremented_val;
  }
}