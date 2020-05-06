<?php
use App\Mail\Registration;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
Route::get('/Student/reupload', function () {
    return view('Student.reupload');
});
Route::get('/Student/viewdocuments', 'StudentController@viewplacement');

Route::get('/email', function () {
    $users = DB::select("select * from users where fname='Kenny'");
    Mail::to('ttalemwacollins@gmail.com')->send(new Registration($users));
    return new Registration($users);
});

Route::get('/registerfieldsupervisor/{id}', function ($id) {
    $users = DB::select("select * from users where id=$id");
    return view('auth.registerfieldsupervisor', compact('users'));
});

Route::get('/placementDetailsEdit', 'StudentController@show');

Route::post('/reupload/{id}', 'StudentController@upload');
Route::post('/delete/{name}', 'StudentController@delete');

Route::get('/view/{name}', 'StudentController@view_file');

Route::get('Student/view/{id}/{user_id}', 'StudentController@view');

Route::get('/placementDetailsEdit', 'StudentController@show');
Route::get('/dailyJournalEdit', 'StudentController@logbook');
Route::get('/Student/placementletter', 'StudentController@placementLetter');
Route::get('/Student/placementDetails', 'StudentController@show');

Auth::routes(['verify' => true]);

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
Route::get('/Student/dailyJournal', 'StudentController@dailyJournal');
Route::get('/back', 'UserController@back');
Route::get('/Student/journaledit', 'StudentController@journaledit');
Route::get('/Student/journaledit1/{id}', 'StudentController@journaledit1');
Route::get('/Field/assess', 'FieldController@assess');
Route::get('/Field/viewjournals1/{id}', 'FieldController@viewjournals1');
Route::get('/Field/viewjournals2/{id}', 'FieldController@viewjournals2');
Route::get('/viewStudentDetails/{id}', 'FieldController@viewStudentDetails');

Route::post('/Studentplacement/{id}', 'StudentController@placement');
Route::post('/fillJournal/{id}', 'StudentController@fillJournal');
Route::post('/editJournal/{id}', 'StudentController@editJournal');
Route::post('/Studentorg', 'StudentController@org');
Route::post('/placementletter/{id}', 'StudentController@upload');
Route::post('/filljournal/{id}', 'StudentController@filljournal');
Route::post('/filljournalEdit/{id}', 'StudentController@filljournalEdit');
Route::post('/registration', 'Registration@register');
Route::post('/registration/{id}', 'Registration@fieldregister');
Route::post('/Studentplacementedit/{id}', 'StudentController@placementedit');
Route::post('/fieldFillJournal/{id}', 'FieldController@fieldFillJournal');

Route::post('StudentController/fetch', 'StudentController@fetch')->name('StudentController.fetch');

