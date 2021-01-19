<?php
$router->group(['prefix' => 'manufacturers'], function ($router) {
    $router->get('/', 'ManufacturersController@index')->name('admin.manufacturers.list');
    $router->get('/create/new', 'ManufacturersController@create');
    $router->post('/store', 'ManufacturersController@store');
    $router->get('/edit/{id}', 'ManufacturersController@edit')->name('manufacturers.edit');
    $router->post('/update', 'ManufacturersController@update');
    $router->post('/delete', 'ManufacturersController@Delete')->name('manufacturers.delete');


});
