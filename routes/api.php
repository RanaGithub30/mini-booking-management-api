<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserManageController;

Route::post('/register', [UserManageController::class, 'register']);

/** 3 times in 1 minute */
Route::post('/login', [UserManageController::class, 'login'])->middleware('throttle:3,1'); 

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(UserManageController::class)->group(function () {
        Route::get('/user', 'getUserDetails');
        Route::post('/user/update', 'updateUserDetails');
    });

});