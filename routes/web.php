<?php

use App\Http\Controllers\ItemController;
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

Route::get('/', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/master_data/item', function () {
    return view('master_data/item');
})->name('/master_data/item');

Route::get('/get-item-list-datatable', [ItemController::class, 'getItemListDatatable'])->name('get-item-list-datatable');

Route::get('/transaction/form', function () {
    return view('transaction/form_transaction');
})->name('/transaction/form');
