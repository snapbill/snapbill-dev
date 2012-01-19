<?php

class Autoload {
  static $paths = array();
  static $callbacks = array();

  static function addPath($path, $split=array('\\', '_'), $lower=True, $prefix=array()) {
    // Prefix is split according to the same rules
    if (!is_array($prefix)) {
      $prefix = explode('\\', str_replace($split, '\\', $prefix));
    }
    // Add to the list of paths
    self::$paths[] = array(realpath($path).'/', $split, $lower, $prefix);
  }

  static function addCallback($callback) {
    self::$callbacks[] = $callback;
  }

  static function testFile($path, $extension) {
    $extension = implode('/', $extension);
    if (file_exists($path.$extension)) {
      return $path.$extension;
    }
    return NULL;
  }

  static function testPath($path, $parts) {
    $final = array_pop($parts);

    if ($result = self::testFile($path, array_merge($parts, array($final, $final.'.php')))) {
      return $result;
    }

    if ($result = self::testFile($path, array_merge($parts, array($final.'.php')))) {
      return $result;
    }

    if ($parts) {
      return self::testPath($path, $parts);
    }
  }

  static function findPath($class) {
    foreach (self::$paths as $path) {
      list($path, $split, $lower, $prefix) = $path;

      // Split the class name appropriately
      if (is_array($class)) {
        $parts = $class;
      }else{
        $parts = explode('\\', str_replace($split, '\\', $class));
      }

      // Move to lower-case if needed
      if ($lower) {
        $parts = array_map('strtolower', $parts);
      }

      // Check the prefix matches
      while ($prefix) {
        if (strcasecmp(array_shift($prefix), array_shift($parts)) != 0) {
          $parts = NULL;
          break;
        }
      }
      if (!$parts) continue;

      // Check if the path is actually valid
      if ($result = self::testPath($path, $parts)) {
        return $result;
      }
    }
    return NULL;
  }

  static function load($class) {
    foreach (self::$callbacks as $cb) {
      if ($cb($class) === True) return True;
    }

    if ($path = self::findPath($class)) {
      require_once $path;
      return True;
    }
    return False;
  }

  static function preload($classes) {
    foreach ($classes as $class) {
      if (!self::load($class)) {
        throw new Exception('Could not preload requested class: '.$class);
      }
    }
  }
}

spl_autoload_register(array('Autoload', 'load'));

