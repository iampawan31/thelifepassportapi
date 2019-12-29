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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/countrylist', 'CountryController@index')->name('countrylist');
Route::get('/socialmedialist', 'SocialMediaController@index')->name('socialmedialist');

Route::middleware(['auth'])->group(function(){
    //Personal information route
    Route::get('personal-info', 'PersonalinfoController@index')->name('personal-info');
    Route::get('personal-details', 'PersonalinfoController@personaldetails')->name('personal-details');
    Route::post('personal-info/postdata', 'PersonalinfoController@postpersonaldata')->name('personalinfo.postdata');
    Route::get('getpersonalinfo', 'PersonalinfoController@getpersonalinfo')->name('personalinfo.getdata');
    Route::post('personal-info/{id}/updatedata', 'PersonalinfoController@updatepersonaldata')->name('personalinfo.updatedata');

    //Spouse information route
    Route::get('getspouseinfo', 'SpouseController@getspouseinfo')->name('spouseinfo.getdata');
    Route::post('spouse/postdata', 'SpouseController@store')->name('spouseinfo.postdata');
    Route::post('spouse/{id}/updatedata', 'SpouseController@update')->name('spouseinfo.updatedata');
    Route::post('spouse/updatemarriagestatus', 'SpouseController@updatemarriagestatus')->name('spouseinfo.updatemarriagestatus');
    Route::get('getmarriagestatus', 'SpouseController@getmarriagestatus')->name('spouseinfo.getmarriagestatus');

    //Previous Spouse information route
    Route::get('getprevspouseinfo', 'PreviousspouseController@getpreviousspouseinfo')->name('prevspouseinfo.getdata');
    Route::post('previousspouse/postdata', 'PreviousspouseController@store')->name('prevspouseinfo.postdata');
    Route::post('previousspouse/{id}/updatedata', 'PreviousspouseController@update')->name('prevspouseinfo.updatedata');
    Route::post('previousspouse/updatemarriagestatus', 'PreviousspouseController@updatemarriagestatus')->name('prevspouseinfo.updatemarriagestatus');
    Route::get('getpreviousmarriagestatus', 'PreviousspouseController@getpreviousmarriagestatus')->name('prevspouseinfo.getpreviousmarriagestatus');
});
