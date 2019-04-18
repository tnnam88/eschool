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

/*Quiz*/
Route::get('/quiz', 'QuizController@index')->name('quiz');
Route::get('/quiz/result','QuizController@result');

/* Do test */
Route::get('/dotest', 'TestController@testform');
Route::get('/test', 'TestController@test');
Route::get('/result', 'TestController@result');