<?php

/*Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Overall', 'OverallController@index');
Route::get('/Regional', 'RegionalController@index');
Route::get('/Department', 'DepartmentController@index');
Route::get('/Academic', 'AcademicController@index');
Route::get('/Field', 'FieldController@index');
Route::get('/Student', 'StudentController@index');
=======
Route::get('about', function () {
    return view('pages.about');
});

Route::get('contact', function () {
    return view('pages.contact');
});
*/

Route::get('/student', 'PagesController@student');
Route::get('/field',   'PagesController@field');
Route::get('/academic', 'PagesController@academic');
Route::get('/department', 'PagesController@department');
Route::get('/regional',   'PagesController@regional');
Route::get('/overrall',   'PagesController@overrall');



>>>>>>> 19f7e025b4c0299d9863b3fa9c27048416016c3c
