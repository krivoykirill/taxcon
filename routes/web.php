<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/show-odometer-form', [App\Http\Controllers\HomeController::class, 'showOdometerForm'])->name('form-show');
Route::post('submit-odometer-form', [App\Http\Controllers\HomeController::class, 'submitOdometerForm'])->name('form-submit');

Route::get('register-car', [App\Http\Controllers\CarsController::class, 'register'])->name('register-car');
Route::post('car-register-submit', [App\Http\Controllers\CarsController::class, 'submitRegister'])->name('car-register-submit');
Route::post('car-update', [App\Http\Controllers\CarsController::class, 'updateCar'])->name('car-update');
Route::get('show-car/{id}', [App\Http\Controllers\CarsController::class, 'showCars'])->name('show-car');
Route::get('show-cars', [App\Http\Controllers\CarsController::class, 'showAllCars'])->name('show-cars');


Route::prefix('driver')->group(function () {
    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/show-odometer-form', [App\Http\Controllers\HomeController::class, 'showOdometerForm'])->name('form-show');
    Route::post('submit-odometer-form', [App\Http\Controllers\HomeController::class, 'submitOdometerForm'])->name('form-submit');
});