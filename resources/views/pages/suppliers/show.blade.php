@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Suppliers Management</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Manage all your battery suppliers in one place.</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 10px 20px; border-radius: 10px;">
            <i class="ph ph-plus-circle me-1"></i> Add New Supplier
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: #ecfdf5; color: #065f46;">
            <i class="ph-fill ph-check-circle me-2" style="font-size: 1.2rem;"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="text-muted fw-semibold py-3 ps-4" style="border-radius: 10px 0 0 10px;">#</th>
                            <th class="text-muted fw-semibold py-3">Supplier</th>
                            <th class="text-muted fw-semibold py-3">Phone</th>
                            <th class="text-muted fw-semibold py-3">Email</th>
                            <th class="text-muted fw-semibold py-3 pe-4 text-end" style="border-radius: 0 10px 10px 0;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="ps-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-box-sm bg-primary-soft text-primary me-3">
                                        <i class="ph ph-truck"></i>
                                    </div>
                                    <div>
                                        <span class="fw-bold d-block" style="color: #1e293b;">{{ $supplier->name }}</span>
                                        <small class="text-muted">{{ Str::limit($supplier->address, 40) ?? 'No address' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($supplier->phone)
                                    <span class="text-muted"><i class="ph ph-phone me-1"></i> {{ $supplier->phone }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($supplier->email)
                                    <span class="text-muted"><i class="ph ph-envelope me-1"></i> {{ $supplier->email }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-sm btn-icon btn-light" title="View">
                                        <i class="ph ph-eye text-primary"></i>
                                    </a>
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-icon btn-light" title="Edit">
                                        <i class="ph ph-pencil-simple text-warning"></i>
                                    </a>
                                    <a href="{{ route('suppliers.delete', $supplier->id) }}" class="btn btn-sm btn-icon btn-light" title="Delete">
                                        <i class="ph ph-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="ph ph-truck" style="font-size: 3rem; opacity: 0.5;"></i>
                                    <p class="mt-3 mb-0 fw-medium">No suppliers found.</p>
                                    <p style="font-size: 0.85rem;">Click "Add New Supplier" to get started.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-soft { background-color: #eef2ff; }
    .text-primary { color: #4f46e5 !important; }
    .text-warning { color: #f59e0b !important; }
    .text-danger { color: #ef4444 !important; }
    .icon-box-sm { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 1.2rem; }
    tbody tr { transition: all 0.2s ease-in-out; }
    tbody tr:hover { background-color: #f8fafc; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
    .btn-icon { width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: 1px solid #e2e8f0; background: #ffffff; transition: all 0.2s; font-size: 1.1rem; }
    .btn-icon:hover { background: #f1f5f9; border-color: #cbd5e1; transform: translateY(-2px); }
</style>
@endsection