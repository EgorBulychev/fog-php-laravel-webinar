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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

// todo сделать роуты и шаблоны для себя
// todo изучить Blade шаблонизатор

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test-two', 'TestController@test');
