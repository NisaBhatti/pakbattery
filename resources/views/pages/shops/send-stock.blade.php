@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 send-stock-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Send Stock</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-paper-plane-tilt me-1"></i>
                Transfer batteries between your shops.
            </p>
        </div>
        <a href="{{ route('shops.create-transfer') }}" class="btn btn-primary-gradient fw-bold">
            <i class="ph ph-plus-circle me-1"></i> New Transfer
        </a>
    </div>

    <!-- Success Alert — Animated -->
    @if(session('success'))
        <div class="alert alert-success-premium fade-in-up" role="alert">
            <div class="alert-icon-wrapper">
                <i class="ph-fill ph-check-circle"></i>
            </div>
            <div class="alert-content">
                <strong>Success!</strong>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Alert — Animated -->
    @if(session('error'))
        <div class="alert alert-error-premium fade-in-up" role="alert">
            <div class="alert-icon-wrapper-error">
                <i class="ph-fill ph-warning-circle"></i>
            </div>
            <div class="alert-content">
                <strong>Error:</strong>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Stats Cards — Premium Gradient Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Batteries -->
        <div class="col-md-4">
            <div class="gradient-stat-card gradient-stat-azure fade-in-up">
                <div class="gradient-stat-shape gradient-shape-1"></div>
                <div class="gradient-stat-shape gradient-shape-2"></div>
                <div class="gradient-stat-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-glass">
                            <i class="ph ph-battery-charging"></i>
                        </div>
                        <span class="gradient-stat-label">TOTAL BATTERIES</span>
                    </div>
                    <h2 class="gradient-stat-value" data-count="{{ $totalBatteries }}">{{ $totalBatteries }}</h2>
                    <p class="gradient-stat-subtitle">
                        <i class="ph ph-storefront me-1"></i>
                        Currently in all shops
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Transfers -->
        <div class="col-md-4">
            <div class="gradient-stat-card gradient-stat-mint fade-in-up">
                <div class="gradient-stat-shape gradient-shape-1"></div>
                <div class="gradient-stat-shape gradient-shape-2"></div>
                <div class="gradient-stat-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-glass">
                            <i class="ph ph-paper-plane-tilt"></i>
                        </div>
                        <span class="gradient-stat-label">TOTAL TRANSFERS</span>
                    </div>
                    <h2 class="gradient-stat-value" data-count="{{ $totalTransfers }}">{{ $totalTransfers }}</h2>
                    <p class="gradient-stat-subtitle">
                        <i class="ph ph-check-circle me-1"></i>
                        Stock transfers made
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Transferred Units -->
        <div class="col-md-4">
            <div class="gradient-stat-card gradient-stat-amber fade-in-up">
                <div class="gradient-stat-shape gradient-shape-1"></div>
                <div class="gradient-stat-shape gradient-shape-2"></div>
                <div class="gradient-stat-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-glass">
                            <i class="ph ph-arrows-left-right"></i>
                        </div>
                        <span class="gradient-stat-label">SENT STOCK</span>
                    </div>
                    <h2 class="gradient-stat-value" data-count="{{ $totalTransferredQty }}">{{ $totalTransferredQty }}</h2>
                    <p class="gradient-stat-subtitle">
                        <i class="ph ph-stack me-1"></i>
                        Total units transferred
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card — Premium -->
    <div class="filter-card fade-in-up mb-4">
        <div class="filter-card-border"></div>
        
        <div class="card-body p-4 p-md-5 position-relative">
            <!-- Filter Header -->
            <div class="filter-header">
                <div class="filter-header-icon">
                    <i class="ph ph-funnel"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0 filter-title">Filters</h6>
                    <p class="text-muted mb-0 filter-subtitle">Refine your transfer search results</p>
                </div>
            </div>

            <form method="GET" action="{{ route('shops.send-stock') }}">
                <div class="row g-3">
                    <!-- Search -->
                    <div class="col-lg-3 col-md-6">
                        <label class="filter-label">Search Transfer #</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon">
                                <i class="ph ph-magnifying-glass"></i>
                            </span>
                            <input type="text" name="search" 
                                   class="filter-control" 
                                   placeholder="TRF-..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <!-- From Shop -->
                    <div class="col-lg-3 col-md-6">
                        <label class="filter-label">From Shop</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon">
                                <i class="ph ph-storefront"></i>
                            </span>
                            <select name="from_shop_id" class="filter-select">
                                <option value="">All Shops</option>
                                @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}" {{ request('from_shop_id') == $shop->id ? 'selected' : '' }}>{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- To Shop -->
                    <div class="col-lg-2 col-md-6">
                        <label class="filter-label">To Shop</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon">
                                <i class="ph ph-storefront"></i>
                            </span>
                            <select name="to_shop_id" class="filter-select">
                                <option value="">All Shops</option>
                                @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}" {{ request('to_shop_id') == $shop->id ? 'selected' : '' }}>{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Date From -->
                    <div class="col-lg-2 col-md-6">
                        <label class="filter-label">Date From</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon">
                                <i class="ph ph-calendar"></i>
                            </span>
                            <input type="date" name="date_from" 
                                   class="filter-control" 
                                   value="{{ request('date_from') }}">
                        </div>
                    </div>
                    
                    <!-- Filter Actions -->
                    <div class="col-lg-2 col-md-12 d-flex align-items-end gap-2">
                        <button type="submit" class="btn-filter-apply w-100">
                            <i class="ph ph-magnifying-glass me-1"></i> Filter
                        </button>
                        <a href="{{ route('shops.send-stock') }}" class="btn-filter-reset" title="Reset Filters">
                            <i class="ph ph-x"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Transfers Table Card — Premium -->
    <div class="table-card fade-in-up">
        <div class="table-card-border"></div>
        
        <!-- Table Section Header -->
        <div class="table-section-header">
            <div class="section-icon section-icon-transfer">
                <i class="ph ph-paper-plane-tilt"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0 section-title">Transfer Log</h5>
                <p class="text-muted mb-0 section-subtitle">
                    {{ $transfers->total() ?? $transfers->count() }} transfer{{ ($transfers->total() ?? $transfers->count()) !== 1 ? 's' : '' }} recorded
                </p>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table premium-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Transfer #</th>
                            <th>From → To</th>
                            <th>Date</th>
                            <th class="text-center">Qty</th>
                            <th class="pe-4 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transfers as $transfer)
                        <tr class="transfer-row">
                            <!-- Transfer Number -->
                            <td class="ps-4">
                                <span class="transfer-number-badge">
                                    <i class="ph ph-hash"></i>
                                    {{ $transfer->transfer_number }}
                                </span>
                            </td>
                            
                            <!-- From → To -->
                            <td>
                                <div class="route-display">
                                    <span class="route-shop route-from">
                                        <i class="ph ph-storefront"></i>
                                        {{ $transfer->fromShop->name ?? 'N/A' }}
                                    </span>
                                    <span class="route-arrow">
                                        <i class="ph ph-arrow-right"></i>
                                    </span>
                                    <span class="route-shop route-to">
                                        <i class="ph ph-storefront"></i>
                                        {{ $transfer->toShop->name ?? 'N/A' }}
                                    </span>
                                </div>
                            </td>
                            
                            <!-- Date -->
                            <td>
                                <span class="date-badge">
                                    <i class="ph ph-calendar"></i>
                                    {{ \Carbon\Carbon::parse($transfer->transfer_date)->format('d M, Y') }}
                                </span>
                            </td>
                            
                            <!-- Quantity -->
                            <td class="text-center">
                                <span class="qty-badge">
                                    <i class="ph ph-stack"></i>
                                    {{ $transfer->total_quantity }}
                                </span>
                            </td>
                            
                            <!-- Action -->
                            <td class="pe-4 text-end">
                                <a href="{{ route('shops.view-transfer', $transfer->id) }}" class="btn-action btn-view" title="View">
                                    <i class="ph ph-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon-wrapper">
                                        <i class="ph ph-paper-plane-tilt"></i>
                                    </div>
                                    <h5 class="empty-title">No stock transfers yet</h5>
                                    <p class="empty-subtitle">Click "New Transfer" to move stock between shops.</p>
                                    <a href="{{ route('shops.create-transfer') }}" class="btn btn-primary-gradient mt-3">
                                        <i class="ph ph-plus-circle me-1"></i> New Transfer
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($transfers->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Showing {{ $transfers->firstItem() }} to {{ $transfers->lastItem() }} of {{ $transfers->total() }} results
                </div>
                <div class="pagination-links">
                    {{ $transfers->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- ============ PREMIUM SEND STOCK STYLES ============ -->
<style>
    /* --- THEME VARIABLES --- */
    :root {
        --primary-electric: #3B82F6;
        --primary-deep: #2563EB;
        --accent-mint: #10B981;
        --accent-mint-light: #D1FAE5;
        --violet-core: #8B5CF6;
        --violet-deep: #7C3AED;
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
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
        border-radius: 10px;
        transition: width 0.4s ease;
    }

    .page-header:hover .page-title::after { width: 100%; }

    .page-subtitle {
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .page-subtitle i { color: var(--primary-electric); }

    /* --- GRADIENT BUTTON --- */
    .btn-primary-gradient {
        background: linear-gradient(105deg, var(--primary-electric) 0%, var(--primary-deep) 100%);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        position: relative;
        overflow: hidden;
        transition: var(--transition-bounce);
        box-shadow: 0 8px 20px -6px rgba(59, 130, 246, 0.5);
        display: inline-flex;
        align-items: center;
    }

    .btn-primary-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-primary-gradient:hover::before { left: 100%; }

    .btn-primary-gradient:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 15px 30px -8px rgba(59, 130, 246, 0.6);
        color: white;
    }

    .btn-primary-gradient:hover i { transform: rotate(180deg) scale(1.2); }
    .btn-primary-gradient i { transition: var(--transition-bounce); }

    /* --- SUCCESS ALERT --- */
    .alert-success-premium {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: 16px;
        color: #065F46;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 4px 20px -4px rgba(16, 185, 129, 0.15);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .alert-success-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--accent-mint);
        border-radius: 4px 0 0 4px;
    }

    .alert-success-premium .alert-icon-wrapper {
        width: 40px;
        height: 40px;
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(16, 185, 129, 0.15);
        border-radius: 12px;
        font-size: 1.4rem;
        color: var(--accent-mint);
        animation: checkPop 0.5s ease-out;
    }

    @keyframes checkPop {
        0% { transform: scale(0); }
        60% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .alert-success-premium .alert-content { flex: 1; }
    .alert-success-premium .alert-content strong { display: block; margin-bottom: 2px; font-size: 0.95rem; }
    .alert-success-premium .alert-content span { font-size: 0.875rem; }

    /* --- ERROR ALERT --- */
    .alert-error-premium {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 16px;
        color: #991B1B;
        padding: 18px 20px;
        display: flex;
        align-items: center;
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

    .alert-error-premium .alert-icon-wrapper-error {
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

    .alert-error-premium .alert-content { flex: 1; }
    .alert-error-premium .alert-content strong { display: block; margin-bottom: 2px; font-size: 0.95rem; }
    .alert-error-premium .alert-content span { font-size: 0.875rem; }

    /* --- GRADIENT STAT CARDS --- */
    .gradient-stat-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        padding: 26px;
        color: white;
        transition: var(--transition-bounce);
        min-height: 180px;
        box-shadow: 0 12px 35px -10px rgba(59, 130, 246, 0.4);
    }

    .gradient-stat-azure {
        background: linear-gradient(135deg, var(--primary-electric) 0%, var(--primary-deep) 100%);
    }

    .gradient-stat-mint {
        background: linear-gradient(135deg, var(--accent-mint) 0%, #059669 100%);
        box-shadow: 0 12px 35px -10px rgba(16, 185, 129, 0.4);
    }

    .gradient-stat-amber {
        background: linear-gradient(135deg, var(--warm-amber) 0%, var(--warm-amber-deep) 100%);
        box-shadow: 0 12px 35px -10px rgba(245, 158, 11, 0.4);
    }

    .gradient-stat-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
    }

    .gradient-stat-mint:hover {
        box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.5);
    }

    .gradient-stat-amber:hover {
        box-shadow: 0 25px 50px -12px rgba(245, 158, 11, 0.5);
    }

    .gradient-stat-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        pointer-events: none;
    }

    .gradient-shape-1 {
        width: 200px;
        height: 200px;
        top: -100px;
        right: -50px;
        animation: floatShape 8s ease-in-out infinite;
    }

    .gradient-shape-2 {
        width: 130px;
        height: 130px;
        bottom: -60px;
        left: -30px;
        background: rgba(255, 255, 255, 0.06);
        animation: floatShape 10s ease-in-out infinite reverse;
    }

    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-15px, 15px) scale(1.08); }
    }

    .gradient-stat-content { position: relative; z-index: 2; }

    .icon-box-glass {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.6rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        transition: var(--transition-bounce);
    }

    .gradient-stat-card:hover .icon-box-glass {
        transform: scale(1.1) rotate(-8deg);
        background: rgba(255, 255, 255, 0.3);
    }

    .gradient-stat-label {
        color: rgba(255, 255, 255, 0.75);
        font-weight: 700;
        font-size: 0.72rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .gradient-stat-value {
        color: white;
        font-weight: 800;
        font-size: 2.4rem;
        letter-spacing: -1.5px;
        margin-bottom: 4px;
        line-height: 1;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: var(--transition-bounce);
    }

    .gradient-stat-card:hover .gradient-stat-value {
        transform: scale(1.03);
    }

    .gradient-stat-subtitle {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.85rem;
        font-weight: 500;
        margin: 0;
        display: flex;
        align-items: center;
    }

    /* --- FILTER CARD --- */
    .filter-card {
        background: var(--surface-card);
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08);
        transition: var(--transition-smooth);
    }

    .filter-card:hover {
        box-shadow: 0 20px 60px -16px rgba(59, 130, 246, 0.12);
        border-color: rgba(59, 130, 246, 0.15);
    }

    .filter-card-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint), var(--primary-electric));
        background-size: 200% 100%;
        animation: gradientShiftFilter 4s ease infinite;
    }

    @keyframes gradientShiftFilter {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .filter-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-bottom: 20px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--border-light);
        position: relative;
    }

    .filter-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
        border-radius: 10px;
    }

    .filter-header-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        border-radius: 13px;
        font-size: 1.35rem;
        color: var(--primary-electric);
        box-shadow: 0 6px 16px -6px rgba(59, 130, 246, 0.35);
        transition: var(--transition-bounce);
    }

    .filter-card:hover .filter-header-icon {
        transform: rotate(-8deg) scale(1.05);
    }

    .filter-title {
        color: var(--text-dark);
        font-size: 1.05rem;
        letter-spacing: -0.3px;
    }

    .filter-subtitle { font-size: 0.82rem; }

    /* --- FILTER INPUTS --- */
    .filter-label {
        display: block;
        font-weight: 700;
        font-size: 0.72rem;
        color: var(--text-soft);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
    }

    .filter-input-wrapper {
        position: relative;
        display: flex;
        align-items: stretch;
        border-radius: 12px;
        overflow: hidden;
        border: 1.5px solid var(--border-light);
        background: #F8FAFC;
        transition: var(--transition-bounce);
    }

    .filter-input-wrapper:focus-within {
        border-color: var(--primary-electric);
        background: white;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 6px 16px -6px rgba(59, 130, 246, 0.25);
        transform: translateY(-1px);
    }

    .filter-input-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 12px;
        background: rgba(226, 232, 240, 0.4);
        color: var(--text-muted);
        font-size: 1.05rem;
        transition: var(--transition-bounce);
    }

    .filter-input-wrapper:focus-within .filter-input-icon {
        background: linear-gradient(135deg, var(--primary-electric), var(--primary-deep));
        color: white;
    }

    .filter-control,
    .filter-select {
        flex: 1;
        border: none;
        background: transparent;
        padding: 11px 14px;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text-dark);
        outline: none;
        font-family: inherit;
        transition: var(--transition-smooth);
        min-width: 0;
    }

    .filter-control::placeholder {
        color: #CBD5E1;
        font-weight: 500;
    }

    .filter-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 12px;
        padding-right: 34px;
        cursor: pointer;
    }

    /* --- FILTER BUTTONS --- */
    .btn-filter-apply {
        background: linear-gradient(105deg, var(--primary-electric) 0%, var(--primary-deep) 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 11px 20px;
        font-weight: 700;
        font-size: 0.88rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 20px -6px rgba(59, 130, 246, 0.5);
        white-space: nowrap;
    }

    .btn-filter-apply::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-filter-apply:hover::before { left: 100%; }

    .btn-filter-apply:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 14px 28px -8px rgba(59, 130, 246, 0.6);
        color: white;
    }

    .btn-filter-apply i { transition: var(--transition-bounce); }
    .btn-filter-apply:hover i { transform: scale(1.15); }

    .btn-filter-reset {
        background: white;
        border: 1.5px solid var(--border-light);
        color: var(--text-soft);
        border-radius: 12px;
        padding: 11px 14px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        text-decoration: none;
        min-width: 44px;
    }

    .btn-filter-reset:hover {
        background: #FEF2F2;
        color: var(--rose-red);
        border-color: var(--rose-red);
        transform: translateY(-2px);
    }

    .btn-filter-reset:hover i { transform: rotate(90deg); }
    .btn-filter-reset i { transition: var(--transition-bounce); }

    /* --- TABLE CARD --- */
    .table-card {
        background: var(--surface-card);
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08);
        transition: var(--transition-smooth);
    }

    .table-card:hover {
        box-shadow: 0 20px 60px -16px rgba(59, 130, 246, 0.12);
        border-color: rgba(59, 130, 246, 0.15);
    }

    .table-card-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-mint), var(--primary-electric), var(--accent-mint));
        background-size: 200% 100%;
        animation: gradientShiftTable 4s ease infinite;
    }

    @keyframes gradientShiftTable {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* --- TABLE SECTION HEADER --- */
    .table-section-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 24px 28px;
        border-bottom: 1px solid var(--border-light);
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.6) 0%, rgba(255, 255, 255, 0.6) 100%);
        flex-wrap: wrap;
    }

    .section-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.5rem;
        transition: var(--transition-bounce);
    }

    .section-icon-transfer {
        background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%);
        color: var(--violet-deep);
        box-shadow: 0 8px 20px -8px rgba(139, 92, 246, 0.4);
    }

    .table-card:hover .section-icon {
        transform: rotate(-8deg) scale(1.05);
    }

    .section-title {
        color: var(--text-dark);
        font-size: 1.1rem;
        letter-spacing: -0.3px;
    }

    .section-subtitle { font-size: 0.85rem; }

    /* --- PREMIUM TABLE --- */
    .premium-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .premium-table thead th {
        background: #F8FAFC;
        color: var(--text-muted);
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 16px 20px;
        border: none;
        white-space: nowrap;
    }

    .premium-table thead th:first-child { padding-left: 28px; }
    .premium-table thead th:last-child { padding-right: 28px; }

    .premium-table tbody td {
        padding: 18px 20px;
        border: none;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .premium-table tbody td:first-child { padding-left: 28px; }
    .premium-table tbody td:last-child { padding-right: 28px; }

    /* Row Hover Effect */
    .transfer-row {
        transition: var(--transition-smooth);
        position: relative;
    }

    .transfer-row:hover {
        background: linear-gradient(90deg, rgba(139, 92, 246, 0.03) 0%, rgba(16, 185, 129, 0.02) 100%);
        transform: scale(1.002);
    }

    .transfer-row:hover td:first-child { border-radius: 12px 0 0 12px; }
    .transfer-row:hover td:last-child { border-radius: 0 12px 12px 0; }

    /* Transfer Number Badge */
    .transfer-number-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%);
        color: var(--violet-deep);
        font-weight: 800;
        font-size: 0.8rem;
        padding: 7px 14px;
        border-radius: 10px;
        border: 1px solid rgba(139, 92, 246, 0.15);
        font-family: 'SF Mono', Monaco, Consolas, monospace;
        letter-spacing: 0.5px;
        transition: var(--transition-bounce);
    }

    .transfer-number-badge i {
        font-size: 0.9rem;
        opacity: 0.7;
    }

    .transfer-row:hover .transfer-number-badge {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 18px -6px rgba(139, 92, 246, 0.35);
        border-color: rgba(139, 92, 246, 0.3);
    }

    /* Route Display */
    .route-display {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .route-shop {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 10px;
        transition: var(--transition-bounce);
        white-space: nowrap;
    }

    .route-shop i {
        font-size: 0.95rem;
    }

    .route-from {
        background: linear-gradient(135deg, #F1F5F9 0%, #E2E8F0 100%);
        color: var(--text-soft);
        border: 1px solid rgba(148, 163, 184, 0.2);
    }

    .route-to {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .route-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        border-radius: 50%;
        color: var(--primary-electric);
        font-size: 1rem;
        transition: var(--transition-bounce);
    }

    .transfer-row:hover .route-arrow {
        transform: translateX(3px) scale(1.1);
        background: linear-gradient(135deg, var(--primary-electric), var(--primary-deep));
        color: white;
    }

    .transfer-row:hover .route-from {
        background: white;
        border-color: rgba(100, 116, 139, 0.3);
        transform: translateY(-1px);
    }

    .transfer-row:hover .route-to {
        background: white;
        border-color: rgba(16, 185, 129, 0.4);
        transform: translateY(-1px);
    }

    /* Date Badge */
    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #F8FAFC;
        border: 1px solid var(--border-light);
        color: var(--text-soft);
        font-weight: 600;
        font-size: 0.82rem;
        padding: 7px 12px;
        border-radius: 10px;
        transition: var(--transition-bounce);
        white-space: nowrap;
    }

    .date-badge i {
        color: var(--text-muted);
        font-size: 0.95rem;
        transition: var(--transition-bounce);
    }

    .transfer-row:hover .date-badge {
        background: white;
        border-color: rgba(59, 130, 246, 0.3);
        color: var(--primary-electric);
        transform: translateY(-1px);
    }

    .transfer-row:hover .date-badge i { color: var(--primary-electric); }

    /* Quantity Badge */
    .qty-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        border: 1px solid rgba(16, 185, 129, 0.15);
        color: #059669;
        font-weight: 800;
        font-size: 0.85rem;
        padding: 7px 14px;
        border-radius: 10px;
        transition: var(--transition-bounce);
        white-space: nowrap;
    }

    .qty-badge i {
        font-size: 1rem;
        color: var(--accent-mint);
    }

    .transfer-row:hover .qty-badge {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 18px -6px rgba(16, 185, 129, 0.35);
    }

    /* --- ACTION BUTTONS --- */
    .btn-action {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        border: 1px solid var(--border-light);
        background: white;
        font-size: 1.1rem;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .btn-action::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-3px) scale(1.08);
    }

    .btn-action:hover::before { opacity: 1; }

    .btn-view { color: var(--violet-core); }
    .btn-view::before { background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); }
    .btn-view:hover {
        border-color: var(--violet-core);
        box-shadow: 0 8px 20px -8px rgba(139, 92, 246, 0.5);
        color: var(--violet-deep);
    }

    .btn-action i {
        position: relative;
        z-index: 1;
        transition: var(--transition-bounce);
    }

    .btn-action:hover i { transform: scale(1.15); }

    /* --- EMPTY STATE --- */
    .empty-state {
        padding: 40px 20px;
    }

    .empty-icon-wrapper {
        width: 90px;
        height: 90px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%);
        border-radius: 24px;
        font-size: 2.8rem;
        color: var(--violet-deep);
        box-shadow: 0 12px 30px -12px rgba(139, 92, 246, 0.4);
        animation: floatIcon 3s ease-in-out infinite;
    }

    @keyframes floatIcon {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-8px) rotate(5deg); }
    }

    .empty-title {
        color: var(--text-dark);
        font-weight: 700;
        margin-bottom: 8px;
    }

    .empty-subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* --- PAGINATION --- */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 28px;
        border-top: 1px solid var(--border-light);
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.4) 0%, rgba(255, 255, 255, 0.4) 100%);
        flex-wrap: wrap;
        gap: 12px;
    }

    .pagination-info {
        color: var(--text-muted);
        font-size: 0.85rem;
        font-weight: 500;
    }

    .pagination-links .pagination {
        margin: 0;
        gap: 4px;
    }

    .pagination .page-item .page-link {
        color: var(--text-soft);
        background: white;
        border: 1px solid var(--border-light);
        border-radius: 10px;
        padding: 8px 14px;
        font-weight: 600;
        font-size: 0.85rem;
        margin: 0;
        transition: var(--transition-bounce);
        min-width: 40px;
        text-align: center;
    }

    .pagination .page-item .page-link:hover {
        background: #F8FAFC;
        color: var(--primary-deep);
        border-color: var(--primary-electric);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.3);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(105deg, var(--primary-electric) 0%, var(--primary-deep) 100%);
        border-color: transparent;
        color: white;
        box-shadow: 0 6px 16px -4px rgba(59, 130, 246, 0.5);
    }

    .pagination .page-item.disabled .page-link {
        background: #F8FAFC;
        color: #CBD5E1;
        border-color: var(--border-light);
        opacity: 0.6;
    }

    /* --- ENTRANCE ANIMATIONS --- */
    .fade-in-up {
        animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header { animation-delay: 0.05s; }
    .alert-success-premium { animation-delay: 0.1s; }
    .alert-error-premium { animation-delay: 0.1s; }
    .gradient-stat-card:nth-child(1) { animation-delay: 0.15s; }
    .gradient-stat-card:nth-child(2) { animation-delay: 0.22s; }
    .gradient-stat-card:nth-child(3) { animation-delay: 0.29s; }
    .filter-card { animation-delay: 0.36s; }
    .table-card { animation-delay: 0.43s; }

    /* Staggered row animation */
    .transfer-row {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .transfer-row:nth-child(1) { animation-delay: 0.48s; }
    .transfer-row:nth-child(2) { animation-delay: 0.53s; }
    .transfer-row:nth-child(3) { animation-delay: 0.58s; }
    .transfer-row:nth-child(4) { animation-delay: 0.63s; }
    .transfer-row:nth-child(5) { animation-delay: 0.68s; }
    .transfer-row:nth-child(6) { animation-delay: 0.73s; }
    .transfer-row:nth-child(7) { animation-delay: 0.78s; }
    .transfer-row:nth-child(8) { animation-delay: 0.83s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 992px) {
        .filter-header { flex-direction: column; align-items: flex-start; }
    }

    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-primary-gradient { width: 100%; justify-content: center; }
        .gradient-stat-value { font-size: 1.9rem; }
        .gradient-stat-card { padding: 22px; min-height: 160px; }
        .premium-table thead th,
        .premium-table tbody td { padding: 14px 12px; }
        .premium-table thead th:first-child,
        .premium-table tbody td:first-child { padding-left: 16px; }
        .premium-table thead th:last-child,
        .premium-table tbody td:last-child { padding-right: 16px; }
        .route-display { flex-direction: column; align-items: flex-start; gap: 6px; }
        .route-arrow { transform: rotate(90deg); }
        .transfer-row:hover .route-arrow { transform: rotate(90deg) translateX(3px) scale(1.1); }
        .pagination-wrapper { flex-direction: column; align-items: center; }
    }
</style>

<!-- Number Count-Up Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat values counting up
        document.querySelectorAll('.gradient-stat-value').forEach(function(el) {
            const target = parseInt(el.getAttribute('data-count')) || 0;
            if (target === 0) return;
            
            let current = 0;
            const duration = 1200;
            const stepTime = 16;
            const totalSteps = duration / stepTime;
            const increment = target / totalSteps;
            
            const timer = setInterval(function() {
                current += increment;
                if (current >= target) {
                    el.textContent = target;
                    clearInterval(timer);
                } else {
                    el.textContent = Math.floor(current);
                }
            }, stepTime);
        });

        // Auto-dismiss success/error alerts
        document.querySelectorAll('.alert-success-premium, .alert-error-premium').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'all 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    });
</script>
@endsection
