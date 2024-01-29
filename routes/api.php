<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Throttle;
use Illuminate\Routing\Middleware\ThrottleRequests;

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
// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Authentication)
Route::middleware('auth:api')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // URL Shortening
    Route::post('/url/shorten', [UrlController::class, 'shorten']);
});

// Anti-Spamming Middleware
Route::middleware(['throttle:3,1'])->group(function () {
    // Define routes here that need anti-spam protection
    // For example, you might want to limit URL creation attempts
    // from the same IP to 3 requests per minute.
    Route::post('/create', 'UrlController@create')->middleware(ThrottleRequests::class.':3,1');
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



