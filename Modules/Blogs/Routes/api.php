<?php

use Illuminate\Support\Facades\Route;

// Public blog routes
Route::get('/blogs', 'Api\BlogController@index');
Route::get('/blogs/{id}', 'Api\BlogController@show');

// Public blog category routes
Route::get('/blog-categories', 'Api\CategoryController@index');
Route::get('/blog-categories/{id}', 'Api\CategoryController@show');

// Admin blog management
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/blogs', 'Api\BlogController@all');
    Route::post('/admin/blogs', 'Api\BlogController@store');
    Route::get('/admin/blogs/{id}', 'Api\BlogController@edit');
    Route::put('/admin/blogs/{id}', 'Api\BlogController@update');
    Route::delete('/admin/blogs/{id}', 'Api\BlogController@destroy');
});
