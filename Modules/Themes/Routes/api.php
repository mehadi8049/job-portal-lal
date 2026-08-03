<?php

use Illuminate\Support\Facades\Route;

// Public landing page API
Route::get('/landing', 'Api\LandingController@index');
