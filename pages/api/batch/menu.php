<?php

Layout_Menu::render('API', array(
  'Introduction' => array(
    'Making Requests' => '/api/introduction/requests',
  ),
  'Reference' => array(
    'Client' => '/api/client',
    'Batch' => array(
      '' => '/api/batch',
      '/batch/get' => '#batch-get',
    ),
  ),
));

Layout_Page::content();
