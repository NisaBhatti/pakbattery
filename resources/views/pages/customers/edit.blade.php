@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Edit Customer</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Update the details for <strong>{{ $customer->name }}</strong>.</p>
        </div>
        <a href="{{ route('customers.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
            <i class="ph ph-arrow-left me-1"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm" role="alert" style="border-radius: 12px; background-color: #fef2f2; color: #991b1b;">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Customer Name <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-user"></i></span>
                            <input type="text" name="name" class="form-control bg-light border-0" value="{{ old('name', $customer->name) }}" required style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Phone Number</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-phone"></i></span>
                            <input type="text" name="phone" class="form-control bg-light border-0" value="{{ old('phone', $customer->phone) }}" style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Email Address</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-envelope"></i></span>
                            <input type="email" name="email" class="form-control bg-light border-0" value="{{ old('email', $customer->email) }}" style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Address</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-map-pin"></i></span>
                            <input type="text" name="address" class="form-control bg-light border-0" value="{{ old('address', $customer->address) }}" style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-2">
                    <a href="{{ route('customers.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 12px 24px;">Cancel</a>
                    <button type="submit" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 12px 30px; border-radius: 10px;">
                        <i class="ph ph-floppy-disk me-1"></i> Update Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .input-group-text { border-radius: 12px 0 0 12px !important; padding-left: 18px; padding-right: 12px; }
    .form-control { padding: 14px 18px; font-size: 1rem; transition: all 0.2s ease-in-out; box-shadow: none !important; }
    .form-control:focus { background-color: #ffffff !important; box-shadow: 0 0 0 4px #eef2ff !important; border: 1px solid #4f46e5 !important; }
    .input-group-text i { font-size: 1.2rem; }
</style>
@endsection