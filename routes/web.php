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

Route::get('/home', 'HomeController@index');
Route::resource('examinfo','ExaminfoController');
Route::resource('makequestion' , 'QuestionController');
Route::resource('student','StudentController');
Route::resource('answer','AnswerController');
Route::resource('result' , 'ResultController');
Auth::routes();



Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
    Route::get('/login/teacher', 'Auth\LoginController@showTeacherLoginForm');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
    Route::get('/register/teacher', 'Auth\RegisterController@showTeacherRegisterForm');

    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::post('/login/teacher', 'Auth\LoginController@teacherLogin');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
    Route::post('/register/teacher', 'Auth\RegisterController@createTeacher');

    Route::view('/home', 'home')->middleware('auth');
    Route::view('/admin', 'admin');
    Route::view('/teacher', 'teacher');



Route::get('ajax',function() {
   return view('message');
});
Route::post('/getmsg','AjaxController@index');
