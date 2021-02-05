<?php


Route::group(['prefix' => 'cart' ] , function ($router){

    $router->get('/', 'ShopCart@index')->name('cart.list');
    $router->post('/add_to_cart', 'ShopCart@addToCart')->name('cart.add');
    $router->get('/remove/{id}/{instance}', 'ShopCart@removeItem')->name('item.remove');
    $router->get('/update', 'ShopCart@updateItem')->name('item.update');

});
