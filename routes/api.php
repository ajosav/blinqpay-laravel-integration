<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProcessorController;
use App\Http\Controllers\API\Payments\PaymentController;

Route::post('/pay', PaymentController::class);
Route::get('processors/currencies', [ProcessorController::class, 'currencies']);
Route::apiResource('processors', ProcessorController::class)->parameters([
    'processor' => 'payment_processor',
]);;
