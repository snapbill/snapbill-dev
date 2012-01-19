<?php

class Layout_Page {

  private static $state = NULL;

  static function header() {
    if (self::$state !== NULL) return;
    self::$state = 'page';

    $uri = Request::getUri();

    $sections = array(
      'home' => 'Home',
      'api'  => 'API',
      'blog' => 'Blog'
    );
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>SnapBill Developers</title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/layout.css" rel="stylesheet">
</head>
<body>

<div class="topbar">
  <div class="topbar-inner">
    <div class="container-fluid">
      <a href="/" class="brand">SnapBill &ndash; Developers</a>
      <ul class="nav">
      <?php foreach ($sections as $section => $title) { ?>
        <li <?php echo $uri->getPart(0) == $section ? ' class="active"' : ''; ?>><a href="/<?php echo $section; ?>"><?php echo HTML($title); ?></a></li>
      <?php } ?>
      </ul>
    </div>
  </div>
</div>
<div class="container">
 <div class="content">
  <div class="row">
    <?php
  }

  static function content() {
    if (self::$state != 'page') return;
    self::$state = 'content';
  }

  static function endContent() {
    if (self::$state != 'content') return;
    self::$state = 'end-page';
  }

  static function footer() {
    if (self::$state == 'content') self::endContent();
    if (self::$state != 'end-page') return;
    ?>
      </div>
      <footer>
        <p>&copy; SnapBill 2011</p>
      </footer>
    </div>
  </div>
<script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
</body>
</html>
    <?php


  }
}
