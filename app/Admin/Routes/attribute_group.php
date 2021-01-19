<?php
$router->group(['prefix' => 'attribute_group'], function ($router) {
    $router->get('/', 'AttributeGroupController@index')->name('admin.attribute_group.list');
    $router->get('/datatable', 'AttributeGroupController@Datatable')->name('admin.attribute_group.datatable');
    $router->get('/create/new', 'AttributeGroupController@create');
    $router->post('/store', 'AttributeGroupController@store');
    $router->get('/edit/{id}', 'AttributeGroupController@edit')->name('attribute_group.edit');
    $router->post('/update', 'AttributeGroupController@update');
    $router->post('/delete', 'AttributeGroupController@Delete')->name('attribute_group.delete');


});
