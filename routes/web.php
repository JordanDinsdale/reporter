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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/{id}', 'UserController@show')->name('user');
Route::post('/user/store', 'UserController@store')->name('userStore');

Route::get('/companies', 'CompanyController@index')->name('companies');
Route::get('/companies/{id}', 'CompanyController@show')->name('company');
Route::post('/companies/store', 'CompanyController@store')->name('companyStore');

Route::get('/manufacturers', 'ManufacturerController@index')->name('manufacturers');
Route::get('/manufacturers/{id}', 'ManufacturerController@show')->name('manufacturer');
Route::post('/manufacturers/store', 'ManufacturerController@store')->name('manufacturerStore');
Route::get('/manufacturers/{manufacturer_id}/country/{country_id}', 'ManufacturerController@country')->name('manufacturerCountry'); 
Route::get('/manufacturers/{manufacturer_id}/country/{country_id}/events', 'ManufacturerController@countryEvents')->name('manufacturerCountryEvents');
Route::get('/manufacturers/{manufacturer_id}/country/{country_id}/regionless', 'ManufacturerController@regionless')->name('manufacturerRegionless');

Route::get('/countries', 'CountryController@index')->name('countries');
Route::get('/countries/{id}', 'CountryController@show')->name('country');
Route::get('/countries/edit/{id}', 'CountryController@edit')->name('countryEdit');
Route::post('/countries/store', 'CountryController@store')->name('countryStore');
Route::post('/countries/update/{id}', 'CountryController@update')->name('countryUpdate');
Route::post('/countries/destroy/{id}', 'CountryController@destroy')->name('countryDestroy');

Route::get('/regions', 'RegionController@index')->name('regions');
Route::get('/regions/{id}', 'RegionController@show')->name('region');
Route::get('/regions/edit/{id}', 'RegionController@edit')->name('regionEdit');
Route::post('/regions/store', 'RegionController@store')->name('regionStore');
Route::post('/regions/update/{id}', 'RegionController@update')->name('regionUpdate');
Route::post('/regions/destroy/{id}', 'RegionController@destroy')->name('regionDestroy');
Route::get('/regions/{id}/events', 'RegionController@events')->name('regionEvents');
Route::get('/regions/{id}/reports', 'RegionController@reports')->name('regionReports');
Route::post('/regions/{id}/reports', 'RegionController@reportDates')->name('regionReportDates');
Route::get('/regions/{id}/{start_date}/{end_date}/download', 'RegionController@download')->name('regionDownload');

Route::get('/groups', 'GroupController@index')->name('groups');
Route::get('/groups/{id}', 'GroupController@show')->name('group');
Route::get('/groups/edit/{id}', 'GroupController@edit')->name('groupEdit');
Route::post('/groups/store', 'GroupController@store')->name('groupStore');
Route::post('/groups/update/{id}', 'GroupController@update')->name('groupUpdate');
Route::post('/groups/destroy/{id}', 'GroupController@destroy')->name('groupDestroy');

Route::get('/dealerships/{id}', 'DealershipController@show')->name('dealership');
Route::get('/dealerships/edit/{id}', 'DealershipController@edit')->name('dealershipEdit');
Route::post('/dealerships/store', 'DealershipController@store')->name('dealershipStore');
Route::post('/dealerships/update/{id}', 'DealershipController@update')->name('dealershipUpdate');
Route::post('/dealerships/destroy/{id}', 'DealershipController@destroy')->name('dealershipDestroy');
Route::post('/dealerships/attachManufacturer', 'DealershipController@attachManufacturer')->name('attachManufacturer');
Route::post('/dealerships/detachManufacturer', 'DealershipController@detachManufacturer')->name('detachManufacturer');
Route::post('/dealerships/updateRegion', 'DealershipController@updateRegion')->name('updateRegion');
Route::get('/dealerships/{id}/events', 'DealershipController@events')->name('dealershipEvents');
Route::get('/dealerships/{id}/reports', 'DealershipController@reports')->name('dealershipReports');
Route::post('/dealerships/{id}/reports', 'DealershipController@reportDates')->name('dealershipReportDates');
Route::get('/dealerships/{id}/{start_date}/{end_date}/download', 'DealershipController@download')->name('dealershipDownload');
Route::get('/dealerships/{dealership_id}/{manufacturer_id}/{start_date}/{end_date}/download', 'DealershipController@downloadManufacturer')->name('dealershipDownloadManufacturer');

Route::get('/events/{id}', 'EventController@show')->name('event');
Route::get('/events/{id}/edit', 'EventController@edit')->name('eventEdit');
Route::get('/events/{event_id}/company/{company_id}', 'EventController@company')->name('eventCompany');
Route::get('/events/{event_id}/manufacturer/{manufacturer_id}', 'EventController@manufacturer')->name('eventManufacturer');
Route::get('/events/{event_id}/manufacturer/{manufacturer_id}', 'EventController@manufacturer')->name('eventManufacturerCountry');
Route::post('/events/store', 'EventController@store')->name('eventStore');
Route::post('/events/update/{id}', 'EventController@update')->name('eventUpdate');
Route::post('/events/update/{event_id}/{manufacturer_id}', 'EventController@updateSync')->name('eventUpdateSync');
Route::get('/events/{id}/download', 'EventController@download')->name('eventDownload');
Route::get('/events/{event_id}/manufacturer/{manufacturer_id}/download', 'EventController@downloadManufacturer')->name('eventManufacturerDownload');

Route::get('/api/companies/{company_id}/manufacturers', 'CompanyController@companyManufacturersApi')->name('companyManufacturersApi');

Route::get('/api/manufacturers/{manufacturer_id}/countries', 'ManufacturerController@manufacturerCountriesApi')->name('manufacturerCountriesApi');
Route::get('/api/manufacturers/{manufacturer_id}/regions', 'ManufacturerController@manufacturerRegionsApi')->name('manufacturerRegionsApi');

Route::get('/api/countries/{country_id}/manufacturers/{manufacturer_id}/regions', 'CountryController@countryManufacturerRegionsApi')->name('countryManufacturerRegionsApi');
Route::get('/api/countries/{country_id}/groups', 'CountryController@countryGroupsApi')->name('countryGroupsApi');
Route::get('/api/countries/{country_id}/dealerships', 'CountryController@countryDealershipsApi')->name('countryDealershipsApi');

Route::get('/api/groups/{group_id}/dealerships', 'GroupController@groupDealershipsApi')->name('groupDealershipsApi');
