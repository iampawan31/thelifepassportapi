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

Route::middleware(['auth'])->group(function () {

    // Personal Information Section Routes
    Route::get('personal-info', 'PersonalInfoController@index')->name('personal-info.index');
    Route::get('get-personal-info', 'PersonalInfoController@show')->name('personal-info.show');

    Route::post('personal-info/steps', 'PersonalStepsController@update')->name('personal-info.steps');

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

    //get employer benefits master list
    Route::get('getemployerbenefitslist', 'GeneralController@employerbefefits')->name('getemployerbenefitslist');

    //Route::get('getemployeraddress', 'PersonalinfoController@getemployeraddress');

    //Home Assistant info
    Route::get('homeassistants/getassistantinfo', 'HomeassistantController@index')->name('homeassistants.getassistantinfo');
    Route::post('homeassistants/updatehomeassistantstatus', 'HomeassistantController@updatehomeassistantstatus')->name('homeassistants.updatehomeassistantstatus');
    Route::get('homeassistants/gethomeassistantstatus', 'HomeassistantController@gethomeassistantstatus')->name('homeassistants.gethomeassistantstatus');
    Route::post('homeassistants/postdata', 'HomeassistantController@store')->name('homeassistants.postdata');
    Route::get('homeassistants/{id}/gethomeassistantinfo', 'HomeassistantController@edit')->name('homeassistants.gethomeassistantinfo');
    Route::post('homeassistants/{id}/updatedata', 'HomeassistantController@update')->name('homeassistants.updatedata');
    Route::delete('homeassistants/{id}/removehomeassistant', 'HomeassistantController@destroy')->name('homeassistants.removehomeassistant');
    Route::post('homeassistants/updatestatus', 'HomeassistantController@updatestatus')->name('homeassistants.updatestatus');

    //Personal estate info
    Route::get('personalestate/getpersonalestateinfo', 'PersonalestateController@index')->name('personalestate.getpersonalestateinfo');
    Route::post('personalestate/updatepersonalestatestatus', 'PersonalestateController@updatepersonalestatestatus')->name('personalestate.updatepersonalestatestatus');
    Route::get('personalestate/getpersonalestatestatus', 'PersonalestateController@getpersonalestatestatus')->name('personalestate.getpersonalestatestatus');
    Route::post('personalestate/postdata', 'PersonalestateController@store')->name('personalestate.postdata');
    Route::get('personalestate/{id}/getpersonalestateinfo', 'PersonalestateController@edit')->name('personalestate.getpersonalestateinfo');
    Route::post('personalestate/{id}/updatedata', 'PersonalestateController@update')->name('personalestate.updatedata');
    Route::delete('personalestate/{id}/removepersonalestate', 'PersonalestateController@destroy')->name('personalestate.removepersonalestate');
    Route::post('personalestate/updatestatus', 'PersonalestateController@updatestatus')->name('personalestate.updatestatus');

    //Personal estate info
    Route::get('spouseestate/getspousestateinfo', 'SpouseestateController@index')->name('spouseestate.getspousestateinfo');
    Route::post('spouseestate/updatespouseestatestatus', 'SpouseestateController@updatespouseestatestatus')->name('spouseestate.updatespouseestatestatus');
    Route::get('spouseestate/getspouseestatestatus', 'SpouseestateController@getspouseestatestatus')->name('spouseestate.getspouseestatestatus');
    Route::post('spouseestate/postdata', 'SpouseestateController@store')->name('spouseestate.postdata');
    Route::get('spouseestate/{id}/getspouseestateinfo', 'SpouseestateController@edit')->name('spouseestate.getspouseestateinfo');
    Route::post('spouseestate/{id}/updatedata', 'SpouseestateController@update')->name('spouseestate.updatedata');
    Route::delete('spouseestate/{id}/removespouseestate', 'SpouseestateController@destroy')->name('spouseestate.removespouseestate');
    Route::post('spouseestate/updatestatus', 'SpouseestateController@updatestatus')->name('spouseestate.updatestatus');
});
