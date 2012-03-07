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

      // If we have array of children
      if (is_array($href)) {
        $children = $href;
        $href = $href[''];
      }else $children = null;

      if ($uri->get() != $href) {
        $html = '<a href="'.HTML($href).'">'.$html.'</a>';
      }else $html = '<span>'.$html.'</span>';

      if ($children) {
        $html .= '<ul>';
        foreach ($children as $title => $href) {
          if (!$title) continue;
          $html .= '<li><a href="'.HTML($href).'">'.HTML($title).'</a></li>';
        }
        $html .= '</ul>';
      }

      print "<li>$html</li>";
    } ?>
    </ul>
  <?php } ?>
  </div>
</div>
    <?php
  }







}
