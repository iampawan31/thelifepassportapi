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

Route::namespace('Api')->middleware('auth:api')->group(function () {
    // Personal Information Routes
    Route::get('personal-info', 'PersonalInfoController@show')->name('api.personal.info.show');
    Route::post('personal-info', 'PersonalInfoController@store')->name('api.personal.info.post');
    Route::put('personal-info/{personalInfo}', 'PersonalInfoController@update')->name('api.personal.info.update');

    // Personal Information Steps
    Route::post('steps', 'PersonalStepsController@update')->name('api.personal.steps');

    // Spouse Information Routes
    Route::post('personal-info/marriage-status', 'MarriageStatusController@store')->name('api.personal.marriage.post');

    // Data Routes
    Route::get('countries', 'CountryController@index')->name('api.countries.index');
});
