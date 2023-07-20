<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('pages.landing');
})->name('home.page');

Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/add-product',[DashboardController::class,'addProduct'])->name('add.product.page');

Route::get('/stock-in',[DashboardController::class,'stockIn'])->name('stock.in.page');

Route::post('/upload-image',[DashboardController::class,'uploadImage'])->name('upload.img');

Route::post('/add-product',[DashboardController::class,'addNewProduct'])->name('add.product');

Route::get('/stock-in/supplier-collection',[DashboardController::class,'indexSupplierCollection'])->name('supplier.collection');

Route::post('/stock-in/add-supplier',[DashboardController::class,'addSupplier'])->name('add.supplier');

Route::get('/stock-in/invoice',[DashboardController::class,'indexInvoice'])->name('index.invoice');

Route::post('/stock-in/get-supplier',[DashboardController::class,'getSupplier'])->name('get.supplier');

Route::post('/stock-in/get-product',[DashboardController::class,'getProduct'])->name('get.product');

Route::post('/stock-in/index-set-quantity-table',[DashboardController::class,'indexSetQuantityTable'])->name('index.setquantity.table');

Route::post('/stock-in/stocking-in',[DashboardController::class,'stockingIn'])->name('stocking.in');

Route::get('/stock-collection',[DashboardController::class,'indexStockCollection'])->name('stock.collection.page');

Route::post('/stock-collection/index-invoice-details',[DashboardController::class,'indexInvoiceDetails'])->name('index.invoice.details');

Route::post('/stock-collection/show-invoice-quantity',[DashboardController::class,'indexInvoiceQuantity'])->name('index.invoice,quantity');

Route::post('/add-new-size',[DashboardController::class,'addNewSize'])->name('add.size');

Route::get('/index-manage-size',[DashboardController::class,'indexManageSizeTable'])->name('index.all.size');

Route::post('/set-status-deactive',[DashboardController::class,'setStatusDeactive'])->name('set.status.deactive');

Route::post('/set-status-active',[DashboardController::class,'setStatusActive'])->name('set.status.active');

Route::post('/stock-collection/delete-stock',[DashboardController::class,'deleteStock'])->name('delete.stock');