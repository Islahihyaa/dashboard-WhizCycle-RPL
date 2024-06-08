<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Middleware\AuthenticatingMiddleware;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyCustomer;


Route::get('/', [LandingController::class, 'index']);

//* Authentication
Route::middleware(AuthenticatingMiddleware::class)->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registration']);
});

// Auth Routes
Route::get('/logout', [AuthController::class, 'logout']);

// Admin Dashboard
    Route::get('dashboard', [AdminController::class, 'getDashboard']);

    // Manage Orders
    Route::get('/admin/orders', [AdminController::class, 'showOrders'])->name('admin.showOrders');
    Route::put('/admin/orders/update/{id}', [AdminController::class, 'updateOrder'])->name('admin.updateOrder');
    Route::delete('/admin/orders/delete/{id}', [AdminController::class, 'deleteOrder'])->name('admin.deleteOrder');
    Route::get('/admin/order/edit/{id}', [AdminController::class, 'editOrder'])->name('admin.order.edit');

    // Manage Users
    Route::get('manageuser', [AdminController::class, 'showUsers'])->name('manageuser');
    Route::get('admin/users/edit/{user_id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('admin/users/edit/{user_id}', [AdminController::class, 'update'])->name('user.update');
    Route::delete('/admin/delete/{user_id}', [AdminController::class, 'delete'])->name('admin.delete');
    
// Storan Sampah
Route::get('manage-order', [AdminController::class, 'getManageOrder']);
Route::get('manage-order-detail/{schedule_id}', [AdminController::class, 'detailOrder'])->name('manage-order-detail');
Route::put('manage-order-detail/{schedule_id}', [AdminController::class, 'submitUpdateOrder']);


    // Manage Vehicles
    Route::get('manage-vehicles', [AdminController::class, 'getManageVehicle']);
    Route::put('manage-vehicles/{vehicle_id}', [AdminController::class, 'updateStatusVehicle'])->name('status-vehicle.update');
    Route::get('add-vehicles', [AdminController::class, 'getAddVehicle']);
    Route::post('add-vehicles', [AdminController::class, 'submitAddVehicle']);
    Route::get('manage-vehicles/{vehicle_id}', [AdminController::class, 'deleteVehicle'])->name('data-vehicle.delete');

    // Manage Articles
    Route::get('/manage-article', [AdminController::class, 'getArticle']);
    Route::get('add-article', [AdminController::class, 'getAddArticle']);
    Route::post('add-article', [AdminController::class, 'submitAddArticle']);
    Route::get('article/{article_id}/detail', [AdminController::class, 'show_detail_article']);
    Route::delete('remove-article/{article_id}', [AdminController::class, 'destroy_article']);
    Route::get('articleup/{article_id}', [AdminController::class, 'editArticle'])->name('edit-article');
    Route::put('articleupp/{article_id}', [AdminController::class, 'updateartikel'])->name('update-article');
    Route::get('/admin/article/{id}/edit', [AdminController::class, 'editArticle'])->name('admin.article.edit');
    Route::put('/admin/article/{id}', [AdminController::class, 'updateArticle'])->name('admin.article.update');

    // Manage Drivers
    Route::get('manage-driver', [AdminController::class, 'getManageDriver']);
    Route::get('add-driver', [AdminController::class, 'getAddDriver']);
    Route::post('add-driver', [AdminController::class, 'submitAddDriver'])->name('add-driver.submit');
    Route::get('manage-driver/{driver_id}', [AdminController::class, 'deleteDriver'])->name('data-driver.delete');
    Route::get('edit-driver-data/{driver_id}', [AdminController::class, 'getEditDriver'])->name('edit-driver-data');
    Route::post('edit-driver-data/{driver_id}', [AdminController::class, 'submitEditDriver'])->name('edit-driver.submit');

    // Manage Complaints
    Route::put('customer-service/{complaint_id}', [AdminController::class, 'updateStatus'])->name('customer-service.update');
    Route::get('complaint-delete/{complaint_id}', [AdminController::class, 'deleteComplaint']);
    Route::get('response-complaint', [AdminController::class, 'getResponseComplaint']);

    // Manage Points
    Route::get('manage-points', [AdminController::class, 'getManagePoint']);
    Route::get('add-rewarder', [AdminController::class, 'getAddRewarder']);
    Route::post('add-rewarder', [AdminController::class, 'submitAddRewarder']);
    Route::get('manage-points/{redeem_id}', [AdminController::class, 'deleteRewarder'])->name('delete-rewarder.delete');

    // Manage Redeem Points History
    Route::get('history-all-redeem-point', [AdminController::class, 'historyAllReedemPoint']);

// User Routes
Route::get('home', [UserController::class, 'getHome']);

// Order Routes
Route::get('order', [UserController::class, 'createOrder']);
Route::post('order', [UserController::class, 'submitOrder'])->name('order');
Route::delete('order/{id}', [UserController::class, 'destroy'])->name('order.destroy');
Route::get('success-payment', [UserController::class, 'getSuccessPayment']);

// History Routes
Route::get('riwayat', [UserController::class, 'getHistory'])->name('history');
Route::delete('history/{id}', [UserController::class, 'deleteHistory'])->name('history.delete');

// Redeem Points Routes
Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);
Route::get('redeem-point', [UserController::class, 'reedemPoint']);
Route::post('store-redeem-point', [UserController::class, 'storeReedemPoint']);

// Customer Service Routes
Route::get('customer-service', [UserController::class, 'getCustomerService']);
Route::post('customer-service', [UserController::class, 'submitComplaint']);

// Article Routes
Route::get('article', [UserController::class, 'getArticle']);
Route::get('/read-article/{article_id}', [UserController::class, 'getDetailArticle'])->name('read-article');

// Report Routes
Route::get('/laporan', [AdminController::class, 'getLaporan'])->name('laporan');
Route::get('/get-table/{tableId}', [AdminController::class, 'getTable'])->name('getTable');
Route::get('/data-vehicles', [AdminController::class, 'getTableVehicle'])->name('data-vehicles');
Route::get('/data-cs', [AdminController::class, 'getTableCS'])->name('data-cs');
Route::get('/data-point', [AdminController::class, 'getTablePoint'])->name('data-point');
Route::get('/data-user', [AdminController::class, 'getTableUser'])->name('data-user');
Route::get('/data-driver', [AdminController::class, 'getTableDriver'])->name('data-driver');

// User Store Route
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

// Voucher Routes
Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher.index');
Route::get('/voucher/create', [VoucherController::class, 'create'])->name('voucher.create');
Route::post('/voucher', [VoucherController::class, 'store'])->name('voucher.store');
Route::get('/voucher/{voucher}', [VoucherController::class, 'show'])->name('voucher.show');
Route::get('/voucher/{voucher}/edit', [VoucherController::class, 'edit'])->name('voucher.edit');
Route::post('/voucher-update', [VoucherController::class, 'update'])->name('voucher.update');
Route::get('/voucher-delete/{id}', [VoucherController::class, 'destroy'])->name('voucher.destroy');
