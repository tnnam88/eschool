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

Route::get('/', 'PostController@index')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*Post*/
Route::resource('posts', 'PostController');
Route::get('/posts/show/{id}/{comment_length?}', 'PostController@show')->name('posts.show');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/comment/like', 'CommentController@like')->name('comment.like');

Route::get('/showprofile', 'ShowProfileController@index')->name('profiles.show');
Route::post('/showprofile', 'ShowProfileController@index');

Route::get('/editprofile', 'EditProfileController@index')->name('profiles.edit');
Route::post('/editprofile', 'EditProfileController@store')->name('profiles.store');

/* Do test */
Route::get('/dotest', 'TestController@testform')->middleware('auth');
Route::get('/test', 'TestController@test');
Route::get('/result', 'TestController@result');

/* Teacher add question */
Route::get('/add_question_form','TestController@addQuestionForm');
Route::post('/add_question','TestController@addQuestion');