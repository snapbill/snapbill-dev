<?php

Layout_Menu::render('API', array(
  'Introduction' => array(
    'Making Requests' => '/api/introduction/requests',
  ),
  'Reference' => array(
    'Client' => array(
      '' => '/api/client',
      '/client/add' => '#client-add',
      '/client/get' => '#client-get',
      'states' => '#states',
      'parameters' => '#parameters',
    ),
    'Batch' => '/api/batch',
  ),
));

Layout_Page::content();
