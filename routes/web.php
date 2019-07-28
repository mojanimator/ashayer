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

use App\Hooze;
use App\School;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Policies\SchoolPolicy;

Route::get('/', function () {
    return view('layouts.home');
});
Route::get('/school/create', function () {
    return view('school.create');
})->name('school.create');


Route::post('schools/all', 'SchoolController@all')->name('school.all');
Route::post('schools/search', 'SchoolController@search')->name('school.search');
Route::post('schools/dropdown', 'SchoolController@dropdown')->name('school.dropdown');
Route::post('schools/create', 'SchoolController@create')->name('schools.create');

//Route::post('madrese/all', 'MadreseController@index')->name('madrese.all');

Route::post('hoozes', 'SchoolController@hoozes')->name('school.hoozes');

Auth::routes();
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('can:register');
//Route::post('register', 'Auth\RegisterController@register')->middleware('can:register');
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify')->name('verification.mail');
Route::get('/resendemail/{token}', 'Auth\RegisterController@resend')->name('resend.mail');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/init', function () {
    // Call and Artisan command from within your application.
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
    echo 'با موفقیت انجام شد!';
});

Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

Route::post('/panel/{username}/delete/s={id}', 'SchoolController@destroy')
    ->name('school.destroy')->middleware('can:delete,App\School');
Route::any('/panel/{username}', 'UserController@showPanel')
    ->name('user.panel')->middleware('auth');
Route::get('/panel/{username}/schools', 'SchoolController@view')
    ->name('school.view')->middleware('can:view,App\School');
Route::post('/panel/{username}/edit/s={id}', 'SchoolController@update')
    ->name('school.edit')->middleware('SchoolPolicy@edit');


Route::get('/panel/{username}/hoozes', 'HoozeController@view')
    ->name('hooze.view')->middleware('can:viewAny,App\Hooze');
Route::post('/panel/{username}/hoozes', 'HoozeController@search')
    ->name('hooze.search');
Route::post('/panel/{username}/hoozes/delete/h={id}', 'HoozeController@destroy')
    ->name('hooze.destroy')->middleware('can:delete,App\Hooze,id');
Route::post('/panel/{username}/hoozes/edit/h={id}', 'HoozeController@update')
    ->name('hooze.edit')->middleware('can:edit,App\Hooze,id');
Route::post('/panel/{username}/hoozes/create', 'HoozeController@create')
    ->name('hooze.create')->middleware('can:create,App\Hooze');

Route::get('mailable', function () {
    $invoice = App\User::find(1);

    return new App\Mail\RegisterUserMail($invoice);
});
Route::get('test', function () {
//    $user = User::find($id);
    $parent_hooze_id = Hooze::find(9)->first();
//    if (Gate::allows('edit', [Hooze::class, 3]))
//        return 't';

//    $roles = $user->role()->first()->permissions;
//
//    echo gettype($roles);
////    echo($roles);
//    foreach ($roles as $role)
//        echo $role . '<br>';
//    echo $user->role()->first();
//    $roles = $user->role->permissions;
//    if (in_array('su', $roles)) echo true; else  echo 'false';
//    foreach ($roles as $role)
//        if ($role == 'cs') {
//            echo $role;
//            break;
//        }
});