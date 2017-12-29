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

Route::get('/', 'PostController@index');
Route::get('/home', 'PostController@index');
Route::view('/instructies', 'instructies');
Route::post('/vote/{vote}', 'CheckVoteController@index');
Route::get('/comments/{id}', 'CommentController@index');
Route::post('/comments/add', 'CommentController@addComment');
