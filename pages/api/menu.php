<?php

Layout_Menu::render('API', array(
  'Introduction' => array(
    'Making Requests' => '/api/introduction/requests',
  ),
  'Reference' => array(
    'Client' => '/api/client',
    'Batch' => '/api/batch',
  ),
));

Layout_Page::content();
