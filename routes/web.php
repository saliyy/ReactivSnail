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





Auth::routes();


Route::get('/contacts', function(){
	return view('contacts');
});

Route::get('/', 'TransportController@index')->name('index');

Route::get('logout','Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome', function()
{
    return view('welcome');
});

Route::get('test', function()
{
    return view('layouts/test');
});


Route::resource('drivers', 'DriverController');

Route::get('/categories', 'TransportController@categories')->name('categories');

Route::get('/{category}', 'TransportController@category')->name('category');

Route::get('/{category}/{car}', 'TransportController@getVehicleById')->name('car');



