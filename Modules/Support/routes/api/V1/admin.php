<?php

use Illuminate\Support\Facades\Route;
use Modules\Support\Http\Controllers\V1\Admin\FaqController;
use Modules\Support\Http\Controllers\V1\Admin\FeedbackController;

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::get('/faqs', [FaqController::class, 'index']);
    Route::post('/faqs', [FaqController::class, 'store']);
    Route::delete('/faqs/{faq}', [FaqController::class, 'destroy']);
    Route::get('/feedbacks', [FeedbackController::class, 'index']);
    Route::get('/feedbacks/{feedback}', [FeedbackController::class, 'index']);
});
