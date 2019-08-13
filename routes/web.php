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
Route::get('/admin/admin', function () {
    return view('/admin/admin');
});
Route::resource('admin/test','TestController');
Route::resource('admin/section','SectionController');
Route::resource('admin/student','StudentController');

// Route::get('export', 'ExcelController@export')->name('export');
// Route::get('importExportView', 'ExcelController@importExportView');
Route::post('import', 'TestController@store')->name('import');
Route::get('/admin/test/{test}/view', 'TestController@view');
Route::resource('/profile','UserController');
Route::resource('/question','QuestionController');
Route::view('/demo', 'test.demo');