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
Route::put('/admin/update-order/{id}', [AdminController::class, 'submitUpdateOrder'])->name('admin.updateOrder');

//* Penjemputan Sampah
Route::get('order', [UserController::class, 'createOrder']);
Route::get('success-payment', [UserController::class, 'getSuccessPayment']);
Route::post('order', [UserController::class, 'submitOrder'])->name('order');

    //* End Penjemputan Sampah

Route::get('manage-order', [AdminController::class, 'getManageOrder']);
Route::get('manage-order-detail/{schedule_id}', [AdminController::class, 'detailOrder'])->name('manage-order-detail');
Route::put('manage-order-detail/{schedule_id}', [AdminController::class, 'submitUpdateOrder']);

//* history
Route::get('history', [UserController::class, 'index'])->name('history.index');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::delete('history/{id}', [UserController::class, 'deleteHistory'])->name('history.delete');

//* Penjemputan Sampah
Route::get('order', [UserController::class, 'createOrder']);
Route::post('order', [UserController::class, 'submitOrder'])->name('order');
    //* End Penjemputan Sampah

//* Redeems Points
Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);

Route::get('redeem-point', [UserController::class, 'reedemPoint']);
Route::post('store-redeem-point', [UserController::class, 'storeReedemPoint']);
    //* End Redeems Points

//* Customer Sercice 
Route::get('customer-service', [UserController::class, 'getCustomerService']);
Route::post('customer-service', [UserController::class, 'submitComplaint']);

    //* End Customer Sercice 
    
//* Kelola Kendaraan
Route::get('manage-vehicles', [AdminController::class, 'getManageVehicle']);
Route::put('manage-vehicles/{vehicle_id}', [AdminController::class, 'updateStatusVehicle'])->name('status-vehicle.update');
Route::get('add-vehicles', [AdminController::class, 'getAddVehicle']);
Route::post('add-vehicles', [AdminController::class, 'submitAddVehicle']);
Route::get('manage-vehicles/{vehicle_id}', [AdminController::class, 'deleteVehicle'])->name('data-vehicle.delete');
//* End Kelola Kendaraan

//* Edukasi Lingkungan
Route::get('/read-article/{article_id}', [UserController::class, 'getDetailArticle'])->name('read-article');
//* End Edukasi Lingkungan
Route::get('/manage-article', [AdminController::class, 'getArticle'])->name('manage-article');



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


    //Storan Sampah
    Route::get('manage-order', [AdminController::class, 'getManageOrder']);
    Route::get('manage-order-detail/{schedule_id}', [AdminController::class, 'detailOrder'])->name('manage-order-detail');
    Route::put('manage-order-detail/{schedule_id}', [AdminController::class, 'submitUpdateOrder']);
        //End Setoran Sampah
    
    Route::get('response-complaint', [AdminController::class, 'getResponseComplaint']);
    Route::get('history-all-redeem-point', [AdminController::class, 'historyAllReedemPoint']);
    
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
    
        // Laporan Routes
    Route::get('/laporan', [AdminController::class, 'getLaporan'])->name('laporan');
    Route::get('/get-table/{tableId}', [AdminController::class, 'getTable'])->name('getTable');
    Route::get('/data-vehicles', [AdminController::class, 'getTableVehicle'])->name('data-vehicles');
    Route::get('/data-cs', [AdminController::class, 'getTableCS'])->name('data-cs');
    Route::get('/data-point', [AdminController::class, 'getTablePoint'])->name('data-point');
    Route::get('/data-user', [AdminController::class, 'getTableUser'])->name('data-user');
    Route::get('/data-driver', [AdminController::class, 'getTableDriver'])->name('data-driver');
    
        //* End Laporan
    Route::put('customer-service/{complaint_id}', [AdminController::class, 'updateStatus'])->name('customer-service.update');
    Route::get('complaint-delete/{complaint_id}', [AdminController::class, 'deleteComplaint']);
    
    /*--------------------------------------------------------------
    # Admin
    --------------------------------------------------------------*/
    //End Setoran Sampah
    
    //* Kelola Artikel
    Route::get('/manage-article', [AdminController::class, 'getArticle']);
    // Route::put('/manage-article/{article_id}', [AdminController::class, ])->name('edit-article.update');
    
    Route::get('add-article', [AdminController::class, 'getAddArticle']);
    
    Route::post('add-article', [AdminController::class, 'submitAddArticle']);
    
    Route::get('article/{article_id}/detail', [AdminController::class, 'show_detail_article']);
    
    Route::delete('remove-article/{article_id}', [AdminController::class, 'destroy_article']);
    
    Route::get('articleup/{article_id}', [AdminController::class, 'editArticle'])->name('edit-article');
    Route::put('articleupp/{article_id}', [AdminController::class, 'updateartikel'])->name('update-article');
    
    //* End Kelola Artikel

Route::delete('/admin/delete/{user}', [AdminController::class, 'delete'])->name('admin.delete');

Route::get('/admin/article/{id}/edit', [AdminController::class, 'editArticle'])->name('admin.article.edit');
Route::put('/admin/article/{id}', [AdminController::class, 'updateArticle'])->name('admin.article.update');

Route::get('/admin/order/edit/{id}', [AdminController::class, 'editOrder'])->name('admin.order.edit');

// ADMIN //
//* Kelola Artikel
Route::get('/manage-article', [AdminController::class, 'getArticle']);
// Route::put('/manage-article/{article_id}', [AdminController::class, ])->name('edit-article.update');

Route::get('add-article', [AdminController::class, 'getAddArticle']);

Route::post('add-article', [AdminController::class, 'submitAddArticle']);

Route::get('article/{article_id}/detail', [AdminController::class, 'show_detail_article']);

Route::delete('remove-article/{article_id}', [AdminController::class, 'destroy_article']);
//Perubahan 4
Route::get('articleup/{article_id}', [AdminController::class, 'editArticle'])->name('edit-article');
Route::put('articleupp/{article_id}', [AdminController::class, 'updateartikel'])->name('update-article');
// Route::get('update-article/{article_id}', [AdminController::class, 'updateArticle'])->name('update-article');

Route::get('article', [UserController::class, 'getArticle']);
Route::get('read-article/{article_id}', [UserController::class, 'getDetailArticle'])->name('read-article');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/orders', [AdminController::class, 'showOrders'])->name('admin.showOrders');
    Route::put('/admin/orders/update/{id}', [AdminController::class, 'updateOrder'])->name('admin.updateOrder');
    Route::delete('/admin/orders/delete/{id}', [AdminController::class, 'deleteOrder'])->name('admin.deleteOrder');
});


    
    
    