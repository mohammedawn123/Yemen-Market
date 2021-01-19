<?php
$router->group(['prefix' => 'orders'], function ($router) {
    $router->get('/', 'AdminOrderController@index')->name('admin.orders.list');
    $router->get('/create/new', 'AdminOrderController@create');
    $router->put('/store', 'AdminOrderController@store');
    $router->get('/edit/{id}', 'AdminOrderController@edit')->name('admin.orders.edit');
    $router->put('/update', 'AdminOrderController@update')->name('admin.orders.update');
    $router->post('/delete', 'AdminOrderController@delete')->name('admin.orders.delete');
    $router->get('/customer_info', 'AdminOrderController@getInfoCustomer')->name('admin.orders.customer_info');
    $router->get('/product_info', 'AdminOrderController@getProductInfo')->name('admin.orders.product_info');
    $router->get('/print/{id}', 'AdminOrderController@orderPrint')->name('admin.order.print');
});

