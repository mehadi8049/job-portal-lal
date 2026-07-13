<?php

use Illuminate\Support\Facades\Route;

// Authenticated user profile
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', 'Api\ProfileController@show');
    Route::put('/profile', 'Api\ProfileController@update');
    Route::post('/profile/photo', 'Api\ProfileController@uploadPhoto');

    // Experience
    Route::get('/experiences', 'Api\ExperienceController@index');
    Route::post('/experiences', 'Api\ExperienceController@store');
    Route::get('/experiences/{id}', 'Api\ExperienceController@show');
    Route::put('/experiences/{id}', 'Api\ExperienceController@update');
    Route::delete('/experiences/{id}', 'Api\ExperienceController@destroy');

    // Qualification
    Route::get('/qualifications', 'Api\QualificationController@index');
    Route::post('/qualifications', 'Api\QualificationController@store');
    Route::get('/qualifications/{id}', 'Api\QualificationController@show');
    Route::put('/qualifications/{id}', 'Api\QualificationController@update');
    Route::delete('/qualifications/{id}', 'Api\QualificationController@destroy');

    // Skill
    Route::get('/skills', 'Api\SkillController@index');
    Route::post('/skills', 'Api\SkillController@store');
    Route::get('/skills/{id}', 'Api\SkillController@show');
    Route::put('/skills/{id}', 'Api\SkillController@update');
    Route::delete('/skills/{id}', 'Api\SkillController@destroy');

    // Preferred Job Category
    Route::get('/preferred-jobs', 'Api\PreferredJobCategoryController@index');
    Route::post('/preferred-jobs', 'Api\PreferredJobCategoryController@store');
    Route::get('/preferred-jobs/{id}', 'Api\PreferredJobCategoryController@show');
    Route::put('/preferred-jobs/{id}', 'Api\PreferredJobCategoryController@update');
    Route::delete('/preferred-jobs/{id}', 'Api\PreferredJobCategoryController@destroy');

    // Language Proficiency
    Route::get('/languages', 'Api\LanguageProficiencyController@index');
    Route::post('/languages', 'Api\LanguageProficiencyController@store');
    Route::get('/languages/{id}', 'Api\LanguageProficiencyController@show');
    Route::put('/languages/{id}', 'Api\LanguageProficiencyController@update');
    Route::delete('/languages/{id}', 'Api\LanguageProficiencyController@destroy');
});
