<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
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
});


// ========================= MASTER CUSTOMER =========================
Route::get('/master_data/customer', [CustomerController::class, 'masterCustomerPage'])->name('/master_data/customer');
Route::get('/get-customer-list-datatable', [CustomerController::class, 'getCustomerListDatatable'])->name('get-customer-list-datatable');
Route::post('/post-new-customer', [CustomerController::class, 'postNewCustomer'])->name('post-new-customer');

// ========================= MASTER ITEM =========================
Route::get('/master_data/item', [ItemController::class, 'masterItemPage'])->name('/master_data/item');
Route::get('/get-item-list-datatable', [ItemController::class, 'getItemListDatatable'])->name('get-item-list-datatable');
Route::post('/post-new-item', [ItemController::class, 'postNewItem'])->name('post-new-item');
Route::get('/get-old-data-of-item', [ItemController::class, 'getOldDataOfItem'])->name('get-old-data-of-item');
Route::post('/post-edit-item', [ItemController::class, 'postEditItem'])->name('post-edit-item');

Route::get('/transaction/form', function () {
    return view('transaction/form_transaction');
})->name('/transaction/form');
