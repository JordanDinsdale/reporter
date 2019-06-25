<?php

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/countries', 'CountryController@index')->name('countries');
Route::get('/countries/{id}', 'CountryController@show')->name('country');
Route::get('/countries/edit/{id}', 'CountryController@edit')->name('countryEdit');
Route::post('/countries/store', 'CountryController@store')->name('countryStore');
Route::post('/countries/update/{id}', 'CountryController@update')->name('countryUpdate');
Route::post('/countries/destroy/{id}', 'CountryController@destroy')->name('countryDestroy');

Route::get('/manufacturers', 'ManufacturerController@index')->name('manufacturers');
Route::get('/manufacturers/{id}', 'ManufacturerController@show')->name('manufacturer');
Route::post('/manufacturers/store', 'ManufacturerController@store')->name('manufacturerStore');

Route::get('/regions', 'RegionController@index')->name('regions');
Route::get('/regions/{id}', 'RegionController@show')->name('region');
Route::post('/regions/store', 'RegionController@store')->name('regionStore');

Route::get('/groups', 'GroupController@index')->name('groups');
Route::get('/groups/{id}', 'GroupController@show')->name('group');

Route::get('/dealerships/{id}', 'DealershipController@show')->name('dealership');
Route::post('/dealerships/store', 'DealershipController@store')->name('dealershipStore');
Route::post('/dealerships/attachManufacturer', 'DealershipController@attachManufacturer')->name('attachManufacturer');
Route::post('/dealerships/detachManufacturer', 'DealershipController@detachManufacturer')->name('detachManufacturer');

Route::get('/appointments', 'AppointmentController@index')->name('appointments');
Route::get('/appointments/{id}', 'AppointmentController@show')->name('appointment');
Route::post('/appointments/store', 'AppointmentController@store')->name('appointmentStore');

Route::get('/api/manufacturers/{manufacturer_id}/regions', 'ManufacturerController@regionsApi')->name('regionsApi');
