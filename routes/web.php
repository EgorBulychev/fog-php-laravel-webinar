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

Route::get('/profile', 'UsersController@profile')->name('users.profile')->middleware('role:user:admin:moderator');
Route::post('/profile', 'UsersController@saveProfile')->name('users.save.profile');
Route::get('/profile/token', 'UsersController@genApiToken')->name('users.token');

Route::prefix('phone-notes')->group(function () {
    Route::get('index', 'PhoneNoteController@index')->name('index');
    Route::get('get-one', 'PhoneNoteController@getOne');
    Route::get('get-all', 'PhoneNoteController@getAll');
    Route::post('create', 'PhoneNoteController@create');
    Route::get('update', 'PhoneNoteController@update')->name('phone.update');
    Route::post('save', 'PhoneNoteController@save')->name('phone.save');
    Route::delete('delete', 'PhoneNoteController@delete');
});

Route::group(['prefix' => 'users', 'middleware' => 'role:admin'], function () {
    Route::get('index', 'UsersController@index')->name('users.index');
    Route::get('edit', 'UsersController@edit')->name('users.edit');
    Route::post('save', 'UsersController@save')->name('users.save');
    Route::get('new', 'UsersController@new')->name('users.new');
    Route::post('create', 'UsersController@create')->name('users.create');
});