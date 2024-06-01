<?php

use App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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
Route::get('dashboard', [AdminController::class, 'getDashboard']);
//* End Authentication

Route::middleware(OnlyCustomer::class)->group(function () {
    Route::get('home', [UserController::class, 'getHome']);

    //* Penjemputan Sampah
    Route::get('order', [UserController::class, 'createOrder']);
    Route::get('success-payment', [UserController::class, 'getSuccessPayment']);
    Route::post('order', [UserController::class, 'submitOrder'])->name('order');
    //* End Penjemputan Sampah

    //* History
    Route::get('history', [UserController::class, 'getHistory']);

    Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);


    //* Penjemputan Sampah
    Route::get('order', [UserController::class, 'createOrder']);
    Route::post('order', [UserController::class, 'submitOrder'])->name('order');
    //* End Penjemputan Sampah

    //* History
    Route::get('history', [UserController::class, 'getHistory']);

    //* End History

    //* Redeems Points
    Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);

    Route::get('redeem-point', [UserController::class, 'reedemPoint']);
    Route::get('history-all-redeem-point', [UserController::class, 'historyAllReedemPoint']);
    Route::post('store-redeem-point', [UserController::class, 'storeReedemPoint']);
    //* End Redeems Points

    //* Customer Sercice 
    Route::get('customer-service', [UserController::class, 'getCustomerService']);
    Route::post('customer-service', [UserController::class, 'submitComplaint']);
    Route::put('customer-service/{complaint_id}', [AdminController::class, 'updateStatus'])->name('customer-service.update');
    Route::get('complaint-delete/{complaint_id}', [AdminController::class, 'deleteComplaint']);
    //* End Customer Sercice 

    //* Edukasi Lingkungan
    Route::get('article', [UserController::class, 'getArticle']);
    Route::get('/read-article/{article_id}', [UserController::class, 'getDetailArticle'])->name('read-article');
    //* End Edukasi Lingkungan

});

/*--------------------------------------------------------------
# Admin
--------------------------------------------------------------*/

Route::middleware(OnlyAdmin::class)->group(function () { 

    //Storan Sampah
    Route::get('manage-order', [AdminController::class, 'getManageOrder']);
    Route::get('manage-order-detail/{schedule_id}', [AdminController::class, 'detailOrder'])->name('manage-order-detail');
    Route::put('manage-order-detail/{schedule_id}', [AdminController::class, 'submitUpdateOrder']);
    //End Setoran Sampah

    Route::get('response-complaint', [AdminController::class, 'getResponseComplaint']);

    //* Kelola Kendaraan
    Route::get('manage-vehicles', [AdminController::class, 'getManageVehicle']);
    Route::put('manage-vehicles/{vehicle_id}', [AdminController::class, 'updateStatusVehicle'])->name('status-vehicle.update');
    Route::get('add-vehicles', [AdminController::class, 'getAddVehicle']);
    Route::post('add-vehicles', [AdminController::class, 'submitAddVehicle']);
    Route::get('manage-vehicles/{vehicle_id}', [AdminController::class, 'deleteVehicle'])->name('data-vehicle.delete');
    //* End Kelola Kendaraan


    //* Kelola Artikel
    Route::get('/manage-article', [AdminController::class, 'getArticle']);

    Route::get('add-article', [AdminController::class, 'getAddArticle']);
    
    Route::post('add-article', [AdminController::class, 'submitAddArticle']);
    
    Route::get('article/{article_id}/detail', [AdminController::class, 'show_detail_article']);
    
    Route::delete('remove-article/{article_id}', [AdminController::class, 'destroy_article']);
    
    //* End Kelola Artikel
    
    Route::get('manageuser', [AdminController::class, 'showUsers'])->name('manageuser');

    Route::get('admin/users/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('admin/users/edit/{user}', [AdminController::class, 'update'])->name('user.update');

    //* Kelola Driver
    Route::get('manage-driver', [AdminController::class, 'getManageDriver']);
    Route::get('add-driver', [AdminController::class, 'getAddDriver']);
    Route::post('add-driver', [AdminController::class, 'submitAddDriver'])->name('add-driver.submit');
    Route::get('manage-driver/{driver_id}', [AdminController::class, 'deleteDriver'])->name('data-driver.delete');
    Route::get('edit-driver-data/{driver_id}', [AdminController::class, 'getEditDriver'])->name('edit-driver-data');
    Route::post('edit-driver-data/{driver_id}', [AdminController::class, 'submitEditDriver'])->name('edit-driver.submit');
    //* End Kelola Driver

});