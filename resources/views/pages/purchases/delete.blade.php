@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 delete-invoice-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Delete Invoice</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-warning me-1"></i>
                Please review the details below before deleting.
            </p>
        </div>
        <a href="{{ route('purchases.index') }}" class="btn btn-back">
            <i class="ph ph-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Delete Confirmation Card — Premium -->
    <div class="delete-card fade-in-up">
        <!-- Animated Top Gradient Border (Danger themed) -->
        <div class="delete-card-border"></div>
        
        <!-- Decorative Background Shapes -->
        <div class="delete-shape delete-shape-1"></div>
        <div class="delete-shape delete-shape-2"></div>
        
        <div class="card-body p-4 p-md-5 text-center position-relative">
            
            <!-- Warning Icon — Animated Pulse -->
            <div class="warning-icon-wrapper mx-auto mb-4">
                <div class="warning-icon-pulse"></div>
                <div class="warning-icon-pulse warning-icon-pulse-delay"></div>
                <div class="warning-icon">
                    <i class="ph-fill ph-warning-octagon"></i>
                </div>
            </div>

            <h4 class="delete-title mb-2">Are you sure?</h4>
            <p class="delete-subtitle mb-4">
                Deleting this purchase will <strong>reverse the stock</strong> that was added to the products.<br>
                <strong class="text-danger">This action cannot be undone.</strong>
            </p>

            <!-- Invoice Details Box -->
            <div class="details-box text-start mb-4">
                <!-- Invoice Number -->
                <div class="detail-item">
                    <div class="detail-icon icon-primary-soft">
                        <i class="ph ph-receipt"></i>
                    </div>
                    <div class="detail-content">
                        <span class="detail-label">Invoice #</span>
                        <span class="detail-value detail-mono">{{ $purchase->invoice_number }}</span>
                    </div>
                </div>

                <!-- Supplier -->
                <div class="detail-item">
                    <div class="detail-icon icon-success-soft">
                        <i class="ph ph-truck"></i>
                    </div>
                    <div class="detail-content">
                        <span class="detail-label">Supplier</span>
                        <span class="detail-value">{{ $purchase->supplier->name ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="detail-item detail-item-last">
                    <div class="detail-icon icon-warning-soft">
                        <i class="ph ph-currency-dollar"></i>
                    </div>
                    <div class="detail-content">
                        <span class="detail-label">Total Amount</span>
                        <span class="detail-value detail-price">${{ number_format($purchase->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" class="delete-form d-flex justify-content-center gap-3">
                @csrf
                @method('DELETE')
                <a href="{{ route('purchases.index') }}" class="btn btn-cancel-delete">
                    <i class="ph ph-x me-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-delete-confirm">
                    <i class="ph ph-trash me-1"></i> Yes, Delete Invoice
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ============ PREMIUM DELETE INVOICE STYLES ============ -->
<style>
    /* --- THEME VARIABLES --- */
    :root {
        --primary-electric: #3B82F6;
        --primary-deep: #2563EB;
        --accent-mint: #10B981;
        --accent-mint-light: #D1FAE5;
        --warm-amber: #F59E0B;
        --rose-red: #EF4444;
        --rose-deep: #DC2626;
        --rose-dark: #B91C1C;
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
        background: linear-gradient(90deg, var(--rose-red), var(--warm-amber));
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
        color: var(--rose-red);
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

    /* --- DELETE CARD --- */
    .delete-card {
        background: var(--surface-card);
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08);
        transition: var(--transition-smooth);
        max-width: 620px;
        margin: 0 auto;
    }

    .delete-card:hover {
        box-shadow: 0 20px 60px -16px rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.15);
    }

    /* Animated top gradient border — danger themed */
    .delete-card-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--rose-red), var(--warm-amber), var(--rose-red));
        background-size: 200% 100%;
        animation: gradientShiftDanger 4s ease infinite;
    }

    @keyframes gradientShiftDanger {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Decorative floating shapes */
    .delete-shape {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        opacity: 0.5;
    }

    .delete-shape-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -100px;
        background: radial-gradient(circle, rgba(239, 68, 68, 0.05) 0%, transparent 70%);
        animation: floatShape 10s ease-in-out infinite;
    }

    .delete-shape-2 {
        width: 250px;
        height: 250px;
        bottom: -120px;
        left: -80px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.05) 0%, transparent 70%);
        animation: floatShape 12s ease-in-out infinite reverse;
    }

    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(20px, -20px) scale(1.08); }
    }

    /* --- WARNING ICON WITH PULSE RINGS --- */
    .warning-icon-wrapper {
        position: relative;
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .warning-icon-pulse {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: rgba(239, 68, 68, 0.15);
        animation: pulseRing 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .warning-icon-pulse-delay {
        animation-delay: 1.25s;
    }

    @keyframes pulseRing {
        0% {
            transform: scale(0.9);
            opacity: 0.8;
        }
        100% {
            transform: scale(1.8);
            opacity: 0;
        }
    }

    .warning-icon {
        position: relative;
        width: 90px;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        border-radius: 26px;
        font-size: 3rem;
        color: var(--rose-red);
        box-shadow: 0 12px 30px -10px rgba(239, 68, 68, 0.5);
        animation: iconShake 3s ease-in-out infinite;
        z-index: 1;
    }

    @keyframes iconShake {
        0%, 90%, 100% { transform: rotate(0deg); }
        92% { transform: rotate(-8deg); }
        94% { transform: rotate(8deg); }
        96% { transform: rotate(-5deg); }
        98% { transform: rotate(5deg); }
    }

    /* --- DELETE TEXT --- */
    .delete-title {
        color: var(--text-dark);
        font-weight: 800;
        font-size: 1.6rem;
        letter-spacing: -0.5px;
        margin-bottom: 12px;
    }

    .delete-subtitle {
        color: var(--text-soft);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 28px;
    }

    .delete-subtitle strong {
        color: var(--rose-red);
        font-weight: 700;
    }

    /* --- DETAILS BOX --- */
    .details-box {
        background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
        padding: 8px 24px;
        border-radius: 18px;
        border: 1px solid #F1F5F9;
        position: relative;
        overflow: hidden;
    }

    .details-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--rose-red), var(--warm-amber), var(--primary-electric), var(--accent-mint));
        border-radius: 4px 0 0 4px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 0;
        border-bottom: 1px dashed #E2E8F0;
        transition: var(--transition-smooth);
    }

    .detail-item-last {
        border-bottom: none;
    }

    .detail-item:hover {
        transform: translateX(6px);
    }

    .detail-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 1.3rem;
        transition: var(--transition-bounce);
    }

    .detail-item:hover .detail-icon {
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

    .detail-content {
        display: flex;
        flex-direction: column;
        gap: 3px;
        min-width: 0;
    }

    .detail-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
    }

    .detail-value {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-dark);
        word-break: break-word;
    }

    .detail-mono {
        font-family: 'SF Mono', Monaco, Consolas, monospace;
        letter-spacing: 0.5px;
    }

    .detail-price {
        color: var(--accent-mint);
        font-size: 1rem;
    }

    /* --- ACTION BUTTONS --- */
    .delete-form {
        flex-wrap: wrap;
    }

    /* Cancel Button */
    .btn-cancel-delete {
        background: white;
        border: 1.5px solid var(--border-light);
        color: var(--text-soft);
        border-radius: 12px;
        padding: 13px 30px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .btn-cancel-delete:hover {
        background: #F8FAFC;
        color: var(--text-dark);
        border-color: #CBD5E1;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -8px rgba(15, 23, 42, 0.15);
    }

    .btn-cancel-delete i {
        transition: var(--transition-bounce);
    }

    .btn-cancel-delete:hover i {
        transform: rotate(90deg);
    }

    /* Delete Confirm Button */
    .btn-delete-confirm {
        background: linear-gradient(105deg, var(--rose-red) 0%, var(--rose-deep) 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 13px 32px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 24px -6px rgba(239, 68, 68, 0.5);
    }

    .btn-delete-confirm::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-delete-confirm:hover::before { left: 100%; }

    .btn-delete-confirm:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 16px 32px -8px rgba(239, 68, 68, 0.6);
        color: white;
        background: linear-gradient(105deg, var(--rose-deep) 0%, var(--rose-dark) 100%);
    }

    .btn-delete-confirm i {
        transition: var(--transition-bounce);
    }

    .btn-delete-confirm:hover i {
        transform: rotate(-15deg) scale(1.15);
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
    .delete-card { animation-delay: 0.15s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-back { width: 100%; justify-content: center; }
        .delete-form { flex-direction: column-reverse; }
        .btn-cancel-delete, .btn-delete-confirm { width: 100%; }
        .delete-title { font-size: 1.35rem; }
        .warning-icon { width: 78px; height: 78px; font-size: 2.5rem; }
        .warning-icon-wrapper { width: 88px; height: 88px; }
        .details-box { padding: 4px 18px; }
        .detail-item { padding: 16px 0; gap: 12px; }
        .detail-icon { width: 40px; height: 40px; min-width: 40px; font-size: 1.15rem; }
    }
</style>

<!-- Delete Interaction Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add stagger animation to detail items
        const detailItems = document.querySelectorAll('.detail-item');
        detailItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.animation = `fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) ${0.3 + index * 0.08}s forwards`;
        });

        // Delete confirmation with loading state
        const deleteForm = document.querySelector('.delete-form');
        const deleteBtn = document.querySelector('.btn-delete-confirm');
        
        if (deleteForm && deleteBtn) {
            deleteForm.addEventListener('submit', function(e) {
                // Show loading state
                deleteBtn.innerHTML = '<i class="ph ph-circle-notch me-1 spinner-icon"></i> Deleting...';
                deleteBtn.style.pointerEvents = 'none';
                deleteBtn.style.opacity = '0.85';
            });
        }
    });
</script>

<style>
    /* Spinner animation for delete button */
    .spinner-icon {
        display: inline-block;
        animation: spin 0.8s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endsection