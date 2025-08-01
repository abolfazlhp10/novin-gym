<?php

use Illuminate\Support\Facades\Route;

Route::prefix('V1')->group(function(){
    require __DIR__.'/api/V1/user.php';
    require __DIR__.'/api/V1/admin.php';
});