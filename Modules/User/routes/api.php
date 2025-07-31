<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::post('register',[UserController::class,'register']);

Route::post('send-otp',[UserController::class,'sendOtp']);

Route::post('login' , [UserController::class , 'login']);