<?php
$router->group(['prefix' => 'countries'], function ($router) {
    $router->get('/', 'AdminCountryController@index')->name('admin.countries.list');
    $router->get('/edit', 'AdminCountryController@edit')->name('admin.countries.edit');
    $router->post('/save', 'AdminCountryController@save')->name('admin.countries.save');
    $router->post('/delete', 'AdminCountryController@delete')->name('admin.countries.delete');
});

