<?php

use Modules\User\Http\Controllers\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register',[UserController::class,'register']);

Route::post('send-otp',[UserController::class,'sendOtp']);

Route::post('login' , [UserController::class , 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('logout', [UserController::class,'logout']);
});