<?php
$router->group(['prefix' => 'users' , 'namespace' =>'Auth'], function ($router) {
    $router->get('/', 'AdminUsersController@index')->name('admin.users');
    $router->get('/users-datatable', 'AdminUsersController@UsersDatatable')->name('admin.users.datatable');
    $router->get('/create/new', 'AdminUsersController@create');
    $router->post('/store_user', 'AdminUsersController@store');
    $router->get('/edit/{id}', 'AdminUsersController@edit')->name('admin.users.edit');
    $router->post('/update_user', 'AdminUsersController@update');
    $router->post('users_autocomplete', 'AdminUsersController@users_autocomplete')->name('admin.users.autocomplete');
    $router->post('/delete', 'AdminUsersController@DeleteUser')->name('admin.users.delete');

    $router->post('roles_autocomplete', 'AdminUsersController@roles_autocomplete')->name('admin.roles.autocomplete');
    $router->post('permission_autocomplete', 'AdminUsersController@permission_autocomplete')->name('admin.permissions.autocomplete');



});
