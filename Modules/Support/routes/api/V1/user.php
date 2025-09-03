<?php

use Illuminate\Support\Facades\Route;
use Modules\Support\Http\Controllers\V1\User\FaqController;
use Modules\Support\Http\Controllers\V1\User\FeedbackController;

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::post('/feedback', [FeedbackController::class, 'store'])
    ->middleware('auth:sanctum')
    ->name('feedback.store');
