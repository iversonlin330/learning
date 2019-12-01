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
Route::get('/forgot', 'Auth\LoginController@getForgot');
Route::post('/forgot', 'Auth\LoginController@postForgot');
Route::get('/reset', 'Auth\LoginController@getReset');
Route::post('/reset', 'Auth\LoginController@postReset');

Route::group(['middleware' => ['auth']], function () {
	Route::get('add-class', 'TeacherController@getAddClass');
	Route::post('add-class', 'TeacherController@postAddClass');
	Route::get('change-id', 'TeacherController@getChangeId');
	Route::post('change-id', 'TeacherController@postChangeId');
	Route::get('teachers/export', 'TeacherController@export');
	
	
	Route::resource('teachers', 'TeacherController');
	Route::get('/logout', 'Auth\LoginController@getLogout');
	
	Route::get('students/admin-create', 'StudentController@getAdminCreate');
	Route::post('students/admin-create', 'StudentController@postAdminCreate');
	Route::get('students/export', 'StudentController@export');
	
	Route::resource('templates', 'TemplateController');
	Route::get('ads/export', 'AdsController@export');
	Route::resource('ads', 'AdsController');
	Route::group(['middleware' => ['user.info']], function () {
		Route::resource('groups', 'GroupController');
		Route::resource('questions', 'QuestionController');
		Route::resource('classrooms', 'ClassroomController');
		Route::resource('students', 'StudentController');
		Route::resource('users', 'UserController');
		Route::get('testing/{id}', 'TestingController@index');
		Route::post('testing/{id}', 'TestingController@finish');
		Route::get('testing-view/{id}', 'TestingController@view');
		
		Route::get('record/index', 'RecordController@index');
		Route::get('record/single', 'RecordController@single');
		Route::get('record/multi', 'RecordController@multi');
		Route::get('record/single-export', 'RecordController@singleExport');
		Route::get('record/multi-export', 'RecordController@multiExport');
		Route::get('record/single-export2', 'RecordController@singleExport2');
		Route::get('record/multi-export2', 'RecordController@multiExport2');
		Route::resource('group_classrooms', 'GroupClassroomController');
	});
});






