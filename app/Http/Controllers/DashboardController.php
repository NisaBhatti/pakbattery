<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch real data from the database for the dashboard cards
        $totalProducts = Product::count();
        
        // Count products where stock is 5 or less (Low Stock Alerts)
        $lowStockCount = Product::where('stock', '<=', 5)->count();
        
        // Calculate total inventory value (Price * Stock)
        // Note: This is a rough estimate. You can adjust the math later.
        $totalInventoryValue = Product::sum(\DB::raw('price * stock'));

        // Placeholders for future modules (Suppliers & Customers)
        // We will uncomment these once we build those tables
        $totalSuppliers = 0; 
        $totalCustomers = 0;

        // Points to: resources/views/pages/dashboard/dashboard.blade.php
        return view('pages.dashboard.dashboard', compact(
            'totalProducts', 
            'lowStockCount', 
            'totalInventoryValue',
            'totalSuppliers',
            'totalCustomers'
        ));
    }
}