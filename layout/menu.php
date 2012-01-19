<?php

class Layout_Menu {



  static function render($section, $menu) {
    Layout_Page::header();
    $uri = Request::getUri();
    ?>
<div class="span4">
  <div id="menu" class="well">
    <?php
      $heading = HTML($section);
      if (count($uri) > 1) {
        $heading = '<a href="/'.$uri->getPart(0).'">'.$heading.'</a>';
      }
      print "<h2>$heading</h2>";
  ?>
  <?php foreach ($menu as $section => $links) { ?>
    <h5><?php echo HTML($section); ?></h5>
    <ul>
    <?php foreach ($links as $title => $href) {
      $html = HTML($title);
      if ($uri->get() != $href) {
        $html = '<a href="'.HTML($href).'">'.$html.'</a>';
      }else $html = '<span>'.$html.'</span>';
      print "<li>$html</li>";
    } ?>
    </ul>
  <?php } ?>
  </div>
</div>
    <?php
  }







}
