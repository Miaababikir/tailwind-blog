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

Route::get('/posts/{post}', 'PostController@show');

Route::middleware('auth')->prefix('manage')->name('manage.')->group(function () {
    Route::get('/posts', 'Manage\PostController@index')->name('posts.index');
    Route::get('/posts/create', 'Manage\PostController@create')->name('posts.create');
});

