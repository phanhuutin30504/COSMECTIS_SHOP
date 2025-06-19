<?php

use App\Http\Controllers\Sepay\SePayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Sepay
// routes/web.php
Route::post('/sepay/webhook', [SePayController::class, 'webhook']);
Route::post('/sepay/create-order', [SePayController::class, 'createOrder']);
