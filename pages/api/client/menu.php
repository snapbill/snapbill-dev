<?php

Layout_Menu::render('API', array(
  'Introduction' => array(
    'Making Requests' => '/api/introduction/requests',
  ),
  'API' => array(
    'Client' => array(
      '' => '/api/client',
      '/client/add' => '/api/client#add',
    ),
    'Batch' => '/api/api#batch',
  ),
  'Other' => array(
    'Home' => '/home',
    'Blog' => '/blog',
  ),
));

Layout_Page::content();
