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


Route::middleware('auth')->group(function () {
	Route::middleware('can:admin')->prefix('settings')->name('settings.')->group(function () {
		// attributes
		Route::group(['prefix' => 'location', 'as' => 'location.'], function(){

			// countries
			Route::group(['prefix' => 'countries', 'as' => 'countries.'], function(){
				Route::get('', 'CountriesController@index')->name('index');
				Route::get('create', 'CountriesController@create')->name('create');
				Route::post('', 'CountriesController@store')->name('store');
				Route::get('{id}/edit', 'CountriesController@edit')->name('edit');
				Route::put('{id}', 'CountriesController@update')->name('update');
				Route::delete('{id}', 'CountriesController@destroy')->name('destroy');
			});

			// country details
			Route::group(['prefix' => 'country_details', 'as' => 'country_details.'], function(){
				Route::get('', 'CountryDetailsController@index')->name('index');
				Route::get('{id}/edit', 'CountryDetailsController@edit')->name('edit');
				Route::put('{id}', 'CountryDetailsController@update')->name('update');
			});

			// states
			Route::group(['prefix' => 'states', 'as' => 'states.'], function(){
				Route::get('', 'StatesController@index')->name('index');
				Route::get('create', 'StatesController@create')->name('create');
				Route::post('', 'StatesController@store')->name('store');
				Route::get('{id}/edit', 'StatesController@edit')->name('edit');
				Route::put('{id}', 'StatesController@update')->name('update');
				Route::delete('{id}', 'StatesController@destroy')->name('destroy');
				Route::get('ajaxgetstates', 'StatesController@ajaxGetStates')->name('ajaxgetstates');
			});

			// cities
			Route::group(['prefix' => 'cities', 'as' => 'cities.'], function(){
				Route::get('', 'CitiesController@index')->name('index');
				Route::get('create', 'CitiesController@create')->name('create');
				Route::post('', 'CitiesController@store')->name('store');
				Route::get('{id}/edit', 'CitiesController@edit')->name('edit');
				Route::put('{id}', 'CitiesController@update')->name('update');
				Route::delete('{id}', 'CitiesController@destroy')->name('destroy');
				Route::get('ajaxgetcities', 'CitiesController@ajaxGetCities')->name('ajaxgetcities');
			});
			
		});
	});
});
		
