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


Route::prefix('customers')->group(function () {
    Route::get("/", [\App\Http\Controllers\Api\CustomerController::class, 'index'])->name('api_index_customer');
    Route::post("/store", [\App\Http\Controllers\Api\CustomerController::class, 'store'])->name('api_store_customer');
    Route::get("/show/{customer}", [\App\Http\Controllers\Api\CustomerController::class, 'show'])->name('api_show_customer');
    Route::patch("/update/{customer}", [\App\Http\Controllers\Api\CustomerController::class, 'update'])->name('api_update_customer');
    Route::delete("/delete/{customer}", [\App\Http\Controllers\Api\CustomerController::class, 'destroy'])->name('api_destroy_customer');
});
