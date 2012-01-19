<?php
chdir(__DIR__.'/..');
require 'free/common.php';
Autoload::addPath('layout', array('_'), True, 'layout');
Autoload::addPath('components');

$uri = Uri::interpretRequest();

$view = View::findExact($uri, 'pages');
if (!$view) {
  $view = View::findExact('/home/error/404', 'pages');
}
$view->render();

Layout_Page::footer();
