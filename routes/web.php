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

Route::post('/stock-collection/invoice-delete',[DashboardController::class,'invoiceDelete'])->name('invoice.delete');

Route::post('/stock-collection/index-productStock-quantity',[DashboardController::class,'indexProductStockQuantity'])->name('index.product.stock.quantity');

Route::get('/stock-collection/index-product-stock',[DashboardController::class,'indexProductStock'])->name('index.product.stock');

Route::get('/stock-collection/index-invoice-stock',[DashboardController::class,'indexInvoiceStock'])->name('index.invoice.stock');

Route::post('/stock-collection/index-invoice-products',[DashboardController::class,'indexInvoiceProducts'])->name('index.invoice.products');

Route::post('/stock-collection/index-invoice-product-quantity',[DashboardController::class,'indexInvoiceProductQuantity'])->name('index.invoice.product.quantity');

Route::post('/stock-collection/edit-invoice-info',[DashboardController::class,'editInvoiceInfo'])->name('edit.invoice.info');

Route::post('/stock-colection/delete-invoice-products',[DashboardController::class,'deleteInvoiceProducts'])->name('delete.invoice.products');

Route::post('/stock-collection/invoice-product-edit',[DashboardController::class,'invoiceProductEdit'])->name('invoice.product.edit');

Route::post('/stock-collection/invoice-product-quantity-edit',[DashboardController::class,'invoiceProductQuantityEdit'])->name('invoice.product.quantity.edit');