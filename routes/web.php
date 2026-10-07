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

Route::get('shops/{shop}/delete', [ShopController::class, 'confirmDelete'])->name('shops.delete');

// Shops - Batteries & Send Stock (must be BEFORE resource route to avoid conflicts)
Route::get('shops/batteries', [ShopController::class, 'batteries'])->name('shops.batteries');
Route::get('shops/send-stock', [ShopController::class, 'sendStockIndex'])->name('shops.send-stock');
Route::get('shops/send-stock/create', [ShopController::class, 'createTransfer'])->name('shops.create-transfer');
Route::post('shops/send-stock', [ShopController::class, 'storeTransfer'])->name('shops.store-transfer');
Route::get('shops/transfers/{transfer}', [ShopController::class, 'viewTransfer'])->name('shops.view-transfer');

Route::resource('shops', ShopController::class);



Route::get('shops/{shop}/products-json', function ($shopId) {
    $stocks = ShopStock::with('product')
        ->where('shop_id', $shopId)
        ->where('quantity', '>', 0)
        ->get();
    
    return response()->json($stocks->map(function ($stock) {
        return [
            'id' => $stock->product_id,
            'name' => $stock->product->name,
            'plate_number' => $stock->product->plate_number,
            'quantity' => $stock->quantity,
        ];
    }));
})->name('shops.products-json');