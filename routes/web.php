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
use Illuminate\Support\Facades\App;

Route::get('/', function () {

    return view('welcome');
})->name('shop.home');


        Route::get('/shop', 'ShopFrontController@index');
