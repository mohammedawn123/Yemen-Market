<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Language

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::get('/facade', function () {


  $ff= Cart::getListCart('default');
  /*  Cart::instance('default')->remove('8e5a44b7e8158839b0203ed7b9f2144b');
    Cart::instance('default')->remove('0d881817bb81e6017d2df92d0313f607');
    Cart::instance('default')->remove('bf93e0040190e2a2c89570e5152c7ce1');*/
   //Cart::instance('default')->destroy();
 //  Cart::instance('wishlist')->destroy();
  dd($ff);
   // dd($test );
});




Route::group([], function (Router $router) {
        foreach (glob(__DIR__ . '/component/*.php') as $filename) {
            require_once $filename;
        }

        $router->get('/shop', 'ShopFrontController@index')->name('shop');
        $router->get('/', function () {
          return view('welcome');
           })->name('shop.home');



});

Route::group([],function () {
    Route::group(['middleware'=>'guest:web'], function ()
    {     Route::get('loginForm', 'Auth\LoginController@showLoginForm')->name('shop.loginForm');
        Route::post('postLogin', 'Auth\LoginController@Login')->name('shop.login');

    });

    Route::group(['middleware'=>'auth:web'], function ()
    {
        Route::post('shopLogout', 'Auth\LoginController@Logout')->name('shop.logout');
    });



});

