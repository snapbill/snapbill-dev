<?php

class Config {
  private static $db = array(
  );

  private static function writeArray(&$db, $array) {
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        self::writeArray($db[$k], $v);
      }else{
        $db[$k] = $v;
      }
    }
  }
  static function write(/*..., $value */) {
    $args = func_get_args();
    $value = array_pop($args);

    $db = &self::$db;

    foreach ($args as $arg) {
      if (!isset($db[$arg])) {
        $db[$arg] = array();
      }
      $db = &$db[$arg];
    }

    if (is_array($value)) {
      self::writeArray($db, $value);
    }else $db = $value;
  }

  static function get(/* ... */) {
    $result = self::$db;
    foreach (func_get_args() as $arg) {
      if (isset($result[$arg])) {
        $result = $result[$arg];
      }else return NULL;
    }
    return $result;
  }
}
