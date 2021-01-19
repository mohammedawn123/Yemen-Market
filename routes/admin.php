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

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'App\Http\Controllers\AdminControllers\Auth' ],function () {
Route::group(['middleware'=>'guest:admin'], function ()
    {     Route::get('login', 'LoginController@getLogin')->name('admin.getLogin');
          Route::post('login', 'LoginController@Login')->name('admin.login');
     });

Route::group(['middleware'=>'auth:admin'], function ()
    {
            Route::get('logout', 'LoginController@Logout')->name('admin.logout');
        });



});

