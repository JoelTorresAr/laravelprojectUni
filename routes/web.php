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

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
    Route::get('/', 'AdminController@index')->name('admin.dashboard')->middleware('can:admins.index');
    Route::get('/{any}', 'AdminController@index');
    
});
/*
Route::middleware(['auth'])->group(function(){
    //Roles
    Route::get('roles','RoleController@index')->name('roles.index')->middleware('can:roles.index');
    Route::get('roles/create','RoleController@create')->name('roles.create')->middleware('can:roles.create');
    Route::post('roles/store','RoleController@store')->name('roles.store')->middleware('can:roles.create');
    Route::put('roles/{role}','RoleController@update')->name('roles.update')->middleware('can:roles.edit');
    Route::get('roles/{role}/edit','RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');
    Route::post('roles/{role}','RoleController@show')->name('roles.show')->middleware('can:roles.show');
    Route::delete('roles/{role}','RoleController@destroy')->name('roles.detroy')->middleware('can:roles.destroy');
});*/

