<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root directly to dashboard (skip login)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard Route (No auth required)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==========================================
// PRODUCT MANAGEMENT ROUTES (No auth required)
// ==========================================

// Custom route for Delete Confirmation
Route::get('products/{product}/delete', [ProductController::class, 'confirmDelete'])->name('products.delete');

// Standard Resource Routes
Route::resource('products', ProductController::class);