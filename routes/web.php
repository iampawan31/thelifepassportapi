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
    //return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('personal-info', 'PersonalinfoController@index')->name('personal-info');
//Route::get('personal-details', 'PersonalinfoController@personaldetails')->name('personal-details');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
