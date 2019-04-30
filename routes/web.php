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

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'PostController@index');


Route::resource('posts', 'PostController');

Route::get('/posts/show/{id}', 'PostController@show')->name('posts.show');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/comment/like', 'CommentController@like')->name('comment.like');

Route::get('/showprofile', 'ShowProfileController@index')->name('profiles.show');
Route::post('/showprofile', 'ShowProfileController@index');

Route::get('/editprofile', 'EditProfileController@index')->name('profiles.edit');
Route::post('/editprofile', 'EditProfileController@store')->name('profiles.store');

Route::get('/loadmore', 'LoadMoreController@index');
Route::post('/loadmore/load_data', 'LoadMoreController@load_data')->name('loadmore.load_data');