<?php

use Illuminate\Support\Facades\Route;
use Modules\Program\Http\Controllers\V1\User\ProgramController;

Route::middleware(['auth:sanctum'])->group(function(){

    Route::apiResource('programs',ProgramController::class);

    Route::get('programs/{program}/download',[ProgramController::class,'download']);

});