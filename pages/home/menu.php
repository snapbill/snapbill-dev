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
  )
));

Layout_Page::content();
