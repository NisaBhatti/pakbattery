@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 shop-view-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">{{ $shop->name }}</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-hash me-1"></i>
                Shop Code: <strong class="shop-highlight">{{ $shop->code }}</strong>
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-edit-action">
                <i class="ph ph-pencil-simple me-1"></i> Edit
            </a>
            <a href="{{ route('shops.index') }}" class="btn btn-back">
                <i class="ph ph-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <!-- Stats Cards Row — Premium -->
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
                        <div class="stat-progress-bar" style="width: 80%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Types -->
        <div class="col-md-4">
            <div class="stat-card stat-card-success fade-in-up">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-success">
                            <i class="ph ph-package"></i>
                        </div>
                        <span class="badge badge-trend badge-trend-up">
                            <i class="ph ph-check-circle me-1"></i>Active
                        </span>
                    </div>
                    <h6 class="stat-label">Product Types</h6>
                    <h2 class="stat-value" data-count="{{ $totalProducts }}">{{ $totalProducts }}</h2>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: 65%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
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
                    <h6 class="stat-label">Low Stock</h6>
                    <h2 class="stat-value" data-count="{{ $lowStockCount }}">{{ $lowStockCount }}</h2>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: {{ $lowStockCount > 0 ? '40%' : '5%' }};"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Information Card -->
    <div class="info-card fade-in-up mb-4">
        <div class="info-card-border"></div>
        <div class="card-body p-4 p-md-5 position-relative">
            
            <div class="info-section-header">
                <div class="info-section-icon">
                    <i class="ph ph-storefront"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 info-section-title">Shop Information</h5>
                    <p class="text-muted mb-0 info-section-subtitle">Contact details and location</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Manager -->
                <div class="col-md-3">
                    <div class="info-box">
                        <div class="info-icon icon-violet-soft">
                            <i class="ph ph-user-circle"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Manager</span>
                            <span class="info-value">{{ $shop->manager_name ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-3">
                    <div class="info-box">
                        <div class="info-icon icon-success-soft">
                            <i class="ph ph-phone"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Phone</span>
                            <span class="info-value info-mono">{{ $shop->phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-primary-soft">
                            <i class="ph ph-map-pin"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Address</span>
                            <span class="info-value">{{ $shop->address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Table Card -->
    <div class="table-card fade-in-up">
        <div class="table-card-border"></div>
        
        <div class="table-section-header">
            <div class="section-icon section-icon-shop">
                <i class="ph ph-battery-charging"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0 section-title">Batteries in Stock</h5>
                <p class="text-muted mb-0 section-subtitle">
                    {{ $shop->stocks->count() }} product type{{ $shop->stocks->count() !== 1 ? 's' : '' }} available
                </p>
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
                            <th class="pe-4 text-end">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($shop->stocks as $stock)
                        <tr class="stock-row">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box-sm icon-battery-soft me-3">
                                        <i class="ph ph-battery-charging"></i>
                                    </div>
                                    <div class="product-info">
                                        <span class="product-name">{{ $stock->product->name ?? 'N/A' }}</span>
                                        <small class="product-meta">Battery Unit</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($stock->product->plate_number ?? null)
                                    <span class="plate-badge">
                                        <i class="ph ph-barcode"></i>
                                        {{ $stock->product->plate_number }}
                                    </span>
                                @else
                                    <span class="text-muted-na">N/A</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($stock->quantity <= 5)
                                    <span class="qty-badge qty-low">
                                        <span class="qty-dot"></span>
                                        {{ $stock->quantity }} Low
                                    </span>
                                @elseif($stock->quantity <= 20)
                                    <span class="qty-badge qty-medium">
                                        <span class="qty-dot"></span>
                                        {{ $stock->quantity }}
                                    </span>
                                @else
                                    <span class="qty-badge qty-good">
                                        <span class="qty-dot"></span>
                                        {{ $stock->quantity }}
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <span class="price-tag">
                                    Rs {{ number_format($stock->product->price ?? 0, 2) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon-wrapper">
                                        <i class="ph ph-battery-charging"></i>
                                    </div>
                                    <h5 class="empty-title">No stock in this shop yet</h5>
                                    <p class="empty-subtitle">Stock will appear here once products are transferred.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ============ PREMIUM SHOP VIEW STYLES ============ -->
<style>
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

    .page-title { color: var(--text-dark); font-size: 1.75rem; letter-spacing: -0.5px; position: relative; display: inline-block; }
    .page-title::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); border-radius: 10px; transition: width 0.4s ease; }
    .page-header:hover .page-title::after { width: 100%; }
    .page-subtitle { font-size: 0.9rem; display: flex; align-items: center; flex-wrap: wrap; gap: 4px; }
    .page-subtitle i { color: var(--violet-core); }
    .shop-highlight { color: var(--violet-deep); font-weight: 800; background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); padding: 2px 12px; border-radius: 8px; font-size: 0.85rem; font-family: 'SF Mono', Monaco, Consolas, monospace; letter-spacing: 0.5px; }

    .btn-edit-action { background: linear-gradient(105deg, var(--warm-amber) 0%, #D97706 100%); border: none; color: white; border-radius: 12px; padding: 11px 22px; font-weight: 600; display: inline-flex; align-items: center; transition: var(--transition-bounce); position: relative; overflow: hidden; box-shadow: 0 8px 20px -6px rgba(245, 158, 11, 0.5); text-decoration: none; }
    .btn-edit-action::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent); transition: left 0.6s ease; }
    .btn-edit-action:hover::before { left: 100%; }
    .btn-edit-action:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 15px 30px -8px rgba(245, 158, 11, 0.6); color: white; }
    .btn-edit-action i { transition: var(--transition-bounce); }
    .btn-edit-action:hover i { transform: rotate(-15deg) scale(1.15); }

    .btn-back { background: white; border: 1px solid var(--border-light); color: var(--text-dark); border-radius: 12px; padding: 11px 22px; font-weight: 600; display: inline-flex; align-items: center; transition: var(--transition-bounce); position: relative; overflow: hidden; text-decoration: none; }
    .btn-back::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.08), transparent); transition: left 0.5s ease; }
    .btn-back:hover::before { left: 100%; }
    .btn-back:hover { color: var(--violet-deep); border-color: var(--violet-core); transform: translateX(-4px); box-shadow: 0 8px 20px -8px rgba(139, 92, 246, 0.4); }
    .btn-back i { transition: var(--transition-bounce); }
    .btn-back:hover i { transform: translateX(-3px); }

    /* Stat Cards */
    .stat-card { background: var(--surface-card); border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.6); position: relative; overflow: hidden; transition: var(--transition-bounce); cursor: pointer; height: 100%; box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04); }
    .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); transform: scaleX(0); transform-origin: left; transition: transform 0.4s ease; }
    .stat-card:hover::before { transform: scaleX(1); }
    .stat-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px -12px rgba(139, 92, 246, 0.18); border-color: rgba(139, 92, 246, 0.2); }

    .stat-card-glow { position: absolute; top: -50%; right: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%); opacity: 0; transition: opacity 0.5s ease; pointer-events: none; }
    .stat-card:hover .stat-card-glow { opacity: 1; }
    .stat-card-success .stat-card-glow { background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); }
    .stat-card-danger .stat-card-glow { background: radial-gradient(circle, rgba(239, 68, 68, 0.08) 0%, transparent 70%); }

    .stat-card.has-alert { animation: alertPulse 2.5s ease-in-out infinite; }
    @keyframes alertPulse { 0%, 100% { box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04); } 50% { box-shadow: 0 8px 30px -4px rgba(239, 68, 68, 0.25); } }

    .icon-box { width: 54px; height: 54px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.6rem; transition: var(--transition-bounce); position: relative; }
    .stat-card:hover .icon-box { transform: scale(1.1) rotate(-8deg); }
    .icon-primary { background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%); color: var(--primary-electric); box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.3); }
    .icon-success { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); color: var(--accent-mint); box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3); }
    .icon-danger { background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%); color: var(--rose-red); box-shadow: 0 4px 12px -4px rgba(239, 68, 68, 0.3); }

    .stat-label { color: var(--text-muted); font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 8px; }
    .stat-value { color: var(--text-dark); font-weight: 800; font-size: 2rem; letter-spacing: -1px; margin-bottom: 16px; line-height: 1; transition: var(--transition-smooth); }
    .stat-card:hover .stat-value { color: var(--violet-deep); transform: translateX(4px); }
    .stat-card-success:hover .stat-value { color: var(--accent-mint); }
    .stat-card-danger:hover .stat-value { color: var(--rose-red); }

    .badge-trend { font-size: 0.75rem; font-weight: 700; padding: 6px 12px; border-radius: 20px; display: inline-flex; align-items: center; transition: var(--transition-bounce); }
    .badge-trend-up { background: linear-gradient(135deg, #ECFDF5, #D1FAE5); color: #059669; }
    .stat-card:hover .badge-trend { transform: scale(1.1); }

    .badge-alert { background: linear-gradient(135deg, #FEF2F2, #FEE2E2); color: var(--rose-red); font-size: 0.7rem; font-weight: 700; padding: 6px 12px; border-radius: 20px; display: inline-flex; align-items: center; gap: 6px; }
    .alert-dot { width: 6px; height: 6px; background: var(--rose-red); border-radius: 50%; animation: dotPulse 1.5s ease-in-out infinite; }
    @keyframes dotPulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.5); } }

    .stat-progress { height: 4px; background: #F1F5F9; border-radius: 10px; overflow: hidden; position: relative; }
    .stat-progress-bar { height: 100%; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); border-radius: 10px; transition: width 1.5s cubic-bezier(0.34, 1.56, 0.64, 1); position: relative; }
    .stat-progress-bar::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent); animation: shimmer 2s infinite; }
    @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }

    /* Info Card */
    .info-card { background: var(--surface-card); border-radius: 24px; border: 1px solid rgba(226, 232, 240, 0.6); position: relative; overflow: hidden; box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08); transition: var(--transition-smooth); }
    .info-card:hover { box-shadow: 0 20px 60px -16px rgba(139, 92, 246, 0.12); border-color: rgba(139, 92, 246, 0.15); }
    .info-card-border { position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint), var(--violet-core)); background-size: 200% 100%; animation: gradientShiftInfo 4s ease infinite; }
    @keyframes gradientShiftInfo { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }

    .info-section-header { display: flex; align-items: center; gap: 16px; padding-bottom: 24px; margin-bottom: 32px; border-bottom: 1px solid var(--border-light); position: relative; }
    .info-section-header::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 80px; height: 2px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); border-radius: 10px; }
    .info-section-icon { width: 52px; height: 52px; min-width: 52px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); border-radius: 14px; font-size: 1.5rem; color: var(--violet-deep); box-shadow: 0 8px 20px -8px rgba(139, 92, 246, 0.4); transition: var(--transition-bounce); }
    .info-card:hover .info-section-icon { transform: rotate(-8deg) scale(1.05); }
    .info-section-title { color: var(--text-dark); font-size: 1.1rem; letter-spacing: -0.3px; }
    .info-section-subtitle { font-size: 0.85rem; }

    .info-box { display: flex; align-items: center; padding: 20px 22px; background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%); border-radius: 16px; border: 1px solid #F1F5F9; transition: var(--transition-bounce); height: 100%; position: relative; overflow: hidden; }
    .info-box::before { content: ''; position: absolute; top: 0; left: 0; width: 3px; height: 100%; background: linear-gradient(180deg, var(--violet-core), var(--accent-mint)); opacity: 0; transition: opacity 0.3s ease; }
    .info-box:hover::before { opacity: 1; }
    .info-box:hover { background: white; box-shadow: 0 12px 30px -10px rgba(139, 92, 246, 0.15); transform: translateY(-4px); border-color: rgba(139, 92, 246, 0.15); }

    .info-icon { width: 52px; height: 52px; min-width: 52px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.4rem; margin-right: 16px; flex-shrink: 0; transition: var(--transition-bounce); }
    .info-box:hover .info-icon { transform: scale(1.1) rotate(-8deg); }
    .icon-violet-soft { background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); color: var(--violet-deep); box-shadow: 0 4px 12px -4px rgba(139, 92, 246, 0.3); }
    .icon-primary-soft { background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%); color: var(--primary-electric); box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.3); }
    .icon-success-soft { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); color: var(--accent-mint); box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3); }

    .info-content { flex: 1; min-width: 0; }
    .info-label { display: block; font-size: 0.7rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
    .info-value { display: block; font-size: 1rem; color: var(--text-dark); font-weight: 700; letter-spacing: -0.2px; word-break: break-word; transition: var(--transition-smooth); }
    .info-box:hover .info-value { color: var(--violet-deep); }
    .info-mono { font-family: 'SF Mono', Monaco, Consolas, monospace; letter-spacing: 0.5px; }

    /* Table Card */
    .table-card { background: var(--surface-card); border-radius: 24px; border: 1px solid rgba(226, 232, 240, 0.6); position: relative; overflow: hidden; box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08); transition: var(--transition-smooth); }
    .table-card:hover { box-shadow: 0 20px 60px -16px rgba(139, 92, 246, 0.12); border-color: rgba(139, 92, 246, 0.15); }
    .table-card-border { position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint), var(--violet-core)); background-size: 200% 100%; animation: gradientShiftTable 4s ease infinite; }
    @keyframes gradientShiftTable { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }

    .table-section-header { display: flex; align-items: center; gap: 16px; padding: 24px 28px; border-bottom: 1px solid var(--border-light); background: linear-gradient(135deg, rgba(248, 250, 252, 0.6) 0%, rgba(255, 255, 255, 0.6) 100%); flex-wrap: wrap; }
    .section-icon { width: 52px; height: 52px; min-width: 52px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.5rem; transition: var(--transition-bounce); }
    .section-icon-shop { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); color: var(--accent-mint); box-shadow: 0 8px 20px -8px rgba(16, 185, 129, 0.4); }
    .table-card:hover .section-icon { transform: rotate(-8deg) scale(1.05); }
    .section-title { color: var(--text-dark); font-size: 1.1rem; letter-spacing: -0.3px; }
    .section-subtitle { font-size: 0.85rem; }

    .premium-table { border-collapse: separate; border-spacing: 0; }
    .premium-table thead th { background: #F8FAFC; color: var(--text-muted); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 16px 20px; border: none; white-space: nowrap; }
    .premium-table thead th:first-child { padding-left: 28px; }
    .premium-table thead th:last-child { padding-right: 28px; }
    .premium-table tbody td { padding: 18px 20px; border: none; border-bottom: 1px solid #F1F5F9; vertical-align: middle; }
    .premium-table tbody td:first-child { padding-left: 28px; }
    .premium-table tbody td:last-child { padding-right: 28px; }

    .stock-row { transition: var(--transition-smooth); }
    .stock-row:hover { background: linear-gradient(90deg, rgba(139, 92, 246, 0.03) 0%, rgba(16, 185, 129, 0.02) 100%); }
    .stock-row:hover td:first-child { border-radius: 12px 0 0 12px; }
    .stock-row:hover td:last-child { border-radius: 0 12px 12px 0; }

    .icon-box-sm { width: 42px; height: 42px; min-width: 42px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 1.25rem; transition: var(--transition-bounce); }
    .icon-battery-soft { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); color: var(--accent-mint); box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3); }
    .stock-row:hover .icon-box-sm { transform: scale(1.1) rotate(-8deg); }

    .product-info { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
    .product-name { color: var(--text-dark); font-weight: 700; font-size: 0.95rem; letter-spacing: -0.2px; transition: var(--transition-smooth); }
    .stock-row:hover .product-name { color: var(--violet-deep); }
    .product-meta { color: var(--text-muted); font-size: 0.72rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.6px; }

    .plate-badge { display: inline-flex; align-items: center; gap: 5px; background: #F8FAFC; border: 1px solid var(--border-light); color: var(--text-soft); font-weight: 600; font-size: 0.78rem; padding: 7px 12px; border-radius: 10px; font-family: 'SF Mono', Monaco, Consolas, monospace; letter-spacing: 0.5px; transition: var(--transition-bounce); }
    .plate-badge i { color: var(--text-muted); font-size: 0.9rem; }
    .stock-row:hover .plate-badge { background: white; border-color: rgba(139, 92, 246, 0.3); color: var(--violet-deep); transform: translateY(-1px); }
    .stock-row:hover .plate-badge i { color: var(--violet-core); }

    .qty-badge { display: inline-flex; align-items: center; gap: 8px; font-weight: 700; font-size: 0.8rem; padding: 8px 14px; border-radius: 10px; transition: var(--transition-bounce); white-space: nowrap; }
    .qty-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .qty-low { background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%); color: var(--rose-red); border: 1px solid rgba(239, 68, 68, 0.15); }
    .qty-low .qty-dot { background: var(--rose-red); animation: dotPulse 1.5s ease-in-out infinite; }
    .qty-medium { background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%); color: #D97706; border: 1px solid rgba(245, 158, 11, 0.15); }
    .qty-medium .qty-dot { background: var(--warm-amber); }
    .qty-good { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); color: #059669; border: 1px solid rgba(16, 185, 129, 0.15); }
    .qty-good .qty-dot { background: var(--accent-mint); }
    .stock-row:hover .qty-badge { transform: translateY(-1px) scale(1.05); }

    .price-tag { color: var(--accent-mint); font-weight: 800; font-size: 1.05rem; letter-spacing: -0.3px; transition: var(--transition-smooth); }
    .stock-row:hover .price-tag { color: #059669; transform: scale(1.05); display: inline-block; }
    .text-muted-na { color: var(--text-muted); font-size: 0.85rem; font-weight: 500; font-style: italic; }

    .empty-state { padding: 40px 20px; }
    .empty-icon-wrapper { width: 90px; height: 90px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); border-radius: 24px; font-size: 2.8rem; color: var(--accent-mint); box-shadow: 0 12px 30px -12px rgba(16, 185, 129, 0.4); animation: floatIcon 3s ease-in-out infinite; }
    @keyframes floatIcon { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-8px) rotate(5deg); } }
    .empty-title { color: var(--text-dark); font-weight: 700; margin-bottom: 8px; }
    .empty-subtitle { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0; }

    .fade-in-up { animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(25px); } to { opacity: 1; transform: translateY(0); } }
    .page-header { animation-delay: 0.05s; }
    .row.g-4 .col-md-4:nth-child(1) .stat-card { animation-delay: 0.1s; }
    .row.g-4 .col-md-4:nth-child(2) .stat-card { animation-delay: 0.2s; }
    .row.g-4 .col-md-4:nth-child(3) .stat-card { animation-delay: 0.3s; }
    .info-card { animation-delay: 0.4s; }
    .table-card { animation-delay: 0.5s; }

    .stock-row { opacity: 0; animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    .stock-row:nth-child(1) { animation-delay: 0.55s; }
    .stock-row:nth-child(2) { animation-delay: 0.6s; }
    .stock-row:nth-child(3) { animation-delay: 0.65s; }
    .stock-row:nth-child(4) { animation-delay: 0.7s; }
    .stock-row:nth-child(5) { animation-delay: 0.75s; }

    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .page-header .d-flex { width: 100%; }
        .btn-edit-action, .btn-back { flex: 1; justify-content: center; }
        .stat-value { font-size: 1.6rem; }
        .info-section-header { flex-direction: column; align-items: flex-start; }
        .info-box { padding: 16px 18px; }
        .info-icon { width: 46px; height: 46px; min-width: 46px; font-size: 1.25rem; margin-right: 14px; }
        .premium-table thead th, .premium-table tbody td { padding: 14px 12px; }
        .premium-table thead th:first-child, .premium-table tbody td:first-child { padding-left: 16px; }
        .premium-table thead th:last-child, .premium-table tbody td:last-child { padding-right: 16px; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat values
        document.querySelectorAll('.stat-value').forEach(function(el) {
            const target = parseInt(el.getAttribute('data-count')) || 0;
            if (target === 0) return;
            let current = 0;
            const duration = 1200;
            const stepTime = 16;
            const increment = target / (duration / stepTime);
            const timer = setInterval(function() {
                current += increment;
                if (current >= target) { el.textContent = target; clearInterval(timer); }
                else { el.textContent = Math.floor(current); }
            }, stepTime);
        });

        // Animate progress bars
        setTimeout(function() {
            document.querySelectorAll('.stat-progress-bar').forEach(function(bar) {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(function() { bar.style.width = width; }, 100);
            });
        }, 300);
    });
</script>
@endsection
