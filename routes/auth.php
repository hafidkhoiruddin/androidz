<?php

$router->post('/signup', 'AuthController@signup');
$router->post('/signin', 'AuthController@signin');
$router->post('/signout', 'AuthController@signout');
