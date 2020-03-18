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
    return view('auth.login');
});

//Route::get('stud', function () {
//    return view('layouts.stud');
//});

Route::get('/Student/placementDetails', function () {
    return view('Student.placementDetails');
});
Route::get('/Student/InternshipDetails', function () {
    return view('Student.internshipDetails');
});
Route::get('/Student/placementletter', function () {
    return view('Student.placementletter');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@edit');
Route::post('/users/update', 'UserController@update');

Route::get('/Overall', 'OverallController@index');
Route::get('/Regional', 'RegionalController@index');
Route::get('/Department', 'DepartmentController@index');
Route::get('/Academic', 'AcademicController@index');
Route::get('/Field', 'FieldController@index');
Route::get('/Student', 'StudentController@index');



Route::post('/Studentplacement', 'StudentController@placement');
Route::post('/Studentorg', 'StudentController@org');
Route::post('/Studentinternshipdetails', 'StudentController@internship');
Route::post('/placementletter', 'StudentController@upload');





