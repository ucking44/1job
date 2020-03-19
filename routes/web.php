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

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('admin', 'AdminController@index')->name('admin');

    Route::get('products', 'ProductController@index')->name('products');
    Route::get('products/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::post('products/{id}/update', 'ProductController@update')->name('update');

});

Route::get('products/create', 'ProductController@create')->name('products.create');
Route::post('products/store', 'ProductController@store')->name('products.store');
Route::get('products/front', 'ProductController@front')->name('products.front');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
