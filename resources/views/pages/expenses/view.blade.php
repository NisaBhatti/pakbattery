@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Expense Details</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-receipt me-1"></i>
                Full details for this expense
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-edit-action">
                <i class="ph ph-pencil-simple me-1"></i> Edit
            </a>
            <a href="{{ route('expenses.index') }}" class="btn btn-back">
                <i class="ph ph-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="details-card fade-in-up">
        <div class="hero-header">
            <div class="hero-shape hero-shape-1"></div>
            <div class="hero-shape hero-shape-2"></div>
            <div class="hero-content">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center">
                        <div class="hero-icon-box">
                            <i class="ph ph-receipt-x"></i>
                        </div>
                        <div class="hero-text">
                            <span class="hero-badge">
                                <i class="ph ph-tag"></i> {{ $expense->category }}
                            </span>
                            <h2 class="hero-title">{{ $expense->title }}</h2>
                            <p class="hero-subtitle">
                                <i class="ph ph-calendar"></i>
                                <span class="hero-date">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M, Y') }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="hero-total">
                        <span class="hero-total-label">AMOUNT</span>
                        <h1 class="hero-total-value">${{ number_format($expense->amount, 2) }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-violet-soft"><i class="ph ph-text-t"></i></div>
                        <div class="info-content">
                            <span class="info-label">Title</span>
                            <span class="info-value">{{ $expense->title }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-primary-soft"><i class="ph ph-tag"></i></div>
                        <div class="info-content">
                            <span class="info-label">Category</span>
                            <span class="info-value">{{ $expense->category }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-success-soft"><i class="ph ph-currency-dollar"></i></div>
                        <div class="info-content">
                            <span class="info-label">Amount</span>
                            <span class="info-value" style="color: #10B981;">${{ number_format($expense->amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-violet-soft"><i class="ph ph-calendar"></i></div>
                        <div class="info-content">
                            <span class="info-label">Expense Date</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M, Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-icon icon-primary-soft"><i class="ph ph-credit-card"></i></div>
                        <div class="info-content">
                            <span class="info-label">Payment Method</span>
                            <span class="info-value">{{ $expense->payment_method ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                @if($expense->description)
                <div class="col-md-12">
                    <div class="info-box">
                        <div class="info-icon icon-success-soft"><i class="ph ph-note-pencil"></i></div>
                        <div class="info-content">
                            <span class="info-label">Description</span>
                            <span class="info-value">{{ $expense->description }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    :root { --violet-core: #8B5CF6; --violet-deep: #7C3AED; --accent-mint: #10B981; --primary-electric: #3B82F6; --rose-red: #EF4444; --text-dark: #0F172A; --text-soft: #475569; --text-muted: #94A3B8; --border-light: #E2E8F0; --transition-bounce: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); }
    .page-title { color: var(--text-dark); font-size: 1.75rem; position: relative; display: inline-block; }
    .page-title::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); border-radius: 10px; }
    .page-subtitle { font-size: 0.9rem; display: flex; align-items: center; }
    .page-subtitle i { color: var(--violet-core); }
    .btn-back { background: white; border: 1px solid var(--border-light); color: var(--text-dark); border-radius: 12px; padding: 11px 22px; font-weight: 600; display: inline-flex; align-items: center; transition: var(--transition-bounce); text-decoration: none; }
    .btn-back:hover { color: var(--violet-deep); border-color: var(--violet-core); }
    .btn-edit-action { background: linear-gradient(105deg, #F59E0B, #D97706); border: none; color: white; border-radius: 12px; padding: 11px 22px; font-weight: 600; display: inline-flex; align-items: center; transition: var(--transition-bounce); text-decoration: none; box-shadow: 0 8px 20px -6px rgba(245, 158, 11, 0.5); }
    .btn-edit-action:hover { transform: translateY(-3px); color: white; box-shadow: 0 15px 30px -8px rgba(245, 158, 11, 0.6); }

    .details-card { background: white; border-radius: 24px; border: 1px solid rgba(226, 232, 240, 0.6); overflow: hidden; box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08); }

    .hero-header { background: linear-gradient(135deg, var(--violet-core) 0%, var(--violet-deep) 50%, #5B21B6 100%); padding: 40px 45px; position: relative; overflow: hidden; }
    .hero-header::after { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent); animation: shineSweep 5s ease-in-out infinite; }
    @keyframes shineSweep { 0%, 100% { left: -100%; } 50% { left: 100%; } }
    .hero-shape { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.08); pointer-events: none; }
    .hero-shape-1 { width: 300px; height: 300px; top: -120px; right: -80px; animation: floatShape 9s ease-in-out infinite; }
    .hero-shape-2 { width: 180px; height: 180px; bottom: -70px; left: 20%; background: rgba(255,255,255,0.05); animation: floatShape 11s ease-in-out infinite reverse; }
    @keyframes floatShape { 0%, 100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-15px,15px) scale(1.08); } }
    .hero-content { position: relative; z-index: 2; }
    .hero-icon-box { width: 88px; height: 88px; min-width: 88px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.95); border-radius: 24px; font-size: 2.6rem; color: var(--violet-core); box-shadow: 0 20px 40px -12px rgba(0,0,0,0.2); margin-right: 28px; }
    .hero-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.25); color: white; font-size: 0.72rem; font-weight: 700; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
    .hero-title { color: white; font-weight: 800; font-size: 2rem; letter-spacing: -1px; margin-bottom: 8px; }
    .hero-subtitle { display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.85); font-size: 0.95rem; margin: 0; }
    .hero-date { background: rgba(255,255,255,0.15); padding: 3px 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); }
    .hero-total { text-align: right; }
    .hero-total-label { display: block; color: rgba(255,255,255,0.75); font-size: 0.75rem; font-weight: 700; letter-spacing: 2px; margin-bottom: 8px; }
    .hero-total-value { color: white; font-weight: 800; font-size: 2.5rem; letter-spacing: -1.5px; margin: 0; line-height: 1; }

    .info-box { display: flex; align-items: center; padding: 20px 22px; background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%); border-radius: 16px; border: 1px solid #F1F5F9; transition: var(--transition-bounce); height: 100%; }
    .info-box:hover { background: white; box-shadow: 0 12px 30px -10px rgba(139, 92, 246, 0.15); transform: translateY(-4px); }
    .info-icon { width: 52px; height: 52px; min-width: 52px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.4rem; margin-right: 16px; }
    .icon-violet-soft { background: linear-gradient(135deg, #F5F3FF, #EDE9FE); color: var(--violet-deep); }
    .icon-primary-soft { background: linear-gradient(135deg, #EEF2FF, #DBEAFE); color: var(--primary-electric); }
    .icon-success-soft { background: linear-gradient(135deg, #ECFDF5, #D1FAE5); color: var(--accent-mint); }
    .info-content { flex: 1; }
    .info-label { display: block; font-size: 0.7rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
    .info-value { display: block; font-size: 1rem; color: var(--text-dark); font-weight: 700; word-break: break-word; }

    .fade-in-up { animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(25px); } to { opacity: 1; transform: translateY(0); } }
    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .page-header .d-flex { width: 100%; }
        .btn-edit-action, .btn-back { flex: 1; justify-content: center; }
        .hero-header { padding: 28px 24px; }
        .hero-icon-box { width: 68px; height: 68px; min-width: 68px; font-size: 2rem; margin-right: 18px; }
        .hero-title { font-size: 1.4rem; }
        .hero-total { text-align: left; margin-top: 20px; width: 100%; }
        .hero-total-value { font-size: 1.8rem; }
    }
</style>
@endsection