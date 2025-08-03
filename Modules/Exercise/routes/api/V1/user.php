<?php

use Illuminate\Support\Facades\Route;
use Modules\Exercise\Http\Controllers\V1\User\CategoryController;
use Modules\Exercise\Http\Controllers\V1\User\EquipmentController;
use Modules\Exercise\Http\Controllers\V1\User\ExerciseController;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('categories', [CategoryController::class, 'index']);

    Route::get('exercises', [ExerciseController::class, 'index']);

    Route::get('equipments', [EquipmentController::class, 'index']);

});
