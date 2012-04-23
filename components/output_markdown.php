#!/usr/bin/php
<?php
require __DIR__ . '/../init.php';
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['REQUEST_URI'] = $argv[2];

$view = new View_Markdown($argv[1], array());
Layout_Page::reset();
Layout_Page::header();
$view->render();
Layout_Page::footer();
