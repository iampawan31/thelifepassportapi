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
    Route::post('updatepersonalstep', 'PersonalinfoController@updateuserpersonalstepinfo')->name('personalinfo.stepupdate');

    //Spouse information route
    Route::get('getspouseinfo', 'SpouseController@getspouseinfo')->name('spouseinfo.getdata');
    Route::post('spouse/postdata', 'SpouseController@store')->name('spouseinfo.postdata');
    Route::post('spouse/{id}/updatedata', 'SpouseController@update')->name('spouseinfo.updatedata');
    Route::post('spouse/updatemarriagestatus', 'SpouseController@updatemarriagestatus')->name('spouseinfo.updatemarriagestatus');
    Route::get('spouse/getmarriagestatus', 'SpouseController@getmarriagestatus')->name('spouseinfo.getmarriagestatus');
    Route::delete('spouse/{id}/removespouse', 'SpouseController@destroy')->name('spouseinfo.removespouse');

    //Previous Spouse information route
    Route::get('getprevspouseinfo', 'PreviousspouseController@getpreviousspouseinfo')->name('prevspouseinfo.getdata');
    Route::post('previousspouse/postdata', 'PreviousspouseController@store')->name('prevspouseinfo.postdata');
    Route::post('previousspouse/{id}/updatedata', 'PreviousspouseController@update')->name('prevspouseinfo.updatedata');
    Route::post('previousspouse/updatemarriagestatus', 'PreviousspouseController@updatemarriagestatus')->name('prevspouseinfo.updatemarriagestatus');
    Route::get('previousspouse/getpreviousmarriagestatus', 'PreviousspouseController@getpreviousmarriagestatus')->name('prevspouseinfo.getpreviousmarriagestatus');
    Route::post('removedivorcefile', 'PreviousspouseController@removedivorcefile')->name('prevspouseinfo.removedivorcefile');
    Route::delete('previousspouse/{id}/removespouse', 'PreviousspouseController@destroy')->name('prevspouseinfo.removespouse');

    //Close family members
    Route::get('familyinfo/getfamilymembersinfo', 'FamilyController@getfamilymembersinfo')->name('familyinfo.getfamilymembersinfo');
    Route::post('familyinfo/updatefamilystatus', 'FamilyController@updatefamilystatus')->name('familyinfo.updatefamilystatus');
    Route::get('familyinfo/getfamilymembersstatus', 'FamilyController@getfamilymembersstatus')->name('familyinfo.getfamilymembersstatus');
    Route::get('familyrelations', 'FamilyController@familyrelations')->name('familyinfo.familyrelations');
    Route::post('familyinfo/postdata', 'FamilyController@store')->name('familyinfo.postdata');
    Route::get('familyinfo/{id}/getfamilymemberinfo', 'FamilyController@edit')->name('familyinfo.getfamilymemberinfo');
    Route::post('familyinfo/{id}/updatedata', 'FamilyController@update')->name('familyinfo.updatedata');
    Route::delete('familyinfo/{id}/removefamilymember', 'FamilyController@destroy')->name('familyinfo.removefamilymember');
    Route::post('familyinfo/updatestatus', 'FamilyController@updatestatus')->name('familyinfo.updatestatus');

    //Close friends info
    Route::get('friendsinfo/getfriendsinfo', 'FriendsController@getfriendsinfo')->name('friendsinfo.getfriendsinfo');
    Route::post('friendsinfo/updatefriendsstatus', 'FriendsController@updatefriendsstatus')->name('friendsinfo.updatefriendsstatus');
    Route::get('friendsinfo/getfriendsstatus', 'FriendsController@getfriendsstatus')->name('friendsinfo.getfamilymembersstatus');
    Route::post('friendsinfo/postdata', 'FriendsController@store')->name('friendsinfo.postdata');
    Route::get('friendsinfo/{id}/getfriendsinfo', 'FriendsController@edit')->name('friendsinfo.getfamilymemberinfo');
    Route::post('friendsinfo/{id}/updatedata', 'FriendsController@update')->name('friendsinfo.updatedata');
    Route::delete('friendsinfo/{id}/removefriends', 'FriendsController@destroy')->name('friendsinfo.removefamilymember');
    Route::post('friendsinfo/updatestatus', 'FriendsController@updatestatus')->name('friendsinfo.updatestatus');

    //get left navigation list
    Route::get('getpersonalinfonav', 'LeftnavController@getpersonalinfoleftnavigation')->name('getpersonalinfonav.getdata');
    
});
