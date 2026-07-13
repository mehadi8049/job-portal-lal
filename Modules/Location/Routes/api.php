<?php

use Illuminate\Support\Facades\Route;

// Public location routes
Route::get('/countries', 'Api\LocationController@countries');
Route::get('/countries/{countryId}/states', 'Api\LocationController@states');
Route::get('/states/{stateId}/cities', 'Api\LocationController@cities');
Route::get('/cities', 'Api\LocationController@allCities');
