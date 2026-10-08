<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ShopController;
use App\Models\ShopStock;
use App\Http\Controllers\ExpenseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Products
Route::get('products/{product}/delete', [ProductController::class, 'confirmDelete'])->name('products.delete');
Route::resource('products', ProductController::class);

// Suppliers
Route::get('suppliers/{supplier}/delete', [SupplierController::class, 'confirmDelete'])->name('suppliers.delete');
Route::resource('suppliers', SupplierController::class);

// Purchases
Route::get('purchases/{purchase}/delete', [PurchaseController::class, 'confirmDelete'])->name('purchases.delete');
Route::resource('purchases', PurchaseController::class);

// Customers
Route::get('customers/{customer}/delete', [CustomerController::class, 'confirmDelete'])->name('customers.delete');
Route::resource('customers', CustomerController::class);

// Bills (Sales)
Route::get('bills/{bill}/delete', [BillController::class, 'confirmDelete'])->name('bills.delete');
Route::resource('bills', BillController::class);

// Shops
Route::get('shops/{shop}/delete', [ShopController::class, 'confirmDelete'])->name('shops.delete');

// Shops - Special Pages (must be BEFORE resource route)
Route::get('shops/batteries', [ShopController::class, 'batteries'])->name('shops.batteries');
Route::get('shops/send-stock', [ShopController::class, 'sendStockIndex'])->name('shops.send-stock');
Route::get('shops/send-stock/create', [ShopController::class, 'createTransfer'])->name('shops.create-transfer');
Route::post('shops/send-stock', [ShopController::class, 'storeTransfer'])->name('shops.store-transfer');
Route::get('shops/transfers/{transfer}', [ShopController::class, 'viewTransfer'])->name('shops.view-transfer');

// API endpoint - returns ALL products with current master stock
Route::get('shops/products-json', [ShopController::class, 'productsJson'])->name('shops.products-json');

Route::resource('shops', ShopController::class);
Route::get('expenses/{expense}/delete', [ExpenseController::class, 'confirmDelete'])->name('expenses.delete');
Route::resource('expenses', ExpenseController::class);