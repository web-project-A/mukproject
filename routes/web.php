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

//Route::post('/register', function () {
//    return view('layouts.stud');
//});

Route::get('/Student/placementDetails', 'StudentController@show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@edit');
Route::get('/studUsers', 'UserController@editStud');
Route::post('/users/update', 'UserController@update');
Route::post('/users/updateStud/{std_number}', 'UserController@updateStud');

Route::get('/Overall', 'OverallController@index');
Route::get('/Regional', 'RegionalController@index');
Route::get('/Department', 'DepartmentController@index');
Route::get('/Academic', 'AcademicController@index');
Route::get('/Field', 'FieldController@index');
Route::get('/Student', 'StudentController@index');

Route::post('/Studentplacement/{std_number}', 'StudentController@placement');

Route::post('/Studentorg', 'StudentController@org');

Route::post('/registration', 'Registration@register');

Route::post('StudentController/fetch', 'StudentController@fetch')->name('StudentController.fetch');

