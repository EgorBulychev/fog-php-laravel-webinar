<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', 'ApiUsersController@index');
Route::middleware(['auth:api', 'role:admin'])->get('/user/list', 'ApiUsersController@list');
Route::middleware(['auth:api', 'role:admin'])->post('/user/create', 'ApiUsersController@create');
Route::middleware(['auth:api', 'role:admin'])->post('/user/{id}/role', 'ApiUsersController@role');

Route::middleware('auth:api')->any('/phone-notes', 'ApiUsersController@phoneNotes');
Route::middleware(['auth:api', 'role:moderator'])->post('/phone-notes/{id}/update', 'ApiUsersController@phoneNotesUpdate');
Route::middleware(['auth:api', 'role:moderator'])->post('/phone-notes/create', 'ApiUsersController@phoneNotesCreate');