<?php
// API routes for Dashboard module

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('candidate/dashboard')->group(function () {
    Route::get('/', 'Api\CandidateDashboardController@index');
    Route::get('/stats', 'Api\CandidateDashboardController@stats');
    Route::get('/profile-completion', 'Api\CandidateDashboardController@profileCompletion');
    Route::get('/recent-resumes', 'Api\CandidateDashboardController@recentResumes');
    Route::get('/recent-applications', 'Api\CandidateDashboardController@recentApplications');
    Route::get('/recommended-jobs', 'Api\CandidateDashboardController@recommendedJobs');
});
