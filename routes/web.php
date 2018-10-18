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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Blog Posts
Route::get('/post', 'PostController@index');
Route::post('/post', 'PostController@create');
Route::get('/posts', 'PostController@posts');
Route::get('/posts/{id}', 'PostController@post');
// Comments
Route::post('/comment', 'CommentController@create');
