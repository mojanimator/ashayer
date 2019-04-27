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

Route::get('madrese/view', 'MadreseController@view')->name('madrese.view');
Route::post('madrese/all', 'MadreseController@index')->name('madrese.all');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
