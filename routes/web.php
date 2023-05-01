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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("/customer")->group(function () {

    Route::get("/", [\App\Http\Controllers\CustomerController::class, 'index'])->name('index_customer');
    Route::get("/create", [\App\Http\Controllers\CustomerController::class, 'create'])->name('create_customer');
    Route::post("/store", [\App\Http\Controllers\CustomerController::class, 'store'])->name('store_customer');
    Route::get("/edit/{customer}", [\App\Http\Controllers\CustomerController::class, 'edit'])->name('edit_customer');
    Route::put("/update/{customer}", [\App\Http\Controllers\CustomerController::class, 'update'])->name('update_customer');
    Route::delete("/delete/{customer}", [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('delete_customer');

});
