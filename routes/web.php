<?php

$router->get('/vendors', 'VendorController@index');
$router->get('/vendors/show/{id}', 'VendorController@show');
$router->post('/vendors/order', 'VendorController@order');
$router->put('/vendors/order/{id}', 'VendorController@updateOrder');

$router->get('/orders', 'VendorController@getOrders');