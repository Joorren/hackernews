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
Route::get('/comments/edit/{id}', 'CommentController@editIndex');
Route::post('/comments/edit', 'CommentController@editComment');
Route::get('/comments/delete/{id}', 'CommentController@deleteComment');
Route::get('/article/add', 'ArticleController@index');
Route::post('/article/add', 'ArticleController@postArticle');
Route::get('/article/edit/{id}', 'ArticleController@editIndex');
Route::post('/article/edit/', 'ArticleController@editArticle');
Route::get('/article/delete/{id}', 'ArticleController@deleteArticle');
Route::post('/article/delete/', 'ArticleController@confirmDelete');