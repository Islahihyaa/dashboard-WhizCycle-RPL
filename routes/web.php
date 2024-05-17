<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\schedulepickupController;
use App\Http\Middleware\AuthenticatingMiddleware;
use App\Models\Order;

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

//* order
Route::get('order', [UserController::class, 'createOrder']);
Route::post('order', [UserController::class, 'submitOrder'])->name('order');
Route::delete('order/{id}', [UserController::class, 'destroy'])->name('order.destroy');
Route::delete('order/{id}', [UserController::class, 'destroy'])->name('destroy');

//* history
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



//* Edukasi Lingkungan
Route::get('article', [UserController::class, 'getArticle']);
 Route::get('/read-article/{article_id}', [UserController::class, 'getDetailArticle'])->name('read-article');
//* End Edukasi Lingkungan



/*--------------------------------------------------------------
# Admin
--------------------------------------------------------------*/




 //* Kelola Artikel
Route::get('/manage-article', [AdminController::class, 'getArticle']);

Route::get('add-article', [AdminController::class, 'getAddArticle']);

Route::post('add-article', [AdminController::class, 'submitAddArticle']);

Route::get('article/{article_id}/detail', [AdminController::class, 'show_detail_article']);

Route::delete('remove-article/{article_id}', [AdminController::class, 'destroy_article']);

//* End Kelola Artikel

Route::get('manage-order', [AdminController::class, 'getManageOrder']);
Route::get('manage-order-detail/{schedule_id}', [AdminController::class, 'detailOrder'])->name('manage-order-detail');
Route::put('manage-order-detail/{schedule_id}', [AdminController::class, 'submitUpdateOrder']);


Route::get('manage-points', [AdminController::class, 'getManagePoint']);
Route::get('add-rewarder', [AdminController::class, 'getAddRewarder']);
Route::post('add-rewarder', [AdminController::class, 'submitAddRewarder']);
Route::get('manage-points/{redeem_id}', [AdminController::class, 'deleteRewarder'])->name('delete-rewarder.delete');

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

//* Redeems Points
Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);
Route::get('redeem-point', [UserController::class, 'reedemPoint']);
Route::get('history-all-redeem-point', [AdminController::class, 'historyAllReedemPoint']);
Route::post('store-redeem-point', [UserController::class, 'storeReedemPoint']);
//* End Redeems Points

Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);