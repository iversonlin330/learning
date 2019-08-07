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
	if(Auth::check()){
		return redirect('groups');
	}else{
		return view('login');
	}
})->name('/');
	
Route::resource('registers', 'Auth\RegisterController');
/*
Route::get('/login', function () {
	return view('login');
});
*/
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/verify', 'Auth\RegisterController@getVerify');

Route::group(['middleware' => ['auth']], function () {
	Route::resource('teachers', 'TeacherController');
	Route::get('/logout', 'Auth\LoginController@getLogout');
	Route::group(['middleware' => ['user.info']], function () {
		Route::resource('groups', 'GroupController');
		Route::resource('questions', 'QuestionController');
		Route::resource('classrooms', 'ClassroomController');
		Route::resource('students', 'StudentController');
	});
});






