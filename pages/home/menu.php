<?php

Layout_Menu::render(array(
  'Concepts' => array(
    'Actions' => '/home/concepts/actions',
    'Xid' => '/home/concepts/xid'
  ),
  'Templates' => array(
    'Reference' => '/home/templates/reference'
  )
));

Layout_Page::content();
