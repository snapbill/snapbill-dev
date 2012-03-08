<?php

class Layout_Menu {



  static function render($section, $menu) {
    Layout_Page::header();
    $uri = Request::getUri();
    ?>
<div class="span2">
  &nbsp;
  <div id="menu">
  <ul class="nav nav-list">
    <?php
      $heading = HTML($section);
      print "<h3>$heading</h3>";
  ?>
  <?php foreach ($menu as $section => $links) { ?>
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
