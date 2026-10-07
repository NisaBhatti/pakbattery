<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Bill;

class DashboardController extends Controller
{
    public function index()
    {
        // ==================== PRODUCT STATS ====================
        $totalProducts = Product::count();
        
        // Count products with low stock (5 or less)
        $lowStockCount = Product::where('stock', '<=', 5)->count();
        
        // Total inventory value (price * stock)
        $totalInventoryValue = Product::sum(\DB::raw('price * stock'));

        // ==================== SUPPLIER & CUSTOMER STATS ====================
        $totalSuppliers = Supplier::count();
        $totalCustomers = Customer::count();

        // ==================== FINANCIAL STATS ====================
        // Total amount spent on purchases (money going out)
        $totalPurchases = Purchase::sum('total_amount');
        
        // Total amount earned from bills (money coming in)
        $totalSales = Bill::sum('total_amount');
        
        // Net Profit / Loss
        $netProfit = $totalSales - $totalPurchases;

        // ==================== RECENT ACTIVITY ====================
        // Recent 5 purchases with supplier info
        $recentPurchases = Purchase::with('supplier')
            ->latest()
            ->take(5)
            ->get();

        // Recent 5 bills with customer info
        $recentBills = Bill::with('customer')
            ->latest()
            ->take(5)
            ->get();

        // ==================== LOW STOCK LIST ====================
        // Get the actual products that are low on stock
        $lowStockProducts = Product::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Points to: resources/views/pages/dashboard/dashboard.blade.php
        return view('pages.dashboard.dashboard', compact(
            'totalProducts', 
            'lowStockCount', 
            'totalInventoryValue',
            'totalSuppliers',
            'totalCustomers',
            'totalPurchases',
            'totalSales',
            'netProfit',
            'recentPurchases',
            'recentBills',
            'lowStockProducts'
        ));
    }
}