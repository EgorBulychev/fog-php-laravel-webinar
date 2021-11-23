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

// todo создать роуты с контроллерами
// todo вывести какую-либо информацию в методах контроллера/ов

Route::get('/get-user', 'TestController@getUserData');

Route::prefix('phone-notes')->group(function () {
    Route::get('index', 'PhoneNoteController@index')->name('index');
    Route::get('get-one', 'PhoneNoteController@getOne');
    Route::get('get-all', 'PhoneNoteController@getAll');
    Route::post('create', 'PhoneNoteController@create');
    Route::post('update', 'PhoneNoteController@update');
    Route::delete('delete', 'PhoneNoteController@delete');
});
