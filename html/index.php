<?php
chdir(__DIR__.'/..');
require 'init.php';

$uri = Request::getUri();

// Permanent redirect from old blog posts
$map = array(
  '%^(/2011/02)?/templating-language-overview/?$%' => '/blog/2011/02/templating-language-overview/',
  '%^(/2011/02)?/a-browseable-restish-api/?$%' => '/blog/2011/02/a-browseable-restish-api/',
  '%^(/2011/10)?/catching-errors-in-php/?$%' => '/blog/2011/02/catching-errors-in-php/'
);
foreach ($map as $regex=>$to) {
  if (preg_match($regex, $uri->get())) {
    Request::permanentRedirect($to);
  }
}

$view = View::findExact($uri, 'pages');
if (!$view) {
  $view = View::findExact('/home/error/404', 'pages');
}
$view->render();

Layout_Page::footer();
