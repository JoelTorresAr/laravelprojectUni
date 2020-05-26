<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:admin-api'])->group(function(){

});

//StaffController
Route::group(['prefix' => 'staff','namespace' => 'Api'], function () {
Route::get('/','StaffController@index');
Route::get('list/noncredential','StaffController@nonCredentialStaff');
Route::post('store','StaffController@store')->name('staff.store');
Route::put('update/{staff}','StaffController@update');
Route::delete('destroy/{staff}','StaffController@destroy');
});

//SubsidiaryController
Route::group(['prefix' => 'subsidiaries','namespace' => 'Api'], function () {
Route::get('/','SubsidiaryController@index');
});

//WorkstationController
Route::group(['prefix' => 'workstations','namespace' => 'Api'], function () {
Route::get('/','WorkstationController@index');
Route::post('store','WorkstationController@store');
Route::put('update/{workstation}','WorkstationController@update');
Route::delete('destroy/{workstation}','WorkstationController@destroy');
});

//WorkpositionController
Route::group(['prefix' => 'workpositions','namespace' => 'Api'], function () {
Route::get('/','WorkpositionController@index');
Route::get('showbyworkstation/{workstation}','WorkpositionController@showbyworkstation');
Route::post('store','WorkpositionController@store');
Route::put('update/{workstation}','WorkpositionController@update');
Route::delete('destroy/{workstation}','WorkpositionController@destroy');
});

//DistrictController
Route::group(['prefix' => 'districts','namespace' => 'Api'], function () {
Route::get('/','DistrictController@index');
Route::get('showbycity/{city}','DistrictController@showbycity');
Route::post('store','DistrictController@store');
Route::put('update/{district}','DistrictController@update');
Route::delete('destroy/{district}','DistrictController@destroy');
});

//CityController
Route::group(['prefix' => 'cities','namespace' => 'Api'], function () {
    Route::get('/','CityController@index');
    Route::get('showbydistrict/{district}','CityController@showbydistrict');
    Route::post('store','CityController@store');
    Route::put('update/{city}','CityController@update');
    Route::delete('destroy/{city}','CityController@destroy');
});

//AdminController
Route::group(['prefix' => 'admins','namespace' => 'Api'], function () {
    Route::get('/','AdminController@list');
    Route::post('store','AdminController@store'); 
    Route::put('update/{admin}','AdminController@update');
    Route::put('assign/{admin}','AdminController@assign');
    Route::delete('destroy/{admin}','AdminController@destroy');
});
//RolesController
Route::group(['prefix' => 'roles','namespace' => 'Api'], function () {
    Route::get('/','RoleController@index');
    Route::get('list/OnlyName','RoleController@listOnlyName');
    Route::post('store','RoleController@store');
    Route::put('update/{role}','RoleController@update');
    Route::delete('destroy/{role}','RoleController@destroy');
});

//PermissionController
Route::group(['prefix' => 'permissions','namespace' => 'Api'], function () {
    Route::get('/','PermissionController@index');
    Route::get('list/OnlyName','PermissionController@listOnlyName');
    Route::post('store','PermissionController@store');
    Route::put('update/{permission}','PermissionController@update');
    Route::delete('destroy/{permission}','PermissionController@destroy');
});