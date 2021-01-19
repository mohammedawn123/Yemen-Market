<?php
$router->group(['prefix' => 'customer_group'], function ($router) {
    $router->get('/', 'CustomerGroupController@index')->name('admin.customer_group.list');
    $router->get('/create/new', 'CustomerGroupController@create');
    $router->post('/store', 'CustomerGroupController@store');
    $router->get('/edit/{id}', 'CustomerGroupController@edit')->name('customer_group.edit');
    $router->post('/update', 'CustomerGroupController@update');
    $router->post('/delete', 'CustomerGroupController@Delete')->name('customer_group.delete');


});
