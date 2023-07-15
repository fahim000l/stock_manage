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

Route::get('/stock-in/invoice-sollection',[DashboardController::class,'indexInvoiceCollection'])->name('invoice.collection');

Route::get('/stock-in/products-collection',[DashboardController::class,'indexProductsCollection'])->name('products.collection');

Route::post('/stock-in/add-supplier',[DashboardController::class,'addSupplier'])->name('add.supplier');

Route::post('/stock-in/add-invoice',[DashboardController::class,'addInvoice'])->name('add.invoice');

Route::post('/stock-in/show-invoice-info',[DashboardController::class,'indexInfoiceInfo'])->name('invoice.info');

Route::get('/stock-in/selected-products',[DashboardController::class,'indexSelectedProducts'])->name('selected.products');

Route::post('/stock-in/selected-products-info',[DashboardController::class,'indexSelectedProductInfo'])->name('selected.products.info');

Route::post('/add-new-size',[DashboardController::class,'addNewSize'])->name('add.size');

Route::get('/stock-in/manage-size',[DashboardController::class,'indexManageSize'])->name('manage.size');

Route::post('/stocking-in',[DashboardController::class,'addToStock'])->name('add.stock');

Route::post('/stock-in/show-invoice-products',[DashboardController::class,'indexInvoiceProducts'])->name('show.invoice.products');

Route::post('/stock-in/invoice-quantity',[DashboardController::class,'indexInvoiceQuantity'])->name('show.invoice.quantity');

Route::get('/stock-collection',[DashboardController::class,'indexStockCollection'])->name('stock.colection');

Route::post('/stock-collection/invoice-info',[DashboardController::class,'indexInvoiceInfo'])->name('index.invoice.info');

Route::post('/stock-collection/stock-quantity',[DashboardController::class,'indexStockQuantity'])->name('index.stock.quantity');