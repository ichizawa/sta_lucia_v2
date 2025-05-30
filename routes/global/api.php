<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Route::group(['middleware' => ['cors', 'json.response']], function () {
//     Route::get('/test-api', [ApiController::class, 'index'])->name('test.api');
// });
