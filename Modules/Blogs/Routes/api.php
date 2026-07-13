<?php

use Illuminate\Support\Facades\Route;

// Public blog routes
Route::get('/blogs', 'Api\BlogController@index');
Route::get('/blogs/{id}', 'Api\BlogController@show');
