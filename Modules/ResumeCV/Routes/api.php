<?php

use Illuminate\Support\Facades\Route;

// Authenticated resume routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/resumes', 'Api\ResumeController@index');
});
