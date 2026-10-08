@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 purchase-form-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Edit Invoice</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-pencil-simple me-1"></i>
                Editing Invoice <strong class="invoice-highlight">#{{ $purchase->invoice_number }}</strong>
            </p>
        </div>
        <a href="{{ route('purchases.index') }}" class="btn btn-back">
            <i class="ph ph-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Error Alert — Animated -->
    @if ($errors->any())
        <div class="alert alert-error-premium fade-in-up" role="alert">
            <div class="alert-icon-wrapper">
                <i class="ph-fill ph-warning-circle"></i>
            </div>
            <div class="alert-content">
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

    <!-- Info Alert — Premium Amber Note -->
    <div class="alert alert-info-premium fade-in-up" role="alert">
        <div class="alert-icon-wrapper-info">
            <i class="ph-fill ph-info"></i>
        </div>
        <div class="alert-content-info">
            <strong>Note:</strong> To modify the products or quantities in this invoice, you must delete this invoice and create a new one. This is to ensure stock levels remain accurate.
        </div>
    </div>

    <!-- Main Form Card — Premium -->
    <div class="form-card fade-in-up">
        <!-- Animated Top Gradient Border (Amber themed for edit) -->
        <div class="form-card-border"></div>
        <!-- Decorative Background Shapes -->
        <div class="form-shape form-shape-1"></div>
        <div class="form-shape form-shape-2"></div>
        
        <div class="card-body p-4 p-md-5 position-relative">
            
            <!-- Form Section Header -->
            <div class="form-section-header">
                <div class="section-icon section-icon-edit">
                    <i class="ph ph-receipt"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 section-title">Update Invoice Information</h5>
                    <p class="text-muted mb-0 section-subtitle">Modify the details below and save your changes</p>
                </div>
                <!-- Edit Badge -->
                <div class="edit-badge ms-auto">
                    <i class="ph ph-pulse"></i>
                    Editing Mode
                </div>
            </div>

            <form action="{{ route('purchases.update', $purchase->id) }}" method="POST" class="purchase-form">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <!-- Supplier -->
                    <div class="col-md-6">
                        <label class="form-label-premium">
                            Supplier <span class="required-star">*</span>
                        </label>
                        <div class="input-group-premium">
                            <span class="input-icon">
                                <i class="ph ph-truck"></i>
                            </span>
                            <select name="supplier_id" class="form-select-premium" required>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $purchase->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }} {{ $supplier->phone ? '(' . $supplier->phone . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Purchase Date -->
                    <div class="col-md-6">
                        <label class="form-label-premium">
                            Purchase Date <span class="required-star">*</span>
                        </label>
                        <div class="input-group-premium">
                            <span class="input-icon">
                                <i class="ph ph-calendar"></i>
                            </span>
                            <input type="date" name="purchase_date" 
                                   class="form-control-premium @error('purchase_date') is-invalid @enderror" 
                                   value="{{ old('purchase_date', $purchase->purchase_date) }}" required>
                        </div>
                        @error('purchase_date')
                            <div class="field-error">
                                <i class="ph ph-warning-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <label class="form-label-premium">
                            <i class="ph ph-note-pencil me-1" style="text-transform: none; letter-spacing: 0;"></i>
                            Notes
                        </label>
                        <div class="input-group-premium input-group-premium-textarea">
                            <textarea name="notes" class="form-control-premium" rows="3" placeholder="Optional notes about this purchase...">{{ old('notes', $purchase->notes) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Read-Only Items Section -->
                <div class="readonly-section">
                    <div class="readonly-header">
                        <div class="readonly-header-left">
                            <i class="ph ph-lock-simple"></i>
                            <span>Current Items (Read Only)</span>
                        </div>
                        <span class="readonly-badge">
                            {{ $purchase->items->count() }} item{{ $purchase->items->count() !== 1 ? 's' : '' }}
                        </span>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table premium-table-readonly align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Product</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="pe-4 text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchase->items as $item)
                                <tr class="readonly-row">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="item-icon">
                                                <i class="ph ph-package"></i>
                                            </div>
                                            <div class="item-info">
                                                <span class="item-name">{{ $item->product->name ?? 'N/A' }}</span>
                                                <span class="item-plate">{{ $item->product->plate_number ?? '' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="qty-badge">×{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="unit-price">${{ number_format($item->unit_price, 2) }}</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <span class="subtotal-value">${{ number_format($item->subtotal, 2) }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="empty-items">
                                            <i class="ph ph-package"></i>
                                            <p>No items in this invoice</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="total-footer-row">
                                    <td colspan="3" class="text-end fw-bold total-footer-label">
                                        <i class="ph ph-receipt me-1"></i>
                                        GRAND TOTAL
                                    </td>
                                    <td class="pe-4 text-end">
                                        <span class="total-footer-value">${{ number_format($purchase->total_amount, 2) }}</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('purchases.index') }}" class="btn btn-cancel">
                        <i class="ph ph-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-update">
                        <i class="ph ph-floppy-disk me-1"></i> Update Invoice
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============ PREMIUM EDIT INVOICE STYLES ============ -->
<style>
    /* --- THEME VARIABLES --- */
    :root {
        --primary-electric: #3B82F6;
        --primary-deep: #2563EB;
        --accent-mint: #10B981;
        --accent-mint-light: #D1FAE5;
        --warm-amber: #F59E0B;
        --warm-amber-deep: #D97706;
        --rose-red: #EF4444;
        --text-dark: #0F172A;
        --text-soft: #475569;
        --text-muted: #94A3B8;
        --surface-card: #FFFFFF;
        --border-light: #E2E8F0;
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        --transition-smooth: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* --- PAGE HEADER --- */
    .page-title {
        color: var(--text-dark);
        font-size: 1.75rem;
        letter-spacing: -0.5px;
        position: relative;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, var(--warm-amber), var(--primary-electric));
        border-radius: 10px;
        transition: width 0.4s ease;
    }

    .page-header:hover .page-title::after {
        width: 100%;
    }

    .page-subtitle {
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 4px;
    }

    .page-subtitle i {
        color: var(--warm-amber);
    }

    .invoice-highlight {
        color: var(--primary-electric);
        font-weight: 800;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        padding: 2px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-family: 'SF Mono', Monaco, Consolas, monospace;
        letter-spacing: 0.5px;
    }

    /* --- BACK BUTTON --- */
    .btn-back {
        background: white;
        border: 1px solid var(--border-light);
        color: var(--text-dark);
        border-radius: 12px;
        padding: 11px 22px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .btn-back::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.08), transparent);
        transition: left 0.5s ease;
    }

    .btn-back:hover::before { left: 100%; }

    .btn-back:hover {
        background: white;
        color: var(--primary-electric);
        border-color: var(--primary-electric);
        transform: translateX(-4px);
        box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.4);
    }

    .btn-back i { transition: var(--transition-bounce); }
    .btn-back:hover i { transform: translateX(-3px); }

    /* --- ERROR ALERT --- */
    .alert-error-premium {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 16px;
        color: #991B1B;
        padding: 18px 20px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        box-shadow: 0 4px 20px -4px rgba(239, 68, 68, 0.15);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .alert-error-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--rose-red);
        border-radius: 4px 0 0 4px;
    }

    .alert-icon-wrapper {
        width: 40px;
        height: 40px;
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(239, 68, 68, 0.15);
        border-radius: 12px;
        font-size: 1.4rem;
        color: var(--rose-red);
        animation: alertShake 0.5s ease-in-out;
    }

    @keyframes alertShake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-4px); }
        75% { transform: translateX(4px); }
    }

    .alert-content { flex: 1; }
    .alert-content strong { display: block; margin-bottom: 4px; font-size: 0.95rem; }
    .alert-content ul { padding-left: 18px; font-size: 0.875rem; }
    .alert-content li { margin-bottom: 2px; }

    /* --- INFO ALERT (Amber) --- */
    .alert-info-premium {
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
        border: 1px solid rgba(245, 158, 11, 0.2);
        border-radius: 16px;
        color: #92400E;
        padding: 18px 20px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        box-shadow: 0 4px 20px -4px rgba(245, 158, 11, 0.15);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .alert-info-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--warm-amber);
        border-radius: 4px 0 0 4px;
    }

    .alert-icon-wrapper-info {
        width: 40px;
        height: 40px;
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(245, 158, 11, 0.15);
        border-radius: 12px;
        font-size: 1.4rem;
        color: var(--warm-amber-deep);
        animation: infoPulse 2.5s ease-in-out infinite;
    }

    @keyframes infoPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.3); }
        50% { transform: scale(1.05); box-shadow: 0 0 0 8px rgba(245, 158, 11, 0); }
    }

    .alert-content-info {
        flex: 1;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .alert-content-info strong {
        color: var(--warm-amber-deep);
    }

    /* --- FORM CARD --- */
    .form-card {
        background: var(--surface-card);
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08);
        transition: var(--transition-smooth);
    }

    .form-card:hover {
        box-shadow: 0 20px 60px -16px rgba(245, 158, 11, 0.15);
        border-color: rgba(245, 158, 11, 0.15);
    }

    /* Animated top gradient border — amber themed for edit */
    .form-card-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--warm-amber), var(--primary-electric), var(--warm-amber));
        background-size: 200% 100%;
        animation: gradientShiftEdit 4s ease infinite;
    }

    @keyframes gradientShiftEdit {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Decorative floating shapes */
    .form-shape {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        opacity: 0.5;
    }

    .form-shape-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -100px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.06) 0%, transparent 70%);
        animation: floatShape 10s ease-in-out infinite;
    }

    .form-shape-2 {
        width: 250px;
        height: 250px;
        bottom: -120px;
        left: -80px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 70%);
        animation: floatShape 12s ease-in-out infinite reverse;
    }

    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(20px, -20px) scale(1.08); }
    }

    /* --- FORM SECTION HEADER --- */
    .form-section-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 24px;
        margin-bottom: 32px;
        border-bottom: 1px solid var(--border-light);
        position: relative;
        flex-wrap: wrap;
    }

    .form-section-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, var(--warm-amber), var(--primary-electric));
        border-radius: 10px;
    }

    .section-icon {
        width: 56px;
        height: 56px;
        min-width: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        font-size: 1.6rem;
        transition: var(--transition-bounce);
    }

    .section-icon-edit {
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
        color: var(--warm-amber-deep);
        box-shadow: 0 8px 20px -8px rgba(245, 158, 11, 0.5);
    }

    .form-card:hover .section-icon {
        transform: rotate(-8deg) scale(1.05);
    }

    .section-title {
        color: var(--text-dark);
        font-size: 1.15rem;
        letter-spacing: -0.3px;
    }

    .section-subtitle {
        font-size: 0.85rem;
    }

    /* --- EDIT BADGE --- */
    .edit-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
        color: var(--warm-amber-deep);
        font-size: 0.75rem;
        font-weight: 700;
        padding: 8px 14px;
        border-radius: 20px;
        border: 1px solid rgba(245, 158, 11, 0.2);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        transition: var(--transition-bounce);
    }

    .edit-badge i {
        font-size: 0.9rem;
        animation: pulseBadge 2s ease-in-out infinite;
    }

    @keyframes pulseBadge {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    .form-card:hover .edit-badge {
        transform: scale(1.05);
        box-shadow: 0 6px 16px -6px rgba(245, 158, 11, 0.4);
    }

    /* --- FORM LABELS --- */
    .form-label-premium {
        font-weight: 700;
        font-size: 0.78rem;
        color: var(--text-soft);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .required-star {
        color: var(--rose-red);
        font-size: 1rem;
        line-height: 1;
    }

    /* --- INPUT GROUPS --- */
    .input-group-premium {
        position: relative;
        display: flex;
        align-items: stretch;
        border-radius: 14px;
        overflow: hidden;
        border: 1.5px solid var(--border-light);
        background: #F8FAFC;
        transition: var(--transition-bounce);
    }

    .input-group-premium:focus-within {
        border-color: var(--warm-amber);
        background: white;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1), 0 8px 20px -8px rgba(245, 158, 11, 0.3);
        transform: translateY(-2px);
    }

    .input-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 18px;
        background: rgba(226, 232, 240, 0.4);
        color: var(--text-muted);
        font-size: 1.25rem;
        transition: var(--transition-bounce);
        min-width: 56px;
    }

    .input-group-premium:focus-within .input-icon {
        background: linear-gradient(135deg, var(--warm-amber), var(--warm-amber-deep));
        color: white;
    }

    .input-group-premium:focus-within .input-icon i {
        transform: scale(1.15);
    }

    .input-icon i { transition: var(--transition-bounce); }

    .form-control-premium,
    .form-select-premium {
        flex: 1;
        border: none;
        background: transparent;
        padding: 16px 20px;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        outline: none;
        font-family: inherit;
        transition: var(--transition-smooth);
        min-width: 0;
    }

    .form-select-premium {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 16px center;
        background-size: 14px;
        padding-right: 44px;
        cursor: pointer;
    }

    .form-control-premium::placeholder {
        color: #CBD5E1;
        font-weight: 500;
    }

    /* Textarea variant */
    .input-group-premium-textarea {
        align-items: flex-start;
    }

    .input-group-premium-textarea .form-control-premium {
        resize: vertical;
        min-height: 90px;
        line-height: 1.6;
        font-weight: 500;
    }

    /* --- READ-ONLY SECTION --- */
    .readonly-section {
        margin-top: 40px;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid var(--border-light);
        background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
        transition: var(--transition-smooth);
    }

    .readonly-section:hover {
        box-shadow: 0 12px 30px -10px rgba(15, 23, 42, 0.08);
    }

    .readonly-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
        border-bottom: 1px solid rgba(245, 158, 11, 0.15);
        flex-wrap: wrap;
        gap: 12px;
    }

    .readonly-header-left {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--warm-amber-deep);
    }

    .readonly-header-left i {
        font-size: 1.1rem;
    }

    .readonly-badge {
        display: inline-flex;
        align-items: center;
        background: white;
        color: var(--warm-amber-deep);
        font-weight: 700;
        font-size: 0.78rem;
        padding: 6px 14px;
        border-radius: 20px;
        border: 1px solid rgba(245, 158, 11, 0.25);
        box-shadow: 0 2px 8px -2px rgba(245, 158, 11, 0.15);
    }

    /* --- PREMIUM READ-ONLY TABLE --- */
    .premium-table-readonly {
        border-collapse: separate;
        border-spacing: 0;
        background: white;
    }

    .premium-table-readonly thead th {
        background: #F8FAFC;
        color: var(--text-muted);
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 14px 16px;
        border: none;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }

    .premium-table-readonly tbody td {
        padding: 16px;
        border: none;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .readonly-row {
        transition: var(--transition-smooth);
    }

    .readonly-row:hover {
        background: linear-gradient(90deg, rgba(245, 158, 11, 0.03) 0%, rgba(59, 130, 246, 0.02) 100%);
    }

    .item-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        color: var(--primary-electric);
        border-radius: 12px;
        font-size: 1.2rem;
        margin-right: 14px;
        transition: var(--transition-bounce);
        box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.3);
    }

    .readonly-row:hover .item-icon {
        transform: scale(1.1) rotate(-8deg);
    }

    .item-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
        min-width: 0;
    }

    .item-name {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 0.92rem;
        letter-spacing: -0.2px;
    }

    .item-plate {
        color: var(--text-muted);
        font-size: 0.72rem;
        font-family: 'SF Mono', Monaco, Consolas, monospace;
        letter-spacing: 0.5px;
    }

    .qty-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 48px;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        color: var(--primary-deep);
        font-weight: 800;
        font-size: 0.85rem;
        padding: 6px 14px;
        border-radius: 10px;
        border: 1px solid rgba(59, 130, 246, 0.15);
    }

    .unit-price {
        color: var(--text-soft);
        font-weight: 700;
        font-size: 0.92rem;
    }

    .subtotal-value {
        color: var(--accent-mint);
        font-weight: 800;
        font-size: 0.98rem;
        letter-spacing: -0.3px;
    }

    /* --- TOTAL FOOTER --- */
    .total-footer-row {
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        border-top: 2px solid rgba(59, 130, 246, 0.2);
    }

    .total-footer-row td {
        padding: 18px 16px !important;
        border: none !important;
    }

    .total-footer-label {
        color: var(--primary-deep);
        font-size: 0.8rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
    }

    .total-footer-label i {
        font-size: 1.1rem;
    }

    .total-footer-value {
        color: var(--primary-deep);
        font-weight: 800;
        font-size: 1.4rem;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
    }

    /* --- EMPTY ITEMS --- */
    .empty-items {
        text-align: center;
        color: var(--text-muted);
    }

    .empty-items i {
        font-size: 2.5rem;
        opacity: 0.4;
        display: block;
        margin-bottom: 8px;
    }

    .empty-items p {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* --- FORM ACTIONS --- */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 40px;
        padding-top: 28px;
        border-top: 1px solid var(--border-light);
        position: relative;
    }

    .form-actions::before {
        content: '';
        position: absolute;
        top: -1px;
        right: 0;
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-electric), var(--warm-amber));
        border-radius: 10px;
    }

    /* Cancel Button */
    .btn-cancel {
        background: white;
        border: 1px solid var(--border-light);
        color: var(--text-soft);
        border-radius: 12px;
        padding: 13px 28px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #F8FAFC;
        color: var(--text-dark);
        border-color: #CBD5E1;
        transform: translateY(-2px);
    }

    .btn-cancel:hover i { transform: rotate(90deg); }
    .btn-cancel i { transition: var(--transition-bounce); }

    /* Update Button — Premium Amber Gradient */
    .btn-update {
        background: linear-gradient(105deg, var(--warm-amber) 0%, var(--warm-amber-deep) 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 13px 32px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 24px -6px rgba(245, 158, 11, 0.5);
    }

    .btn-update::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-update:hover::before { left: 100%; }

    .btn-update:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 16px 32px -8px rgba(245, 158, 11, 0.6);
        color: white;
    }

    .btn-update:hover i {
        transform: rotate(-15deg) scale(1.15);
    }

    .btn-update i { transition: var(--transition-bounce); }

    /* --- ENTRANCE ANIMATIONS --- */
    .fade-in-up {
        animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-header { animation-delay: 0.05s; }
    .alert-error-premium { animation-delay: 0.1s; }
    .alert-info-premium { animation-delay: 0.15s; }
    .form-card { animation-delay: 0.2s; }

    /* Staggered row animations */
    .readonly-row {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .readonly-row:nth-child(1) { animation-delay: 0.4s; }
    .readonly-row:nth-child(2) { animation-delay: 0.45s; }
    .readonly-row:nth-child(3) { animation-delay: 0.50s; }
    .readonly-row:nth-child(4) { animation-delay: 0.55s; }
    .readonly-row:nth-child(5) { animation-delay: 0.60s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-back { width: 100%; justify-content: center; }
        .form-section-header { flex-direction: column; align-items: flex-start; }
        .edit-badge { margin-left: 0 !important; }
        .form-actions { flex-direction: column-reverse; }
        .btn-cancel, .btn-update { width: 100%; justify-content: center; }
        .input-icon { padding: 0 14px; min-width: 48px; }
        .form-control-premium, .form-select-premium { padding: 14px 16px; font-size: 0.95rem; }
        .premium-table-readonly thead th,
        .premium-table-readonly tbody td { padding: 12px 8px; font-size: 0.85rem; }
        .total-footer-value { font-size: 1.15rem; }
    }

    /* --- FOCUS VISIBLE ACCESSIBILITY --- */
    .form-control-premium:focus-visible,
    .form-select-premium:focus-visible,
    .btn-update:focus-visible,
    .btn-cancel:focus-visible,
    .btn-back:focus-visible {
        outline: 2px solid var(--warm-amber);
        outline-offset: 2px;
    }
</style>

<!-- Form Interaction Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add subtle stagger animation to form fields
        const formFields = document.querySelectorAll('.col-md-6, .col-md-12');
        formFields.forEach((field, index) => {
            field.style.opacity = '0';
            field.style.animation = `fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) ${0.3 + index * 0.08}s forwards`;
        });

        // Auto-dismiss error alert after 8 seconds
        const errorAlert = document.querySelector('.alert-error-premium');
        if (errorAlert) {
            setTimeout(() => {
                errorAlert.style.transition = 'all 0.5s ease';
                errorAlert.style.opacity = '0';
                errorAlert.style.transform = 'translateY(-10px)';
                setTimeout(() => errorAlert.remove(), 500);
            }, 8000);
        }

        // Form submit — show loading state on update button
        const form = document.querySelector('.purchase-form');
        const updateBtn = document.querySelector('.btn-update');
        
        if (form && updateBtn) {
            form.addEventListener('submit', function() {
                updateBtn.innerHTML = '<i class="ph ph-circle-notch me-1 spinner-icon"></i> Updating...';
                updateBtn.style.pointerEvents = 'none';
                updateBtn.style.opacity = '0.85';
            });
        }

        // Highlight changed fields (visual diff indicator)
        const originalValues = {
            supplier_id: "{{ $purchase->supplier_id }}",
            purchase_date: "{{ $purchase->purchase_date }}",
            notes: "{{ $purchase->notes }}"
        };

        const fieldMapping = ['supplier_id', 'purchase_date', 'notes'];

        fieldMapping.forEach(fieldName => {
            const input = document.querySelector(`[name="${fieldName}"]`);
            if (!input) return;

            const eventType = input.tagName === 'SELECT' ? 'change' : 'input';
            
            input.addEventListener(eventType, function() {
                const parent = this.closest('.input-group-premium');
                if (!parent) return;
                
                const original = String(originalValues[fieldName] || '');
                const current = String(this.value || '');
                
                if (current !== original && current.trim() !== '') {
                    parent.classList.add('field-changed');
                } else {
                    parent.classList.remove('field-changed');
                }
            });
        });
    });
</script>

<style>
    /* Spinner animation for update button */
    .spinner-icon {
        display: inline-block;
        animation: spin 0.8s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Changed field indicator — subtle amber dot */
    .input-group-premium.field-changed {
        border-color: rgba(245, 158, 11, 0.5);
        background: linear-gradient(135deg, #FFFDF5 0%, #FFFBEB 100%);
    }

    .input-group-premium.field-changed::after {
        content: '';
        position: absolute;
        top: 8px;
        right: 12px;
        width: 8px;
        height: 8px;
        background: var(--warm-amber);
        border-radius: 50%;
        box-shadow: 0 0 8px var(--warm-amber);
        animation: pulseChanged 1.5s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes pulseChanged {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.3); }
    }
</style>
@endsection
