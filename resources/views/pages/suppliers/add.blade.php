@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 supplier-form-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Add New Supplier</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-sparkle me-1"></i>
                Fill in the details below to register a new supplier.
            </p>
        </div>
        <a href="{{ route('suppliers.index') }}" class="btn btn-back">
            <i class="ph ph-arrow-left me-1"></i> Back to List
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

    <!-- Main Form Card — Premium -->
    <div class="form-card fade-in-up">
        <!-- Animated Top Gradient Border -->
        <div class="form-card-border"></div>
        <!-- Decorative Background Shapes -->
        <div class="form-shape form-shape-1"></div>
        <div class="form-shape form-shape-2"></div>
        
        <div class="card-body p-4 p-md-5 position-relative">
            
            <!-- Form Section Header -->
            <div class="form-section-header">
                <div class="section-icon">
                    <i class="ph ph-truck"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 section-title">Supplier Information</h5>
                    <p class="text-muted mb-0 section-subtitle">Enter the contact details of your new supplier</p>
                </div>
            </div>

            <form action="{{ route('suppliers.store') }}" method="POST" class="supplier-form">
                @csrf
                
                <div class="row g-4">
                    <!-- Supplier Name -->
                    <div class="col-md-6">
                        <label class="form-label-premium">
                            Supplier Name <span class="required-star">*</span>
                        </label>
                        <div class="input-group-premium">
                            <span class="input-icon">
                                <i class="ph ph-truck"></i>
                            </span>
                            <input type="text" name="name" 
                                   class="form-control-premium @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   required 
                                   placeholder="e.g., Exide Distributors">
                        </div>
                        @error('name')
                            <div class="field-error">
                                <i class="ph ph-warning-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="col-md-6">
                        <label class="form-label-premium">
                            Phone Number
                        </label>
                        <div class="input-group-premium">
                            <span class="input-icon">
                                <i class="ph ph-phone"></i>
                            </span>
                            <input type="text" name="phone" 
                                   class="form-control-premium @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone') }}" 
                                   placeholder="e.g., +92 300 1234567">
                        </div>
                        @error('phone')
                            <div class="field-error">
                                <i class="ph ph-warning-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="col-md-6">
                        <label class="form-label-premium">
                            Email Address
                        </label>
                        <div class="input-group-premium">
                            <span class="input-icon">
                                <i class="ph ph-envelope"></i>
                            </span>
                            <input type="email" name="email" 
                                   class="form-control-premium @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   placeholder="e.g., info@supplier.com">
                        </div>
                        @error('email')
                            <div class="field-error">
                                <i class="ph ph-warning-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <label class="form-label-premium">
                            Address
                        </label>
                        <div class="input-group-premium">
                            <span class="input-icon">
                                <i class="ph ph-map-pin"></i>
                            </span>
                            <input type="text" name="address" 
                                   class="form-control-premium @error('address') is-invalid @enderror" 
                                   value="{{ old('address') }}" 
                                   placeholder="e.g., 123 Main Street, Lahore">
                        </div>
                        @error('address')
                            <div class="field-error">
                                <i class="ph ph-warning-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-cancel">
                        <i class="ph ph-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="ph ph-floppy-disk me-1"></i> Save Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============ PREMIUM SUPPLIER FORM STYLES ============ -->
