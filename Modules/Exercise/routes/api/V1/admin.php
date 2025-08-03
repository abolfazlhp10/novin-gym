<?php

use Illuminate\Support\Facades\Route;
use Modules\Exercise\Http\Controllers\V1\Admin\CategoryController;
use Modules\Exercise\Http\Controllers\V1\Admin\EquipmentController;
use Modules\Exercise\Http\Controllers\V1\Admin\ExerciseController;

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function(){

    Route::apiResource('categories',CategoryController::class);

    Route::apiResource('exercises',ExerciseController::class);

    Route::apiResource('equipments',EquipmentController::class);
        
});