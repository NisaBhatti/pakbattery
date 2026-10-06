@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Edit Invoice</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Editing Invoice #{{ $purchase->invoice_number }}</p>
        </div>
        <a href="{{ route('purchases.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
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

    <!-- Warning Banner -->
    <div class="alert border-0 shadow-sm d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: #fffbeb; color: #92400e;">
        <i class="ph-fill ph-info me-2" style="font-size: 1.2rem;"></i>
        <div>
            <strong>Note:</strong> To modify the products or quantities in this invoice, you must delete this invoice and create a new one. This is to ensure stock levels remain accurate.
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <!-- Supplier -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Supplier <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-truck"></i></span>
                            <select name="supplier_id" class="form-select bg-light border-0" required style="border-radius: 0 12px 12px 0;">
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Purchase Date -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Purchase Date <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-calendar"></i></span>
                            <input type="date" name="purchase_date" class="form-control bg-light border-0" value="{{ old('purchase_date', $purchase->purchase_date) }}" required style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Notes</label>
                        <textarea name="notes" class="form-control bg-light border-0" rows="3" placeholder="Optional notes about this purchase..." style="border-radius: 12px;">{{ old('notes', $purchase->notes) }}</textarea>
                    </div>
                </div>

                <!-- Current Items (Read Only) -->
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
                                @foreach($purchase->items as $item)
                                <tr>
                                    <td class="ps-4">{{ $item->product->name ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">${{ number_format($item->unit_price, 2) }}</td>
                                    <td class="pe-4 text-end fw-bold" style="color: #10b981;">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr style="border-top: 2px solid #f1f5f9;">
                                    <td colspan="3" class="text-end fw-bold text-muted pt-3">Grand Total:</td>
                                    <td class="pe-4 text-end pt-3">
                                        <h5 class="fw-bold mb-0" style="color: #4f46e5;">${{ number_format($purchase->total_amount, 2) }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-2">
                    <a href="{{ route('purchases.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 12px 24px;">Cancel</a>
                    <button type="submit" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 12px 30px; border-radius: 10px;">
                        <i class="ph ph-floppy-disk me-1"></i> Update Invoice
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
    .input-group-text i { font-size: 1.2rem; }
</style>
@endsection