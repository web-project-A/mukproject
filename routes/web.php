<?php
use App\Mail\Registration;
use Illuminate\Support\Facades\Mail;

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

Route::get('/Student/reupload', 'StudentController@reupload');
Route::get('/Student/viewdocuments', 'StudentController@viewplacement');

Route::get('/email', function () {
    Mail::to('ttalemwacollins@gmail.com')->send(new Registration());
    return new Registration();
});

Route::get('/registerfieldsupervisor', function () {
    return view('auth.registerfieldsupervisor');
});

Route::get('/placementDetailsEdit', 'StudentController@show');

Route::post('/reupload/{id}', 'StudentController@upload');
Route::post('/delete/{name}', 'StudentController@delete');

Route::get('/view/{name}', 'StudentController@view_file');

Route::get('Student/view/{id}/{user_id}', 'StudentController@view');
Route::get('/Student/guidelines', 'StudentController@view_guidelines');

Route::get('/placementDetailsEdit', 'StudentController@show');
Route::get('/dailyJournalEdit', 'StudentController@logbook');
Route::get('/Student/placementletter', 'StudentController@placementLetter');
Route::get('/Student/placementDetails', 'StudentController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@edit');
Route::get('/studUsers', 'UserController@editStud');
Route::post('/users/update/{id}', 'UserController@update');
Route::post('/users/updateStud/{id}', 'UserController@updateStud');

Route::get('/Overall', 'OverallController@index');
Route::get('/Regional', 'RegionalController@index'); 
Route::get('/Department', 'DepartmentController@index');
Route::get('/Academic', 'AcademicController@index');
Route::get('/Field', 'FieldController@index');
Route::get('/Student', 'StudentController@index');
Route::get('/Student/dailyJournal', 'StudentController@logbook');
Route::get('/Student/report', 'StudentController@report');
Route::get('/back', 'UserController@back');
Route::get('/Student/reportedit', 'StudentController@reportedit');
Route::get('/Student/reportedit1/{id}', 'StudentController@reportedit1');
Route::get('/Field/assess', 'FieldController@assess');
Route::get('/Field/viewreports1/{id}', 'FieldController@viewreports1');
Route::get('/Field/viewreports2/{id}', 'FieldController@viewreports2');

Route::post('/Studentplacement/{id}', 'StudentController@placement');
Route::post('/fillJournal/{id}', 'StudentController@fillJournal');
Route::post('/editJournal/{id}', 'StudentController@editJournal');
Route::post('/Studentorg', 'StudentController@org');

Route::post('/reupload/{{ $user->id}}', 'StudentController@upload');
Route::post('/placementletter/{id}', 'StudentController@upload');
Route::post('/fillReport/{id}', 'StudentController@fillReport');
Route::post('/fillReportEdit/{id}', 'StudentController@fillReportEdit');
Route::post('/registration', 'Registration@register');
Route::post('/Studentplacementedit/{id}', 'StudentController@placementedit');
Route::post('/fieldFillReport/{id}', 'FieldController@fieldFillReport');

Route::post('StudentController/fetch', 'StudentController@fetch')->name('StudentController.fetch');

