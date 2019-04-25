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

Route::resource('posts', 'PostController');

Route::get('/changePassword','HomeController@showChangePasswordForm')->name('showChange');

Route::post('/changePassword','HomeController@changePassword')->name('changePassword');


Route::get('create','ImageController@create');
Route::post('create','ImageController@store');


Route::get('profiles/user_image', 'UserController@index');
Route::post('save', 'UserController@save');

//quiz
    //Route::get('/quiz', 'QuizController@index')->name('quiz');
    //Route::get('/quiz/result','QuizController@result');

/* Do test */
Route::get('/dotest', 'TestController@testform');
Route::get('/test', 'TestController@test');
Route::get('/result', 'TestController@result');

//User Profile
//Route::get('/showprofile', 'ShowProfileController@index')->name('showprofile');
//
//
//
//Route::get('/editprofile', 'EditProfileController@index')->name('editprofile');
//Route::post('/editprofile', 'EditProfileController@store');

//user profiles v2
Route::get('/showprofile', 'ShowProfileController@index')->name('profiles.show');
Route::post('/showprofile', 'ShowProfileController@index')->name('profiles.show');

Route::get('/editprofile', 'EditProfileController@index')->name('profiles.edit');
Route::post('/editprofile', 'EditProfileController@store')->name('profiles.store');

//route graph
Route::post('/showmark', 'ShowProfileController@showmark')->name('showmark');
Route::get('/showmark', 'ShowProfileController@showmark')->name('showmark');



