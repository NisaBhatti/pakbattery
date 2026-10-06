@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Customer Details</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Complete information about this customer.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px; color: #f59e0b;">
                <i class="ph ph-pencil-simple me-1"></i> Edit
            </a>
            <a href="{{ route('customers.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
                <i class="ph ph-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);">
            <div class="d-flex align-items-center">
                <div class="hero-icon-box bg-white text-danger me-4">
                    <i class="ph ph-user"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1 text-white">{{ $customer->name }}</h2>
                    <p class="mb-0 text-white-50">
                        <i class="ph ph-calendar me-1"></i> Added {{ $customer->created_at->format('d M, Y') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-primary-soft text-primary"><i class="ph ph-user"></i></div>
                        <div>
                            <span class="info-label">Customer Name</span>
                            <span class="info-value">{{ $customer->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-success-soft text-success"><i class="ph ph-phone"></i></div>
                        <div>
                            <span class="info-label">Phone</span>
                            <span class="info-value">{{ $customer->phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-warning-soft text-warning"><i class="ph ph-envelope"></i></div>
                        <div>
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $customer->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon bg-danger-soft text-danger"><i class="ph ph-map-pin"></i></div>
                        <div>
                            <span class="info-label">Address</span>
                            <span class="info-value">{{ $customer->address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
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
    .hero-icon-box { width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; border-radius: 20px; font-size: 2.5rem; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .info-box { display: flex; align-items: center; padding: 20px; background-color: #f8fafc; border-radius: 14px; border: 1px solid #f1f5f9; transition: all 0.2s ease-in-out; height: 100%; }
    .info-box:hover { background-color: #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transform: translateY(-2px); }
    .info-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 1.5rem; margin-right: 15px; flex-shrink: 0; }
    .info-label { display: block; font-size: 0.8rem; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }
    .info-value { display: block; font-size: 1.1rem; color: #1e293b; font-weight: 600; }
</style>
@endsection