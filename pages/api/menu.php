<?php

$reference = array();
foreach (glob(__DIR__.'/reference/*.txt') as $file) {
  $class = substr(basename($file), 0, -4);
  $reference[ucfirst(u2s($class))] = '/api/reference/'.$class;
}

Layout_Menu::setup('API', array(
  'Introduction' => array(
    'Requests' => '/api/introduction/requests',
  ),
  'Reference' => $reference
));

