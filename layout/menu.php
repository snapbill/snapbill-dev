<?php

class Layout_Menu {



  static function render($menu) {
    Layout_Page::header();
    ?>
<div class="sidebar">
  <div class="well">
  <?php foreach ($menu as $section => $links) { ?>
    <h5><?php echo HTML($section); ?></h5>
    <ul>
    <?php foreach ($links as $title => $href) { ?>
      <li><a href="<?php echo HTML($href); ?>"><?php echo HTML($title); ?></a></li>
    <?php } ?>
    </ul>
  <?php } ?>
  </div>
</div>
    <?php
  }







}
