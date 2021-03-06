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

Auth::routes();

Route::get('/', 'BlogController@index');

Route::get('/posts/{post}', 'PostController@show')->name('posts.show');

Route::get('/categories/{category}/posts', 'CategoryPostController@index')->name('categories.posts.index');

Route::middleware('auth')->group(function () {

    Route::post('/posts/{post}/comments', 'CommentController@store')->name('posts.comments.store');

});


Route::middleware('auth')->prefix('manage')->name('manage.')->group(function () {

    Route::get('/posts', 'Manage\PostController@index')->name('posts.index');
    Route::get('/posts/create', 'Manage\PostController@create')->name('posts.create');
    Route::post('/posts', 'Manage\PostController@store')->name('posts.store');
    Route::get('/posts/{post}/edit', 'Manage\PostController@edit')->name('posts.edit');
    Route::put('/posts/{post}', 'Manage\PostController@update')->name('posts.update');

});

