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
Route::put('{staff}','StaffController@update');
});

//SubsidiaryController
Route::group(['prefix' => 'subsidiaries','namespace' => 'Api'], function () {
Route::get('/','SubsidiaryController@index');
});

//WorkstationController
Route::group(['prefix' => 'workstations','namespace' => 'Api'], function () {
Route::get('/','WorkstationController@index');
});

//WorkpositionController
Route::group(['prefix' => 'workpositions','namespace' => 'Api'], function () {
Route::get('{workstation}','WorkpositionController@show');
});

//DistrictController
Route::group(['prefix' => 'districts','namespace' => 'Api'], function () {
Route::get('/','DistrictController@index');
Route::get('{city}','DistrictController@showbycity');
});

//CityController
Route::group(['prefix' => 'cities','namespace' => 'Api'], function () {
    Route::get('{district}','CityController@showbydistrict');
    Route::get('/','CityController@index');
});

//AdminController
Route::group(['prefix' => 'admins','namespace' => 'Api'], function () {
    Route::get('/','AdminController@list');
    Route::post('store','AdminController@store'); 
    Route::put('edit/{admin}','AdminController@update');
    Route::put('assign/{admin}','AdminController@assign');
});
//RolesController
Route::group(['prefix' => 'roles','namespace' => 'Api'], function () {
    Route::get('/','RoleController@index');
});