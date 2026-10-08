@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Delete Expense</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-warning-circle me-1"></i>
                Please review the details before deleting
            </p>
        </div>
        <a href="{{ route('expenses.index') }}" class="btn btn-back">
            <i class="ph ph-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="confirm-card fade-in-up">
        <div class="card-body p-4 p-md-5 text-center">
            <div class="icon-box-lg">
                <i class="ph-fill ph-warning-octagon"></i>
            </div>

            <h4 class="fw-bold mb-2" style="color: #0F172A;">Are you sure?</h4>
            <p class="text-muted mb-4">You are about to permanently delete this expense. This action cannot be undone.</p>

            <div class="details-box text-start mb-4">
                <div class="d-flex align-items-center mb-3 pb-3" style="border-bottom: 1px dashed #E2E8F0;">
                    <div class="icon-box-sm icon-violet-soft me-3"><i class="ph ph-receipt-x"></i></div>
                    <div>
                        <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Title</span>
                        <span class="fw-bold" style="color: #0F172A;">{{ $expense->title }}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3 pb-3" style="border-bottom: 1px dashed #E2E8F0;">
                    <div class="icon-box-sm icon-primary-soft me-3"><i class="ph ph-calendar"></i></div>
                    <div>
                        <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Date</span>
                        <span class="fw-bold" style="color: #0F172A;">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M, Y') }}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="icon-box-sm icon-success-soft me-3"><i class="ph ph-currency-circle-dollar"></i></div>
                    <div>
                        <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Amount</span>
                        <span class="fw-bold" style="color: #10B981;">Rs {{ number_format($expense->amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-flex justify-content-center gap-2">
                @csrf
                @method('DELETE')
                <a href="{{ route('expenses.index') }}" class="btn btn-cancel-confirm">Cancel</a>
                <button type="submit" class="btn btn-delete-confirm">
                    <i class="ph ph-trash me-1"></i> Yes, Delete Expense
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .page-title { color: #0F172A; font-size: 1.75rem; position: relative; display: inline-block; }
    .page-title::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, #EF4444, #8B5CF6); border-radius: 10px; }
    .page-subtitle { font-size: 0.9rem; display: flex; align-items: center; }
    .page-subtitle i { color: #EF4444; }
    .btn-back { background: white; border: 1px solid #E2E8F0; color: #0F172A; border-radius: 12px; padding: 11px 22px; font-weight: 600; display: inline-flex; align-items: center; transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1); text-decoration: none; }
    .btn-back:hover { color: #EF4444; border-color: #EF4444; transform: translateX(-4px); }
    .confirm-card { background: white; border-radius: 24px; border: 1px solid rgba(226,232,240,0.6); box-shadow: 0 8px 40px -12px rgba(15,23,42,0.08); max-width: 600px; margin: 0 auto; }
    .icon-box-lg { width: 90px; height: 90px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; border-radius: 24px; font-size: 3rem; background: linear-gradient(135deg, #FEF2F2, #FEE2E2); color: #EF4444; }
    .details-box { background: #F8FAFC; padding: 24px; border-radius: 14px; border: 1px solid #F1F5F9; }
    .icon-box-sm { width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 1.3rem; flex-shrink: 0; }
    .icon-violet-soft { background: linear-gradient(135deg, #F5F3FF, #EDE9FE); color: #7C3AED; }
    .icon-success-soft { background: linear-gradient(135deg, #ECFDF5, #D1FAE5); color: #10B981; }
    .icon-primary-soft { background: linear-gradient(135deg, #EEF2FF, #DBEAFE); color: #3B82F6; }
    .btn-cancel-confirm { background: white; border: 1px solid #E2E8F0; color: #475569; border-radius: 10px; padding: 12px 30px; font-weight: 700; text-decoration: none; transition: all 0.3s; }
    .btn-cancel-confirm:hover { background: #F8FAFC; color: #0F172A; }
    .btn-delete-confirm { background: #EF4444; border: none; color: white; border-radius: 10px; padding: 12px 30px; font-weight: 700; transition: all 0.3s; box-shadow: 0 8px 20px -6px rgba(239,68,68,0.5); }
    .btn-delete-confirm:hover { background: #DC2626; transform: translateY(-2px); }
    .fade-in-up { animation: fadeInUp 0.7s cubic-bezier(0.34,1.56,0.64,1) forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(25px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
