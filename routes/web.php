<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichs
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('personal-info', 'DashboardController@personalinfo')->name('personal-info');
Route::get('personal-details', 'DashboardController@personaldetails')->name('personal-details');
