<?php

use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderTypeController;
use App\Http\Controllers\WorkTypeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
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

Route::group(['middleware' => 'auth'], function () {

    // ========================= HOME PAGE =========================
    Route::get('/home', function () {
        return view('home');
    })->name('/home');

    // ========================= LOGOUT =========================
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/get-all-data-menu', [MasterDataController::class, 'getAllDataMenu'])->name('get-all-data-menu');
    Route::get('/get-all-data-profile', [MasterDataController::class, 'getAllDataProfile'])->name('get-all-data-profile');
    Route::get('/get-all-data-work-type', [MasterDataController::class, 'getAllDataWorkType'])->name('get-all-data-work-type');
    Route::get('/get-all-data-order-type', [MasterDataController::class, 'getAllDataOrderType'])->name('get-all-data-order-type');
    Route::get('/get-all-data-payment-status', [MasterDataController::class, 'getAllDataPaymentStatus'])->name('get-all-data-payment-status');
    Route::get('/get-all-data-customer', [MasterDataController::class, 'getAllDataCustomer'])->name('get-all-data-customer');
    Route::get('/get-all-data-item', [MasterDataController::class, 'getAllDataItem'])->name('get-all-data-item');
    Route::get('/get-all-data-movement-type', [MasterDataController::class, 'getAllDataMovementType'])->name('get-all-data-movement-type');
    Route::get('/get-all-data-income-type', [MasterDataController::class, 'getAllDataIncomeType'])->name('get-all-data-income-type');

    // ========================= MASTER USER =========================
    Route::get('/master_data/user', [UserController::class, 'masterUserPage'])->name('/master_data/user');
    Route::get('/get-user-list-datatable', [UserController::class, 'getUserListDatatable'])->name('get-user-list-datatable');
    Route::post('/post-new-user', [UserController::class, 'postNewUser'])->name('post-new-user');
    Route::get('/get-old-data-of-user', [UserController::class, 'getOldDataUser'])->name('get-old-data-of-user');
    Route::post('/post-edit-user', [UserController::class, 'postEditUser'])->name('post-edit-user');
    Route::post('/post-user-req-reset-pw', [UserController::class, 'postUserReqResetPw'])->name('post-user-req-reset-pw');

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

    // ========================= TRANSACTION =========================
    Route::get('/transaction/list', [TransactionController::class, 'transactionListPage'])->name('/transaction/list');
    Route::get('/get-transaction-list-datatable', [TransactionController::class, 'getTransactionListDatatable'])->name('/get-transaction-list-datatable');
    Route::get('/transaction/view/{id}', [TransactionController::class, 'viewTransactionPage'])->name('transaction/view');
    Route::post('/post-trs-on-process-submit', [TransactionController::class, 'postTrsOnProcessSubmit'])->name('post-trs-on-process-submit');

    Route::get('/transaction/history', [TransactionController::class, 'transactionHistoryPage'])->name('/transaction/history');
    Route::get('/get-transaction-history-datatable', [TransactionController::class, 'getTransactionHistoryDatatable'])->name('/get-transaction-history-datatable');

    Route::get('/transaction/form', [TransactionController::class, 'transactionFormPage'])->name('/transaction/form');
    Route::get('/get-order-type-by-id', [TransactionController::class, 'getOrderTypeById'])->name('get-order-type-by-id');
    Route::get('/get-data-customer-by-id', [TransactionController::class, 'getDataCustomerById'])->name('get-data-customer-by-id');
    Route::get('/get-trs-item', [TransactionController::class, 'getTrsItem'])->name('get-trs-item');
    Route::get('/get-trs-stock-qty', [TransactionController::class, 'getTrsStockQty'])->name('get-trs-stock-qty');
    Route::get('/get-trs-subtotal', [TransactionController::class, 'getTrsSubtotal'])->name('get-trs-subtotal');
    Route::post('/post-trs-submit', [TransactionController::class, 'postTrsSubmit'])->name('post-trs-submit');


    // ========================= RECEIVING =========================
    Route::get('/receiving/list', [ReceivingController::class, 'receivingListPage'])->name('/receiving/list');
    Route::get('/get-receiving-list-datatable', [ReceivingController::class, 'getReceivingListDatatable'])->name('/get-receiving-list-datatable');
    Route::get('/receiving/view/{id}', [ReceivingController::class, 'viewReceivingPage'])->name('receiving/view');
    Route::get('/receiving/form', [ReceivingController::class, 'receivingFormPage'])->name('/receiving/form');
    Route::get('/get-rec-item', [ReceivingController::class, 'getRecItem'])->name('get-rec-item');
    Route::post('/post-rec-submit', [ReceivingController::class, 'postRecSubmit'])->name('post-rec-submit');

    // ========================= STOCK =========================
    Route::get('/stock/list', [StockController::class, 'stockListPage'])->name('/stock/list');
    Route::post('/get-stock-list-datatable', [StockController::class, 'getStockListDatatable'])->name('get-stock-list-datatable');

    Route::get('/stock/movement', [StockController::class, 'listStockMovementPage'])->name('/stock/movement');
    Route::post('/get-movement-stock-list-datatable', [StockController::class, 'getMovementStockList'])->name('/get-movement-stock-list-datatable');

    // ========================= FINANCE =========================
    Route::get('/finance/list', [FinanceController::class, 'financeIncomePage'])->name('/finance/list');
    Route::get('/get-income-list-datatable', [FinanceController::class, 'getIncomeListDatatable'])->name('get-income-list-datatable');
    Route::post('/post-new-finance-income', [FinanceController::class, 'postFinIncomeSubmit'])->name('post-new-finance-income');

});
