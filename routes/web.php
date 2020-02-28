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

Route::get('/Overall', 'OverallController@index');
Route::get('/Regional', 'RegionalController@index');
Route::get('/Department', 'DepartmentController@index');
Route::get('/Academic', 'AcademicController@index');
Route::get('/Field', 'FieldController@index');
Route::get('/Student', 'StudentController@index');
