<?php
$router->group(['prefix' => 'products' ], function ($router) {
    $router->get('/', 'ProductsController@index')->name('admin.products.list');
    $router->get('/create/new', 'ProductsController@create');
    $router->get('/edit/{id?}', 'ProductsController@edit')->name('admin.product.edit');
    $router->put('/update', 'ProductsController@update');
    $router->put('/store', 'ProductsController@store');
    $router->post('/delete', 'ProductsController@DeleteProduct')->name('admin.products.delete');
  //  $router->post('/delete_all', 'ProductsController@DeleteAllProducts');

    $router->get('/products_datatable', 'ProductsController@ProductsDatatable')->name('admin.products.datatable');
     $router->get('/CategoriesAutocomplete', 'ProductsController@CategoriesAutocomplete');
     $router->get('/AttributeAutocomplete', 'ProductsController@AttributeAutocomplete')->name('attribute.autocomplete');

    $router->post('manufacturer_autocomplete', 'ProductsController@manufacturer_autocomplete');
      //  $router->resource('Product', 'ProductsController');
        /*"Admin.Products.index" is true with use  'as'=>'Admin.'in group
        or "Products.index" without use  'as'=>'Admin.'*/
    $router->get('/l','ProductsController@test' )->name('admin.languages.form1');
});
