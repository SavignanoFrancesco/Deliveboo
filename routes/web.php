<?php

use Illuminate\Support\Facades\Route;

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

// public routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/restaurant/{slug}', 'RestaurantController@show')->name('restaurant');

// admin routes
Auth::routes();
Route::get('/admin', 'Admin\HomeController@index')->name('admin.home');

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function() {

    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/user','UserController');
    Route::resource('/restaurant','RestaurantController');
    Route::resource('/dish','DishController');
    Route::resource('/{restaurant}/menu','MenuController');
    Route::resource('/stats','ChartJsController');

});
