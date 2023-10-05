<?php

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

Route::post('register', [\App\Http\Controllers\Api\RegisterController::class, 'register']);
Route::post('update', [\App\Http\Controllers\Api\RegisterController::class, 'update']);
Route::post('login', [\App\Http\Controllers\Api\LoginController::class, 'login']);
Route::post('orders', [\App\Http\Controllers\Api\AgoraController::class, 'index']);
Route::post('orders/{id}', [\App\Http\Controllers\Api\AgoraController::class, 'report']);
Route::post('order', [\App\Http\Controllers\Api\AgoraController::class, 'store']);

Route::get("topics", [\App\Http\Controllers\Api\DataController::class, 'topics']);
Route::get("topics/doctor", [\App\Http\Controllers\Api\DataController::class, 'topics_doctor']);
Route::get("topics/lawyer", [\App\Http\Controllers\Api\DataController::class, 'topics_lawyer']);

Route::get("services", [\App\Http\Controllers\Api\DataController::class, 'services']);
Route::get("services/doctor", [\App\Http\Controllers\Api\DataController::class, 'services_doctor']);
Route::get("services/lawyer", [\App\Http\Controllers\Api\DataController::class, 'services_lawyer']);

Route::post("experts", [\App\Http\Controllers\Api\DataController::class, 'experts']);

Route::get("expert/{id}", [\App\Http\Controllers\Api\DataController::class, 'expert']);

Route::post("/agora", [\App\Http\Controllers\Api\AgoraController::class, 'token']);
Route::post("/get_token_by_channel", [\App\Http\Controllers\Api\AgoraController::class, 'get_token_by_channel']);
Route::post('/user_call', [\App\Http\Controllers\Api\AgoraController::class, 'user_call']);
