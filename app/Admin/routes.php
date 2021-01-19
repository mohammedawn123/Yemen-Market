<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;

Route::group(
    [
       //'prefix' => 'Admin2',
        'middleware' => [ 'admin.permission'  , 'Localization', 'auth:admin' ],
       'namespace' => 'App\Admin\Controllers'
    ],
    function (Router $router) {
    foreach (glob(__DIR__ . '/Routes/*.php') as $filename) {
        require_once $filename;
    }

       $router->get('deny', 'HomeController@deny')->name('admin.deny');
        $router->get('home2', 'HomeController@index')->name('admin.home2');
        $router->get('/', 'HomeController@index')->name('admin.home2');


        $router->get('locale/{code}', function ($code) {
            session(['locale' => $code]);
            app::setLocale( $code);
            return back();
        })->name('locale');


    });

