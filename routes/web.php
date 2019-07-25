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
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@getLogout');

Route::resource('groups', 'GroupController');
Route::resource('questions', 'QuestionController');
Route::resource('registers', 'Auth\RegisterController');
Route::get('verify', 'Auth\RegisterController@getVerify');

