@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 expenses-list-wrapper">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Expenses</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-receipt-x me-1"></i>
                Track all your business expenses in one place.
            </p>
        </div>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary-gradient fw-bold">
            <i class="ph ph-plus-circle me-1"></i> Add New Expense
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success-premium fade-in-up" role="alert">
            <div class="alert-icon-wrapper"><i class="ph-fill ph-check-circle"></i></div>
            <div class="alert-content">
                <strong>Success!</strong>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card stat-card-primary fade-in-up">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-primary"><i class="ph ph-wallet"></i></div>
                        <span class="badge badge-trend badge-trend-up"><i class="ph ph-trend-up me-1"></i>Total</span>
                    </div>
                    <h6 class="stat-label">Total Expenses</h6>
                    <h2 class="stat-value">${{ number_format($totalExpense, 2) }}</h2>
                    <div class="stat-progress"><div class="stat-progress-bar" style="width: 85%;"></div></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card stat-card-success fade-in-up">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-success"><i class="ph ph-calendar-check"></i></div>
                        <span class="badge badge-trend badge-trend-up"><i class="ph ph-check-circle me-1"></i>This Month</span>
                    </div>
                    <h6 class="stat-label">This Month</h6>
                    <h2 class="stat-value">${{ number_format($thisMonthExpense, 2) }}</h2>
                    <div class="stat-progress"><div class="stat-progress-bar" style="width: 60%;"></div></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card stat-card-danger fade-in-up">
                <div class="stat-card-glow"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box icon-danger"><i class="ph ph-calendar-today"></i></div>
                        <span class="badge badge-alert"><span class="alert-dot"></span> Today</span>
                    </div>
                    <h6 class="stat-label">Today's Expenses</h6>
                    <h2 class="stat-value">${{ number_format($todayExpense, 2) }}</h2>
                    <div class="stat-progress"><div class="stat-progress-bar" style="width: 30%;"></div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="filter-card fade-in-up mb-4">
        <div class="filter-card-border"></div>
        <div class="card-body p-4 p-md-5 position-relative">
            <div class="filter-header">
                <div class="filter-header-icon"><i class="ph ph-funnel"></i></div>
                <div>
                    <h6 class="fw-bold mb-0 filter-title">Filters</h6>
                    <p class="text-muted mb-0 filter-subtitle">Refine your expense search results</p>
                </div>
            </div>

            <form method="GET" action="{{ route('expenses.index') }}">
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="filter-label">Search</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon"><i class="ph ph-magnifying-glass"></i></span>
                            <input type="text" name="search" class="filter-control" placeholder="Expense title..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="filter-label">Category</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon"><i class="ph ph-tag"></i></span>
                            <select name="category" class="filter-select">
                                <option value="">All Categories</option>
                                @foreach(\App\Models\Expense::categories() as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="filter-label">Date From</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon"><i class="ph ph-calendar"></i></span>
                            <input type="date" name="date_from" class="filter-control" value="{{ request('date_from') }}">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="filter-label">Date To</label>
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon"><i class="ph ph-calendar"></i></span>
                            <input type="date" name="date_to" class="filter-control" value="{{ request('date_to') }}">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12 d-flex align-items-end gap-2">
                        <button type="submit" class="btn-filter-apply w-100">
                            <i class="ph ph-magnifying-glass me-1"></i> Filter
                        </button>
                        <a href="{{ route('expenses.index') }}" class="btn-filter-reset" title="Reset">
                            <i class="ph ph-x"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Expenses Table -->
    <div class="table-card fade-in-up">
        <div class="table-card-border"></div>
        <div class="table-section-header">
            <div class="section-icon section-icon-shop"><i class="ph ph-receipt-x"></i></div>
            <div>
                <h5 class="fw-bold mb-0 section-title">Expense Records</h5>
                <p class="text-muted mb-0 section-subtitle">
                    {{ $expenses->total() ?? $expenses->count() }} expense{{ ($expenses->total() ?? $expenses->count()) !== 1 ? 's' : '' }} found
                </p>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table premium-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Expense</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Payment</th>
                            <th class="text-end">Amount</th>
                            <th class="pe-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                        <tr class="shop-row">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box-sm icon-shop-soft me-3"><i class="ph ph-receipt"></i></div>
                                    <div class="shop-info">
                                        <span class="shop-name">{{ $expense->title }}</span>
                                        <small class="shop-manager">
                                            <i class="ph ph-note"></i>
                                            {{ Str::limit($expense->description, 30) ?? 'No description' }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="code-badge">
                                    <i class="ph ph-tag"></i> {{ $expense->category }}
                                </span>
                            </td>
                            <td>
                                <span class="contact-badge">
                                    <i class="ph ph-calendar"></i>
                                    {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M, Y') }}
                                </span>
                            </td>
                            <td>
                                @if($expense->payment_method)
                                    <span class="contact-badge">
                                        <i class="ph ph-credit-card"></i> {{ $expense->payment_method }}
                                    </span>
                                @else
                                    <span class="text-muted-na">N/A</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <span class="stock-badge">
                                    <i class="ph ph-currency-dollar"></i> {{ number_format($expense->amount, 2) }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('expenses.show', $expense->id) }}" class="btn-action btn-view" title="View">
                                        <i class="ph ph-eye"></i>
                                    </a>
                                    <a href="{{ route('expenses.edit', $expense->id) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="ph ph-pencil-simple"></i>
                                    </a>
                                    <a href="{{ route('expenses.delete', $expense->id) }}" class="btn-action btn-delete" title="Delete">
                                        <i class="ph ph-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon-wrapper"><i class="ph ph-receipt-x"></i></div>
                                    <h5 class="empty-title">No expenses yet</h5>
                                    <p class="empty-subtitle">Click "Add New Expense" to record your first expense.</p>
                                    <a href="{{ route('expenses.create') }}" class="btn btn-primary-gradient mt-3">
                                        <i class="ph ph-plus-circle me-1"></i> Add New Expense
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($expenses->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Showing {{ $expenses->firstItem() }} to {{ $expenses->lastItem() }} of {{ $expenses->total() }} results
                </div>
                <div class="pagination-links">{{ $expenses->links() }}</div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- ============ STYLES ============ -->
<style>
    :root {
        --primary-electric: #3B82F6;
        --primary-deep: #2563EB;
        --accent-mint: #10B981;
        --violet-core: #8B5CF6;
        --violet-deep: #7C3AED;
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
    .page-subtitle { font-size: 0.9rem; display: flex; align-items: center; }
    .page-subtitle i { color: var(--violet-core); }

    .btn-primary-gradient { background: linear-gradient(105deg, var(--violet-core) 0%, var(--violet-deep) 100%); border: none; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 600; position: relative; overflow: hidden; transition: var(--transition-bounce); box-shadow: 0 8px 20px -6px rgba(139, 92, 246, 0.5); display: inline-flex; align-items: center; text-decoration: none; }
    .btn-primary-gradient::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); transition: left 0.6s ease; }
    .btn-primary-gradient:hover::before { left: 100%; }
    .btn-primary-gradient:hover { transform: translateY(-3px) scale(1.03); box-shadow: 0 15px 30px -8px rgba(139, 92, 246, 0.6); color: white; }
    .btn-primary-gradient i { transition: var(--transition-bounce); }
    .btn-primary-gradient:hover i { transform: rotate(180deg) scale(1.2); }

    .alert-success-premium { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 16px; color: #065F46; padding: 18px 20px; display: flex; align-items: center; gap: 14px; box-shadow: 0 4px 20px -4px rgba(16, 185, 129, 0.15); margin-bottom: 24px; position: relative; overflow: hidden; }
    .alert-success-premium::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--accent-mint); border-radius: 4px 0 0 4px; }
    .alert-icon-wrapper { width: 40px; height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; background: rgba(16, 185, 129, 0.15); border-radius: 12px; font-size: 1.4rem; color: var(--accent-mint); animation: checkPop 0.5s ease-out; }
    @keyframes checkPop { 0% { transform: scale(0); } 60% { transform: scale(1.2); } 100% { transform: scale(1); } }
    .alert-content { flex: 1; }
    .alert-content strong { display: block; margin-bottom: 2px; font-size: 0.95rem; }
    .alert-content span { font-size: 0.875rem; }

    /* Stat Cards */
    .stat-card { background: var(--surface-card); border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.6); position: relative; overflow: hidden; transition: var(--transition-bounce); cursor: pointer; height: 100%; box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.04); }
    .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); transform: scaleX(0); transform-origin: left; transition: transform 0.4s ease; }
    .stat-card:hover::before { transform: scaleX(1); }
    .stat-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px -12px rgba(139, 92, 246, 0.18); border-color: rgba(139, 92, 246, 0.2); }
    .stat-card-glow { position: absolute; top: -50%; right: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%); opacity: 0; transition: opacity 0.5s ease; pointer-events: none; }
    .stat-card:hover .stat-card-glow { opacity: 1; }
    .stat-card-success .stat-card-glow { background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); }
    .stat-card-danger .stat-card-glow { background: radial-gradient(circle, rgba(239, 68, 68, 0.08) 0%, transparent 70%); }
    .icon-box { width: 54px; height: 54px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.6rem; transition: var(--transition-bounce); }
    .stat-card:hover .icon-box { transform: scale(1.1) rotate(-8deg); }
    .icon-primary { background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%); color: var(--primary-electric); box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.3); }
    .icon-success { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); color: var(--accent-mint); box-shadow: 0 4px 12px -4px rgba(16, 185, 129, 0.3); }
    .icon-danger { background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%); color: var(--rose-red); box-shadow: 0 4px 12px -4px rgba(239, 68, 68, 0.3); }
    .stat-label { color: var(--text-muted); font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 8px; }
    .stat-value { color: var(--text-dark); font-weight: 800; font-size: 1.6rem; letter-spacing: -1px; margin-bottom: 16px; line-height: 1.1; transition: var(--transition-smooth); }
    .stat-card:hover .stat-value { color: var(--violet-deep); transform: translateX(4px); }
    .stat-card-success:hover .stat-value { color: var(--accent-mint); }
    .stat-card-danger:hover .stat-value { color: var(--rose-red); }
    .badge-trend { font-size: 0.75rem; font-weight: 700; padding: 6px 12px; border-radius: 20px; display: inline-flex; align-items: center; transition: var(--transition-bounce); }
    .badge-trend-up { background: linear-gradient(135deg, #ECFDF5, #D1FAE5); color: #059669; }
    .stat-card:hover .badge-trend { transform: scale(1.1); }
    .badge-alert { background: linear-gradient(135deg, #FEF2F2, #FEE2E2); color: var(--rose-red); font-size: 0.7rem; font-weight: 700; padding: 6px 12px; border-radius: 20px; display: inline-flex; align-items: center; gap: 6px; }
    .alert-dot { width: 6px; height: 6px; background: var(--rose-red); border-radius: 50%; animation: dotPulse 1.5s ease-in-out infinite; }
    @keyframes dotPulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.5); } }
    .stat-progress { height: 4px; background: #F1F5F9; border-radius: 10px; overflow: hidden; }
    .stat-progress-bar { height: 100%; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); border-radius: 10px; transition: width 1.5s cubic-bezier(0.34, 1.56, 0.64, 1); }

    /* Filter Card */
    .filter-card { background: var(--surface-card); border-radius: 24px; border: 1px solid rgba(226, 232, 240, 0.6); position: relative; overflow: hidden; box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08); }
    .filter-card-border { position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint), var(--violet-core)); background-size: 200% 100%; animation: gradientShiftFilter 4s ease infinite; }
    @keyframes gradientShiftFilter { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
    .filter-header { display: flex; align-items: center; gap: 14px; padding-bottom: 20px; margin-bottom: 24px; border-bottom: 1px solid var(--border-light); position: relative; }
    .filter-header::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 60px; height: 2px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint)); border-radius: 10px; }
    .filter-header-icon { width: 46px; height: 46px; min-width: 46px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%); border-radius: 13px; font-size: 1.35rem; color: var(--primary-electric); box-shadow: 0 6px 16px -6px rgba(59, 130, 246, 0.35); }
    .filter-title { color: var(--text-dark); font-size: 1.05rem; letter-spacing: -0.3px; }
    .filter-subtitle { font-size: 0.82rem; }
    .filter-label { display: block; font-weight: 700; font-size: 0.72rem; color: var(--text-soft); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 8px; }
    .filter-input-wrapper { position: relative; display: flex; align-items: stretch; border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border-light); background: #F8FAFC; transition: var(--transition-bounce); }
    .filter-input-wrapper:focus-within { border-color: var(--violet-core); background: white; box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1); }
    .filter-input-icon { display: flex; align-items: center; justify-content: center; padding: 0 12px; background: rgba(226, 232, 240, 0.4); color: var(--text-muted); font-size: 1.05rem; }
    .filter-input-wrapper:focus-within .filter-input-icon { background: linear-gradient(135deg, var(--violet-core), var(--violet-deep)); color: white; }
    .filter-control, .filter-select { flex: 1; border: none; background: transparent; padding: 11px 14px; font-size: 0.88rem; font-weight: 600; color: var(--text-dark); outline: none; font-family: inherit; min-width: 0; }
    .filter-control::placeholder { color: #CBD5E1; font-weight: 500; }
    .filter-select { appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 12px center; background-size: 12px; padding-right: 34px; cursor: pointer; }
    .btn-filter-apply { background: linear-gradient(105deg, var(--violet-core) 0%, var(--violet-deep) 100%); border: none; color: white; border-radius: 12px; padding: 11px 20px; font-weight: 700; font-size: 0.88rem; display: inline-flex; align-items: center; justify-content: center; transition: var(--transition-bounce); box-shadow: 0 8px 20px -6px rgba(139, 92, 246, 0.5); white-space: nowrap; }
    .btn-filter-apply:hover { transform: translateY(-2px) scale(1.02); color: white; box-shadow: 0 14px 28px -8px rgba(139, 92, 246, 0.6); }
    .btn-filter-reset { background: white; border: 1.5px solid var(--border-light); color: var(--text-soft); border-radius: 12px; padding: 11px 14px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; transition: var(--transition-bounce); text-decoration: none; min-width: 44px; }
    .btn-filter-reset:hover { background: #FEF2F2; color: var(--rose-red); border-color: var(--rose-red); transform: translateY(-2px); }

    /* Table Card */
    .table-card { background: var(--surface-card); border-radius: 24px; border: 1px solid rgba(226, 232, 240, 0.6); position: relative; overflow: hidden; box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08); }
    .table-card-border { position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--violet-core), var(--accent-mint), var(--violet-core)); background-size: 200% 100%; animation: gradientShiftTable 4s ease infinite; }
    @keyframes gradientShiftTable { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
    .table-section-header { display: flex; align-items: center; gap: 16px; padding: 24px 28px; border-bottom: 1px solid var(--border-light); background: linear-gradient(135deg, rgba(248, 250, 252, 0.6) 0%, rgba(255, 255, 255, 0.6) 100%); flex-wrap: wrap; }
    .section-icon { width: 52px; height: 52px; min-width: 52px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.5rem; transition: var(--transition-bounce); }
    .section-icon-shop { background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); color: var(--violet-deep); box-shadow: 0 8px 20px -8px rgba(139, 92, 246, 0.4); }
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
    .shop-row { transition: var(--transition-smooth); }
    .shop-row:hover { background: linear-gradient(90deg, rgba(139, 92, 246, 0.03) 0%, rgba(16, 185, 129, 0.02) 100%); }
    .shop-row:hover td:first-child { border-radius: 12px 0 0 12px; }
    .shop-row:hover td:last-child { border-radius: 0 12px 12px 0; }

    .icon-box-sm { width: 42px; height: 42px; min-width: 42px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 1.25rem; transition: var(--transition-bounce); }
    .icon-shop-soft { background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); color: var(--violet-deep); box-shadow: 0 4px 12px -4px rgba(139, 92, 246, 0.3); }
    .shop-row:hover .icon-box-sm { transform: scale(1.1) rotate(-8deg); }
    .shop-info { display: flex; flex-direction: column; gap: 3px; min-width: 0; }
    .shop-name { color: var(--text-dark); font-weight: 700; font-size: 0.95rem; letter-spacing: -0.2px; }
    .shop-row:hover .shop-name { color: var(--violet-deep); }
    .shop-manager { display: flex; align-items: center; gap: 5px; color: var(--text-muted); font-size: 0.78rem; font-weight: 500; }
    .shop-manager i { font-size: 0.9rem; }

    .code-badge { display: inline-flex; align-items: center; gap: 5px; background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); border: 1px solid rgba(139, 92, 246, 0.15); color: var(--violet-deep); font-weight: 700; font-size: 0.8rem; padding: 7px 14px; border-radius: 10px; transition: var(--transition-bounce); }
    .shop-row:hover .code-badge { transform: translateY(-2px) scale(1.05); box-shadow: 0 8px 18px -6px rgba(139, 92, 246, 0.35); }

    .contact-badge { display: inline-flex; align-items: center; gap: 6px; background: #F8FAFC; border: 1px solid var(--border-light); color: var(--text-soft); font-weight: 600; font-size: 0.8rem; padding: 7px 12px; border-radius: 10px; transition: var(--transition-bounce); white-space: nowrap; }
    .shop-row:hover .contact-badge { background: white; border-color: rgba(139, 92, 246, 0.25); color: var(--violet-deep); }

    .stock-badge { display: inline-flex; align-items: center; gap: 7px; background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); border: 1px solid rgba(16, 185, 129, 0.15); color: #059669; font-weight: 800; font-size: 0.85rem; padding: 7px 14px; border-radius: 10px; }
    .shop-row:hover .stock-badge { transform: translateY(-2px) scale(1.05); box-shadow: 0 8px 18px -6px rgba(16, 185, 129, 0.35); }
    .text-muted-na { color: var(--text-muted); font-size: 0.85rem; font-weight: 500; font-style: italic; }

    /* Action Buttons */
    .btn-action { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border-radius: 11px; border: 1px solid var(--border-light); background: white; font-size: 1.1rem; transition: var(--transition-bounce); text-decoration: none; }
    .btn-action:hover { transform: translateY(-3px) scale(1.08); }
    .btn-view { color: var(--violet-core); }
    .btn-view:hover { border-color: var(--violet-core); box-shadow: 0 8px 20px -8px rgba(139, 92, 246, 0.5); color: var(--violet-deep); }
    .btn-edit { color: #F59E0B; }
    .btn-edit:hover { border-color: #F59E0B; box-shadow: 0 8px 20px -8px rgba(245, 158, 11, 0.5); color: #D97706; }
    .btn-delete { color: var(--rose-red); }
    .btn-delete:hover { border-color: var(--rose-red); box-shadow: 0 8px 20px -8px rgba(239, 68, 68, 0.5); }

    .empty-state { padding: 40px 20px; }
    .empty-icon-wrapper { width: 90px; height: 90px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); border-radius: 24px; font-size: 2.8rem; color: var(--violet-deep); box-shadow: 0 12px 30px -12px rgba(139, 92, 246, 0.4); animation: floatIcon 3s ease-in-out infinite; }
    @keyframes floatIcon { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-8px) rotate(5deg); } }
    .empty-title { color: var(--text-dark); font-weight: 700; margin-bottom: 8px; }
    .empty-subtitle { color: var(--text-muted); font-size: 0.9rem; }

    /* Pagination */
    .pagination-wrapper { display: flex; justify-content: space-between; align-items: center; padding: 20px 28px; border-top: 1px solid var(--border-light); background: linear-gradient(135deg, rgba(248, 250, 252, 0.4) 0%, rgba(255, 255, 255, 0.4) 100%); flex-wrap: wrap; gap: 12px; }
    .pagination-info { color: var(--text-muted); font-size: 0.85rem; font-weight: 500; }
    .pagination .page-item .page-link { color: var(--text-soft); background: white; border: 1px solid var(--border-light); border-radius: 10px; padding: 8px 14px; font-weight: 600; font-size: 0.85rem; margin: 0 2px; transition: var(--transition-bounce); min-width: 40px; text-align: center; }
    .pagination .page-item .page-link:hover { background: #F8FAFC; color: var(--violet-deep); border-color: var(--violet-core); transform: translateY(-2px); }
    .pagination .page-item.active .page-link { background: linear-gradient(105deg, var(--violet-core) 0%, var(--violet-deep) 100%); border-color: transparent; color: white; }

    /* Animations */
    .fade-in-up { animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(25px); } to { opacity: 1; transform: translateY(0); } }
    .page-header { animation-delay: 0.05s; }
    .alert-success-premium { animation-delay: 0.1s; }
    .table-card { animation-delay: 0.4s; }
    .shop-row { opacity: 0; animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    .shop-row:nth-child(1) { animation-delay: 0.45s; }
    .shop-row:nth-child(2) { animation-delay: 0.5s; }
    .shop-row:nth-child(3) { animation-delay: 0.55s; }
    .shop-row:nth-child(4) { animation-delay: 0.6s; }
    .shop-row:nth-child(5) { animation-delay: 0.65s; }

    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-primary-gradient { width: 100%; justify-content: center; }
        .stat-value { font-size: 1.3rem; }
        .premium-table thead th, .premium-table tbody td { padding: 14px 12px; }
        .premium-table thead th:first-child, .premium-table tbody td:first-child { padding-left: 16px; }
        .premium-table thead th:last-child, .premium-table tbody td:last-child { padding-right: 16px; }
        .pagination-wrapper { flex-direction: column; align-items: center; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.querySelector('.alert-success-premium');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = 'all 0.5s ease';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }, 5000);
        }

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