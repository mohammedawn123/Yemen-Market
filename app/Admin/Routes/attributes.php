<?php
$router->group(['prefix' => 'attributes'], function ($router) {
    $router->get('/', 'AttributesController@index')->name('admin.attributes.list');
    $router->get('/create/new', 'AttributesController@create');
    $router->post('/store', 'AttributesController@store');
    $router->get('/edit/{id}', 'AttributesController@edit')->name('attributes.edit');
    $router->post('/update', 'AttributesController@update');
    $router->post('/delete', 'AttributesController@Delete')->name('attributes.delete');


});
