<?php

class Layout_Menu {

  private static $section;
  private static $menu;

  static function setup($section, $menu) {
    self::$section = $section;
    self::$menu = $menu;
  }

  private static function updateRef($uri, &$ref, $replace) {
    foreach ($ref as $key => $menu) {
      if (is_array($menu)) {
        self::updateRef($uri, $ref[$key], $replace);
      }elseif ($menu == $uri) {
        if (is_array($replace) && !isset($replace[''])) {
          $replace[''] = $uri;
        }
        $ref[$key] = $replace;
      }
    }
  }

  static function update($replace) {
    $uri = Request::getUri();
    self::updateRef($uri->get(), self::$menu, $replace);
  }

  static function render() {
    Layout_Page::header();
    $uri = Request::getUri();
    ?>
<div class="span2">
  &nbsp;
  <div id="menu">
  <ul class="nav nav-list">
  <?php foreach (self::$menu as $section => $links) {

    // See if the page is active
    $active = False;
    $first = null;
    foreach ($links as $title => $href) {
      if (is_array($href)) {
        $href = $href[''];
      }

      // Check if its active, and keep track of first href
      if ($first === null) $first = $href;
      $active = $active || ($uri->get() == $href);
    }

    if ($uri->get() == '/home' && strtoupper($section) == 'GENERAL') {
      $active = True;
    }elseif ($uri->get() == '/api' && strtoupper($section) == 'REFERENCE') {
      $active = True;
    }

    if ($active) {
      print '<li class="nav-header">'.HTML($section).'</li>';
    }

    if ($active) {
      foreach ($links as $title => $href) {
        $html = HTML($title);

        // If we have array of children
        if (is_array($href)) {
          $children = $href;
          $href = $href[''];
        }else $children = null;

        if ($uri->get() == $href) {
          print '<li class="fixed-active"><a href="'.HTML($href).'">'.$html.'</a></li>';
        }else{
          print '<li><a href="'.HTML($href).'">'.$html.'</a></li>';
        }

        if ($children) {
          foreach ($children as $title => $href) {
            if (!$title) continue;
            print '<li class="level2"><a href="'.HTML($href).'">'.HTML($title).'</a></li>';
          }
        }
      }
    }
  }
  ?>
  </ul>
  </div>
</div>
    <?php
  }







}
