<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TuitionController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::get('unpaid-tuitions/{student_id}', [TuitionController::class, 'show']);
});
