<?php
$router->group(['prefix' => 'currencies'], function ($router) {
    $router->get('/', 'AdminCurrencyController@index')->name('admin.currencies.list');
    $router->get('/edit', 'AdminCurrencyController@edit')->name('admin.currencies.edit');
    $router->post('/save', 'AdminCurrencyController@save')->name('admin.currencies.save');
    $router->post('/delete', 'AdminCurrencyController@delete')->name('admin.currencies.delete');
});

