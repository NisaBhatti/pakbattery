@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Delete Customer</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Please review the details below before deleting.</p>
        </div>
        <a href="{{ route('customers.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
            <i class="ph ph-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px; max-width: 600px; margin: 0 auto;">
        <div class="card-body p-4 p-md-5 text-center">
            <div class="icon-box-lg bg-danger-soft text-danger mx-auto mb-4">
                <i class="ph-fill ph-warning-octagon"></i>
            </div>

            <h4 class="fw-bold mb-2" style="color: #1e293b;">Are you sure?</h4>
            <p class="text-muted mb-4" style="font-size: 0.95rem;">You are about to permanently delete this customer. This action cannot be undone.</p>

            <div class="details-box text-start mb-4">
                <div class="d-flex align-items-center mb-3 pb-3" style="border-bottom: 1px dashed #e2e8f0;">
                    <div class="icon-box-sm bg-primary-soft text-primary me-3"><i class="ph ph-user"></i></div>
                    <div>
                        <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Customer Name</span>
                        <span class="fw-bold" style="color: #1e293b;">{{ $customer->name }}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3 pb-3" style="border-bottom: 1px dashed #e2e8f0;">
                    <div class="icon-box-sm bg-success-soft text-success me-3"><i class="ph ph-phone"></i></div>
                    <div>
                        <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Phone</span>
                        <span class="fw-bold" style="color: #1e293b;">{{ $customer->phone ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="icon-box-sm bg-warning-soft text-warning me-3"><i class="ph ph-envelope"></i></div>
                    <div>
                        <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Email</span>
                        <span class="fw-bold" style="color: #1e293b;">{{ $customer->email ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-flex justify-content-center gap-2">
                @csrf
                @method('DELETE')
                <a href="{{ route('customers.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 12px 30px;">Cancel</a>
                <button type="submit" class="btn btn-danger fw-bold" style="background: #ef4444; border: none; padding: 12px 30px; border-radius: 10px;">
                    <i class="ph ph-trash me-1"></i> Yes, Delete Customer
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-primary-soft { background-color: #eef2ff; }
    .bg-success-soft { background-color: #ecfdf5; }
    .bg-warning-soft { background-color: #fffbeb; }
    .bg-danger-soft { background-color: #fef2f2; }
    .text-primary { color: #4f46e5 !important; }
    .text-success { color: #10b981 !important; }
    .text-warning { color: #f59e0b !important; }
    .text-danger { color: #ef4444 !important; }
    .icon-box-lg { width: 90px; height: 90px; display: flex; align-items: center; justify-content: center; border-radius: 24px; font-size: 3rem; }
    .icon-box-sm { width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 1.3rem; flex-shrink: 0; }
    .details-box { background-color: #f8fafc; padding: 24px; border-radius: 14px; border: 1px solid #f1f5f9; }
</style>
@endsection