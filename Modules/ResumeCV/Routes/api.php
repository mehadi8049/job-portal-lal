<?php

use Illuminate\Support\Facades\Route;

// Public template routes
Route::get('/resume-templates', 'Api\TemplateController@index');
Route::get('/resume-templates/{id}', 'Api\TemplateController@show');

// Authenticated resume routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/resumes', 'Api\ResumeController@index');
    Route::post('/resumes', 'Api\ResumeController@store');
    Route::get('/resumes/{code}', 'Api\ResumeController@show');
    Route::put('/resumes/{code}', 'Api\ResumeController@update');
    Route::delete('/resumes/{code}', 'Api\ResumeController@destroy');
    Route::post('/resumes/{code}/clone', 'Api\ResumeController@clone');
    Route::get('/resumes/{code}/download', 'Api\ResumeController@download');
});
