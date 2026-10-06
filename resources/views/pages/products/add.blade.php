@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Add New Product</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Fill in the details below to add a new battery or product to your inventory.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
            <i class="ph ph-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: #fef2f2; color: #991b1b;">
            <i class="ph-fill ph-warning-circle me-2" style="font-size: 1.2rem;"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Form Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                
                <div class="row g-4">
                    <!-- Product Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Product Name <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-package"></i></span>
                            <input type="text" name="name" class="form-control bg-light border-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="e.g., Exide Battery 150Ah" style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>
                    
                    <!-- Plate Number -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Plate Number <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-barcode"></i></span>
                            <input type="text" name="plate_number" class="form-control bg-light border-0 @error('plate_number') is-invalid @enderror" value="{{ old('plate_number') }}" required placeholder="e.g., PLT-00123" style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Price <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-currency-dollar"></i></span>
                            <input type="number" step="0.01" name="price" class="form-control bg-light border-0 @error('price') is-invalid @enderror" value="{{ old('price') }}" required placeholder="0.00" style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Stock Quantity <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-stack"></i></span>
                            <input type="number" name="stock" class="form-control bg-light border-0 @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" required placeholder="0" style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 12px 24px;">Cancel</a>
                    <button type="submit" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 12px 30px; border-radius: 10px;">
                        <i class="ph ph-floppy-disk me-1"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Input Styling -->
<style>
    /* Soft Input Group Styling */
    .input-group-text {
        border-radius: 12px 0 0 12px !important;
        padding-left: 18px;
        padding-right: 12px;
    }
    
    .form-control {
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.2s ease-in-out;
        box-shadow: none !important;
    }
    
    .form-control:focus {
        background-color: #ffffff !important;
        box-shadow: 0 0 0 4px #eef2ff !important;
        border: 1px solid #4f46e5 !important;
    }
    
    .form-control.is-invalid {
        background-color: #fef2f2 !important;
    }

    /* Icon inside input */
    .input-group-text i {
        font-size: 1.2rem;
    }
</style>
@endsection