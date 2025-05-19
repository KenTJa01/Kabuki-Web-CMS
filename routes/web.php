<?php

use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderTypeController;
use App\Http\Controllers\WorkTypeController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class, 'loginPage'])->name('login')->middleware('guest');
Route::post('/post-request-login', [LoginController::class, 'postRequestLogin'])->name('post-request-login')->middleware('guest');

Route::get('/home', function () {
    return view('home');
})->name('/home');

Route::get('/get-all-data-menu', [MasterDataController::class, 'getAllDataMenu'])->name('get-all-data-menu');
Route::get('/get-all-data-profile', [MasterDataController::class, 'getAllDataProfile'])->name('get-all-data-profile');

// ========================= MASTER USER =========================
Route::get('/master_data/user', [UserController::class, 'masterUserPage'])->name('/master_data/user');
Route::get('/get-user-list-datatable', [UserController::class, 'getUserListDatatable'])->name('get-user-list-datatable');
Route::post('/post-new-user', [UserController::class, 'postNewUser'])->name('post-new-user');
Route::get('/get-old-data-of-user', [UserController::class, 'getOldDataUser'])->name('get-old-data-of-user');
Route::post('/post-edit-user', [UserController::class, 'postEditUser'])->name('post-edit-user');

// ========================= MASTER PROFILE =========================
Route::get('/master_data/profile', [ProfileController::class, 'masterProfilePage'])->name('/master_data/profile');
Route::get('/get-profile-list-datatable', [ProfileController::class, 'getProfileListDatatable'])->name('get-profile-list-datatable');
Route::post('/post-new-profile', [ProfileController::class, 'postNewProfile'])->name('post-new-profile');
Route::get('/get-old-data-of-profile', [ProfileController::class, 'getOldDataProfile'])->name('get-old-data-of-profile');
Route::get('/get-profile-menu-by-id', [ProfileController::class, 'getProfileMenuById'])->name('get-profile-menu-by-id');
Route::post('/post-edit-profile', [ProfileController::class, 'postEditProfile'])->name('post-edit-profile');


// ========================= MASTER CUSTOMER =========================
Route::get('/master_data/customer', [CustomerController::class, 'masterCustomerPage'])->name('/master_data/customer');
Route::get('/get-customer-list-datatable', [CustomerController::class, 'getCustomerListDatatable'])->name('get-customer-list-datatable');
Route::post('/post-new-customer', [CustomerController::class, 'postNewCustomer'])->name('post-new-customer');
Route::get('/get-old-data-of-customer', [CustomerController::class, 'getOldDataOfCustomer'])->name('get-old-data-of-customer');
Route::post('/post-edit-customer', [CustomerController::class, 'postEditCustomer'])->name('post-edit-customer');

// ========================= MASTER ITEM =========================
Route::get('/master_data/item', [ItemController::class, 'masterItemPage'])->name('/master_data/item');
Route::get('/get-item-list-datatable', [ItemController::class, 'getItemListDatatable'])->name('get-item-list-datatable');
Route::post('/post-new-item', [ItemController::class, 'postNewItem'])->name('post-new-item');
Route::get('/get-old-data-of-item', [ItemController::class, 'getOldDataOfItem'])->name('get-old-data-of-item');
Route::post('/post-edit-item', [ItemController::class, 'postEditItem'])->name('post-edit-item');

// ========================= MASTER ORDER TYPE =========================
Route::get('/master_data/order_type', [OrderTypeController::class, 'masterOrderTypePage'])->name('/master_data/order_type');
Route::get('/get-order-type-list-datatable', [OrderTypeController::class, 'getOrderTypeListDatatable'])->name('get-order-type-list-datatable');
Route::post('/post-new-order-type', [OrderTypeController::class, 'postNewOrderType'])->name('post-new-order-type');
Route::get('/get-old-data-of-order-type', [OrderTypeController::class, 'getOldDataOfOrderType'])->name('get-old-data-of-order-type');
Route::post('/post-edit-order-type', [OrderTypeController::class, 'postEditOrderType'])->name('post-edit-order-type');

// ========================= MASTER WORK TYPE =========================
Route::get('/master_data/work_type', [WorkTypeController::class, 'masterWorkTypePage'])->name('/master_data/work_type');
Route::get('/get-work-type-list-datatable', [WorkTypeController::class, 'getWorkTypeListDatatable'])->name('get-work-type-list-datatable');
Route::post('/post-new-work-type', [WorkTypeController::class, 'postNewWorkType'])->name('post-new-work-type');
Route::get('/get-old-data-of-work-type', [WorkTypeController::class, 'getOldDataOfWorkType'])->name('get-old-data-of-work-type');
Route::post('/post-edit-work-type', [WorkTypeController::class, 'postEditWorkType'])->name('post-edit-work-type');

Route::get('/transaction/form', function () {
    return view('transaction/form_transaction');
})->name('/transaction/form');
