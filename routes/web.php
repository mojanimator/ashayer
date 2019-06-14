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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.home');
});
Route::get('/school/create', function () {
    return view('school.create');
})->name('school.create');;

Route::post('schools/search', 'SchoolController@search')->name('school.search');
Route::post('schools/dropdown', 'SchoolController@dropdown')->name('school.dropdown');
Route::get('/schools', 'SchoolController@view')->name('school.view');
//Route::post('madrese/all', 'MadreseController@index')->name('madrese.all');

Route::post('hoozes', 'SchoolController@hoozes')->name('school.hoozes');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
