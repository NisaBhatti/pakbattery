@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 dashboard-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Dashboard Overview</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-sparkle me-1"></i>
                Welcome back, here's what's happening with your business today.
            </p>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- ROW 1: MAIN ENTITY COUNTERS -->
    <!-- ============================================ -->
    <div class="row g-4 mb-4">
        
        <!-- Total Products -->
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="stat-card stat-card-primary">
                    <div class="stat-card-glow"></div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box icon-primary"><i class="ph ph-package"></i></div>
                            <span class="badge badge-trend badge-trend-up">
                                <i class="ph ph-arrow-up-right"></i>
                            </span>
                        </div>
                        <h6 class="stat-label">Total Products</h6>
                        <h2 class="stat-value" data-count="{{ $totalProducts }}">{{ $totalProducts }}</h2>
                        <div class="stat-progress">
                            <div class="stat-progress-bar" style="width: 78%;"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Customers -->
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('customers.index') }}" class="text-decoration-none">
                <div class="stat-card stat-card-warning">
                    <div class="stat-card-glow"></div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box icon-warning"><i class="ph ph-users"></i></div>
                            <span class="badge badge-trend badge-trend-up">
                                <i class="ph ph-arrow-up-right"></i>
                            </span>
                        </div>
                        <h6 class="stat-label">Total Customers</h6>
                        <h2 class="stat-value" data-count="{{ $totalCustomers }}">{{ $totalCustomers }}</h2>
                        <div class="stat-progress">
                            <div class="stat-progress-bar" style="width: 85%;"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Suppliers -->
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('suppliers.index') }}" class="text-decoration-none">
                <div class="stat-card stat-card-success">
                    <div class="stat-card-glow"></div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box icon-success"><i class="ph ph-truck"></i></div>
                            <span class="badge badge-trend badge-trend-up">
                                <i class="ph ph-arrow-up-right"></i>
                            </span>
                        </div>
                        <h6 class="stat-label">Total Suppliers</h6>
                        <h2 class="stat-value" data-count="{{ $totalSuppliers }}">{{ $totalSuppliers }}</h2>
                        <div class="stat-progress">
                            <div class="stat-progress-bar" style="width: 62%;"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Shops -->
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('shops.index') }}" class="text-decoration-none">
                <div class="stat-card stat-card-cyan">
                    <div class="stat-card-glow"></div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box icon-cyan"><i class="ph ph-storefront"></i></div>
                            @if($activeShops > 0)
                                <span class="badge badge-trend badge-trend-up">
                                    <i class="ph ph-check-circle me-1"></i>{{ $activeShops }} Active
                                </span>
                            @endif
                        </div>
                        <h6 class="stat-label">Total Shops</h6>
                        <h2 class="stat-value" data-count="{{ $totalShops }}">{{ $totalShops }}</h2>
                        <div class="stat-progress">
                            <div class="stat-progress-bar" style="width: 70%;"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <!-- ============================================ -->
    <!-- ROW 2: FINANCIAL OVERVIEW (GRADIENT CARDS) -->
    <!-- ============================================ -->
    <div class="row g-4 mb-4">
        
        <!-- Total Sales -->
        <div class="col-md-3">
            <div class="gradient-card gradient-sales">
                <div class="gradient-shape gradient-shape-1"></div>
                <div class="gradient-shape gradient-shape-2"></div>
                <div class="gradient-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-glass"><i class="ph ph-trend-up"></i></div>
                        <span class="gradient-label">SALES</span>
                    </div>
                    <h6 class="gradient-title">Total Sales</h6>
                    <h4 class="gradient-value">Rs {{ number_format($totalSales, 2) }}</h4>
                    <p class="gradient-subtitle">Revenue from bills</p>
                </div>
            </div>
        </div>

        <!-- Total Purchases -->
        <div class="col-md-3">
            <div class="gradient-card gradient-purchases">
                <div class="gradient-shape gradient-shape-1"></div>
                <div class="gradient-shape gradient-shape-2"></div>
                <div class="gradient-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-glass"><i class="ph ph-shopping-cart"></i></div>
                        <span class="gradient-label">PURCHASES</span>
                    </div>
                    <h6 class="gradient-title">Total Purchases</h6>
                    <h4 class="gradient-value">Rs {{ number_format($totalPurchases, 2) }}</h4>
                    <p class="gradient-subtitle">Money spent on inventory</p>
                </div>
            </div>
        </div>

        <!-- Total Expenses -->
        <div class="col-md-3">
            <div class="gradient-card gradient-expenses">
                <div class="gradient-shape gradient-shape-1"></div>
                <div class="gradient-shape gradient-shape-2"></div>
                <div class="gradient-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-glass"><i class="ph ph-receipt-x"></i></div>
                        <span class="gradient-label">EXPENSES</span>
                    </div>
                    <h6 class="gradient-title">Total Expenses</h6>
                    <h4 class="gradient-value">Rs {{ number_format($totalExpenses, 2) }}</h4>
                    <p class="gradient-subtitle">Rent, utilities & other</p>
                </div>
            </div>
        </div>

        <!-- Net Profit -->
        <div class="col-md-3">
            <div class="gradient-card {{ $netProfit >= 0 ? 'gradient-profit' : 'gradient-loss' }}">
                <div class="gradient-shape gradient-shape-1"></div>
                <div class="gradient-shape gradient-shape-2"></div>
                <div class="gradient-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-glass"><i class="ph ph-chart-line-up"></i></div>
                        <span class="gradient-label">{{ $netProfit >= 0 ? 'NET PROFIT' : 'NET LOSS' }}</span>
                    </div>
                    <h6 class="gradient-title">{{ $netProfit >= 0 ? 'Net Profit' : 'Net Loss' }}</h6>
                    <h4 class="gradient-value">Rs {{ number_format($netProfit, 2) }}</h4>
                    <p class="gradient-subtitle">Sales − Purchases − Expenses</p>
                </div>
            </div>
        </div>

    </div>

    <!-- ============================================ -->
    <!-- ROW 3: OPERATIONAL STATS -->
    <!-- ============================================ -->
    <div class="row g-4 mb-4">
        
        <!-- Stock Transfers -->
        <div class="col-md-4">
            <a href="{{ route('shops.send-stock') }}" class="text-decoration-none">
                <div class="stat-card stat-card-violet">
                    <div class="stat-card-glow"></div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box icon-violet"><i class="ph ph-paper-plane-tilt"></i></div>
                            <span class="badge badge-trend badge-trend-up">
                                <i class="ph ph-arrow-up-right"></i>
                            </span>
                        </div>
                        <h6 class="stat-label">Stock Transfers</h6>
                        <h2 class="stat-value" data-count="{{ $totalTransfers }}">{{ $totalTransfers }}</h2>
                        <p class="text-muted mb-2" style="font-size: 0.8rem;">
                            <i class="ph ph-stack me-1"></i>
                            {{ $totalTransferredQty }} units transferred
                        </p>
                        <div class="stat-progress">
                            <div class="stat-progress-bar" style="width: 65%;"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Low Stock Alerts -->
        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="stat-card stat-card-danger {{ $lowStockCount > 0 ? 'has-alert' : '' }}">
                    <div class="stat-card-glow"></div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box icon-danger"><i class="ph ph-warning-circle"></i></div>
                            @if($lowStockCount > 0)
                                <span class="badge badge-alert">
                                    <span class="alert-dot"></span> Action Needed
                                </span>
                            @endif
                        </div>
                        <h6 class="stat-label">Low Stock Alerts</h6>
                        <h2 class="stat-value" data-count="{{ $lowStockCount }}">{{ $lowStockCount }}</h2>
                        <p class="text-muted mb-2" style="font-size: 0.8rem;">
                            <i class="ph ph-info me-1"></i>
                            Products with stock ≤ 5
                        </p>
                        <div class="stat-progress">
                            <div class="stat-progress-bar" style="width: {{ $lowStockCount > 0 ? '40%' : '5%' }};"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Inventory Value -->
        <div class="col-md-4">
            <div class="gradient-card gradient-inventory">
                <div class="gradient-shape gradient-shape-1"></div>
                <div class="gradient-shape gradient-shape-2"></div>
                <div class="gradient-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-glass"><i class="ph ph-warehouse"></i></div>
                        <span class="gradient-label">STOCK VALUE</span>
                    </div>
                    <h6 class="gradient-title">Total Inventory Value</h6>
                    <h4 class="gradient-value">Rs {{ number_format($totalInventoryValue, 2) }}</h4>
                    <p class="gradient-subtitle">Value of all products in stock</p>
                </div>
            </div>
        </div>

    </div>

    <!-- ============================================ -->
    <!-- ROW 4: RECENT ACTIVITY (4 COLUMNS) -->
    <!-- ============================================ -->
    <div class="row g-4 mb-4">
        
        <!-- Recent Sales -->
        <div class="col-lg-6 col-xl-3">
            <div class="activity-card">
                <div class="activity-header">
                    <h6 class="activity-title">
                        <i class="ph ph-receipt text-success me-2"></i> Recent Sales
                    </h6>
                    <a href="{{ route('bills.index') }}" class="activity-link">View All</a>
                </div>
                <div class="activity-body">
                    @forelse($recentBills as $bill)
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon activity-icon-success"><i class="ph ph-user"></i></div>
                                <div>
                                    <span class="activity-name">{{ $bill->customer->name ?? 'N/A' }}</span>
                                    <small class="activity-meta">{{ $bill->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <span class="activity-amount text-success">Rs {{ number_format($bill->total_amount, 0) }}</span>
                        </div>
                    @empty
                        <div class="activity-empty">No sales yet</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Purchases -->
        <div class="col-lg-6 col-xl-3">
            <div class="activity-card">
                <div class="activity-header">
                    <h6 class="activity-title">
                        <i class="ph ph-shopping-bag text-warning me-2"></i> Recent Purchases
                    </h6>
                    <a href="{{ route('purchases.index') }}" class="activity-link">View All</a>
                </div>
                <div class="activity-body">
                    @forelse($recentPurchases as $purchase)
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon activity-icon-warning"><i class="ph ph-truck"></i></div>
                                <div>
                                    <span class="activity-name">{{ $purchase->supplier->name ?? 'N/A' }}</span>
                                    <small class="activity-meta">{{ $purchase->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <span class="activity-amount text-warning">Rs {{ number_format($purchase->total_amount, 0) }}</span>
                        </div>
                    @empty
                        <div class="activity-empty">No purchases yet</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Expenses -->
        <div class="col-lg-6 col-xl-3">
            <div class="activity-card">
                <div class="activity-header">
                    <h6 class="activity-title">
                        <i class="ph ph-receipt-x text-danger me-2"></i> Recent Expenses
                    </h6>
                    <a href="{{ route('expenses.index') }}" class="activity-link">View All</a>
                </div>
                <div class="activity-body">
                    @forelse($recentExpenses as $expense)
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon activity-icon-danger"><i class="ph ph-wallet"></i></div>
                                <div>
                                    <span class="activity-name">{{ Str::limit($expense->title, 18) }}</span>
                                    <small class="activity-meta">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M') }}</small>
                                </div>
                            </div>
                            <span class="activity-amount text-danger">Rs {{ number_format($expense->amount, 0) }}</span>
                        </div>
                    @empty
                        <div class="activity-empty">No expenses yet</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Stock Transfers -->
        <div class="col-lg-6 col-xl-3">
            <div class="activity-card">
                <div class="activity-header">
                    <h6 class="activity-title">
                        <i class="ph ph-paper-plane-tilt text-violet me-2"></i> Recent Transfers
                    </h6>
                    <a href="{{ route('shops.send-stock') }}" class="activity-link">View All</a>
                </div>
                <div class="activity-body">
                    @forelse($recentTransfers as $transfer)
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon activity-icon-violet"><i class="ph ph-storefront"></i></div>
                                <div>
                                    <span class="activity-name">
                                        {{ Str::limit($transfer->fromShop->name ?? 'N/A', 8) }} → {{ Str::limit($transfer->toShop->name ?? 'N/A', 8) }}
                                    </span>
                                    <small class="activity-meta">{{ $transfer->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <span class="activity-amount text-violet">{{ $transfer->total_quantity }}u</span>
                        </div>
                    @empty
                        <div class="activity-empty">No transfers yet</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- ============================================ -->
    <!-- ROW 5: LOW STOCK TABLE (ONLY IF ANY) -->
    <!-- ============================================ -->
    @if($lowStockProducts->count() > 0)
    <div class="row g-4">
        <div class="col-12">
            <div class="low-stock-card">
                <div class="low-stock-header">
                    <div>
                        <h5 class="low-stock-title">
                            <i class="ph ph-warning-circle text-danger me-2"></i> Low Stock Products
                        </h5>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Products that need restocking soon</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn-light-action">
                        Manage Products <i class="ph ph-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="low-stock-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Plate Number</th>
                                <th class="text-center">Stock</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockProducts as $product)
                            <tr>
                                <td>
                                    <span class="fw-bold" style="color: var(--text-dark);">{{ $product->name }}</span>
                                </td>
                                <td>
                                    <span class="plate-badge">{{ $product->plate_number }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="stock-badge">
                                        <i class="ph ph-warning-circle me-1"></i> {{ $product->stock }} left
                                    </span>
                                </td>
                                <td class="text-end fw-bold" style="color: var(--accent-mint);">
                                    Rs {{ number_format($product->price, 2) }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('purchases.create') }}" class="btn-restock">
                                        <i class="ph ph-plus-circle me-1"></i> Restock
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

<!-- ============ PREMIUM DASHBOARD STYLES ============ -->
<style>
    /* --- GLOBAL THEME VARIABLES --- */
    :root {
        --primary-electric: #3B82F6;
        --primary-deep: #2563EB;
        --accent-mint: #10B981;
        --accent-mint-light: #D1FAE5;
        --warm-amber: #F59E0B;
        --rose-red: #EF4444;
        --violet-core: #8B5CF6;
        --violet-deep: #7C3AED;
        --cyan-core: #06B6D4;
        --cyan-deep: #0891B2;
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
        top: 0; left: 0; right: 0;
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

    .stat-card-cyan:hover {
        box-shadow: 0 20px 40px -12px rgba(6, 182, 212, 0.18);
        border-color: rgba(6, 182, 212, 0.2);
    }

    .stat-card-violet:hover {
        box-shadow: 0 20px 40px -12px rgba(139, 92, 246, 0.18);
        border-color: rgba(139, 92, 246, 0.2);
    }

    .stat-card-glow {
        position: absolute;
        top: -50%; right: -50%;
        width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none;
    }

    .stat-card:hover .stat-card-glow { opacity: 1; }
    .stat-card-success .stat-card-glow { background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); }
    .stat-card-warning .stat-card-glow { background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, transparent 70%); }
    .stat-card-danger .stat-card-glow { background: radial-gradient(circle, rgba(239, 68, 68, 0.08) 0%, transparent 70%); }
    .stat-card-cyan .stat-card-glow { background: radial-gradient(circle, rgba(6, 182, 212, 0.08) 0%, transparent 70%); }
    .stat-card-violet .stat-card-glow { background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%); }

    .stat-card.has-alert { animation: alertPulse 2.5s ease-in-out infinite; }

    @keyframes alertPulse {
        0%, 100% { box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04); }
        50% { box-shadow: 0 8px 30px -4px rgba(239, 68, 68, 0.25); }
    }

    /* --- ICON BOXES --- */
    .icon-box {
        width: 54px; height: 54px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 14px;
        font-size: 1.6rem;
        transition: var(--transition-bounce);
        position: relative;
    }

    .stat-card:hover .icon-box { transform: scale(1.1) rotate(-8deg); }

    .icon-primary { background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%); color: var(--primary-electric); box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.3); }
    .icon-success { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); color: var(--accent-mint); box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3); }
    .icon-warning { background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%); color: var(--warm-amber); box-shadow: 0 4px 12px -4px rgba(245, 158, 11, 0.3); }
    .icon-danger { background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%); color: var(--rose-red); box-shadow: 0 4px 12px -4px rgba(239, 68, 68, 0.3); }
    .icon-cyan { background: linear-gradient(135deg, #CFFAFE 0%, #A5F3FC 100%); color: var(--cyan-deep); box-shadow: 0 4px 12px -4px rgba(6, 182, 212, 0.3); }
    .icon-violet { background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); color: var(--violet-deep); box-shadow: 0 4px 12px -4px rgba(139, 92, 246, 0.3); }

    /* --- STAT TEXT --- */
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
    .stat-card-warning:hover .stat-value { color: var(--warm-amber); }
    .stat-card-danger:hover .stat-value { color: var(--rose-red); }
    .stat-card-cyan:hover .stat-value { color: var(--cyan-deep); }
    .stat-card-violet:hover .stat-value { color: var(--violet-deep); }

    /* --- BADGES --- */
    .badge-trend {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
    }

    .badge-trend-up { background: linear-gradient(135deg, #ECFDF5, #D1FAE5); color: #059669; }
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
        width: 6px; height: 6px;
        background: var(--rose-red);
        border-radius: 50%;
        animation: dotPulse 1.5s ease-in-out infinite;
    }

    @keyframes dotPulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.5); }
    }

    /* --- STAT PROGRESS BAR --- */
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
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    /* ============================================ */
    /* GRADIENT CARDS (Financial Overview)         */
    /* ============================================ */
    .gradient-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        padding: 24px;
        color: white;
        transition: var(--transition-bounce);
        min-height: 180px;
        box-shadow: 0 12px 35px -10px rgba(59, 130, 246, 0.4);
    }

    .gradient-sales {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        box-shadow: 0 12px 35px -10px rgba(16, 185, 129, 0.4);
    }
    .gradient-purchases {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        box-shadow: 0 12px 35px -10px rgba(245, 158, 11, 0.4);
    }
    .gradient-expenses {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        box-shadow: 0 12px 35px -10px rgba(239, 68, 68, 0.4);
    }
    .gradient-profit {
        background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);
        box-shadow: 0 12px 35px -10px rgba(139, 92, 246, 0.4);
    }
    .gradient-loss {
        background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);
        box-shadow: 0 12px 35px -10px rgba(220, 38, 38, 0.4);
    }
    .gradient-inventory {
        background: linear-gradient(135deg, #1E293B 0%, #0F172A 100%);
        box-shadow: 0 12px 35px -10px rgba(15, 23, 42, 0.5);
    }

    .gradient-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
    }

    .gradient-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        pointer-events: none;
    }

    .gradient-shape-1 {
        width: 200px; height: 200px;
        top: -100px; right: -50px;
        animation: floatShape 8s ease-in-out infinite;
    }

    .gradient-shape-2 {
        width: 130px; height: 130px;
        bottom: -60px; left: -30px;
        background: rgba(255, 255, 255, 0.06);
        animation: floatShape 10s ease-in-out infinite reverse;
    }

    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-15px, 15px) scale(1.08); }
    }

    .gradient-content { position: relative; z-index: 2; }

    .icon-box-glass {
        width: 48px; height: 48px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px;
        font-size: 1.4rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        transition: var(--transition-bounce);
    }

    .gradient-card:hover .icon-box-glass {
        transform: scale(1.1) rotate(-8deg);
        background: rgba(255, 255, 255, 0.3);
    }

    .gradient-label {
        color: rgba(255, 255, 255, 0.75);
        font-weight: 700;
        font-size: 0.7rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .gradient-title {
        color: rgba(255, 255, 255, 0.85);
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 4px;
    }

    .gradient-value {
        color: white;
        font-weight: 800;
        font-size: 1.5rem;
        letter-spacing: -1px;
        margin-bottom: 6px;
        line-height: 1.2;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: var(--transition-bounce);
    }

    .gradient-card:hover .gradient-value { transform: scale(1.03); }

    .gradient-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.75rem;
        margin: 0;
    }

    /* ============================================ */
    /* ACTIVITY CARDS (Recent Activity)            */
    /* ============================================ */
    .activity-card {
        background: var(--surface-card);
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04);
        transition: var(--transition-bounce);
        height: 100%;
        overflow: hidden;
    }

    .activity-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -12px rgba(59, 130, 246, 0.12);
        border-color: rgba(59, 130, 246, 0.15);
    }

    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 20px 12px;
    }

    .activity-title {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 0.9rem;
        margin: 0;
    }

    .activity-link {
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition-smooth);
    }

    .activity-link:hover { color: var(--primary-electric); }

    .activity-body {
        padding: 0 20px 20px;
    }

    .activity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dashed #F1F5F9;
    }

    .activity-item:last-child { border-bottom: none; }

    .activity-icon {
        width: 34px; height: 34px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 9px;
        font-size: 1rem;
        flex-shrink: 0;
        margin-right: 10px;
    }

    .activity-icon-success { background: linear-gradient(135deg, #ECFDF5, #D1FAE5); color: var(--accent-mint); }
    .activity-icon-warning { background: linear-gradient(135deg, #FFFBEB, #FEF3C7); color: var(--warm-amber); }
    .activity-icon-danger { background: linear-gradient(135deg, #FEF2F2, #FEE2E2); color: var(--rose-red); }
    .activity-icon-violet { background: linear-gradient(135deg, #F5F3FF, #EDE9FE); color: var(--violet-deep); }

    .activity-name {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.82rem;
        display: block;
        line-height: 1.2;
    }

    .activity-meta {
        color: var(--text-muted);
        font-size: 0.7rem;
    }

    .activity-amount {
        font-weight: 800;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .activity-empty {
        text-align: center;
        padding: 20px 0;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .text-success { color: var(--accent-mint) !important; }
    .text-warning { color: var(--warm-amber) !important; }
    .text-danger { color: var(--rose-red) !important; }
    .text-violet { color: var(--violet-deep) !important; }

    /* ============================================ */
    /* LOW STOCK CARD                              */
    /* ============================================ */
    .low-stock-card {
        background: var(--surface-card);
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-left: 4px solid var(--rose-red) !important;
        box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04);
        overflow: hidden;
        transition: var(--transition-bounce);
    }

    .low-stock-card:hover {
        box-shadow: 0 20px 40px -12px rgba(239, 68, 68, 0.15);
    }

    .low-stock-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px 24px 16px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .low-stock-title {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.05rem;
        margin: 0;
    }

    .btn-light-action {
        background: white;
        border: 1px solid var(--border-light);
        color: var(--text-soft);
        font-weight: 700;
        font-size: 0.8rem;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
    }

    .btn-light-action:hover {
        color: var(--primary-electric);
        border-color: var(--primary-electric);
        transform: translateX(2px);
    }

    .low-stock-table {
        width: 100%;
        border-collapse: collapse;
    }

    .low-stock-table thead th {
        text-align: left;
        padding: 14px 24px;
        color: var(--text-muted);
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1px solid var(--border-light);
        background: #F8FAFC;
    }

    .low-stock-table tbody td {
        padding: 16px 24px;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .low-stock-table tbody tr { transition: var(--transition-smooth); }

    .low-stock-table tbody tr:hover {
        background: linear-gradient(90deg, rgba(239, 68, 68, 0.02) 0%, rgba(16, 185, 129, 0.01) 100%);
    }

    .plate-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #F8FAFC;
        border: 1px solid var(--border-light);
        color: var(--text-soft);
        font-weight: 600;
        font-size: 0.78rem;
        padding: 6px 12px;
        border-radius: 8px;
        font-family: 'SF Mono', Monaco, Consolas, monospace;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #FEF2F2, #FEE2E2);
        border: 1px solid rgba(239, 68, 68, 0.15);
        color: var(--rose-red);
        font-weight: 700;
        font-size: 0.8rem;
        padding: 6px 14px;
        border-radius: 10px;
    }

    .btn-restock {
        background: linear-gradient(105deg, var(--primary-electric) 0%, var(--primary-deep) 100%);
        border: none;
        color: white;
        font-weight: 700;
        font-size: 0.8rem;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: var(--transition-bounce);
        box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.4);
    }

    .btn-restock:hover {
        transform: translateY(-2px) scale(1.03);
        color: white;
        box-shadow: 0 8px 20px -6px rgba(59, 130, 246, 0.5);
    }

    /* ============================================ */
    /* ENTRANCE ANIMATIONS                         */
    /* ============================================ */
    .fade-in-up {
        animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .stat-card, .gradient-card, .activity-card {
        opacity: 0;
        animation: fadeInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    /* Staggered animation delays */
    .row.g-4 > div:nth-child(1) .stat-card,
    .row.g-4 > div:nth-child(1) .gradient-card,
    .row.g-4 > div:nth-child(1) .activity-card { animation-delay: 0.1s; }

    .row.g-4 > div:nth-child(2) .stat-card,
    .row.g-4 > div:nth-child(2) .gradient-card,
    .row.g-4 > div:nth-child(2) .activity-card { animation-delay: 0.18s; }

    .row.g-4 > div:nth-child(3) .stat-card,
    .row.g-4 > div:nth-child(3) .gradient-card,
    .row.g-4 > div:nth-child(3) .activity-card { animation-delay: 0.26s; }

    .row.g-4 > div:nth-child(4) .stat-card,
    .row.g-4 > div:nth-child(4) .gradient-card,
    .row.g-4 > div:nth-child(4) .activity-card { animation-delay: 0.34s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .stat-value { font-size: 1.6rem; }
        .gradient-value { font-size: 1.25rem; }
        .gradient-card { min-height: auto; padding: 20px; }
        .low-stock-header { padding: 20px 16px 12px; }
        .low-stock-table thead th,
        .low-stock-table tbody td { padding: 12px 16px; font-size: 0.85rem; }
    }
</style>

<!-- Number Count-Up Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat values counting up
        document.querySelectorAll('.stat-value').forEach(function(el) {
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
    });
</script>
@endsection