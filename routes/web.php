<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\SaleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\SaleController;
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('sales', SaleController::class);
Auth::routes();

Route::resource('sales', SaleController::class);
Route::resource('payments', PaymentController::class);
Route::resource('fasilitas', fasilitasController::class);
Route::get('houses', [HouseController::class, 'index'])->name('houses.index');
Route::get('houses/create', [HouseController::class, 'create'])->name('houses.create');
Route::post('houses', [HouseController::class, 'store'])->name('houses.store');
Route::get('houses/{house}', [HouseController::class, 'show'])->name('houses.show');
Route::get('houses/{house}/edit', [HouseController::class, 'edit'])->name('houses.edit');
Route::put('houses/{house}', [HouseController::class, 'update'])->name('houses.update');
Route::delete('houses/{house}', [HouseController::class, 'destroy'])->name('houses.destroy');
