@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 dashboard-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Dashboard Overview</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-sparkle me-1"></i>
                Welcome back, here's what's happening with your battery inventory today.
            </p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary-gradient fw-bold">
            <i class="ph ph-plus-circle me-1"></i> Add New Product
        </a>
    </div>

    <!-- Stat Cards Row — Premium Interactive Cards -->
    <div class="row g-4 mb-4">
        
        <!-- Stat Card 1: Total Products -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-primary">
                            <i class="ph ph-package"></i>
                        </div>
                        <span class="badge badge-trend badge-trend-up">
                            <i class="ph ph-trend-up me-1"></i>+12%
                        </span>
                    </div>
                    <h6 class="stat-label">Total Products</h6>
                    <h2 class="stat-value" data-count="{{ $totalProducts }}">{{ $totalProducts }}</h2>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: 78%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 2: Total Suppliers -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-success">
                            <i class="ph ph-truck"></i>
                        </div>
                        <span class="badge badge-trend badge-trend-up">
                            <i class="ph ph-trend-up me-1"></i>+5%
                        </span>
                    </div>
                    <h6 class="stat-label">Total Suppliers</h6>
                    <h2 class="stat-value" data-count="{{ $totalSuppliers }}">{{ $totalSuppliers }}</h2>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: 62%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 3: Total Customers -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-warning">
                            <i class="ph ph-users"></i>
                        </div>
                        <span class="badge badge-trend badge-trend-up">
                            <i class="ph ph-trend-up me-1"></i>+18%
                        </span>
                    </div>
                    <h6 class="stat-label">Total Customers</h6>
                    <h2 class="stat-value" data-count="{{ $totalCustomers }}">{{ $totalCustomers }}</h2>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: 85%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 4: Low Stock Alerts -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-danger {{ $lowStockCount > 0 ? 'has-alert' : '' }}">
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

    <!-- Inventory Value Card — Premium Gradient with Animation -->
    <div class="row g-4">
        <div class="col-12">
            <div class="inventory-card">
                <!-- Animated Background Elements -->
                <div class="inventory-bg-shape shape-1"></div>
                <div class="inventory-bg-shape shape-2"></div>
                <div class="inventory-bg-shape shape-3"></div>
                
                <div class="card-body p-4 p-md-5 d-flex justify-content-between align-items-center position-relative">
                    <div class="inventory-content">
                        <div class="inventory-label">
                            <span class="pulse-dot"></span>
                            Total Inventory Value
                        </div>
                        <h1 class="inventory-value">${{ number_format($totalInventoryValue, 2) }}</h1>
                        <div class="inventory-meta">
                            <span class="meta-item">
                                <i class="ph ph-arrow-up-right text-mint"></i> +8.2% from last month
                            </span>
                        </div>
                    </div>
                    <div class="d-none d-md-block inventory-icon-wrapper">
                        <i class="ph-fill ph-currency-dollar inventory-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    }

    .page-subtitle i {
        color: var(--primary-electric);
    }

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

    .btn-primary-gradient:hover::before {
        left: 100%;
    }

    .btn-primary-gradient:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 15px 30px -8px rgba(59, 130, 246, 0.6);
        color: white;
    }

    .btn-primary-gradient i {
        transition: var(--transition-bounce);
    }

    .btn-primary-gradient:hover i {
        transform: rotate(180deg) scale(1.2);
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

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -12px rgba(59, 130, 246, 0.18);
        border-color: rgba(59, 130, 246, 0.2);
    }

    /* Card glow effect on hover */
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

    .stat-card:hover .stat-card-glow {
        opacity: 1;
    }

    .stat-card-success .stat-card-glow {
        background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%);
    }

    .stat-card-warning .stat-card-glow {
        background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, transparent 70%);
    }

    .stat-card-danger .stat-card-glow {
        background: radial-gradient(circle, rgba(239, 68, 68, 0.08) 0%, transparent 70%);
    }

    /* Alert pulse for danger card */
    .stat-card.has-alert {
        animation: alertPulse 2.5s ease-in-out infinite;
    }

    @keyframes alertPulse {
        0%, 100% { box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04); }
        50% { box-shadow: 0 8px 30px -4px rgba(239, 68, 68, 0.25); }
    }

    /* --- ICON BOXES --- */
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

    .icon-box::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 14px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover .icon-box {
        transform: scale(1.1) rotate(-8deg);
    }

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

    .icon-warning {
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
        color: var(--warm-amber);
        box-shadow: 0 4px 12px -4px rgba(245, 158, 11, 0.3);
    }

    .icon-danger {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        color: var(--rose-red);
        box-shadow: 0 4px 12px -4px rgba(239, 68, 68, 0.3);
    }

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

    .stat-card:hover .stat-value {
        color: var(--primary-electric);
        transform: translateX(4px);
    }

    .stat-card-success:hover .stat-value { color: var(--accent-mint); }
    .stat-card-warning:hover .stat-value { color: var(--warm-amber); }
    .stat-card-danger:hover .stat-value { color: var(--rose-red); }

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

    .badge-trend-up {
        background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
        color: #059669;
    }

    .stat-card:hover .badge-trend {
        transform: scale(1.1);
    }

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

    /* --- INVENTORY VALUE CARD --- */
    .inventory-card {
        border-radius: 24px;
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 45%, #10B981 100%);
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px -12px rgba(59, 130, 246, 0.5);
        transition: var(--transition-bounce);
        min-height: 180px;
    }

    .inventory-card:hover {
        transform: translateY(-4px) scale(1.005);
        box-shadow: 0 30px 60px -12px rgba(59, 130, 246, 0.6);
    }

    /* Animated decorative shapes */
    .inventory-bg-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        pointer-events: none;
    }

    .shape-1 {
        width: 300px;
        height: 300px;
        top: -100px;
        right: -50px;
        animation: floatShape 8s ease-in-out infinite;
    }

    .shape-2 {
        width: 200px;
        height: 200px;
        bottom: -80px;
        right: 20%;
        animation: floatShape 10s ease-in-out infinite reverse;
    }

    .shape-3 {
        width: 150px;
        height: 150px;
        top: 20%;
        right: 40%;
        background: rgba(255, 255, 255, 0.04);
        animation: floatShape 12s ease-in-out infinite;
    }

    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(-15px, 20px) scale(1.05); }
        66% { transform: translate(10px, -15px) scale(0.95); }
    }

    /* Shine sweep effect */
    .inventory-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
        animation: shineSweep 4s ease-in-out infinite;
    }

    @keyframes shineSweep {
        0%, 100% { left: -100%; }
        50% { left: 100%; }
    }

    .inventory-content {
        position: relative;
        z-index: 2;
    }

    .inventory-label {
        color: rgba(255, 255, 255, 0.85);
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        background: var(--accent-mint-light);
        border-radius: 50%;
        box-shadow: 0 0 12px var(--accent-mint-light);
        animation: dotPulse 2s ease-in-out infinite;
    }

    .inventory-value {
        color: white;
        font-weight: 800;
        font-size: 3rem;
        letter-spacing: -2px;
        margin-bottom: 12px;
        line-height: 1;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: var(--transition-bounce);
    }

    .inventory-card:hover .inventory-value {
        transform: translateX(8px) scale(1.02);
    }

    .inventory-meta {
        display: flex;
        gap: 16px;
    }

    .meta-item {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .text-mint {
        color: var(--accent-mint-light);
        font-weight: 700;
    }

    .inventory-icon-wrapper {
        position: relative;
        z-index: 2;
    }

    .inventory-icon {
        font-size: 6rem;
        color: rgba(255, 255, 255, 0.15);
        transition: var(--transition-bounce);
        filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.1));
    }

    .inventory-card:hover .inventory-icon {
        transform: scale(1.1) rotate(8deg);
        color: rgba(255, 255, 255, 0.25);
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

    /* Staggered card animations */
    .stat-card {
        opacity: 0;
        animation: fadeInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .col-xl-3:nth-child(1) .stat-card { animation-delay: 0.1s; }
    .col-xl-3:nth-child(2) .stat-card { animation-delay: 0.2s; }
    .col-xl-3:nth-child(3) .stat-card { animation-delay: 0.3s; }
    .col-xl-3:nth-child(4) .stat-card { animation-delay: 0.4s; }

    .inventory-card {
        opacity: 0;
        animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) 0.5s forwards;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .stat-value { font-size: 1.6rem; }
        .inventory-value { font-size: 2rem; }
        .inventory-icon { font-size: 4rem; }
        .btn-primary-gradient { padding: 10px 18px; font-size: 0.9rem; }
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