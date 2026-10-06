@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Product Management</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Manage your battery inventory, pricing, and stock levels.</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 10px 20px; border-radius: 10px;">
            <i class="ph ph-plus-circle me-1"></i> Add New Product
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: #ecfdf5; color: #065f46;">
            <i class="ph-fill ph-check-circle me-2" style="font-size: 1.2rem;"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead style="background-color: #f8fafc; border-radius: 10px;">
                        <tr>
                            <th class="text-muted fw-semibold py-3 ps-4" style="border-radius: 10px 0 0 10px;">#</th>
                            <th class="text-muted fw-semibold py-3">Product Details</th>
                            <th class="text-muted fw-semibold py-3">Plate Number</th>
                            <th class="text-muted fw-semibold py-3">Price</th>
                            <th class="text-muted fw-semibold py-3">Stock Status</th>
                            <th class="text-muted fw-semibold py-3 pe-4 text-end" style="border-radius: 0 10px 10px 0;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="ps-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                            
                            <!-- Product Name with Icon -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-box-sm bg-primary-soft text-primary me-3">
                                        <i class="ph ph-package"></i>
                                    </div>
                                    <span class="fw-bold" style="color: #1e293b;">{{ $product->name }}</span>
                                </div>
                            </td>
                            
                            <!-- Plate Number -->
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2" style="font-weight: 600; border-radius: 8px;">
                                    <i class="ph ph-barcode me-1 text-muted"></i> {{ $product->plate_number }}
                                </span>
                            </td>
                            
                            <!-- Price -->
                            <td>
                                <span class="fw-bold" style="color: #10b981;">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </td>
                            
                            <!-- Stock Status -->
                            <td>
                                @if($product->stock <= 5)
                                    <span class="badge bg-danger-soft text-danger px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                                        <i class="ph ph-warning-circle me-1"></i> {{ $product->stock }} (Low)
                                    </span>
                                @else
                                    <span class="badge bg-success-soft text-success px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                                        <i class="ph ph-check-circle me-1"></i> {{ $product->stock }} In Stock
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Action Buttons -->
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-icon btn-light" title="View">
                                        <i class="ph ph-eye text-primary"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-icon btn-light" title="Edit">
                                        <i class="ph ph-pencil-simple text-warning"></i>
                                    </a>
                                    <a href="{{ route('products.delete', $product->id) }}" class="btn btn-sm btn-icon btn-light" title="Delete">
                                        <i class="ph ph-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="ph ph-package" style="font-size: 3rem; opacity: 0.5;"></i>
                                    <p class="mt-3 mb-0 fw-medium">No products found.</p>
                                    <p style="font-size: 0.85rem;">Click "Add New Product" to get started.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-end">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Soft Colors -->
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

    /* Small Icon Box for Table Row */
    .icon-box-sm {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 1.2rem;
    }

    /* Clean Hover Effect for Table Rows */
    tbody tr {
        transition: all 0.2s ease-in-out;
    }
    tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.005);
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    /* Icon Action Buttons */
    .btn-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        transition: all 0.2s;
        font-size: 1.1rem;
    }
    .btn-icon:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }

    /* Custom Pagination Styling */
    .pagination .page-item.active .page-link {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }
    .pagination .page-link {
        color: #64748b;
        border-radius: 8px;
        margin: 0 2px;
        border: none;
    }
</style>
@endsection