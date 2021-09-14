<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('user','UserController');
Route::resource('permission', 'PermissionController');
Route::resource('role','RoleController');

Route::get('/profile', 'UserController@profile')->name('user.profile');
Route::post('/profile', 'UserController@post_profile')->name('user.postprofile');

// =======axios request========
Route::get('getAllPermission', 'PermissionController@getAllPermission');
Route::post('postRole', 'RoleController@store');
Route::get('getAllUsers', 'UserController@getAllUsers');
Route::get('getAllRoles', 'RoleController@getAllRoles');

Route::post('account/create', 'UserController@store');