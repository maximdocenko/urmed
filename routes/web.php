<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, "index"]);
Route::get('/privacy-policy', [\App\Http\Controllers\HomeController::class, "privacy_policy"]);
Route::get('/delete-my-account', [\App\Http\Controllers\HomeController::class, "delete_my_account"]);

Route::post('/payment/payme', [App\Http\Controllers\PaymeController::class, 'payme']);

Route::post('/prepare', [App\Http\Controllers\ClickController::class, 'prepare']);
Route::post('/complete', [App\Http\Controllers\ClickController::class, 'complete']);

Route::group(["prefix" => "admin"], function(){
    Route::resource("users", \App\Http\Controllers\Admin\UserController::class);
    Route::resource("experts", \App\Http\Controllers\Admin\ExpertController::class);
    Route::resource("categories", \App\Http\Controllers\Admin\CategoryController::class);
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/agora', [App\Http\Controllers\UserController::class, 'agora']);
    Route::post('/token', [App\Http\Controllers\AgoraController::class, 'token']);
    Route::post('/user_call', [App\Http\Controllers\AgoraController::class, 'user_call']);

    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index']);

    Route::get('/account/payment', [App\Http\Controllers\AccountController::class, 'payment']);
    Route::post('/account/payment', [App\Http\Controllers\AccountController::class, 'pay']);

    Route::get('/account/edit', [App\Http\Controllers\AccountController::class, 'edit']);
    Route::put('/account/update', [App\Http\Controllers\AccountController::class, 'update']);

    Route::get('/account/orders', [App\Http\Controllers\AgoraController::class, 'index']);
    Route::get('/account/orders/{id}', [App\Http\Controllers\AgoraController::class, 'report']);
    Route::get('/account/feedback', [App\Http\Controllers\AgoraController::class, 'feedback']);

    Route::post('/order', [App\Http\Controllers\AgoraController::class, 'store']);

    Route::get('/order/{unique_id}', [App\Http\Controllers\UserController::class, 'order']);

    Route::post('/rating', [App\Http\Controllers\UserController::class, 'rating']);

});


Auth::routes();

//Route::get('/topics/{id}', [App\Http\Controllers\UserController::class, 'topics']);

Route::get('/experts/{id}', [App\Http\Controllers\UserController::class, 'experts']);
Route::get('/expert/{unique_id}', [App\Http\Controllers\UserController::class, 'expert']);

Route::get('/chat', [App\Http\Controllers\UserController::class, 'chat']);

Route::get('/success', [App\Http\Controllers\UserController::class, 'success']);

Route::get('/database', [App\Http\Controllers\UserController::class, 'database']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/editor', function (){
    return view("editor");
});

Route::post('/sendsms', [App\Http\Controllers\SMSController::class, 'send']);
Route::post('/sendsms/check', [App\Http\Controllers\SMSController::class, 'check']);

Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'index']);
Route::get('/chat/{unique_id}', [\App\Http\Controllers\ChatController::class, 'room']);

Route::post("message", [\App\Http\Controllers\ChatController::class, 'message']);
Route::post("messages", [\App\Http\Controllers\ChatController::class, 'messages']);


Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/admin/editors', function () {
    return view('admin.editors');
});

Route::get('/admin/general', function () {
    return view('admin.general');
});

Route::get('admin/users', function () {
    return view('admin.users');
});
