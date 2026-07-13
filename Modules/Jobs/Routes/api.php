<?php

use Illuminate\Support\Facades\Route;

// Public jobs routes
Route::get('/jobs', 'Api\JobController@index');
Route::get('/jobs/filters', 'Api\JobController@filters');
Route::get('/jobs/{id}', 'Api\JobController@show');
Route::get('/jobs/{id}/similar', 'Api\JobController@similar');

// Public companies routes
Route::get('/companies', 'Api\CompanyController@index');
Route::get('/companies/{slug}', 'Api\CompanyController@show');