<style>
    /* --- THEME VARIABLES --- */
    :root {
        --primary-electric: #3B82F6;
        --primary-deep: #2563EB;
        --accent-mint: #10B981;
        --accent-mint-light: #D1FAE5;
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
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.08), transparent);
        transition: left 0.5s ease;
    }

    .btn-back:hover::before { left: 100%; }

    .btn-back:hover {
        color: var(--accent-mint);
        border-color: var(--accent-mint);
        transform: translateX(-4px);
        box-shadow: 0 8px 20px -8px rgba(16, 185, 129, 0.4);
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
        box-shadow: 0 20px 60px -16px rgba(16, 185, 129, 0.15);
        border-color: rgba(16, 185, 129, 0.15);
    }

    /* Animated top gradient border */
    .form-card-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-mint), var(--primary-electric), var(--accent-mint));
        background-size: 200% 100%;
        animation: gradientShift 4s ease infinite;
    }

    @keyframes gradientShift {
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
        background: radial-gradient(circle, rgba(16, 185, 129, 0.06) 0%, transparent 70%);
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
    }

    .form-section-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, var(--accent-mint), var(--primary-electric));
        border-radius: 10px;
    }

    .section-icon {
        width: 56px;
        height: 56px;
        min-width: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        border-radius: 16px;
        font-size: 1.6rem;
        color: var(--accent-mint);
        box-shadow: 0 8px 20px -8px rgba(16, 185, 129, 0.4);
        transition: var(--transition-bounce);
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

    /* --- FORM LABELS --- */
    .form-label-premium {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--text-soft);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 4px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        transition: var(--transition-smooth);
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
        border-color: var(--accent-mint);
        background: white;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1), 0 8px 20px -8px rgba(16, 185, 129, 0.3);
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
        background: linear-gradient(135deg, var(--accent-mint), #059669);
        color: white;
    }

    .input-group-premium:focus-within .input-icon i {
        transform: scale(1.15);
    }

    .input-icon i { transition: var(--transition-bounce); }

    .form-control-premium {
        flex: 1;
        border: none;
        background: transparent;
        padding: 16px 20px;
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-dark);
        outline: none;
        font-family: inherit;
        transition: var(--transition-smooth);
        min-width: 0;
    }

    .form-control-premium::placeholder {
        color: #CBD5E1;
        font-weight: 400;
    }

    .form-control-premium.is-invalid {
        color: var(--rose-red);
    }

    .input-group-premium:has(.is-invalid) {
        border-color: var(--rose-red);
        background: #FEF2F2;
    }

    .input-group-premium:has(.is-invalid) .input-icon {
        background: rgba(239, 68, 68, 0.15);
        color: var(--rose-red);
    }

    /* --- FIELD ERROR --- */
    .field-error {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--rose-red);
        font-size: 0.8rem;
        font-weight: 500;
        margin-top: 8px;
        padding-left: 4px;
        animation: fadeInUp 0.3s ease forwards;
    }

    .field-error i {
        font-size: 0.95rem;
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
        background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
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

    /* Save Button — Premium Mint Gradient */
    .btn-save {
        background: linear-gradient(105deg, var(--accent-mint) 0%, #059669 100%);
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
        box-shadow: 0 8px 24px -6px rgba(16, 185, 129, 0.5);
    }

    .btn-save::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-save:hover::before { left: 100%; }

    .btn-save:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 16px 32px -8px rgba(16, 185, 129, 0.6);
        color: white;
    }

    .btn-save:hover i {
        transform: rotate(-15deg) scale(1.15);
    }

    .btn-save i { transition: var(--transition-bounce); }

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
    .form-card { animation-delay: 0.2s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-back { width: 100%; justify-content: center; }
        .form-section-header { flex-direction: column; align-items: flex-start; }
        .form-actions { flex-direction: column-reverse; }
        .btn-cancel, .btn-save { width: 100%; justify-content: center; }
        .input-icon { padding: 0 14px; min-width: 48px; }
        .form-control-premium { padding: 14px 16px; font-size: 0.95rem; }
    }

    /* --- FOCUS VISIBLE ACCESSIBILITY --- */
    .form-control-premium:focus-visible,
    .btn-save:focus-visible,
    .btn-cancel:focus-visible,
    .btn-back:focus-visible {
        outline: 2px solid var(--accent-mint);
        outline-offset: 2px;
    }
</style>

<!-- Form Interaction Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add subtle stagger animation to form fields
        const formFields = document.querySelectorAll('.col-md-6');
        formFields.forEach((field, index) => {
            field.style.opacity = '0';
            field.style.animation = `fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) ${0.25 + index * 0.08}s forwards`;
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

        // Form submit — show loading state on save button
        const form = document.querySelector('.supplier-form');
        const saveBtn = document.querySelector('.btn-save');
        
        if (form && saveBtn) {
            form.addEventListener('submit', function() {
                saveBtn.innerHTML = '<i class="ph ph-circle-notch me-1 spinner-icon"></i> Saving...';
                saveBtn.style.pointerEvents = 'none';
                saveBtn.style.opacity = '0.85';
            });
        }
    });
</script>

<style>
    /* Spinner animation for save button */
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
