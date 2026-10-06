@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Product Details</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">View complete information about this product.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px; color: #f59e0b;">
                <i class="ph ph-pencil-simple me-1"></i> Edit
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
                <i class="ph ph-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Main Details Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        
        <!-- Hero Header (Colored Banner) -->
        <div class="p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
            <div class="d-flex align-items-center">
                <div class="hero-icon-box bg-white text-primary me-4">
                    <i class="ph ph-package"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1 text-white">{{ $product->name }}</h2>
                    <p class="mb-0 text-white-50">
                        <i class="ph ph-barcode me-1"></i> Plate: {{ $product->plate_number }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="card-body p-4 p-md-5">
            <div class="row g-4">
                
                <!-- Product Name -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-primary-soft text-primary">
                            <i class="ph ph-package"></i>
                        </div>
                        <div>
                            <span class="info-label">Product Name</span>
                            <span class="info-value">{{ $product->name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Plate Number -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-success-soft text-success">
                            <i class="ph ph-barcode"></i>
                        </div>
                        <div>
                            <span class="info-label">Plate Number</span>
                            <span class="info-value">{{ $product->plate_number }}</span>
                        </div>
                    </div>
                </div>

                <!-- Price -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-warning-soft text-warning">
                            <i class="ph ph-currency-dollar"></i>
                        </div>
                        <div>
                            <span class="info-label">Price</span>
                            <span class="info-value text-success fw-bold">${{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Stock Quantity -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-danger-soft text-danger">
                            <i class="ph ph-stack"></i>
                        </div>
                        <div>
                            <span class="info-label">Stock Quantity</span>
                            <span class="info-value">
                                @if($product->stock <= 5)
                                    <span class="badge bg-danger-soft text-danger px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                                        <i class="ph ph-warning-circle me-1"></i> {{ $product->stock }} (Low Stock)
                                    </span>
                                @else
                                    <span class="badge bg-success-soft text-success px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                                        <i class="ph ph-check-circle me-1"></i> {{ $product->stock }} In Stock
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Created At -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-primary-soft text-primary">
                            <i class="ph ph-calendar"></i>
                        </div>
                        <div>
                            <span class="info-label">Created At</span>
                            <span class="info-value">{{ $product->created_at->format('d M, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Last Updated -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-success-soft text-success">
                            <i class="ph ph-clock-counter-clockwise"></i>
                        </div>
                        <div>
                            <span class="info-label">Last Updated</span>
                            <span class="info-value">{{ $product->updated_at->format('d M, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Modern Info Boxes -->
<style>
    /* Soft Background Colors */
    .bg-primary-soft { background-color: #eef2ff; }
    .bg-success-soft { background-color: #ecfdf5; }
    .bg-warning-soft { background-color: #fffbeb; }
    .bg-danger-soft { background-color: #fef2f2; }

    /* Text Colors */
    .text-primary { color: #4f46e5 !important; }
    .text-success { color: #10b981 !important; }
    .text-warning { color: #f59e0b !important; }
    .text-danger { color: #ef4444 !important; }

    /* Hero Header Icon */
    .hero-icon-box {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        font-size: 2.5rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    /* Info Box Layout */
    .info-box {
        display: flex;
        align-items: center;
        padding: 20px;
        background-color: #f8fafc;
        border-radius: 14px;
        border: 1px solid #f1f5f9;
        transition: all 0.2s ease-in-out;
        height: 100%;
    }
    .info-box:hover {
        background-color: #ffffff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transform: translateY(-2px);
    }
    
    .info-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .info-label {
        display: block;
        font-size: 0.8rem;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 3px;
    }
    
    .info-value {
        display: block;
        font-size: 1.1rem;
        color: #1e293b;
        font-weight: 600;
    }
</style>
@endsection