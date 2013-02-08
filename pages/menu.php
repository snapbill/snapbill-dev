<?php

$reference = array();
foreach (glob(__DIR__.'/api/reference/*.txt') as $file) {
  $class = substr(basename($file), 0, -4);
  $reference[ucfirst(u2s($class))] = '/api/reference/'.$class;
}

Layout_Menu::setup('Home', array(
  'General' => array(
    'Actions' => '/home/general/actions',
    'Permissions' => '/home/general/permissions',
    'Xid' => '/home/general/xid',
  ),
  'Signup & payments' => array(
    'Signup' => '/home/signup/signup',
    'Payment' => '/home/signup/payment',
    'Signatures' => '/home/signup/signatures',
  ),
  'Templates' => array(
    'Template reference' => '/home/templates/reference',
    'Including files' => '/home/templates/files',
  ),
  'API' => array(
    'Requests' => '/api/introduction/requests',
  ),
  'Reference' => $reference
));

