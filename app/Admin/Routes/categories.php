<?php
$router->group(['prefix' => 'categories' ], function ($router) {

    $router->get('/', 'CategoriesController@index')->name('admin.categories.list');
    $router->get('/create/new', 'CategoriesController@create')->name('Category_form1');
    $router->get('/edit/{id?}', 'CategoriesController@edit')->name('admin.categories.edit');
    $router->post('/update', 'CategoriesController@update');
    $router->post('/store', 'CategoriesController@store');
    $router->post('/delete', 'CategoriesController@delete')->name('admin.categories.delete');

    $router->post('/autocomplete', 'CategoriesController@autocomplete');
});
