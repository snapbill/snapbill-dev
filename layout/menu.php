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
    <?php
      $heading = HTML(self::$section);
      print "<h3>$heading</h3>";
  ?>
  <?php foreach (self::$menu as $section => $links) { ?>
    <li class="nav-header"><?php echo HTML($section); ?></li>
    <?php foreach ($links as $title => $href) {
      $html = HTML($title);

      // If we have array of children
      if (is_array($href)) {
        $children = $href;
        $href = $href[''];
      }else $children = null;

      if ($uri->get() == $href) {
        print '<li class="active"><a href="'.HTML($href).'">'.$html.'</a></li>';
      }else{
        print '<li><a href="'.HTML($href).'">'.$html.'</a></li>';
      }

      if ($children) {
        foreach ($children as $title => $href) {
          if (!$title) continue;
          print '<li class="level2"><a href="'.HTML($href).'">'.HTML($title).'</a></li>';
        }
      }
    } ?>
  <?php } ?>
  </ul>
  </div>
</div>
    <?php
  }







}
