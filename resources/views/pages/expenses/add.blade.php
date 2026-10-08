@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Add New Expense</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-sparkle me-1"></i> Record a new business expense.
            </p>
        </div>
        <a href="{{ route('expenses.index') }}" class="btn btn-back">
            <i class="ph ph-arrow-left me-1"></i> Back to List
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-error-premium fade-in-up">
            <div class="alert-icon-wrapper"><i class="ph-fill ph-warning-circle"></i></div>
            <div class="alert-content">
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="form-card fade-in-up">
        <div class="form-card-border"></div>
        <div class="card-body p-4 p-md-5 position-relative">
            <div class="form-section-header">
                <div class="section-icon"><i class="ph ph-receipt-x"></i></div>
                <div>
                    <h5 class="fw-bold mb-0 section-title">Expense Information</h5>
                    <p class="text-muted mb-0 section-subtitle">Fill in the details below</p>
                </div>
            </div>

            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-premium">Expense Title <span class="required-star">*</span></label>
                        <div class="input-group-premium">
                            <span class="input-icon"><i class="ph ph-text-t"></i></span>
                            <input type="text" name="title" class="form-control-premium" value="{{ old('title') }}" required placeholder="e.g., Office Rent">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-premium">Category <span class="required-star">*</span></label>
                        <div class="input-group-premium">
                            <span class="input-icon"><i class="ph ph-tag"></i></span>
                            <select name="category" class="form-control-premium" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-premium">Amount <span class="required-star">*</span></label>
                        <div class="input-group-premium">
                            <span class="input-icon"><i class="ph ph-currency-dollar"></i></span>
                            <input type="number" step="0.01" name="amount" class="form-control-premium" value="{{ old('amount') }}" required placeholder="0.00">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-premium">Expense Date <span class="required-star">*</span></label>
                        <div class="input-group-premium">
                            <span class="input-icon"><i class="ph ph-calendar"></i></span>
                            <input type="date" name="expense_date" class="form-control-premium" value="{{ old('expense_date', date('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-premium">Payment Method</label>
                        <div class="input-group-premium">
                            <span class="input-icon"><i class="ph ph-credit-card"></i></span>
                            <select name="payment_method" class="form-control-premium">
                                <option value="">-- Select Method --</option>
                                <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="Card" {{ old('payment_method') == 'Card' ? 'selected' : '' }}>Card</option>
                                <option value="Cheque" {{ old('payment_method') == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label-premium">Description</label>
                        <div class="input-group-premium">
                            <span class="input-icon"><i class="ph ph-note-pencil"></i></span>
                            <textarea name="description" rows="3" class="form-control-premium" placeholder="Optional notes about this expense...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('expenses.index') }}" class="btn btn-cancel">
                        <i class="ph ph-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="ph ph-floppy-disk me-1"></i> Save Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    :root { --violet-core: #8B5CF6; --violet-deep: #7C3AED; --accent-mint: #10B981; --rose-red: #EF4444; --text-dark: #0F172A; --text-soft: #475569; --text-muted: #94A3B8; --border-light: #E2E8F0; --transition-bounce: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); }
    .page-title { color: var(--text-dark); font-size: 1.75rem; letter-spacing: -0.5px; position: relative; display: inline-block; }
    .page-title::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); border-radius: 10px; }
    .page-header:hover .page-title::after { width: 100%; }
    .page-subtitle { font-size: 0.9rem; display: flex; align-items: center; }
    .page-subtitle i { color: var(--violet-core); }
    .btn-back { background: white; border: 1px solid var(--border-light); color: var(--text-dark); border-radius: 12px; padding: 11px 22px; font-weight: 600; display: inline-flex; align-items: center; transition: var(--transition-bounce); text-decoration: none; }
    .btn-back:hover { color: var(--violet-deep); border-color: var(--violet-core); transform: translateX(-4px); box-shadow: 0 8px 20px -8px rgba(139, 92, 246, 0.4); }
    .alert-error-premium { background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 16px; color: #991B1B; padding: 18px 20px; display: flex; align-items: flex-start; gap: 14px; margin-bottom: 24px; }
    .alert-icon-wrapper { width: 40px; height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; background: rgba(239, 68, 68, 0.15); border-radius: 12px; font-size: 1.4rem; color: var(--rose-red); }
    .form-card { background: white; border-radius: 24px; border: 1px solid rgba(226, 232, 240, 0.6); position: relative; overflow: hidden; box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08); }
    .form-card-border { position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint), var(--violet-core)); background-size: 200% 100%; animation: gradientShift 4s ease infinite; }
    @keyframes gradientShift { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
    .form-section-header { display: flex; align-items: center; gap: 16px; padding-bottom: 24px; margin-bottom: 32px; border-bottom: 1px solid var(--border-light); position: relative; }
    .form-section-header::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 80px; height: 2px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); border-radius: 10px; }
    .section-icon { width: 56px; height: 56px; min-width: 56px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); border-radius: 16px; font-size: 1.6rem; color: var(--violet-deep); box-shadow: 0 8px 20px -8px rgba(139, 92, 246, 0.4); }
    .section-title { color: var(--text-dark); font-size: 1.15rem; }
    .section-subtitle { font-size: 0.85rem; }
    .form-label-premium { font-weight: 700; font-size: 0.78rem; color: var(--text-soft); margin-bottom: 10px; display: flex; align-items: center; gap: 6px; text-transform: uppercase; letter-spacing: 0.8px; }
    .required-star { color: var(--rose-red); font-size: 1rem; }
    .input-group-premium { position: relative; display: flex; align-items: stretch; border-radius: 14px; overflow: hidden; border: 1.5px solid var(--border-light); background: #F8FAFC; transition: var(--transition-bounce); }
    .input-group-premium:focus-within { border-color: var(--violet-core); background: white; box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1); transform: translateY(-2px); }
    .input-icon { display: flex; align-items: center; justify-content: center; padding: 0 18px; background: rgba(226, 232, 240, 0.4); color: var(--text-muted); font-size: 1.25rem; min-width: 56px; transition: var(--transition-bounce); }
    .input-group-premium:focus-within .input-icon { background: linear-gradient(135deg, var(--violet-core), var(--violet-deep)); color: white; }
    .form-control-premium { flex: 1; border: none; background: transparent; padding: 16px 20px; font-size: 1rem; font-weight: 600; color: var(--text-dark); outline: none; font-family: inherit; min-width: 0; }
    .form-control-premium::placeholder { color: #CBD5E1; font-weight: 500; }
    select.form-control-premium { appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 16px center; background-size: 14px; padding-right: 44px; cursor: pointer; }
    textarea.form-control-premium { resize: vertical; }
    .form-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 40px; padding-top: 28px; border-top: 1px solid var(--border-light); }
    .btn-cancel { background: white; border: 1px solid var(--border-light); color: var(--text-soft); border-radius: 12px; padding: 13px 28px; font-weight: 600; display: inline-flex; align-items: center; transition: var(--transition-bounce); text-decoration: none; }
    .btn-cancel:hover { background: #F8FAFC; color: var(--text-dark); border-color: #CBD5E1; transform: translateY(-2px); }
    .btn-save { background: linear-gradient(105deg, var(--violet-core) 0%, var(--violet-deep) 100%); border: none; color: white; border-radius: 12px; padding: 13px 32px; font-weight: 700; display: inline-flex; align-items: center; transition: var(--transition-bounce); box-shadow: 0 8px 24px -6px rgba(139, 92, 246, 0.5); }
    .btn-save:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 16px 32px -8px rgba(139, 92, 246, 0.6); color: white; }
    .fade-in-up { animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(25px); } to { opacity: 1; transform: translateY(0); } }
    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-back { width: 100%; justify-content: center; }
        .form-actions { flex-direction: column-reverse; }
        .btn-cancel, .btn-save { width: 100%; justify-content: center; }
        .input-icon { padding: 0 14px; min-width: 48px; }
    }
</style>
@endsection