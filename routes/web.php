<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController; // We will create this next

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

// Purchases (Invoices)
Route::get('purchases/{purchase}/delete', [PurchaseController::class, 'confirmDelete'])->name('purchases.delete');
Route::resource('purchases', PurchaseController::class);