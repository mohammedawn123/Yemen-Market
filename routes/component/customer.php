<?php


Route::group(['prefix' => 'customer','middleware'=>'auth'] , function ($router){

    $router->get('/', 'ShopAccount@index')->name('customer.index');
    $router->post('/update', 'ShopAccount@update')->name('customer.update');

    $router->get('/orderList', 'ShopAccount@orderList')->name('customer.order_list');
    $router->get('/orderDetail/{id}', 'ShopAccount@orderDetail')->name('customer.order_detail');
    $router->get('/addressList', 'ShopAccount@addressList')->name('customer.address_list');
    $router->get('/updateAddress/{id}', 'ShopAccount@updateAddress')->name('customer.update_address');
    $router->post('/postUpdateAddress/{id}', 'ShopAccount@postUpdateAddress')->name('customer.post_update_address');
    $router->post('/deleteAddress', 'ShopAccount@deleteAddress')->name('customer.delete_address');
    $router->get('/changePassword', 'ShopAccount@changePassword')->name('customer.change_password');
    $router->post('/postChangePassword', 'ShopAccount@postChangePassword')->name('customer.post_change_password');
    $router->get('/changeInfomation', 'ShopAccount@changeInfomation')->name('customer.change_infomation');
$router->post('/address-detail', 'ShopAccount@getAddress')->name('customer.address_detail');
});
