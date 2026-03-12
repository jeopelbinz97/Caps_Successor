<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Controllers\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

