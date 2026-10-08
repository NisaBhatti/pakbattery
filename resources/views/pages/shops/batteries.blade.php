@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 batteries-list-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">All Batteries Across Shops</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-battery-charging me-1"></i>
                View and filter battery stock in all your shops.
            </p>
        </div>
    </div>

    <!-- Hero Summary Banner — NEW -->
    <div class="hero-summary-card fade-in-up mb-4">
        <div class="hero-summary-border"></div>
        <div class="hero-summary-shape hero-shape-1"></div>
        <div class="hero-summary-shape hero-shape-2"></div>
        <div class="hero-summary-shape hero-shape-3"></div>
        
        <div class="hero-summary-content">
            <div class="hero-summary-left">
                <div class="hero-summary-icon">
                    <i class="ph ph-battery-charging"></i>
                </div>
                <div class="hero-summary-text">
                    <span class="hero-summary-badge">
                        <i class="ph ph-sparkle"></i>
                        Live Inventory Overview
                    </span>
                    <h2 class="hero-summary-title">Battery Stock Summary</h2>
                    <p class="hero-summary-subtitle">
                        Real-time inventory across all your shop locations
                    </p>
                </div>
            </div>
            <div class="hero-summary-stats">
                <div class="hero-summary-stat">
                    <span class="hero-summary-stat-label">UNITS</span>
                    <span class="hero-summary-stat-value" data-count="{{ $totalBatteries }}">{{ $totalBatteries }}</span>
                </div>
                <div class="hero-summary-divider"></div>
                <div class="hero-summary-stat">
                    <span class="hero-summary-stat-label">SHOPS</span>
                    <span class="hero-summary-stat-value" data-count="{{ $totalShops }}">{{ $totalShops }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards — Premium -->
    <div class="row g-4 mb-4">
        <!-- Total Batteries -->
        <div class="col-md-4">
            <div class="stat-card stat-card-primary fade-in-up">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-primary">
                            <i class="ph ph-battery-charging"></i>
                        </div>
                        <span class="badge badge-trend badge-trend-up">
                            <i class="ph ph-trend-up me-1"></i>In Stock
                        </span>
                    </div>
                    <h6 class="stat-label">Total Batteries</h6>
                    <h2 class="stat-value" data-count="{{ $totalBatteries }}">{{ $totalBatteries }}</h2>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: 85%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Shops -->
        <div class="col-md-4">
            <div class="stat-card stat-card-success fade-in-up">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-success">
                            <i class="ph ph-storefront"></i>
                        </div>
                        <span class="badge badge-trend badge-trend-up">
                            <i class="ph ph-check-circle me-1"></i>Active
                        </span>
                    </div>
                    <h6 class="stat-label">Total Shops</h6>
                    <h2 class="stat-value" data-count="{{ $totalShops }}">{{ $totalShops }}</h2>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: 70%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="col-md-4">
            <div class="stat-card stat-card-danger {{ $lowStockCount > 0 ? 'has-alert' : '' }} fade-in-up">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-danger">
                            <i class="ph ph-warning-circle"></i>
                        </div>
                        @if($lowStockCount > 0)
                            <span class="badge badge-alert">
                                <span class="alert-dot"></span> Action Needed
                            </span>
                        @endif
                    </div>
                    <h6 class="stat-label">Low Stock Alerts</h6>
                    <h2 class="stat-value" data-count="{{ $lowStockCount }}">{{ $lowStockCount }}</h2>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: {{ $lowStockCount > 0 ? '40%' : '5%' }};"></div>
                    </div>
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
                    <p class="text-muted mb-0 filter-subtitle">Refine your battery search results</p>
                </div>
                <!-- Active Filter Count Badge -->
                @php
                    $activeFilters = collect([request('search'), request('product_id'), request('stock_level')])->filter()->count();
                @endphp
                @if($activeFilters > 0)
                    <span class="active-filter-badge ms-auto">
                        <i class="ph ph-check-circle"></i>
                        {{ $activeFilters }} active
                    </span>
                @endif
            </div>

            <form method="GET" action="{{ route('shops.batteries') }}">
                <div class="row g-3">
                    <!-- Search -->
                    <div class="col-lg-4 col-md-6">
                        <label class="filter-label">Search</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon">
                                <i class="ph ph-magnifying-glass"></i>
                            </span>
                            <input type="text" name="search" 
                                   class="filter-control" 
                                   placeholder="Product name or plate..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <!-- Product -->
                    <div class="col-lg-4 col-md-6">
                        <label class="filter-label">Product</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon">
                                <i class="ph ph-package"></i>
                            </span>
                            <select name="product_id" class="filter-select">
                                <option value="">All Products</option>
                                @foreach($allProducts as $product)
                                    <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Stock Level -->
                    <div class="col-lg-2 col-md-6">
                        <label class="filter-label">Stock Level</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon">
                                <i class="ph ph-chart-bar"></i>
                            </span>
                            <select name="stock_level" class="filter-select">
                                <option value="">All Levels</option>
                                <option value="low" {{ request('stock_level') == 'low' ? 'selected' : '' }}>Low (≤ 5)</option>
                                <option value="medium" {{ request('stock_level') == 'medium' ? 'selected' : '' }}>Medium (6-20)</option>
                                <option value="high" {{ request('stock_level') == 'high' ? 'selected' : '' }}>High (> 20)</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Filter Actions -->
                    <div class="col-lg-2 col-md-12 d-flex align-items-end gap-2">
                        <button type="submit" class="btn-filter-apply w-100">
                            <i class="ph ph-magnifying-glass me-1"></i> Filter
                        </button>
                        <a href="{{ route('shops.batteries') }}" class="btn-filter-reset" title="Reset Filters">
                            <i class="ph ph-x"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Batteries Table Card — Premium -->
    <div class="table-card fade-in-up">
        <div class="table-card-border"></div>
        
        <!-- Table Section Header -->
        <div class="table-section-header">
            <div class="section-icon section-icon-battery">
                <i class="ph ph-battery-charging"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0 section-title">Battery Stock</h5>
                <p class="text-muted mb-0 section-subtitle">
                    {{ $products->total() ?? $products->count() }} product{{ ($products->total() ?? $products->count()) !== 1 ? 's' : '' }} found
                </p>
            </div>
            <!-- View Toggle (Visual Only) -->
            <div class="view-toggle ms-auto">
                <button type="button" class="view-toggle-btn active" title="Table view">
                    <i class="ph ph-list-dashes"></i>
                </button>
                <button type="button" class="view-toggle-btn" title="Grid view (coming soon)" disabled>
                    <i class="ph ph-squares-four"></i>
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table premium-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Product</th>
                            <th>Plate Number</th>
                            <th class="text-center">Quantity</th>
                            <th class="pe-4 text-end">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr class="battery-row">
                            <!-- Product -->
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box-sm icon-battery-soft me-3">
                                        <i class="ph ph-battery-charging"></i>
                                    </div>
                                    <div class="product-info">
                                        <span class="product-name">{{ $product->name }}</span>
                                        <small class="product-meta">Battery Unit</small>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Plate Number -->
                            <td>
                                @if($product->plate_number)
                                    <span class="plate-badge">
                                        <i class="ph ph-barcode"></i>
                                        {{ $product->plate_number }}
                                    </span>
                                @else
                                    <span class="text-muted-na">N/A</span>
                                @endif
                            </td>
                            
                            <!-- Quantity -->
                            <td class="text-center">
                                @if($product->stock <= 5)
                                    <span class="qty-badge qty-low">
                                        <span class="qty-dot"></span>
                                        {{ $product->stock }} Low
                                    </span>
                                @elseif($product->stock <= 20)
                                    <span class="qty-badge qty-medium">
                                        <span class="qty-dot"></span>
                                        {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="qty-badge qty-good">
                                        <span class="qty-dot"></span>
                                        {{ $product->stock }}
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Value -->
                            <td class="pe-4 text-end">
                                <span class="value-tag">
                                    ${{ number_format($product->price * $product->stock, 2) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon-wrapper">
                                        <i class="ph ph-magnifying-glass"></i>
                                    </div>
                                    <h5 class="empty-title">No batteries found</h5>
                                    <p class="empty-subtitle">Try adjusting your filters to find what you're looking for.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                </div>
                <div class="pagination-links">
                    {{ $products->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- ============ PREMIUM BATTERIES LIST STYLES ============ -->
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

    /* --- HERO SUMMARY BANNER --- */
    .hero-summary-card {
        background: linear-gradient(135deg, var(--violet-core) 0%, var(--violet-deep) 50%, var(--primary-deep) 100%);
        border-radius: 24px;
        padding: 32px 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px -12px rgba(139, 92, 246, 0.4);
        transition: var(--transition-smooth);
    }

    .hero-summary-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 25px 60px -12px rgba(139, 92, 246, 0.5);
    }

    .hero-summary-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-mint), var(--primary-electric), var(--accent-mint));
        background-size: 200% 100%;
        animation: gradientShiftHero 4s ease infinite;
    }

    @keyframes gradientShiftHero {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .hero-summary-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        pointer-events: none;
    }

    .hero-shape-1 {
        width: 280px;
        height: 280px;
        top: -140px;
        right: -60px;
        animation: floatShape 9s ease-in-out infinite;
    }

    .hero-shape-2 {
        width: 160px;
        height: 160px;
        bottom: -80px;
        right: 30%;
        background: rgba(255, 255, 255, 0.05);
        animation: floatShape 11s ease-in-out infinite reverse;
    }

    .hero-shape-3 {
        width: 100px;
        height: 100px;
        top: 40%;
        left: 25%;
        background: rgba(255, 255, 255, 0.04);
        animation: floatShape 13s ease-in-out infinite;
    }

    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-15px, 15px) scale(1.08); }
    }

    .hero-summary-content {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 24px;
    }

    .hero-summary-left {
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .hero-summary-icon {
        width: 76px;
        height: 76px;
        min-width: 76px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 22px;
        font-size: 2.4rem;
        color: var(--violet-core);
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.25);
        position: relative;
        transition: var(--transition-bounce);
    }

    .hero-summary-icon::before {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.15);
        z-index: -1;
        animation: iconPulse 2.5s ease-in-out infinite;
    }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.08); opacity: 0.3; }
    }

    .hero-summary-card:hover .hero-summary-icon {
        transform: rotate(-8deg) scale(1.05);
    }

    .hero-summary-text { min-width: 0; }

    .hero-summary-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: white;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .hero-summary-badge i {
        color: var(--accent-mint-light);
        font-size: 0.85rem;
    }

    .hero-summary-title {
        color: white;
        font-weight: 800;
        font-size: 1.75rem;
        letter-spacing: -0.8px;
        margin-bottom: 4px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .hero-summary-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin: 0;
        font-weight: 500;
    }

    .hero-summary-stats {
        display: flex;
        align-items: center;
        gap: 24px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 18px;
        padding: 18px 28px;
    }

    .hero-summary-stat {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }

    .hero-summary-stat-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .hero-summary-stat-value {
        color: white;
        font-size: 1.7rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .hero-summary-divider {
        width: 1px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
    }

    /* --- STAT CARDS --- */
    .stat-card {
        background: var(--surface-card);
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        position: relative;
        overflow: hidden;
        transition: var(--transition-bounce);
        cursor: pointer;
        height: 100%;
        box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover::before { transform: scaleX(1); }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -12px rgba(59, 130, 246, 0.18);
        border-color: rgba(59, 130, 246, 0.2);
    }

    .stat-card-glow {
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none;
    }

    .stat-card:hover .stat-card-glow { opacity: 1; }

    .stat-card-success .stat-card-glow {
        background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%);
    }

    .stat-card-danger .stat-card-glow {
        background: radial-gradient(circle, rgba(239, 68, 68, 0.08) 0%, transparent 70%);
    }

    .stat-card.has-alert {
        animation: alertPulse 2.5s ease-in-out infinite;
    }

    @keyframes alertPulse {
        0%, 100% { box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04); }
        50% { box-shadow: 0 8px 30px -4px rgba(239, 68, 68, 0.25); }
    }

    .icon-box {
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.6rem;
        transition: var(--transition-bounce);
        position: relative;
    }

    .stat-card:hover .icon-box { transform: scale(1.1) rotate(-8deg); }

    .icon-primary {
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        color: var(--primary-electric);
        box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.3);
    }

    .icon-success {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: var(--accent-mint);
        box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3);
    }

    .icon-danger {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        color: var(--rose-red);
        box-shadow: 0 4px 12px -4px rgba(239, 68, 68, 0.3);
    }

    .stat-label {
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
    }

    .stat-value {
        color: var(--text-dark);
        font-weight: 800;
        font-size: 2rem;
        letter-spacing: -1px;
        margin-bottom: 16px;
        line-height: 1;
        transition: var(--transition-smooth);
    }

    .stat-card:hover .stat-value { color: var(--primary-electric); transform: translateX(4px); }
    .stat-card-success:hover .stat-value { color: var(--accent-mint); }
    .stat-card-danger:hover .stat-value { color: var(--rose-red); }

    .badge-trend {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
    }

    .badge-trend-up {
        background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
        color: #059669;
    }

    .stat-card:hover .badge-trend { transform: scale(1.1); }

    .badge-alert {
        background: linear-gradient(135deg, #FEF2F2, #FEE2E2);
        color: var(--rose-red);
        font-size: 0.7rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .alert-dot {
        width: 6px;
        height: 6px;
        background: var(--rose-red);
        border-radius: 50%;
        animation: dotPulse 1.5s ease-in-out infinite;
    }

    @keyframes dotPulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.5); }
    }

    .stat-progress {
        height: 4px;
        background: #F1F5F9;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .stat-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
        border-radius: 10px;
        transition: width 1.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
    }

    .stat-progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
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

    .active-filter-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
        color: #059669;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 20px;
        border: 1px solid rgba(16, 185, 129, 0.2);
        animation: badgePulse 2s ease-in-out infinite;
    }

    @keyframes badgePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.03); }
    }

    .active-filter-badge i {
        font-size: 0.85rem;
    }

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

    .section-icon-battery {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: var(--accent-mint);
        box-shadow: 0 8px 20px -8px rgba(16, 185, 129, 0.4);
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

    /* View Toggle */
    .view-toggle {
        display: flex;
        gap: 4px;
        padding: 4px;
        background: #F1F5F9;
        border-radius: 12px;
        border: 1px solid var(--border-light);
    }

    .view-toggle-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        border: none;
        background: transparent;
        color: var(--text-muted);
        font-size: 1.05rem;
        cursor: pointer;
        transition: var(--transition-bounce);
    }

    .view-toggle-btn.active {
        background: white;
        color: var(--primary-electric);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    }

    .view-toggle-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .view-toggle-btn:not(.active):not(:disabled):hover {
        color: var(--text-dark);
    }

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
    .battery-row {
        transition: var(--transition-smooth);
        position: relative;
    }

    .battery-row:hover {
        background: linear-gradient(90deg, rgba(59, 130, 246, 0.03) 0%, rgba(16, 185, 129, 0.02) 100%);
        transform: scale(1.002);
    }

    .battery-row:hover td:first-child { border-radius: 12px 0 0 12px; }
    .battery-row:hover td:last-child { border-radius: 0 12px 12px 0; }

    /* Battery Icon Box */
    .icon-box-sm {
        width: 42px;
        height: 42px;
        min-width: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.25rem;
        transition: var(--transition-bounce);
    }

    .icon-battery-soft {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: var(--accent-mint);
        box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3);
    }

    .battery-row:hover .icon-box-sm {
        transform: scale(1.1) rotate(-8deg);
    }

    /* Product Info */
    .product-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
        min-width: 0;
    }

    .product-name {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: -0.2px;
        transition: var(--transition-smooth);
    }

    .battery-row:hover .product-name { color: var(--accent-mint); }

    .product-meta {
        color: var(--text-muted);
        font-size: 0.72rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    /* Plate Badge */
    .plate-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #F8FAFC;
        border: 1px solid var(--border-light);
        color: var(--text-soft);
        font-weight: 600;
        font-size: 0.78rem;
        padding: 7px 12px;
        border-radius: 10px;
        font-family: 'SF Mono', Monaco, Consolas, monospace;
        letter-spacing: 0.5px;
        transition: var(--transition-bounce);
    }

    .plate-badge i {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .battery-row:hover .plate-badge {
        background: white;
        border-color: rgba(59, 130, 246, 0.3);
        color: var(--primary-electric);
        transform: translateY(-1px);
    }

    .battery-row:hover .plate-badge i { color: var(--primary-electric); }

    /* Quantity Badges */
    .qty-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        padding: 8px 14px;
        border-radius: 10px;
        transition: var(--transition-bounce);
        white-space: nowrap;
    }

    .qty-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .qty-low {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        color: var(--rose-red);
        border: 1px solid rgba(239, 68, 68, 0.15);
    }

    .qty-low .qty-dot {
        background: var(--rose-red);
        animation: dotPulse 1.5s ease-in-out infinite;
    }

    .qty-medium {
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
        color: #D97706;
        border: 1px solid rgba(245, 158, 11, 0.15);
    }

    .qty-medium .qty-dot { background: var(--warm-amber); }

    .qty-good {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.15);
    }

    .qty-good .qty-dot { background: var(--accent-mint); }

    .battery-row:hover .qty-badge { transform: translateY(-1px) scale(1.05); }

    /* Value Tag */
    .value-tag {
        display: inline-flex;
        align-items: center;
        color: var(--accent-mint);
        font-weight: 800;
        font-size: 1.05rem;
        letter-spacing: -0.3px;
        transition: var(--transition-smooth);
    }

    .battery-row:hover .value-tag {
        color: #059669;
        transform: scale(1.05);
    }

    .text-muted-na {
        color: var(--text-muted);
        font-size: 0.85rem;
        font-weight: 500;
        font-style: italic;
    }

    /* --- EMPTY STATE --- */
    .empty-state { padding: 40px 20px; }

    .empty-icon-wrapper {
        width: 90px;
        height: 90px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        border-radius: 24px;
        font-size: 2.8rem;
        color: var(--primary-electric);
        box-shadow: 0 12px 30px -12px rgba(59, 130, 246, 0.4);
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
    .hero-summary-card { animation-delay: 0.1s; }
    .row.g-4 .col-md-4:nth-child(1) .stat-card { animation-delay: 0.15s; }
    .row.g-4 .col-md-4:nth-child(2) .stat-card { animation-delay: 0.22s; }
    .row.g-4 .col-md-4:nth-child(3) .stat-card { animation-delay: 0.29s; }
    .filter-card { animation-delay: 0.36s; }
    .table-card { animation-delay: 0.43s; }

    .battery-row {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .battery-row:nth-child(1) { animation-delay: 0.48s; }
    .battery-row:nth-child(2) { animation-delay: 0.53s; }
    .battery-row:nth-child(3) { animation-delay: 0.58s; }
    .battery-row:nth-child(4) { animation-delay: 0.63s; }
    .battery-row:nth-child(5) { animation-delay: 0.68s; }
    .battery-row:nth-child(6) { animation-delay: 0.73s; }
    .battery-row:nth-child(7) { animation-delay: 0.78s; }
    .battery-row:nth-child(8) { animation-delay: 0.83s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 992px) {
        .hero-summary-content {
            flex-direction: column;
            align-items: flex-start;
        }
        .hero-summary-stats {
            width: 100%;
            justify-content: space-around;
        }
    }

    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .hero-summary-card { padding: 24px 22px; }
        .hero-summary-icon {
            width: 60px;
            height: 60px;
            min-width: 60px;
            font-size: 1.9rem;
        }
        .hero-summary-title { font-size: 1.3rem; }
        .hero-summary-stat-value { font-size: 1.3rem; }
        .filter-header { flex-direction: column; align-items: flex-start; }
        .active-filter-badge { margin-left: 0 !important; }
        .view-toggle { margin-left: 0 !important; }
        .premium-table thead th,
        .premium-table tbody td { padding: 14px 12px; }
        .premium-table thead th:first-child,
        .premium-table tbody td:first-child { padding-left: 16px; }
        .premium-table thead th:last-child,
        .premium-table tbody td:last-child { padding-right: 16px; }
        .pagination-wrapper { flex-direction: column; align-items: center; }
    }
</style>

<!-- Number Count-Up Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat values counting up
        document.querySelectorAll('.stat-value, .hero-summary-stat-value').forEach(function(el) {
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

        // Animate progress bars after a slight delay
        setTimeout(function() {
            document.querySelectorAll('.stat-progress-bar').forEach(function(bar) {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(function() {
                    bar.style.width = width;
                }, 100);
            });
        }, 300);

        // Add parallax to hero summary
        const heroCard = document.querySelector('.hero-summary-card');
        const heroShapes = document.querySelectorAll('.hero-summary-shape');
        
        if (heroCard && heroShapes.length) {
            heroCard.addEventListener('mousemove', function(e) {
                const rect = heroCard.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                
                heroShapes.forEach((shape, index) => {
                    const intensity = (index + 1) * 8;
                    shape.style.transform = `translate(${x * intensity}px, ${y * intensity}px)`;
                });
            });

            heroCard.addEventListener('mouseleave', function() {
                heroShapes.forEach(shape => {
                    shape.style.transform = '';
                });
            });
        }
    });
</script>
@endsection