<?php

Layout_Menu::render(array(
  'Introduction' => array(
    'Making Requests' => '/api/introduction/requests',
    'Xid' => '/home/concepts/xid'
  ),
  'Templates' => array(
    'Reference' => '/home/templates/reference'
  )
));

Layout_Page::content();
