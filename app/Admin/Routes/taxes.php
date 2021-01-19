<?php
$router->group(['prefix' => 'taxes'], function ($router) {
    $router->get('/', 'AdminTaxController@index')->name('admin.taxes.list');
    $router->get('/edit', 'AdminTaxController@edit')->name('admin.taxes.edit');
    $router->post('/save', 'AdminTaxController@save')->name('admin.taxes.save');
    $router->post('/delete', 'AdminTaxController@delete')->name('admin.taxes.delete');
});

