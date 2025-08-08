<?php

use Illuminate\Support\Facades\Route;
use Modules\Program\Http\Controllers\V1\Admin\ProgramController;

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function(){
    Route::get('programs',[ProgramController::class,'index']);
});