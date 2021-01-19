<?php
$router->group(['prefix' => 'customers'], function ($router) {
    $router->get('/', 'CustomersController@index')->name('admin.customers.list');
    $router->get('/create/new', 'CustomersController@create');
    $router->post('/store', 'CustomersController@store');
    $router->get('/edit/{id}', 'CustomersController@edit')->name('customers.edit');
    $router->post('/update', 'CustomersController@update');
    $router->post('/delete', 'CustomersController@Delete')->name('customers.delete');


});
