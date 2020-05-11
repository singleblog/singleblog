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

Route::get('/', 'ViewController@home');
Route::get('/post/{sid}', 'ViewController@post');
Route::get('/page/{sid}', 'ViewController@page');

Route::get('/admin/posts', 'PostController@list');
Route::get('/admin/posts/new', 'PostController@new');
Route::get('/admin/posts/{sid}', 'PostController@edit');
Route::put('/admin/posts', 'PostController@save');
Route::delete('/admin/posts', 'PostController@del');

Route::get('/admin/pages', 'PageController@list');
Route::get('/admin/pages/new', 'PageController@new');
Route::get('/admin/pages/{sid}', 'PageController@edit');
Route::put('/admin/pages', 'PageController@save');
Route::delete('/admin/pages', 'PageController@del');

Route::get('/admin', 'UserController@page_signin');
Route::post('/admin', 'UserController@api_signin');
Route::get('/admin/logout', 'UserController@page_logout');
Route::get('/password/new', 'UserController@page_resetpasswd');



