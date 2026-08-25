<?php

use Illuminate\Support\Facades\Route;
use Modules\PagesWebsite\Http\Controllers\Api\PageController;

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy']);
Route::get('/terms-and-conditions', [PageController::class, 'termsAndConditions']);
