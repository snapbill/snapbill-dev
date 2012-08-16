<?php

class JSONPretty {
  static function val($val) {

    if (is_object($val)) {
      if ($val instanceof Date) {
        $val = strval($val);
      }else{
        throw new Exception('Unknown object type for JSONPretty: '.$val);
      }
    }

    if (is_array($val)) {
      if (array_is_standard($val)) {
        return '['.self::arr($val).']';
      }else{
        return '{'.self::obj($val).'}';
      }
    }elseif (is_string($val)) {
      return '<span class="string">'.HTML(json_encode($val)).'</span>';
    }elseif (is_bool($val)) {
      return '<span class="bool">'.HTML(json_encode($val)).'</span>';
    }elseif (is_null($val)) {
      return '<span class="null">'.HTML(json_encode($val)).'</span>';
    }elseif (is_numeric($val)) {
      return '<span class="number">'.HTML(json_encode($val)).'</span>';
    }else{
      return '<span class="unknown">'.HTML(json_encode($val)).'</span>';
    }
  }

  static function arr($arr) {
    if (!$arr) {
      return ' ';
    }

    $output = '<ul class="obj closeable">';
    $first = True;
    foreach ($arr as $k => $v) {
      if ($first) {
        $first = False;
      }else $output .= ',</li>';

      $output .= '<li>' . self::val($v);
    }
    return $output . '</li></ul>';
  }

  static function obj($obj) {
    if (!$obj) {
      return ' ';
    }

    $output = '<ul class="obj closeable">';
    $first = True;
    foreach ($obj as $k => $v) {
      if ($first) {
        $first = False;
      }else $output .= ',</li>';
      $output .= '<li><span class="key">'.HTML($k).'</span>: ' . self::val($v);
    }
    return $output . '</li></ul>';
  }

  static function write($obj) {
    print '<div class="json">' . self::val($obj) . '</div>';
  }
}


