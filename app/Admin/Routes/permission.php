<?php
$router->group(['prefix' => 'permission' , 'namespace' =>'Auth'], function ($router) {
    $router->get('/', 'AdminPermissionController@index')->name('admin.permission.list');
    $router->get('/create_permission', 'AdminPermissionController@create');
    $router->post('/store_permission', 'AdminPermissionController@store');
    $router->get('/edit/{id}', 'AdminPermissionController@edit')->name('admin.permission.edit');
    $router->post('/update_permission', 'AdminPermissionController@update');
    $router->post('/delete', 'AdminPermissionController@DeletePermission')->name('admin.permission.delete');
     $router->post('routeAdmin_autocomplete', 'AdminPermissionController@routeAdmin_autocomplete')->name('routeAdmin.autocomplete');

});
