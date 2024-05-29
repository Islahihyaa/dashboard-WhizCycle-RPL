<?php

use App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Order;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthenticatingMiddleware;
use App\Http\Controllers\schedulepickupController;


//* Authentication
Route::middleware(AuthenticatingMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'login']);
    Route::post('/', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
});
Route::middleware(AuthenticatingMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'login']);
    Route::post('/', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);    
    Route::post('register', [AuthController::class, 'registration']);
});

// Auth Routes
Route::get('logout', [AuthController::class, 'logout']);

// User Routes
Route::get('home', [UserController::class, 'getHome']);
Route::delete('order/{id}', [AdminController::class, 'destroy'])->name('order.destroy');

// History Routes
Route::get('history', [AdminController::class, 'getHistory'])->name('history');
Route::delete('history/{id}', [AdminController::class, 'deleteHistory'])->name('history.delete');

// Redeem Points Routes
Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);
Route::get('redeem-point', [UserController::class, 'reedemPoint']);
Route::get('history-all-redeem-point', [AdminController::class, 'historyAllReedemPoint']);
Route::post('store-redeem-point', [UserController::class, 'storeReedemPoint']);

// Admin Routes
Route::get('dashboard', [AdminController::class, 'getDashboard']);
Route::get('manageuser', [AdminController::class, 'showUsers'])->name('manageuser');
Route::get('admin/users/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('admin/users/edit/{user}', [AdminController::class, 'update'])->name('user.update');

// Customer Service Routes
Route::get('customer-service', [UserController::class, 'getCustomerService']);
Route::post('customer-service', [UserController::class, 'submitComplaint']);
Route::get('response-complaint', [AdminController::class, 'getResponseComplaint']);

// User Store Route
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

//route article 

Route::get('article', [AdminController::class, 'createArticle']);

//* End Authentication

//* Penjemputan Sampah
Route::get('order', [UserController::class, 'createOrder']);
Route::post('order', [UserController::class, 'submitOrder'])->name('order');
//* End Penjemputan Sampah

//* History
Route::get('history', [UserController::class, 'getHistory']);
Route::get('history', [schedulepickupController::class, 'getHistory']);

//* End History


//* End Redeems Points

//* Customer Sercice
Route::put('customer-service/{complaint_id}', [AdminController::class, 'updateStatus'])->name('customer-service.update');
Route::get('complaint-delete/{complaint_id}', [AdminController::class, 'deleteComplaint']);

//* End Customer Sercice


/*--------------------------------------------------------------
# Admin
--------------------------------------------------------------*/
//Storan Sampah
Route::get('manage-order', [AdminController::class, 'getManageOrder']);
Route::get('manage-order-detail/{schedule_id}', [AdminController::class, 'detailOrder'])->name('manage-order-detail');
Route::put('manage-order-detail/{schedule_id}', [AdminController::class, 'submitUpdateOrder']);

//End Setoran Sampah
