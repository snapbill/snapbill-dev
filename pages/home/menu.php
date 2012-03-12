<?php

Layout_Menu::setup('Home', array(
  'Concepts' => array(
    'Actions' => '/home/concepts/actions',
    'Permissions' => '/home/concepts/permissions',
    'Signatures' => '/home/concepts/signatures',
    'Signup' => '/home/concepts/signup',
    'Xid' => '/home/concepts/xid',
  ),
  'Templates' => array(
    'Reference' => '/home/templates/reference',
    'Files' => '/home/templates/files',
  ),
));

Layout_Page::content();
