<?php
$router->group(['prefix' => 'roles' , 'namespace' =>'Auth'], function ($router) {
    $router->get('/', 'AdminRolesController@index')->name('admin.roles.list');
    $router->get('/create_role', 'AdminRolesController@create');
    $router->post('/store_role', 'AdminRolesController@store');
    $router->get('/edit/{id}', 'AdminRolesController@edit')->name('admin.roles.edit');
    $router->post('/update_role', 'AdminRolesController@update');
    $router->post('/delete', 'AdminRolesController@DeleteRole')->name('admin.roles.delete');
    $router->post('permission_autocomplete', 'AdminRolesController@permission_autocomplete')->name('admin.permissions.autocomplete');


});
