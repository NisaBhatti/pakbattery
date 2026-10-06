@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Customer Bills</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">All sales bills issued to your customers.</p>
        </div>
        <a href="{{ route('bills.create') }}" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 10px 20px; border-radius: 10px;">
            <i class="ph ph-plus-circle me-1"></i> Add New Bill
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: #ecfdf5; color: #065f46;">
            <i class="ph-fill ph-check-circle me-2" style="font-size: 1.2rem;"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm" role="alert" style="border-radius: 12px; background-color: #fef2f2; color: #991b1b;">
            <i class="ph-fill ph-warning-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="text-muted fw-semibold py-3 ps-4" style="border-radius: 10px 0 0 10px;">Bill #</th>
                            <th class="text-muted fw-semibold py-3">Customer</th>
                            <th class="text-muted fw-semibold py-3">Date</th>
                            <th class="text-muted fw-semibold py-3">Total</th>
                            <th class="text-muted fw-semibold py-3 pe-4 text-end" style="border-radius: 0 10px 10px 0;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="ps-4">
                                <span class="badge bg-primary-soft text-primary px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                                    {{ $bill->bill_number }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-box-sm bg-pink-soft text-pink me-3">
                                        <i class="ph ph-user"></i>
                                    </div>
                                    <span class="fw-bold" style="color: #1e293b;">{{ $bill->customer->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted"><i class="ph ph-calendar me-1"></i> {{ \Carbon\Carbon::parse($bill->bill_date)->format('d M, Y') }}</span>
                            </td>
                            <td>
                                <span class="fw-bold" style="color: #10b981;">${{ number_format($bill->total_amount, 2) }}</span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-sm btn-icon btn-light" title="View">
                                        <i class="ph ph-eye text-primary"></i>
                                    </a>
                                    <a href="{{ route('bills.edit', $bill->id) }}" class="btn btn-sm btn-icon btn-light" title="Edit">
                                        <i class="ph ph-pencil-simple text-warning"></i>
                                    </a>
                                    <a href="{{ route('bills.delete', $bill->id) }}" class="btn btn-sm btn-icon btn-light" title="Delete">
                                        <i class="ph ph-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="ph ph-receipt" style="font-size: 3rem; opacity: 0.5;"></i>
                                    <p class="mt-3 mb-0 fw-medium">No bills yet.</p>
                                    <p style="font-size: 0.85rem;">Click "Add New Bill" to create your first sale.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                {{ $bills->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-soft { background-color: #eef2ff; }
    .bg-pink-soft { background-color: #fce7f3; }
    .text-primary { color: #4f46e5 !important; }
    .text-pink { color: #db2777 !important; }
    .text-success { color: #10b981 !important; }
    .text-warning { color: #f59e0b !important; }
    .text-danger { color: #ef4444 !important; }
    .icon-box-sm { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 1.2rem; }
    tbody tr { transition: all 0.2s ease-in-out; }
    tbody tr:hover { background-color: #f8fafc; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
    .btn-icon { width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: 1px solid #e2e8f0; background: #ffffff; transition: all 0.2s; font-size: 1.1rem; }
    .btn-icon:hover { background: #f1f5f9; border-color: #cbd5e1; transform: translateY(-2px); }
</style>
@endsection