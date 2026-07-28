<?php

use Illuminate\Support\Facades\Route;

// Public jobs routes
Route::get('/jobs', 'Api\JobController@index');
Route::get('/jobs/filters', 'Api\JobController@filters');
Route::get('/jobs/{id}', 'Api\JobController@show');
Route::get('/jobs/{id}/similar', 'Api\JobController@similar');
Route::post('/jobs/{id}/apply', 'Api\JobController@apply');

// Public companies routes
Route::get('/companies', 'Api\CompanyController@index');
Route::get('/companies/{slug}', 'Api\CompanyController@show');

// Employer authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    // Company profile management
    Route::get('/company', 'Api\CompanyController@myCompany');
    Route::post('/company', 'Api\CompanyController@store');
    Route::put('/company', 'Api\CompanyController@update');
    Route::post('/company/logo', 'Api\CompanyController@uploadLogo');

    // Employer job management
    Route::get('/employer/jobs', 'Api\EmployerJobController@index');
    Route::post('/employer/jobs', 'Api\EmployerJobController@store');
    Route::get('/employer/jobs/{id}', 'Api\EmployerJobController@show');
    Route::put('/employer/jobs/{id}', 'Api\EmployerJobController@update');
    Route::delete('/employer/jobs/{id}', 'Api\EmployerJobController@destroy');

    // Employer applicant management
    Route::get('/employer/applicants', 'Api\EmployerApplicantController@index');
    Route::get('/employer/applicants/{id}', 'Api\EmployerApplicantController@show');
    Route::delete('/employer/applicants/{id}', 'Api\EmployerApplicantController@destroy');
});
