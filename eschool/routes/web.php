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
Route::get('/loadpost', 'PostController@index')->middleware('auth');
Route::post('/loadpost/loadmore','PostController@loadpost')->name('loadpost');
Route::post('/post','PostController@store')->name('posts');
Route::get('/allpost','PostController@manager');

Route::get('/post/show/{id}', 'PostController@showpost')->name('posts.show');
Route::get('/wall/{user_id}','PostController@wall')->middleware('auth');
Route::post('/wall/loadmore','PostController@wallpost')->name('wall');

Route::post('/comment', 'PostController@postcmt')->name('comment');
Route::post('/comment/like', 'CommentController@like')->name('comment.like');
Route::post('/loadcomment/loadmore','PostController@loadcomment')->name('loadcmt');
Route::post('/changelike', 'CommentController@changelike')->name('changelike');


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

//user profiles v2
Route::get('/showprofile', 'ShowProfileController@index')->name('profiles.show');
Route::post('/showprofile', 'ShowProfileController@index')->name('profiles.show');

Route::get('/editprofile', 'EditProfileController@index')->name('profiles.edit');
Route::post('/editprofile', 'EditProfileController@store')->name('profiles.store');

//route graph
Route::post('/showmark', 'ShowProfileController@showmark')->name('showmark');
Route::get('/showmark', 'ShowProfileController@showmark')->name('showmark');

//pasword
Route::get('/changePassword','HomeController@showChangePasswordForm')->name('showChange');

Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

//Notification
Route::post('/notify','NotifyController@shownotify')->name('notifications');
Route::post('/notify/load','NotifyController@notify')->name('notify');
Route::get('/activity','NotifyController@showact');
Route::post('/activity/load','NotifyController@activity')->name('activity');

//Testing route
