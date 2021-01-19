<?php
$router->group(['prefix' => 'orderStatuses'], function ($router) {
    $router->get('/', 'AdminOrderStatusController@index')->name('admin.orderStatuses.list');
    $router->get('/edit', 'AdminOrderStatusController@edit')->name('admin.orderStatuses.edit');
    $router->post('/save', 'AdminOrderStatusController@save')->name('admin.orderStatuses.save');
    $router->post('/delete', 'AdminOrderStatusController@delete')->name('admin.orderStatuses.delete');
});

