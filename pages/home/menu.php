<?php

Layout_Menu::render('Home', array(
  'Concepts' => array(
    'Actions' => '/home/concepts/actions',
    'Permissions' => '/home/concepts/permissions',
    'Xid' => '/home/concepts/xid',
  ),
  'Templates' => array(
    'Reference' => '/home/templates/reference',
    'Files' => '/home/templates/files',
  ),
  'Other' => array(
    'API' => '/api',
    'Blog' => '/blog',
  ),
));

Layout_Page::content();
