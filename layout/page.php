<?php

class Layout_Page {

  private static $state = NULL;

  static function header() {
    if (self::$state !== NULL) return;
    self::$state = 'page';
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
        <li class="active"><a href="/">Home</a></li>
        <li><a href="/blog">Blog</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container-fluid">
    <?php
  }

  static function content() {
    if (self::$state != 'page') return;
    print '<div class="content">';
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
