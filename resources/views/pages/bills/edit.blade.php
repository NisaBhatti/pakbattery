@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Edit Bill</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Editing Bill #{{ $bill->bill_number }}</p>
        </div>
        <a href="{{ route('bills.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
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

    <div class="alert border-0 shadow-sm d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: #fffbeb; color: #92400e;">
        <i class="ph-fill ph-info me-2" style="font-size: 1.2rem;"></i>
        <div>
            <strong>Note:</strong> To modify the products in this bill, you must delete this bill and create a new one. This ensures stock levels stay accurate.
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('bills.update', $bill->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Customer <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-user"></i></span>
                            <select name="customer_id" class="form-select bg-light border-0" required style="border-radius: 0 12px 12px 0;">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $bill->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Bill Date <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-calendar"></i></span>
                            <input type="date" name="bill_date" class="form-control bg-light border-0" value="{{ old('bill_date', $bill->bill_date) }}" required style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Notes</label>
                        <textarea name="notes" class="form-control bg-light border-0" rows="3" style="border-radius: 12px;">{{ old('notes', $bill->notes) }}</textarea>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="text-muted fw-bold mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Current Items (Read Only)</h6>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead style="background-color: #f8fafc;">
                                <tr>
                                    <th class="text-muted fw-semibold py-3 ps-4" style="border-radius: 10px 0 0 10px;">Product</th>
                                    <th class="text-muted fw-semibold py-3 text-center">Qty</th>
                                    <th class="text-muted fw-semibold py-3 text-end">Unit Price</th>
                                    <th class="text-muted fw-semibold py-3 pe-4 text-end" style="border-radius: 0 10px 10px 0;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bill->items as $item)
                                <tr>
                                    <td class="ps-4">{{ $item->product->name ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">${{ number_format($item->unit_price, 2) }}</td>
                                    <td class="pe-4 text-end fw-bold" style="color: #10b981;">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-2">
                    <a href="{{ route('bills.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 12px 24px;">Cancel</a>
                    <button type="submit" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 12px 30px; border-radius: 10px;">
                        <i class="ph ph-floppy-disk me-1"></i> Update Bill
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .input-group-text { border-radius: 12px 0 0 12px !important; padding-left: 18px; padding-right: 12px; }
    .form-control, .form-select { padding: 14px 18px; font-size: 1rem; transition: all 0.2s ease-in-out; box-shadow: none !important; }
    .form-control:focus, .form-select:focus { background-color: #ffffff !important; box-shadow: 0 0 0 4px #eef2ff !important; border: 1px solid #4f46e5 !important; }
</style>
@endsection