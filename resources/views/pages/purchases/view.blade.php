@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Invoice Details</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Invoice #{{ $purchase->invoice_number }}</p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
                <i class="ph ph-printer me-1"></i> Print
            </button>
            <a href="{{ route('purchases.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
                <i class="ph ph-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <!-- Hero Header -->
        <div class="p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center">
                    <div class="hero-icon-box bg-white text-primary me-4">
                        <i class="ph ph-receipt"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1 text-white">Invoice #{{ $purchase->invoice_number }}</h2>
                        <p class="mb-0 text-white-50">
                            <i class="ph ph-calendar me-1"></i> {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M, Y') }}
                        </p>
                    </div>
                </div>
                <div class="text-end mt-3 mt-md-0">
                    <p class="mb-0 text-white-50" style="font-size: 0.9rem;">TOTAL AMOUNT</p>
                    <h1 class="fw-bold mb-0 text-white">${{ number_format($purchase->total_amount, 2) }}</h1>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <!-- Supplier Info -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <h6 class="text-muted fw-bold mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Supplier</h6>
                    <div class="info-box">
                        <div class="info-icon bg-success-soft text-success"><i class="ph ph-truck"></i></div>
                        <div>
                            <span class="info-value">{{ $purchase->supplier->name ?? 'N/A' }}</span>
                            <small class="text-muted d-block">{{ $purchase->supplier->phone ?? '' }}</small>
                            <small class="text-muted d-block">{{ $purchase->supplier->email ?? '' }}</small>
                        </div>
                    </div>
                </div>
                @if($purchase->notes)
                <div class="col-md-6">
                    <h6 class="text-muted fw-bold mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Notes</h6>
                    <div class="p-3 bg-light rounded" style="font-size: 0.9rem;">{{ $purchase->notes }}</div>
                </div>
                @endif
            </div>

            <!-- Items Table -->
            <h6 class="text-muted fw-bold mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Items Purchased</h6>
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="text-muted fw-semibold py-3 ps-4" style="border-radius: 10px 0 0 10px;">#</th>
                            <th class="text-muted fw-semibold py-3">Product</th>
                            <th class="text-muted fw-semibold py-3 text-center">Qty</th>
                            <th class="text-muted fw-semibold py-3 text-end">Unit Price</th>
                            <th class="text-muted fw-semibold py-3 pe-4 text-end" style="border-radius: 0 10px 10px 0;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchase->items as $item)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="ps-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-bold" style="color: #1e293b;">{{ $item->product->name ?? 'Deleted Product' }}</span>
                                <br><small class="text-muted">Plate: {{ $item->product->plate_number ?? 'N/A' }}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-soft text-primary px-3 py-2" style="border-radius: 8px;">{{ $item->quantity }}</span>
                            </td>
                            <td class="text-end text-muted">${{ number_format($item->unit_price, 2) }}</td>
                            <td class="pe-4 text-end fw-bold" style="color: #10b981;">${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end pt-4 fw-semibold text-muted">Grand Total:</td>
                            <td class="pe-4 text-end pt-4">
                                <h4 class="fw-bold mb-0" style="color: #4f46e5;">${{ number_format($purchase->total_amount, 2) }}</h4>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-soft { background-color: #eef2ff; }
    .bg-success-soft { background-color: #ecfdf5; }
    .text-primary { color: #4f46e5 !important; }
    .text-success { color: #10b981 !important; }
    .hero-icon-box { width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; border-radius: 20px; font-size: 2.5rem; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .info-box { display: flex; align-items: center; padding: 20px; background-color: #f8fafc; border-radius: 14px; border: 1px solid #f1f5f9; height: 100%; }
    .info-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 1.5rem; margin-right: 15px; flex-shrink: 0; }
    .info-value { font-size: 1.1rem; color: #1e293b; font-weight: 600; display: block; }
</style>
@endsection