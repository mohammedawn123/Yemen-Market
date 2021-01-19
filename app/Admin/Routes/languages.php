<?php
$router->group(['prefix' => 'languages' ], function ($router) {
    $router->get('/', 'LanguagesController@index')->name('admin.languages');
    $router->get('/create/new', 'LanguagesController@create');
    $router->get('/edit/{code}', 'LanguagesController@edit')->name('admin.languages.edit');
   /* $router->get('test/{code?}', 'LanguagesController@test')->name('admin.test');*/
    $router->post('/store', 'LanguagesController@store');
    $router->post('/update', 'LanguagesController@update');
    $router->post('/delete', 'LanguagesController@Delete')->name('languages.delete');
    $router->get('path/{code}', 'LanguagesController@path')->name('admin.path');
    $router->get('getcontent/{code}/{filename}', 'LanguagesController@getContent')->name('admin.getContent');
    $router->post('save/{code}/{filename}', 'LanguagesController@save')->name('admin.save');


});
