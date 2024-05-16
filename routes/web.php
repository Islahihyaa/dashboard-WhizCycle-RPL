<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\schedulepickupController;
use App\Http\Middleware\AuthenticatingMiddleware;
use App\Models\Order;


Route::middleware(AuthenticatingMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'login']);
    Route::post('/', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);    
    Route::post('register', [AuthController::class, 'registration']);
});

Route::get('logout', [AuthController::class, 'logout']);

Route::get('home', [UserController::class, 'getHome']);
Route::get('dashboard', [AdminController::class, 'getDashboard']);

Route::get('order', [UserController::class, 'createOrder']);
Route::post('order', [UserController::class, 'submitOrder'])->name('order');
Route::delete('order/{id}', [UserController::class, 'destroy'])->name('order.destroy');
Route::delete('order/{id}', [UserController::class, 'destroy'])->name('destroy');


Route::get('history', [UserController::class, 'index'])->name('history.index');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::delete('history/{id}', [UserController::class, 'deleteHistory'])->name('history.delete');

Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);   

//* Kelola Kendaraan
Route::get('manage-vehicles', [AdminController::class, 'getManageVehicle']);
Route::put('manage-vehicles/{vehicle_id}', [AdminController::class, 'updateStatusVehicle'])->name('status-vehicle.update');
Route::get('add-vehicles', [AdminController::class, 'getAddVehicle']);
Route::post('add-vehicles', [AdminController::class, 'submitAddVehicle']);
Route::get('manage-vehicles/{vehicle_id}', [AdminController::class, 'deleteVehicle'])->name('data-vehicle.delete');
//* End Kelola Kendaraan

