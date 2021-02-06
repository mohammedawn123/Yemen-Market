<?php


Route::group(['prefix' => 'product'] , function ($router){

    $router->get('/', 'ShopFrontController@allProduct')->name('product.all');
    $router->get('/detail/{id}', 'ShopFrontController@productDetail')->name('product.detail');

});
