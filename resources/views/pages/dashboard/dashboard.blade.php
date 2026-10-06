@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Dashboard Overview</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Welcome back, here is what's happening with your battery inventory today.</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 10px 20px; border-radius: 10px;">
            <i class="ph ph-plus-circle me-1"></i> Add New Product
        </a>
    </div>

    <!-- Stat Cards Row -->
    <div class="row g-4 mb-4">
        
        <!-- Stat Card 1: Total Products -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-primary-soft text-primary">
                            <i class="ph ph-package"></i>
                        </div>
                        <span class="badge bg-success-soft text-success fw-bold rounded-pill px-3 py-2">+12%</span>
                    </div>
                    <h6 class="text-muted fw-semibold mb-1">Total Products</h6>
                    <h2 class="fw-bold mb-0" style="color: #1e293b;">{{ $totalProducts }}</h2>
                </div>
            </div>
        </div>

        <!-- Stat Card 2: Total Suppliers -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-success-soft text-success">
                            <i class="ph ph-truck"></i>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-1">Total Suppliers</h6>
                    <h2 class="fw-bold mb-0" style="color: #1e293b;">{{ $totalSuppliers }}</h2>
                </div>
            </div>
        </div>

        <!-- Stat Card 3: Total Customers -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-warning-soft text-warning">
                            <i class="ph ph-users"></i>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-1">Total Customers</h6>
                    <h2 class="fw-bold mb-0" style="color: #1e293b;">{{ $totalCustomers }}</h2>
                </div>
            </div>
        </div>

        <!-- Stat Card 4: Low Stock Alerts -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-danger-soft text-danger">
                            <i class="ph ph-warning-circle"></i>
                        </div>
                        @if($lowStockCount > 0)
                            <span class="badge bg-danger text-white fw-bold rounded-pill px-3 py-2">Action Needed</span>
                        @endif
                    </div>
                    <h6 class="text-muted fw-semibold mb-1">Low Stock Alerts</h6>
                    <h2 class="fw-bold mb-0" style="color: #1e293b;">{{ $lowStockCount }}</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Inventory Value Card (Gradient) -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm text-white" style="border-radius: 16px; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 fw-semibold mb-2 text-uppercase" style="letter-spacing: 1px;">Total Inventory Value</h6>
                        <h1 class="fw-bold mb-0 text-white">${{ number_format($totalInventoryValue, 2) }}</h1>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="ph-fill ph-currency-dollar" style="font-size: 5rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Custom CSS for Soft Colors -->
<style>
    /* Soft Background Colors for Icon Boxes */
    .bg-primary-soft { background-color: #eef2ff; }
    .bg-success-soft { background-color: #ecfdf5; }
    .bg-warning-soft { background-color: #fffbeb; }
    .bg-danger-soft { background-color: #fef2f2; }

    /* Icon Box Styling */
    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
    }
    
    /* Text Colors matching the soft backgrounds */
    .text-primary { color: #4f46e5 !important; }
    .text-success { color: #10b981 !important; }
    .text-warning { color: #f59e0b !important; }
    .text-danger { color: #ef4444 !important; }
</style>
@endsection