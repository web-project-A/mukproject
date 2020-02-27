<?php

/*Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/departmental', 'PagesController@departmental');
Route::get('/regional',   'PagesController@regional');
Route::get('/overrall',   'PagesController@overrall');



