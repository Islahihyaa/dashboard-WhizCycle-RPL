<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\schedulepickupController;
use App\Http\Middleware\AuthenticatingMiddleware;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyCustomer;


//* Authentication
Route::middleware(AuthenticatingMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'login']);
    Route::post('/', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registration']);
});

Route::get('logout', [AuthController::class, 'logout']);

Route::get('home', [UserController::class, 'getHome']);
Route::get('dashboard', [AdminController::class, 'getDashboard']);

//* End Authentication

//* Penjemputan Sampah
Route::get('order', [UserController::class, 'createOrder']);
Route::post('order', [UserController::class, 'submitOrder'])->name('order');
//* End Penjemputan Sampah

//* History
Route::get('history', [UserController::class, 'getHistory']);
Route::get('history', [schedulepickupController::class, 'getHistory']);

//* End History

//* Redeems Points
Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);

//* End Redeems Points

//* Customer Sercice 
Route::get('customer-service', [UserController::class, 'getCustomerService']);
Route::post('customer-service', [UserController::class, 'submitComplaint']);
Route::put('customer-service/{complaint_id}', [AdminController::class, 'updateStatus'])->name('customer-service.update');
Route::get('complaint-delete/{complaint_id}', [AdminController::class, 'deleteComplaint']);

//* End Customer Sercice 


/*--------------------------------------------------------------
# Admin
--------------------------------------------------------------*/

Route::get('response-complaint', [AdminController::class, 'getResponseComplaint']);