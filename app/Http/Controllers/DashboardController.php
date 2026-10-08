<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Bill;
use App\Models\Shop;
use App\Models\Expense;
use App\Models\StockTransfer;

class DashboardController extends Controller
{
    public function index()
    {
        // ==================== PRODUCT STATS ====================
        $totalProducts = Product::count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();
        $totalInventoryValue = Product::sum(\DB::raw('price * stock'));

        // ==================== SUPPLIER & CUSTOMER STATS ====================
        $totalSuppliers = Supplier::count();
        $totalCustomers = Customer::count();

        // ==================== SHOP STATS ====================
        $totalShops = Shop::count();
        $activeShops = Shop::where('is_active', true)->count();

        // ==================== STOCK TRANSFER STATS ====================
        $totalTransfers = StockTransfer::count();
        $totalTransferredQty = StockTransfer::sum('total_quantity');

        // ==================== FINANCIAL STATS ====================
        $totalPurchases = Purchase::sum('total_amount');
        $totalSales = Bill::sum('total_amount');
        $totalExpenses = Expense::sum('amount');
        
        // Net Profit = Sales - Purchases - Expenses
        $netProfit = $totalSales - $totalPurchases - $totalExpenses;

        // ==================== RECENT ACTIVITY ====================
        $recentPurchases = Purchase::with('supplier')->latest()->take(5)->get();
        $recentBills = Bill::with('customer')->latest()->take(5)->get();
        $recentExpenses = Expense::latest('expense_date')->take(5)->get();
        $recentTransfers = StockTransfer::with('fromShop', 'toShop')->latest()->take(5)->get();

        // ==================== LOW STOCK LIST ====================
        $lowStockProducts = Product::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('pages.dashboard.dashboard', compact(
            'totalProducts', 
            'lowStockCount', 
            'totalInventoryValue',
            'totalSuppliers',
            'totalCustomers',
            'totalShops',
            'activeShops',
            'totalTransfers',
            'totalTransferredQty',
            'totalPurchases',
            'totalSales',
            'totalExpenses',
            'netProfit',
            'recentPurchases',
            'recentBills',
            'recentExpenses',
            'recentTransfers',
            'lowStockProducts'
        ));
    }
}