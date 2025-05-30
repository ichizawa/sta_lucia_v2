<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\TenantController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::get('/test-api', [ApiController::class, 'index'])->name('test.api');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {

      Route::middleware('auth:api')->prefix('tenant')->group(function () {
        // Route::get('/user/{user_id}', [TenantController::class, 'tenantProfile']);
    });
    

    });
    
    Route::get('/user/{user_id}', [TenantController::class, 'tenantProfile']);
});


