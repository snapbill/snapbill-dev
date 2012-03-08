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
<link href="/ext/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/layout.css" rel="stylesheet">
<link href="/ext/google-code-prettify/prettify.css" rel="stylesheet">
</head>
<body data-spy="scroll">

<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
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
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/ext/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/ext/google-code-prettify/prettify.js"></script>
<script src="/js/code.js"></script>
</body>
</html>
    <?php


  }
}
