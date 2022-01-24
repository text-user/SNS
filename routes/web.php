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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', 'App\Http\Controllers\PostController', 'index');



Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
Route::get('/posts/search', 'App\Http\Controllers\PostController@search')->name('posts.search');

Route::resource('/posts', 'App\Http\Controllers\PostController');
Route::resource('/users', 'App\Http\Controllers\UserController');
Route::resource('/comments', 'App\Http\Controllers\CommentController')->middleware('auth');