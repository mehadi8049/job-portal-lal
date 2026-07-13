<?php

use Illuminate\Support\Facades\Route;

// Public contact route
Route::post('/contacts', 'Api\ContactController@store');
