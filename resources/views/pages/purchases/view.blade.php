@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 invoice-view-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Invoice Details</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-truck me-1"></i>
                Invoice <strong class="invoice-highlight">#{{ $purchase->invoice_number }}</strong>
            </p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-print-action no-print">
                <i class="ph ph-printer me-1"></i> Print
            </button>
            <a href="{{ route('purchases.index') }}" class="btn btn-back no-print">
                <i class="ph ph-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <!-- Main Details Card — Premium -->
    <div class="details-card fade-in-up" id="printableInvoice">
        
        <!-- Hero Header (Azure → Mint Gradient) -->
        <div class="hero-header">
            <!-- Animated Background Shapes -->
            <div class="hero-shape hero-shape-1"></div>
            <div class="hero-shape hero-shape-2"></div>
            <div class="hero-shape hero-shape-3"></div>
            
            <div class="hero-content">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <!-- Left: Invoice Info -->
                    <div class="d-flex align-items-center">
                        <div class="hero-icon-box">
                            <i class="ph ph-receipt"></i>
                        </div>
                        <div class="hero-text">
                            <span class="hero-badge">
                                <i class="ph ph-check-circle-fill"></i>
                                Purchase Invoice
                            </span>
                            <h2 class="hero-title">Invoice #{{ $purchase->invoice_number }}</h2>
                            <p class="hero-subtitle">
                                <i class="ph ph-calendar"></i>
                                <span class="hero-date">{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M, Y') }}</span>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Right: Total Amount -->
                    <div class="hero-total">
                        <span class="hero-total-label">TOTAL AMOUNT</span>
                        <h1 class="hero-total-value">${{ number_format($purchase->total_amount, 2) }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Body -->
        <div class="card-body p-4 p-md-5">
            
            <!-- Supplier & Notes Info Section -->
            <div class="row g-4 mb-5">
                <!-- Supplier Info -->
                <div class="col-md-6">
                    <div class="info-section-label">
                        <i class="ph ph-truck"></i>
                        Supplier Information
                    </div>
                    <div class="supplier-info-card">
                        <div class="supplier-avatar">
                            <i class="ph ph-truck"></i>
                        </div>
                        <div class="supplier-details">
                            <span class="supplier-name-main">{{ $purchase->supplier->name ?? 'N/A' }}</span>
                            @if($purchase->supplier->phone)
                                <span class="supplier-meta">
                                    <i class="ph ph-phone"></i>
                                    {{ $purchase->supplier->phone }}
                                </span>
                            @endif
                            @if($purchase->supplier->email)
                                <span class="supplier-meta">
                                    <i class="ph ph-envelope"></i>
                                    {{ $purchase->supplier->email }}
                                </span>
                            @endif
                            @if($purchase->supplier->address)
                                <span class="supplier-meta">
                                    <i class="ph ph-map-pin"></i>
                                    {{ $purchase->supplier->address }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                @if($purchase->notes)
                <div class="col-md-6">
                    <div class="info-section-label">
                        <i class="ph ph-note-pencil"></i>
                        Notes
                    </div>
                    <div class="notes-card">
                        <i class="ph ph-quotes"></i>
                        <p class="notes-text">{{ $purchase->notes }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Items Section Header -->
            <div class="items-section-header">
                <div class="items-header-icon">
                    <i class="ph ph-package"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 items-header-title">Items Purchased</h5>
                    <p class="text-muted mb-0 items-header-subtitle">
                        {{ $purchase->items->count() }} item{{ $purchase->items->count() !== 1 ? 's' : '' }} in this invoice
                    </p>
                </div>
                <span class="items-count-badge ms-auto">
                    {{ $purchase->items->count() }}
                </span>
            </div>

            <!-- Items Table -->
            <div class="table-responsive">
                <table class="table premium-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Product</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Unit Price</th>
                            <th class="pe-4 text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchase->items as $item)
                        <tr class="item-row">
                            <td class="ps-4">
                                <span class="row-number">{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="item-icon">
                                        <i class="ph ph-package"></i>
                                    </div>
                                    <div class="item-info">
                                        <span class="item-name">{{ $item->product->name ?? 'Deleted Product' }}</span>
                                        <span class="item-plate">
                                            <i class="ph ph-barcode"></i>
                                            {{ $item->product->plate_number ?? 'N/A' }}
                                        </span>
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
                            <td colspan="5" class="text-center py-5">
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
                            <td colspan="4" class="text-end fw-bold total-footer-label">
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

            <!-- Footer Signature (Subtle) -->
            <div class="invoice-footer">
                <div class="invoice-footer-left">
                    <i class="ph ph-check-circle-fill"></i>
                    <span>Generated on {{ now()->format('d M, Y \a\t h:i A') }}</span>
                </div>
                <div class="invoice-footer-right">
                    <span>Purchase Invoice — Official Record</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============ PREMIUM INVOICE VIEW STYLES ============ -->
<style>
    /* --- THEME VARIABLES --- */
    :root {
        --primary-electric: #3B82F6;
        --primary-deep: #2563EB;
        --accent-mint: #10B981;
        --accent-mint-light: #D1FAE5;
        --warm-amber: #F59E0B;
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
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
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
        color: var(--primary-electric);
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

    /* --- HEADER BUTTONS --- */
    .btn-print-action {
        background: linear-gradient(105deg, var(--accent-mint) 0%, #059669 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 11px 22px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 20px -6px rgba(16, 185, 129, 0.5);
    }

    .btn-print-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-print-action:hover::before { left: 100%; }

    .btn-print-action:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 30px -8px rgba(16, 185, 129, 0.6);
        color: white;
    }

    .btn-print-action i { transition: var(--transition-bounce); }
    .btn-print-action:hover i { transform: scale(1.15) rotate(-8deg); }

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

    /* --- DETAILS CARD --- */
    .details-card {
        background: var(--surface-card);
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08);
        transition: var(--transition-smooth);
    }

    .details-card:hover {
        box-shadow: 0 20px 60px -16px rgba(59, 130, 246, 0.12);
        border-color: rgba(59, 130, 246, 0.15);
    }

    /* --- HERO HEADER --- */
    .hero-header {
        background: linear-gradient(135deg, var(--primary-electric) 0%, var(--primary-deep) 45%, var(--accent-mint) 100%);
        padding: 40px 45px;
        position: relative;
        overflow: hidden;
        border-radius: 24px 24px 0 0;
    }

    /* Shine sweep */
    .hero-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.12), transparent);
        animation: shineSweep 5s ease-in-out infinite;
    }

    @keyframes shineSweep {
        0%, 100% { left: -100%; }
        50% { left: 100%; }
    }

    /* Floating shapes */
    .hero-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        pointer-events: none;
    }

    .hero-shape-1 {
        width: 300px;
        height: 300px;
        top: -120px;
        right: -80px;
        animation: floatShape 9s ease-in-out infinite;
    }

    .hero-shape-2 {
        width: 180px;
        height: 180px;
        bottom: -70px;
        right: 25%;
        background: rgba(255, 255, 255, 0.05);
        animation: floatShape 11s ease-in-out infinite reverse;
    }

    .hero-shape-3 {
        width: 120px;
        height: 120px;
        top: 30%;
        left: 15%;
        background: rgba(255, 255, 255, 0.04);
        animation: floatShape 13s ease-in-out infinite;
    }

    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-15px, 15px) scale(1.08); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-icon-box {
        width: 88px;
        height: 88px;
        min-width: 88px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        font-size: 2.6rem;
        color: var(--primary-electric);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
        transition: var(--transition-bounce);
        position: relative;
        margin-right: 28px;
    }

    .hero-icon-box::before {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.15);
        z-index: -1;
        animation: iconPulse 2.5s ease-in-out infinite;
    }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.08); opacity: 0.3; }
    }

    .details-card:hover .hero-icon-box {
        transform: rotate(-6deg) scale(1.05);
    }

    .hero-text {
        flex: 1;
        min-width: 0;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: white;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .hero-badge i {
        font-size: 0.9rem;
        color: var(--accent-mint-light);
    }

    .hero-title {
        color: white;
        font-weight: 800;
        font-size: 2rem;
        letter-spacing: -1px;
        margin-bottom: 8px;
        line-height: 1.15;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'SF Mono', Monaco, Consolas, monospace;
    }

    .hero-subtitle {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 0;
    }

    .hero-subtitle i {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .hero-date {
        background: rgba(255, 255, 255, 0.15);
        padding: 3px 12px;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Hero Total Amount */
    .hero-total {
        text-align: right;
        padding-left: 20px;
    }

    .hero-total-label {
        display: block;
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .hero-total-value {
        color: white;
        font-weight: 800;
        font-size: 2.5rem;
        letter-spacing: -1.5px;
        margin: 0;
        line-height: 1;
        text-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
        transition: var(--transition-bounce);
    }

    .details-card:hover .hero-total-value {
        transform: scale(1.03);
    }

    /* --- INFO SECTION LABELS --- */
    .info-section-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-muted);
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 14px;
    }

    .info-section-label i {
        color: var(--accent-mint);
        font-size: 1rem;
    }

    /* --- SUPPLIER INFO CARD --- */
    .supplier-info-card {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 20px 22px;
        background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
        border-radius: 16px;
        border: 1px solid #F1F5F9;
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: var(--transition-bounce);
    }

    .supplier-info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, var(--accent-mint), var(--primary-electric));
        opacity: 0.6;
    }

    .supplier-info-card:hover {
        background: white;
        box-shadow: 0 12px 30px -10px rgba(16, 185, 129, 0.15);
        transform: translateY(-3px);
        border-color: rgba(16, 185, 129, 0.15);
    }

    .supplier-avatar {
        width: 54px;
        height: 54px;
        min-width: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        border-radius: 14px;
        font-size: 1.5rem;
        color: var(--accent-mint);
        box-shadow: 0 6px 16px -6px rgba(16, 185, 129, 0.35);
        transition: var(--transition-bounce);
    }

    .supplier-info-card:hover .supplier-avatar {
        transform: scale(1.08) rotate(-6deg);
    }

    .supplier-details {
        display: flex;
        flex-direction: column;
        gap: 5px;
        min-width: 0;
        flex: 1;
    }

    .supplier-name-main {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.05rem;
        letter-spacing: -0.3px;
        margin-bottom: 4px;
    }

    .supplier-meta {
        display: flex;
        align-items: center;
        gap: 7px;
        color: var(--text-soft);
        font-size: 0.85rem;
        font-weight: 500;
        word-break: break-word;
    }

    .supplier-meta i {
        color: var(--text-muted);
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    /* --- NOTES CARD --- */
    .notes-card {
        position: relative;
        padding: 22px 24px 22px 54px;
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
        border-radius: 16px;
        border: 1px solid rgba(245, 158, 11, 0.15);
        height: 100%;
        transition: var(--transition-bounce);
    }

    .notes-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px -10px rgba(245, 158, 11, 0.2);
    }

    .notes-card > i {
        position: absolute;
        top: 20px;
        left: 20px;
        color: var(--warm-amber);
        font-size: 1.4rem;
        opacity: 0.7;
    }

    .notes-text {
        color: #78350F;
        font-size: 0.92rem;
        line-height: 1.7;
        margin: 0;
        font-weight: 500;
        word-break: break-word;
    }

    /* --- ITEMS SECTION HEADER --- */
    .items-section-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 20px;
        margin-bottom: 8px;
        border-bottom: 1px solid var(--border-light);
        position: relative;
        flex-wrap: wrap;
    }

    .items-section-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
        border-radius: 10px;
    }

    .items-header-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        border-radius: 14px;
        font-size: 1.5rem;
        color: var(--primary-electric);
        box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.4);
        transition: var(--transition-bounce);
    }

    .details-card:hover .items-header-icon {
        transform: rotate(-8deg) scale(1.05);
    }

    .items-header-title {
        color: var(--text-dark);
        font-size: 1.1rem;
        letter-spacing: -0.3px;
    }

    .items-header-subtitle {
        font-size: 0.85rem;
    }

    .items-count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        padding: 6px 16px;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        color: var(--primary-deep);
        font-weight: 800;
        font-size: 0.9rem;
        border-radius: 12px;
        border: 1px solid rgba(59, 130, 246, 0.15);
        box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.25);
    }

    /* --- PREMIUM TABLE --- */
    .premium-table {
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 16px;
    }

    .premium-table thead th {
        background: #F8FAFC;
        color: var(--text-muted);
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 16px;
        border: none;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }

    .premium-table thead th:first-child { padding-left: 20px; }
    .premium-table thead th:last-child { padding-right: 20px; }

    .premium-table tbody td {
        padding: 18px 16px;
        border: none;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .premium-table tbody td:first-child { padding-left: 20px; }
    .premium-table tbody td:last-child { padding-right: 20px; }

    /* Row Hover Effect */
    .item-row {
        transition: var(--transition-smooth);
    }

    .item-row:hover {
        background: linear-gradient(90deg, rgba(59, 130, 246, 0.03) 0%, rgba(16, 185, 129, 0.02) 100%);
    }

    /* Row number */
    .row-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: #F1F5F9;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-soft);
        transition: var(--transition-bounce);
    }

    .item-row:hover .row-number {
        background: linear-gradient(135deg, var(--primary-electric), var(--primary-deep));
        color: white;
        transform: scale(1.1);
    }

    /* Item Icon */
    .item-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: var(--accent-mint);
        border-radius: 12px;
        font-size: 1.2rem;
        margin-right: 14px;
        transition: var(--transition-bounce);
        box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3);
    }

    .item-row:hover .item-icon {
        transform: scale(1.1) rotate(-8deg);
    }

    .item-info {
        display: flex;
        flex-direction: column;
        gap: 3px;
        min-width: 0;
    }

    .item-name {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 0.94rem;
        letter-spacing: -0.2px;
    }

    .item-plate {
        display: flex;
        align-items: center;
        gap: 5px;
        color: var(--text-muted);
        font-size: 0.72rem;
        font-family: 'SF Mono', Monaco, Consolas, monospace;
        letter-spacing: 0.5px;
    }

    .item-plate i {
        font-size: 0.85rem;
    }

    /* Quantity Badge */
    .qty-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 52px;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        color: var(--primary-deep);
        font-weight: 800;
        font-size: 0.85rem;
        padding: 6px 14px;
        border-radius: 10px;
        border: 1px solid rgba(59, 130, 246, 0.15);
        transition: var(--transition-bounce);
    }

    .item-row:hover .qty-badge {
        transform: scale(1.08);
        box-shadow: 0 6px 16px -6px rgba(59, 130, 246, 0.35);
    }

    /* Unit Price */
    .unit-price {
        color: var(--text-soft);
        font-weight: 700;
        font-size: 0.92rem;
    }

    /* Subtotal */
    .subtotal-value {
        color: var(--accent-mint);
        font-weight: 800;
        font-size: 1rem;
        letter-spacing: -0.3px;
        transition: var(--transition-smooth);
    }

    .item-row:hover .subtotal-value {
        color: #059669;
        transform: scale(1.05);
        display: inline-block;
    }

    /* --- TOTAL FOOTER --- */
    .total-footer-row {
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        border-top: 2px solid rgba(59, 130, 246, 0.2);
    }

    .total-footer-row td {
        padding: 22px 16px !important;
        border: none !important;
    }

    .total-footer-label {
        color: var(--primary-deep);
        font-size: 0.85rem;
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
        font-size: 1.6rem;
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

    /* --- INVOICE FOOTER --- */
    .invoice-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px dashed var(--border-light);
        flex-wrap: wrap;
        gap: 12px;
    }

    .invoice-footer-left {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-muted);
        font-size: 0.8rem;
        font-weight: 500;
    }

    .invoice-footer-left i {
        color: var(--accent-mint);
        font-size: 1rem;
    }

    .invoice-footer-right {
        color: var(--text-muted);
        font-size: 0.8rem;
        font-weight: 600;
        font-style: italic;
        letter-spacing: 0.3px;
    }

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
    .details-card { animation-delay: 0.15s; }

    /* Staggered item animations */
    .item-row {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .item-row:nth-child(1) { animation-delay: 0.3s; }
    .item-row:nth-child(2) { animation-delay: 0.36s; }
    .item-row:nth-child(3) { animation-delay: 0.42s; }
    .item-row:nth-child(4) { animation-delay: 0.48s; }
    .item-row:nth-child(5) { animation-delay: 0.54s; }
    .item-row:nth-child(6) { animation-delay: 0.60s; }

    /* --- PRINT STYLES --- */
    @media print {
        .no-print,
        .page-header .d-flex,
        .top-navbar,
        #sidebar,
        .btn-print-action,
        .btn-back {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .container-fluid {
            padding: 0 !important;
        }

        .details-card {
            box-shadow: none !important;
            border: none !important;
            border-radius: 0 !important;
        }

        .hero-header {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            border-radius: 0 !important;
        }

        .hero-shape,
        .hero-header::after {
            display: none !important;
        }

        .fade-in-up,
        .item-row {
            animation: none !important;
            opacity: 1 !important;
        }

        .item-row:hover,
        .supplier-info-card:hover,
        .notes-card:hover,
        .details-card:hover {
            transform: none !important;
            box-shadow: none !important;
        }
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .page-header .d-flex { width: 100%; }
        .btn-print-action, .btn-back { flex: 1; justify-content: center; }
        
        .hero-header { padding: 28px 24px; }
        .hero-icon-box {
            width: 68px;
            height: 68px;
            min-width: 68px;
            font-size: 2rem;
            margin-right: 18px;
        }
        .hero-title { font-size: 1.4rem; }
        .hero-subtitle { font-size: 0.85rem; flex-wrap: wrap; }
        .hero-total {
            text-align: left;
            padding-left: 0;
            margin-top: 20px;
            width: 100%;
        }
        .hero-total-value { font-size: 1.8rem; }
        
        .supplier-info-card { padding: 16px 18px; }
        .supplier-avatar { width: 48px; height: 48px; min-width: 48px; font-size: 1.3rem; }
        .notes-card { padding: 18px 20px 18px 48px; }
        
        .premium-table thead th,
        .premium-table tbody td { padding: 12px 8px; font-size: 0.85rem; }
        .total-footer-value { font-size: 1.25rem; }
        
        .invoice-footer { flex-direction: column; align-items: flex-start; }
    }

    @media (max-width: 480px) {
        .hero-badge { font-size: 0.65rem; padding: 5px 10px; }
        .hero-title { font-size: 1.2rem; }
        .hero-total-value { font-size: 1.5rem; }
    }
</style>

<!-- View Interaction Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add subtle parallax effect to hero shapes on mouse move
        const heroHeader = document.querySelector('.hero-header');
        const heroShapes = document.querySelectorAll('.hero-shape');
        
        if (heroHeader && heroShapes.length) {
            heroHeader.addEventListener('mousemove', function(e) {
                const rect = heroHeader.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                
                heroShapes.forEach((shape, index) => {
                    const intensity = (index + 1) * 8;
                    shape.style.transform = `translate(${x * intensity}px, ${y * intensity}px)`;
                });
            });

            heroHeader.addEventListener('mouseleave', function() {
                heroShapes.forEach(shape => {
                    shape.style.transform = '';
                });
            });
        }

        // Add copy-to-clipboard for invoice number
        const invoiceTitle = document.querySelector('.hero-title');
        if (invoiceTitle) {
            invoiceTitle.style.cursor = 'pointer';
            invoiceTitle.title = 'Click to copy invoice number';
            
            invoiceTitle.addEventListener('click', function() {
                const text = this.textContent.trim();
                navigator.clipboard.writeText(text).then(() => {
                    const original = this.textContent;
                    this.textContent = '✓ Copied!';
                    setTimeout(() => {
                        this.textContent = original;
                    }, 1200);
                });
            });
        }
    });
</script>
@endsection
