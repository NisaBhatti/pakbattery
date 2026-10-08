@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 customer-view-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Customer Details</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-info me-1"></i>
                Complete information about this customer.
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-edit-action">
                <i class="ph ph-pencil-simple me-1"></i> Edit
            </a>
            <a href="{{ route('customers.index') }}" class="btn btn-back">
                <i class="ph ph-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <!-- Main Details Card — Premium -->
    <div class="details-card fade-in-up">
        
        <!-- Hero Header (Premium Rose-Magenta Gradient) -->
        <div class="hero-header">
            <!-- Animated Background Shapes -->
            <div class="hero-shape hero-shape-1"></div>
            <div class="hero-shape hero-shape-2"></div>
            <div class="hero-shape hero-shape-3"></div>
            
            <div class="hero-content">
                <div class="d-flex align-items-center">
                    <div class="hero-icon-box">
                        <i class="ph ph-user"></i>
                    </div>
                    <div class="hero-text">
                        <span class="hero-badge">
                            <i class="ph ph-check-circle-fill"></i>
                            Active Customer
                        </span>
                        <h2 class="hero-title">{{ $customer->name }}</h2>
                        <p class="hero-subtitle">
                            <i class="ph ph-calendar"></i>
                            <span class="hero-date">Added {{ $customer->created_at->format('d M, Y') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="card-body p-4 p-md-5">
            
            <!-- Section Header -->
            <div class="details-section-header">
                <div class="section-icon section-icon-customer">
                    <i class="ph ph-address-book"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 section-title">Contact Information</h5>
                    <p class="text-muted mb-0 section-subtitle">Complete details and metadata</p>
                </div>
            </div>

            <div class="row g-4">
                
                <!-- Customer Name -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-primary-soft">
                            <i class="ph ph-user"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Customer Name</span>
                            <span class="info-value">{{ $customer->name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-success-soft">
                            <i class="ph ph-phone"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Phone</span>
                            <span class="info-value info-mono">{{ $customer->phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-warning-soft">
                            <i class="ph ph-envelope"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $customer->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-danger-soft">
                            <i class="ph ph-map-pin"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Address</span>
                            <span class="info-value">{{ $customer->address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Created At -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-primary-soft">
                            <i class="ph ph-calendar-plus"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Created At</span>
                            <span class="info-value">{{ $customer->created_at->format('d M, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Last Updated -->
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-success-soft">
                            <i class="ph ph-clock-counter-clockwise"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Last Updated</span>
                            <span class="info-value">{{ $customer->updated_at->format('d M, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ============ PREMIUM CUSTOMER VIEW STYLES ============ -->
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
        --rose-magenta-deep: #DB2777;
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
        background: linear-gradient(90deg, var(--rose-magenta), var(--primary-electric));
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
        color: var(--rose-magenta);
    }

    /* --- HEADER BUTTONS --- */
    .btn-edit-action {
        background: linear-gradient(105deg, var(--warm-amber) 0%, #D97706 100%);
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
        box-shadow: 0 8px 20px -6px rgba(245, 158, 11, 0.5);
        text-decoration: none;
    }

    .btn-edit-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-edit-action:hover::before {
        left: 100%;
    }

    .btn-edit-action:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 30px -8px rgba(245, 158, 11, 0.6);
        color: white;
    }

    .btn-edit-action i {
        transition: var(--transition-bounce);
    }

    .btn-edit-action:hover i {
        transform: rotate(-15deg) scale(1.15);
    }

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

    .btn-back:hover::before {
        left: 100%;
    }

    .btn-back:hover {
        background: white;
        color: var(--primary-electric);
        border-color: var(--primary-electric);
        transform: translateX(-4px);
        box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.4);
    }

    .btn-back i {
        transition: var(--transition-bounce);
    }

    .btn-back:hover i {
        transform: translateX(-3px);
    }

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
        box-shadow: 0 20px 60px -16px rgba(236, 72, 153, 0.15);
        border-color: rgba(236, 72, 153, 0.15);
    }

    /* --- HERO HEADER (Rose-Magenta) --- */
    .hero-header {
        background: linear-gradient(135deg, var(--rose-magenta) 0%, var(--rose-magenta-deep) 50%, var(--primary-deep) 100%);
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
        color: var(--rose-magenta);
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
        word-break: break-word;
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

    /* --- DETAILS SECTION HEADER --- */
    .details-section-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 24px;
        margin-bottom: 32px;
        border-bottom: 1px solid var(--border-light);
        position: relative;
    }

    .details-section-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, var(--rose-magenta), var(--primary-electric));
        border-radius: 10px;
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

    .section-icon-customer {
        background: linear-gradient(135deg, #FDF2F8 0%, #FCE7F3 100%);
        color: var(--rose-magenta-deep);
        box-shadow: 0 8px 20px -8px rgba(236, 72, 153, 0.4);
    }

    .details-card:hover .section-icon {
        transform: rotate(-8deg) scale(1.05);
    }

    .section-title {
        color: var(--text-dark);
        font-size: 1.1rem;
        letter-spacing: -0.3px;
    }

    .section-subtitle {
        font-size: 0.85rem;
    }

    /* --- INFO BOXES --- */
    .info-box {
        display: flex;
        align-items: center;
        padding: 20px 22px;
        background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
        border-radius: 16px;
        border: 1px solid #F1F5F9;
        transition: var(--transition-bounce);
        height: 100%;
        position: relative;
        overflow: hidden;
        cursor: default;
    }

    .info-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, var(--rose-magenta), var(--primary-electric));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .info-box:hover::before {
        opacity: 1;
    }

    .info-box:hover {
        background: white;
        box-shadow: 0 12px 30px -10px rgba(236, 72, 153, 0.15);
        transform: translateY(-4px);
        border-color: rgba(236, 72, 153, 0.15);
    }

    .info-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.4rem;
        margin-right: 16px;
        flex-shrink: 0;
        transition: var(--transition-bounce);
    }

    .info-box:hover .info-icon {
        transform: scale(1.1) rotate(-8deg);
    }

    .icon-primary-soft {
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
        color: var(--primary-electric);
        box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.3);
    }

    .icon-success-soft {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: var(--accent-mint);
        box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3);
    }

    .icon-warning-soft {
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
        color: var(--warm-amber);
        box-shadow: 0 4px 12px -4px rgba(245, 158, 11, 0.3);
    }

    .icon-danger-soft {
        background: linear-gradient(135deg, #FDF2F8 0%, #FCE7F3 100%);
        color: var(--rose-magenta-deep);
        box-shadow: 0 4px 12px -4px rgba(236, 72, 153, 0.3);
    }

    .info-content {
        flex: 1;
        min-width: 0;
    }

    .info-label {
        display: block;
        font-size: 0.7rem;
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .info-value {
        display: block;
        font-size: 1rem;
        color: var(--text-dark);
        font-weight: 700;
        letter-spacing: -0.2px;
        word-break: break-word;
        transition: var(--transition-smooth);
    }

    .info-box:hover .info-value {
        color: var(--rose-magenta-deep);
    }

    .info-mono {
        font-family: 'SF Mono', Monaco, Consolas, monospace;
        letter-spacing: 0.5px;
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

    /* Staggered info box animations */
    .info-box {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .col-md-6:nth-child(1) .info-box { animation-delay: 0.25s; }
    .col-md-6:nth-child(2) .info-box { animation-delay: 0.32s; }
    .col-md-6:nth-child(3) .info-box { animation-delay: 0.39s; }
    .col-md-6:nth-child(4) .info-box { animation-delay: 0.46s; }
    .col-md-6:nth-child(5) .info-box { animation-delay: 0.53s; }
    .col-md-6:nth-child(6) .info-box { animation-delay: 0.60s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .page-header .d-flex { width: 100%; }
        .btn-edit-action, .btn-back { flex: 1; justify-content: center; }
        
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
        
        .details-section-header { flex-direction: column; align-items: flex-start; }
        .info-box { padding: 16px 18px; }
        .info-icon { width: 46px; height: 46px; min-width: 46px; font-size: 1.25rem; margin-right: 14px; }
        .info-value { font-size: 0.95rem; }
    }

    @media (max-width: 480px) {
        .hero-badge { font-size: 0.65rem; padding: 5px 10px; }
        .hero-title { font-size: 1.2rem; }
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

        // Add copy-to-clipboard for phone number
        const phoneElement = document.querySelector('.hero-subtitle .hero-date');
        if (phoneElement) {
            // No-op for date, keeping utility clean
        }
    });
</script>
@endsection
