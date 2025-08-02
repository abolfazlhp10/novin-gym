<?php

use Illuminate\Support\Facades\Route;
use Modules\Exercise\Http\Controllers\V1\CategoryController;
use Modules\Exercise\Http\Controllers\V1\EquipmentController;
use Modules\Exercise\Http\Controllers\V1\ExerciseController;

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function(){

    Route::apiResource('categories',CategoryController::class);

    Route::apiResource('exercises',ExerciseController::class);

    Route::apiResource('equipments',EquipmentController::class);    
});