@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 bill-form-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Create New Bill</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-receipt me-1"></i>
                Create a new customer bill. Stock will reduce automatically.
            </p>
        </div>
        <a href="{{ route('bills.index') }}" class="btn btn-back">
            <i class="ph ph-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <!-- Error Alerts — Animated -->
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
    @if(session('error'))
        <div class="alert alert-error-premium fade-in-up" role="alert">
            <div class="alert-icon-wrapper">
                <i class="ph-fill ph-warning-circle"></i>
            </div>
            <div class="alert-content">
                <strong>Error:</strong>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('bills.store') }}" method="POST" id="billForm">
        @csrf
        
        <!-- Top Info Card — Bill Metadata -->
        <div class="form-card fade-in-up mb-4">
            <div class="form-card-border form-card-border-azure"></div>
            <div class="card-body p-4 p-md-5 position-relative">
                
                <!-- Section Header -->
                <div class="form-section-header">
                    <div class="section-icon">
                        <i class="ph ph-receipt"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 section-title">Bill Information</h5>
                        <p class="text-muted mb-0 section-subtitle">Basic details about this bill</p>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Bill Number -->
                    <div class="col-md-4">
                        <label class="form-label-premium">Bill Number</label>
                        <div class="input-group-premium input-group-premium-readonly">
                            <span class="input-icon">
                                <i class="ph ph-receipt"></i>
                            </span>
                            <input type="text" class="form-control-premium" value="{{ $nextBill }}" readonly>
                        </div>
                    </div>

                    <!-- Customer -->
                    <div class="col-md-4">
                        <label class="form-label-premium">
                            Customer <span class="required-star">*</span>
                        </label>
                        <div class="input-group-premium">
                            <span class="input-icon">
                                <i class="ph ph-user"></i>
                            </span>
                            <select name="customer_id" class="form-select-premium" required>
                                <option value="">-- Select Customer --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} {{ $customer->phone ? '(' . $customer->phone . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Bill Date -->
                    <div class="col-md-4">
                        <label class="form-label-premium">
                            Bill Date <span class="required-star">*</span>
                        </label>
                        <div class="input-group-premium">
                            <span class="input-icon">
                                <i class="ph ph-calendar"></i>
                            </span>
                            <input type="date" name="bill_date" class="form-control-premium" value="{{ old('bill_date', date('Y-m-d')) }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Card — Products Sold -->
        <div class="form-card fade-in-up mb-4">
            <div class="form-card-border form-card-border-mint"></div>
            <div class="card-body p-4 p-md-5 position-relative">
                
                <!-- Section Header with Add Button -->
                <div class="form-section-header">
                    <div class="section-icon section-icon-mint">
                        <i class="ph ph-package"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 section-title">Products Sold</h5>
                        <p class="text-muted mb-0 section-subtitle">Add products to this bill — stock reduces on save</p>
                    </div>
                    <button type="button" class="btn btn-add-row ms-auto" id="addRowBtn">
                        <i class="ph ph-plus-circle me-1"></i> Add Product Row
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table premium-table align-middle mb-0" id="itemsTable">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 35%;">Product</th>
                                <th class="text-center" style="width: 15%;">Quantity</th>
                                <th class="text-end" style="width: 20%;">Unit Price</th>
                                <th class="text-end" style="width: 20%;">Subtotal</th>
                                <th class="pe-4 text-center" style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="itemsBody"></tbody>
                    </table>
                </div>
                
                <!-- Total Summary -->
                <div class="row mt-4">
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                        <div class="total-card">
                            <div class="total-card-shape total-shape-1"></div>
                            <div class="total-card-shape total-shape-2"></div>
                            
                            <div class="total-card-content">
                                <div class="total-row">
                                    <span class="total-label">
                                        <i class="ph ph-list-numbers"></i>
                                        Items Count
                                    </span>
                                    <span class="total-count" id="itemsCount">0</span>
                                </div>
                                <div class="total-divider"></div>
                                <div class="total-row total-row-grand">
                                    <span class="total-grand-label">GRAND TOTAL</span>
                                    <h3 class="total-grand-value" id="grandTotal">$0.00</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes Card -->
        <div class="form-card fade-in-up mb-4">
            <div class="form-card-border form-card-border-amber"></div>
            <div class="card-body p-4 p-md-5 position-relative">
                <label class="form-label-premium">
                    <i class="ph ph-note-pencil me-1" style="text-transform: none; letter-spacing: 0;"></i>
                    Notes
                </label>
                <div class="input-group-premium input-group-premium-textarea">
                    <textarea name="notes" class="form-control-premium" rows="3" placeholder="Optional notes about this bill...">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions form-actions-bill fade-in-up">
            <a href="{{ route('bills.index') }}" class="btn btn-cancel">
                <i class="ph ph-x me-1"></i> Cancel
            </a>
            <button type="submit" class="btn btn-save-bill">
                <i class="ph ph-floppy-disk me-1"></i> Save Bill & Reduce Stock
            </button>
        </div>
    </form>
</div>

<script id="productsData" type="application/json">
    {!! json_encode($products->map(function($p) {
        return [
            'id' => $p->id,
            'name' => $p->name,
            'plate_number' => $p->plate_number,
            'price' => (float) $p->price,
            'stock' => (int) $p->stock
        ];
    })) !!}
</script>

<!-- ============ PREMIUM BILL FORM STYLES ============ -->
<style>
    /* --- THEME VARIABLES --- */
    :root {
        --primary-electric: #3B82F6;
        --primary-deep: #2563EB;
        --accent-mint: #10B981;
        --accent-mint-light: #D1FAE5;
        --warm-amber: #F59E0B;
        --rose-red: #EF4444;
        --rose-magenta: #EC4899;
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
        background: linear-gradient(90deg, var(--accent-mint), var(--primary-electric));
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
    }

    .page-subtitle i {
        color: var(--accent-mint);
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
        box-shadow: 0 20px 60px -16px rgba(59, 130, 246, 0.12);
        border-color: rgba(59, 130, 246, 0.15);
    }

    /* Animated top gradient borders */
    .form-card-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background-size: 200% 100%;
    }

    .form-card-border-azure {
        background-image: linear-gradient(90deg, var(--primary-electric), var(--primary-deep), var(--primary-electric));
        animation: gradientShiftAzure 4s ease infinite;
    }

    .form-card-border-mint {
        background-image: linear-gradient(90deg, var(--accent-mint), var(--primary-electric), var(--accent-mint));
        animation: gradientShiftMint 4s ease infinite;
    }

    .form-card-border-amber {
        background-image: linear-gradient(90deg, var(--warm-amber), var(--accent-mint), var(--warm-amber));
        animation: gradientShiftAmber 4s ease infinite;
    }

    @keyframes gradientShiftAzure {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes gradientShiftMint {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes gradientShiftAmber {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* --- FORM SECTION HEADER --- */
    .form-section-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 24px;
        margin-bottom: 28px;
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
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
        border-radius: 10px;
    }

    .section-icon {
        width: 56px;
        height: 56px;
        min-width: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        border-radius: 16px;
        font-size: 1.6rem;
        color: var(--primary-electric);
        box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.4);
        transition: var(--transition-bounce);
    }

    .section-icon-mint {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: var(--accent-mint);
        box-shadow: 0 8px 20px -8px rgba(16, 185, 129, 0.4);
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

    /* --- ADD ROW BUTTON --- */
    .btn-add-row {
        background: linear-gradient(105deg, var(--accent-mint) 0%, #059669 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 11px 22px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 20px -6px rgba(16, 185, 129, 0.5);
        font-size: 0.9rem;
    }

    .btn-add-row::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-add-row:hover::before { left: 100%; }

    .btn-add-row:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 15px 30px -8px rgba(16, 185, 129, 0.6);
        color: white;
    }

    .btn-add-row:hover i {
        transform: rotate(180deg) scale(1.15);
    }

    .btn-add-row i { transition: var(--transition-bounce); }

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
        border-color: var(--primary-electric);
        background: white;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 8px 20px -8px rgba(59, 130, 246, 0.3);
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
        background: linear-gradient(135deg, var(--primary-electric), var(--primary-deep));
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

    /* Readonly styling */
    .input-group-premium-readonly {
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        border-color: rgba(59, 130, 246, 0.2);
    }

    .input-group-premium-readonly .input-icon {
        background: linear-gradient(135deg, var(--primary-electric), var(--primary-deep));
        color: white;
    }

    .input-group-premium-readonly .form-control-premium {
        color: var(--primary-deep);
        font-weight: 800;
        letter-spacing: 0.5px;
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

    /* --- PREMIUM TABLE --- */
    .premium-table {
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 8px;
    }

    .premium-table thead th {
        background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
        color: var(--text-muted);
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 14px 16px;
        border: none;
        white-space: nowrap;
        border-top: 1px solid #F1F5F9;
        border-bottom: 1px solid #F1F5F9;
    }

    .premium-table thead th:first-child {
        padding-left: 20px;
        border-top-left-radius: 12px;
        border-left: 1px solid #F1F5F9;
    }

    .premium-table thead th:last-child {
        padding-right: 20px;
        border-top-right-radius: 12px;
        border-right: 1px solid #F1F5F9;
    }

    .premium-table tbody td {
        padding: 16px;
        border: none;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    /* --- ITEM ROW --- */
    .item-row {
        animation: rowSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        transition: var(--transition-smooth);
    }

    @keyframes rowSlideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .item-row:hover {
        background: linear-gradient(90deg, rgba(16, 185, 129, 0.02) 0%, rgba(59, 130, 246, 0.02) 100%);
    }

    /* Product Select */
    .product-select {
        border: 1.5px solid var(--border-light);
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
        background: #F8FAFC;
        outline: none;
        transition: var(--transition-bounce);
        width: 100%;
        font-family: inherit;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 12px;
        padding-right: 36px;
        cursor: pointer;
    }

    .product-select:focus {
        border-color: var(--accent-mint);
        background: white;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    /* Quantity & Price Inputs */
    .quantity-input,
    .price-input {
        border: 1.5px solid var(--border-light);
        border-radius: 10px;
        padding: 10px;
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-dark);
        background: #F8FAFC;
        outline: none;
        transition: var(--transition-bounce);
        width: 100%;
        font-family: inherit;
    }

    .quantity-input:focus,
    .price-input:focus {
        border-color: var(--primary-electric);
        background: white;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Subtotal */
    .subtotal {
        display: inline-block;
        color: var(--accent-mint);
        font-size: 1.05rem;
        font-weight: 800;
        letter-spacing: -0.3px;
        transition: var(--transition-bounce);
    }

    .item-row:hover .subtotal {
        transform: scale(1.05);
    }

    /* Product Details */
    .product-details {
        display: flex;
        gap: 8px;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 6px;
        font-weight: 600;
        align-items: center;
    }

    .product-details i {
        color: var(--accent-mint);
    }

    /* Delete Row Button */
    .btn-delete-row {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        border: 1.5px solid rgba(239, 68, 68, 0.2);
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        color: var(--rose-red);
        transition: var(--transition-bounce);
        font-size: 1.15rem;
    }

    .btn-delete-row:hover {
        background: linear-gradient(105deg, var(--rose-red) 0%, #DC2626 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px) scale(1.08);
        box-shadow: 0 8px 20px -8px rgba(239, 68, 68, 0.5);
    }

    .btn-delete-row i {
        transition: var(--transition-bounce);
    }

    .btn-delete-row:hover i {
        transform: rotate(-15deg) scale(1.1);
    }

    /* --- TOTAL CARD — Premium Gradient --- */
    .total-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        padding: 24px;
        background: linear-gradient(135deg, var(--accent-mint) 0%, var(--primary-electric) 60%, var(--primary-deep) 100%);
        box-shadow: 0 20px 45px -12px rgba(16, 185, 129, 0.5);
        transition: var(--transition-bounce);
    }

    .total-card:hover {
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 25px 55px -12px rgba(16, 185, 129, 0.6);
    }

    .total-card-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        pointer-events: none;
    }

    .total-shape-1 {
        width: 220px;
        height: 220px;
        top: -100px;
        right: -60px;
        animation: floatShape 8s ease-in-out infinite;
    }

    .total-shape-2 {
        width: 140px;
        height: 140px;
        bottom: -60px;
        left: -40px;
        background: rgba(255, 255, 255, 0.06);
        animation: floatShape 10s ease-in-out infinite reverse;
    }

    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-15px, 15px) scale(1.08); }
    }

    .total-card-content {
        position: relative;
        z-index: 2;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 4px 0;
    }

    .total-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .total-label i {
        font-size: 1.05rem;
    }

    .total-count {
        color: white;
        font-weight: 800;
        font-size: 1.15rem;
        padding: 2px 14px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        transition: var(--transition-bounce);
    }

    .total-card:hover .total-count {
        background: rgba(255, 255, 255, 0.25);
        transform: scale(1.05);
    }

    .total-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.2);
        margin: 14px 0;
    }

    .total-row-grand {
        padding: 0;
    }

    .total-grand-label {
        color: white;
        font-weight: 800;
        font-size: 0.85rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .total-grand-value {
        color: white;
        font-weight: 800;
        font-size: 1.8rem;
        margin: 0;
        letter-spacing: -1px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: var(--transition-bounce);
    }

    .total-card:hover .total-grand-value {
        transform: scale(1.05);
        text-shadow: 0 6px 25px rgba(0, 0, 0, 0.25);
    }

    /* --- FORM ACTIONS --- */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-bottom: 40px;
    }

    .btn-cancel {
        background: white;
        border: 1px solid var(--border-light);
        color: var(--text-soft);
        border-radius: 12px;
        padding: 14px 28px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #F8FAFC;
        color: var(--text-dark);
        border-color: #CBD5E1;
        transform: translateY(-2px);
    }

    .btn-cancel:hover i {
        transform: rotate(90deg);
    }

    .btn-cancel i { transition: var(--transition-bounce); }

    .btn-save-bill {
        background: linear-gradient(105deg, var(--accent-mint) 0%, #059669 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 14px 36px;
        font-weight: 700;
        font-size: 1.02rem;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 28px -6px rgba(16, 185, 129, 0.55);
    }

    .btn-save-bill::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-save-bill:hover::before { left: 100%; }

    .btn-save-bill:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 18px 38px -8px rgba(16, 185, 129, 0.65);
        color: white;
    }

    .btn-save-bill:hover i {
        transform: rotate(-15deg) scale(1.15);
    }

    .btn-save-bill i { transition: var(--transition-bounce); }

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
    .form-card:nth-of-type(1) { animation-delay: 0.15s; }
    .form-card:nth-of-type(2) { animation-delay: 0.22s; }
    .form-card:nth-of-type(3) { animation-delay: 0.29s; }
    .form-actions-bill { animation-delay: 0.36s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-back { width: 100%; justify-content: center; }
        .form-section-header { flex-direction: column; align-items: flex-start; }
        .btn-add-row { margin-left: 0 !important; width: 100%; justify-content: center; }
        .form-actions { flex-direction: column-reverse; }
        .btn-cancel, .btn-save-bill { width: 100%; justify-content: center; }
        .input-icon { padding: 0 14px; min-width: 48px; }
        .form-control-premium, .form-select-premium { padding: 14px 16px; font-size: 0.95rem; }
        .premium-table thead th,
        .premium-table tbody td { padding: 12px 8px; font-size: 0.85rem; }
        .total-card { padding: 20px; }
        .total-grand-value { font-size: 1.5rem; }
    }

    /* --- FOCUS VISIBLE ACCESSIBILITY --- */
    .form-control-premium:focus-visible,
    .form-select-premium:focus-visible,
    .btn-save-bill:focus-visible,
    .btn-cancel:focus-visible,
    .btn-back:focus-visible {
        outline: 2px solid var(--primary-electric);
        outline-offset: 2px;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const products = JSON.parse(document.getElementById('productsData').textContent);
    const tbody = document.getElementById('itemsBody');
    let rowCounter = 0;

    function buildProductOptions() {
        let options = '<option value="">-- Search & Select Product --</option>';
        products.forEach(p => {
            options += `<option value="${p.id}">${p.name} (${p.plate_number}) - Stock: ${p.stock}</option>`;
        });
        return options;
    }

    function addRow() {
        rowCounter++;
        const rowId = 'row-' + rowCounter;
        const row = document.createElement('tr');
        row.className = 'item-row';
        row.id = rowId;
        
        row.innerHTML = `
            <td class="ps-4">
                <select name="items[${rowCounter}][product_id]" class="product-select" required>
                    ${buildProductOptions()}
                </select>
                <div class="product-details"></div>
            </td>
            <td class="text-center">
                <input type="number" name="items[${rowCounter}][quantity]" class="quantity-input text-center" value="1" min="1" required>
            </td>
            <td class="text-end">
                <input type="number" step="0.01" name="items[${rowCounter}][unit_price]" class="price-input text-end" value="0.00" min="0" required>
            </td>
            <td class="text-end">
                <span class="subtotal">$0.00</span>
            </td>
            <td class="text-center pe-4">
                <button type="button" class="btn-delete-row" onclick="removeRow('${rowId}')" title="Remove">
                    <i class="ph ph-trash"></i>
                </button>
            </td>
        `;
        
        tbody.appendChild(row);
        updateTotals();
    }

    window.removeRow = function(rowId) {
        const row = document.getElementById(rowId);
        if (row) {
            if (tbody.children.length <= 1) {
                alert('At least one product row is required.');
                return;
            }
            row.style.animation = 'rowSlideOut 0.3s ease forwards';
            setTimeout(() => {
                row.remove();
                updateTotals();
            }, 250);
        }
    };

    function updateTotals() {
        let grandTotal = 0;
        let itemCount = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const qty = parseFloat(row.querySelector('.quantity-input').value) || 0;
            const price = parseFloat(row.querySelector('.price-input').value) || 0;
            const subtotal = qty * price;
            row.querySelector('.subtotal').textContent = '$' + subtotal.toFixed(2);
            if (qty > 0) {
                grandTotal += subtotal;
                itemCount++;
            }
        });
        document.getElementById('grandTotal').textContent = '$' + grandTotal.toFixed(2);
        document.getElementById('itemsCount').textContent = itemCount;
    }

    tbody.addEventListener('input', function(e) {
        if (e.target.classList.contains('quantity-input') || e.target.classList.contains('price-input')) {
            updateTotals();
        }
    });

    tbody.addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select')) {
            const row = e.target.closest('.item-row');
            const productId = e.target.value;
            const priceInput = row.querySelector('.price-input');
            const detailsDiv = row.querySelector('.product-details');
            
            if (productId) {
                const product = products.find(p => p.id == productId);
                if (product) {
                    priceInput.value = product.price.toFixed(2);
                    detailsDiv.innerHTML = `<span><i class="ph ph-stack"></i> Available Stock: <strong>${product.stock}</strong></span>`;
                }
            } else {
                priceInput.value = '0.00';
                detailsDiv.innerHTML = '';
            }
            updateTotals();
        }
    });

    addRow();
    document.getElementById('addRowBtn').addEventListener('click', addRow);

    document.getElementById('billForm').addEventListener('submit', function(e) {
        const rows = document.querySelectorAll('.item-row');
        let valid = true;
        
        rows.forEach(row => {
            const productSelect = row.querySelector('.product-select');
            const qty = parseFloat(row.querySelector('.quantity-input').value) || 0;
            
            if (!productSelect.value || qty < 1) {
                valid = false;
            } else {
                const productId = productSelect.value;
                const product = products.find(p => p.id == productId);
                if (product && qty > product.stock) {
                    alert(`Not enough stock for ${product.name}. Available: ${product.stock}, Requested: ${qty}`);
                    valid = false;
                }
            }
        });
        
        if (!valid) {
            e.preventDefault();
            return false;
        }
        
        const btn = document.querySelector('.btn-save-bill');
        btn.innerHTML = '<i class="ph ph-circle-notch me-1 spinner-icon"></i> Saving Bill...';
        btn.style.pointerEvents = 'none';
        btn.style.opacity = '0.85';
        
        return confirm('Save this bill? Stock will be reduced from selected products.');
    });
});
</script>
@endpush

<style>
    /* Spinner animation */
    .spinner-icon {
        display: inline-block;
        animation: spin 0.8s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Row exit animation */
    @keyframes rowSlideOut {
        to {
            opacity: 0;
            transform: translateX(20px);
        }
    }
</style>
@endsection