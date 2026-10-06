@extends('Layout.app')

@section('content')
<div class="container-fluid p-0 customer-list-wrapper">
    
    <!-- Page Header — Animated Entrance -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header fade-in-up">
        <div>
            <h3 class="fw-bold mb-1 page-title">Customers Management</h3>
            <p class="text-muted mb-0 page-subtitle">
                <i class="ph ph-sparkle me-1"></i>
                Manage all your customers in one place.
            </p>
        </div>
        <a href="{{ route('customers.create') }}" class="btn btn-primary-gradient fw-bold">
            <i class="ph ph-plus-circle me-1"></i> Add New Customer
        </a>
    </div>

    <!-- Success Alert — Animated -->
    @if(session('success'))
        <div class="alert alert-success-premium fade-in-up" role="alert">
            <div class="alert-icon-wrapper">
                <i class="ph-fill ph-check-circle"></i>
            </div>
            <div class="alert-content">
                <strong>Success!</strong>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Table Card — Premium -->
    <div class="table-card fade-in-up">
        <!-- Animated Top Gradient Border (Rose-Magenta themed) -->
        <div class="table-card-border"></div>
        
        <!-- Table Section Header -->
        <div class="table-section-header">
            <div class="section-icon section-icon-customer">
                <i class="ph ph-users"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0 section-title">All Customers</h5>
                <p class="text-muted mb-0 section-subtitle">
                    {{ $customers->total() ?? $customers->count() }} customer{{ ($customers->total() ?? $customers->count()) !== 1 ? 's' : '' }} in your database
                </p>
            </div>
            <!-- Search Box -->
            <div class="search-wrapper ms-auto">
                <i class="ph ph-magnifying-glass search-icon"></i>
                <input type="text" class="search-input" id="customerSearch" placeholder="Search customers...">
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table premium-table align-middle mb-0" id="customerTable">
                    <thead>
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th class="pe-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr class="customer-row">
                            <td class="ps-4">
                                <span class="row-number">{{ $loop->iteration }}</span>
                            </td>
                            
                            <!-- Customer Name with Icon -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-box-sm icon-customer-soft me-3">
                                        <i class="ph ph-user"></i>
                                    </div>
                                    <div class="customer-info">
                                        <span class="customer-name">{{ $customer->name }}</span>
                                        <small class="customer-address">{{ Str::limit($customer->address, 40) ?? 'No address' }}</small>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Phone -->
                            <td>
                                @if($customer->phone)
                                    <span class="contact-badge">
                                        <i class="ph ph-phone"></i>
                                        {{ $customer->phone }}
                                    </span>
                                @else
                                    <span class="text-muted-na">N/A</span>
                                @endif
                            </td>
                            
                            <!-- Email -->
                            <td>
                                @if($customer->email)
                                    <span class="contact-badge contact-email">
                                        <i class="ph ph-envelope"></i>
                                        {{ $customer->email }}
                                    </span>
                                @else
                                    <span class="text-muted-na">N/A</span>
                                @endif
                            </td>
                            
                            <!-- Action Buttons -->
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn-action btn-view" title="View">
                                        <i class="ph ph-eye"></i>
                                    </a>
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="ph ph-pencil-simple"></i>
                                    </a>
                                    <a href="{{ route('customers.delete', $customer->id) }}" class="btn-action btn-delete" title="Delete">
                                        <i class="ph ph-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon-wrapper">
                                        <i class="ph ph-users"></i>
                                    </div>
                                    <h5 class="empty-title">No customers found</h5>
                                    <p class="empty-subtitle">Get started by adding your first customer to the database.</p>
                                    <a href="{{ route('customers.create') }}" class="btn btn-primary-gradient mt-3">
                                        <i class="ph ph-plus-circle me-1"></i> Add New Customer
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($customers->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} results
                </div>
                <div class="pagination-links">
                    {{ $customers->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- ============ PREMIUM CUSTOMER TABLE STYLES ============ -->
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

    /* --- GRADIENT BUTTON --- */
    .btn-primary-gradient {
        background: linear-gradient(105deg, var(--rose-magenta) 0%, var(--rose-magenta-deep) 100%);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        position: relative;
        overflow: hidden;
        transition: var(--transition-bounce);
        box-shadow: 0 8px 20px -6px rgba(236, 72, 153, 0.5);
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
        box-shadow: 0 15px 30px -8px rgba(236, 72, 153, 0.6);
        color: white;
    }

    .btn-primary-gradient i {
        transition: var(--transition-bounce);
    }

    .btn-primary-gradient:hover i {
        transform: rotate(180deg) scale(1.2);
    }

    /* --- SUCCESS ALERT --- */
    .alert-success-premium {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: 16px;
        color: #065F46;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 4px 20px -4px rgba(16, 185, 129, 0.15);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .alert-success-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--accent-mint);
        border-radius: 4px 0 0 4px;
    }

    .alert-success-premium .alert-icon-wrapper {
        width: 40px;
        height: 40px;
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(16, 185, 129, 0.15);
        border-radius: 12px;
        font-size: 1.4rem;
        color: var(--accent-mint);
        animation: checkPop 0.5s ease-out;
    }

    @keyframes checkPop {
        0% { transform: scale(0); }
        60% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .alert-success-premium .alert-content {
        flex: 1;
    }

    .alert-success-premium .alert-content strong {
        display: block;
        margin-bottom: 2px;
        font-size: 0.95rem;
    }

    .alert-success-premium .alert-content span {
        font-size: 0.875rem;
    }

    /* --- TABLE CARD --- */
    .table-card {
        background: var(--surface-card);
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 40px -12px rgba(15, 23, 42, 0.08);
        transition: var(--transition-smooth);
    }

    .table-card:hover {
        box-shadow: 0 20px 60px -16px rgba(236, 72, 153, 0.12);
        border-color: rgba(236, 72, 153, 0.15);
    }

    /* Animated top gradient border — customer themed */
    .table-card-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--rose-magenta), var(--primary-electric), var(--rose-magenta));
        background-size: 200% 100%;
        animation: gradientShiftCustomer 4s ease infinite;
    }

    @keyframes gradientShiftCustomer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* --- TABLE SECTION HEADER --- */
    .table-section-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 24px 28px;
        border-bottom: 1px solid var(--border-light);
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.6) 0%, rgba(255, 255, 255, 0.6) 100%);
        flex-wrap: wrap;
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

    .table-card:hover .section-icon {
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

    /* --- SEARCH BOX --- */
    .search-wrapper {
        position: relative;
        max-width: 280px;
        width: 100%;
    }

    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 1.1rem;
        pointer-events: none;
        transition: var(--transition-bounce);
    }

    .search-input {
        width: 100%;
        padding: 11px 16px 11px 44px;
        border: 1.5px solid var(--border-light);
        border-radius: 12px;
        background: white;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-dark);
        outline: none;
        transition: var(--transition-bounce);
        font-family: inherit;
    }

    .search-input::placeholder {
        color: #CBD5E1;
        font-weight: 400;
    }

    .search-input:focus {
        border-color: var(--rose-magenta);
        box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1);
        transform: translateY(-2px);
    }

    .search-wrapper:focus-within .search-icon {
        color: var(--rose-magenta);
        transform: translateY(-50%) scale(1.15);
    }

    /* --- PREMIUM TABLE --- */
    .premium-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .premium-table thead th {
        background: #F8FAFC;
        color: var(--text-muted);
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 16px 20px;
        border: none;
        white-space: nowrap;
    }

    .premium-table thead th:first-child {
        padding-left: 28px;
    }

    .premium-table thead th:last-child {
        padding-right: 28px;
    }

    .premium-table tbody td {
        padding: 18px 20px;
        border: none;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .premium-table tbody td:first-child {
        padding-left: 28px;
    }

    .premium-table tbody td:last-child {
        padding-right: 28px;
    }

    /* Row Hover Effect */
    .customer-row {
        transition: var(--transition-smooth);
        position: relative;
    }

    .customer-row:hover {
        background: linear-gradient(90deg, rgba(236, 72, 153, 0.03) 0%, rgba(59, 130, 246, 0.02) 100%);
        transform: scale(1.002);
    }

    .customer-row:hover td:first-child {
        border-radius: 12px 0 0 12px;
    }

    .customer-row:hover td:last-child {
        border-radius: 0 12px 12px 0;
    }

    /* Row number */
    .row-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: #F1F5F9;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-soft);
        transition: var(--transition-bounce);
    }

    .customer-row:hover .row-number {
        background: linear-gradient(135deg, var(--rose-magenta), var(--rose-magenta-deep));
        color: white;
        transform: scale(1.1);
    }

    /* Customer Icon Box */
    .icon-box-sm {
        width: 42px;
        height: 42px;
        min-width: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.25rem;
        transition: var(--transition-bounce);
    }

    .icon-customer-soft {
        background: linear-gradient(135deg, #FDF2F8 0%, #FCE7F3 100%);
        color: var(--rose-magenta-deep);
        box-shadow: 0 4px 12px -4px rgba(236, 72, 153, 0.3);
    }

    .customer-row:hover .icon-box-sm {
        transform: scale(1.1) rotate(-8deg);
    }

    /* Customer Info */
    .customer-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
        min-width: 0;
    }

    .customer-name {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: -0.2px;
        transition: var(--transition-smooth);
    }

    .customer-row:hover .customer-name {
        color: var(--rose-magenta-deep);
    }

    .customer-address {
        color: var(--text-muted);
        font-size: 0.78rem;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 220px;
    }

    /* Contact Badges */
    .contact-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #F8FAFC;
        border: 1px solid var(--border-light);
        color: var(--text-soft);
        font-weight: 600;
        font-size: 0.8rem;
        padding: 7px 12px;
        border-radius: 10px;
        transition: var(--transition-bounce);
        white-space: nowrap;
    }

    .contact-badge i {
        color: var(--text-muted);
        font-size: 0.95rem;
        transition: var(--transition-bounce);
    }

    .customer-row:hover .contact-badge {
        background: white;
        border-color: rgba(236, 72, 153, 0.25);
        color: var(--rose-magenta-deep);
        transform: translateY(-1px);
    }

    .customer-row:hover .contact-badge i {
        color: var(--rose-magenta);
    }

    .contact-email {
        font-family: inherit;
    }

    .text-muted-na {
        color: var(--text-muted);
        font-size: 0.85rem;
        font-weight: 500;
        font-style: italic;
    }

    /* --- ACTION BUTTONS --- */
    .btn-action {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        border: 1px solid var(--border-light);
        background: white;
        font-size: 1.1rem;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .btn-action::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-3px) scale(1.08);
    }

    .btn-action:hover::before {
        opacity: 1;
    }

    /* View button */
    .btn-view {
        color: var(--primary-electric);
    }

    .btn-view::before {
        background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
    }

    .btn-view:hover {
        border-color: var(--primary-electric);
        box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.5);
        color: var(--primary-electric);
    }

    /* Edit button */
    .btn-edit {
        color: var(--warm-amber);
    }

    .btn-edit::before {
        background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
    }

    .btn-edit:hover {
        border-color: var(--warm-amber);
        box-shadow: 0 8px 20px -8px rgba(245, 158, 11, 0.5);
        color: #D97706;
    }

    /* Delete button */
    .btn-delete {
        color: var(--rose-red);
    }

    .btn-delete::before {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
    }

    .btn-delete:hover {
        border-color: var(--rose-red);
        box-shadow: 0 8px 20px -8px rgba(239, 68, 68, 0.5);
        color: var(--rose-red);
    }

    .btn-action i {
        position: relative;
        z-index: 1;
        transition: var(--transition-bounce);
    }

    .btn-action:hover i {
        transform: scale(1.15);
    }

    /* --- EMPTY STATE --- */
    .empty-state {
        padding: 40px 20px;
    }

    .empty-icon-wrapper {
        width: 90px;
        height: 90px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #FDF2F8 0%, #FCE7F3 100%);
        border-radius: 24px;
        font-size: 2.8rem;
        color: var(--rose-magenta-deep);
        box-shadow: 0 12px 30px -12px rgba(236, 72, 153, 0.4);
        animation: floatIcon 3s ease-in-out infinite;
    }

    @keyframes floatIcon {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-8px) rotate(5deg); }
    }

    .empty-title {
        color: var(--text-dark);
        font-weight: 700;
        margin-bottom: 8px;
    }

    .empty-subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* --- PAGINATION --- */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 28px;
        border-top: 1px solid var(--border-light);
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.4) 0%, rgba(255, 255, 255, 0.4) 100%);
        flex-wrap: wrap;
        gap: 12px;
    }

    .pagination-info {
        color: var(--text-muted);
        font-size: 0.85rem;
        font-weight: 500;
    }

    .pagination-links .pagination {
        margin: 0;
        gap: 4px;
    }

    .pagination .page-item .page-link {
        color: var(--text-soft);
        background: white;
        border: 1px solid var(--border-light);
        border-radius: 10px;
        padding: 8px 14px;
        font-weight: 600;
        font-size: 0.85rem;
        margin: 0;
        transition: var(--transition-bounce);
        min-width: 40px;
        text-align: center;
    }

    .pagination .page-item .page-link:hover {
        background: #F8FAFC;
        color: var(--rose-magenta-deep);
        border-color: var(--rose-magenta);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px -4px rgba(236, 72, 153, 0.3);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(105deg, var(--rose-magenta) 0%, var(--rose-magenta-deep) 100%);
        border-color: transparent;
        color: white;
        box-shadow: 0 6px 16px -4px rgba(236, 72, 153, 0.5);
    }

    .pagination .page-item.disabled .page-link {
        background: #F8FAFC;
        color: #CBD5E1;
        border-color: var(--border-light);
        opacity: 0.6;
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
    .alert-success-premium { animation-delay: 0.1s; }
    .table-card { animation-delay: 0.2s; }

    /* Staggered row animation */
    .customer-row {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .customer-row:nth-child(1) { animation-delay: 0.25s; }
    .customer-row:nth-child(2) { animation-delay: 0.30s; }
    .customer-row:nth-child(3) { animation-delay: 0.35s; }
    .customer-row:nth-child(4) { animation-delay: 0.40s; }
    .customer-row:nth-child(5) { animation-delay: 0.45s; }
    .customer-row:nth-child(6) { animation-delay: 0.50s; }
    .customer-row:nth-child(7) { animation-delay: 0.55s; }
    .customer-row:nth-child(8) { animation-delay: 0.60s; }
    .customer-row:nth-child(9) { animation-delay: 0.65s; }
    .customer-row:nth-child(10) { animation-delay: 0.70s; }

    /* --- RESPONSIVE --- */
    @media (max-width: 992px) {
        .table-section-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .search-wrapper {
            max-width: 100%;
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .page-title { font-size: 1.4rem; }
        .page-header { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-primary-gradient { width: 100%; justify-content: center; }
        .premium-table thead th,
        .premium-table tbody td { padding: 14px 12px; }
        .premium-table thead th:first-child,
        .premium-table tbody td:first-child { padding-left: 16px; }
        .premium-table thead th:last-child,
        .premium-table tbody td:last-child { padding-right: 16px; }
        .pagination-wrapper { flex-direction: column; align-items: center; }
        .customer-address { max-width: 140px; }
    }
</style>

<!-- Table Interaction Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss success alert after 5 seconds
        const successAlert = document.querySelector('.alert-success-premium');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = 'all 0.5s ease';
                successAlert.style.opacity = '0';
                successAlert.style.transform = 'translateY(-10px)';
                setTimeout(() => successAlert.remove(), 500);
            }, 5000);
        }

        // Live search functionality
        const searchInput = document.getElementById('customerSearch');
        const table = document.getElementById('customerTable');
        
        if (searchInput && table) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                const rows = table.querySelectorAll('.customer-row');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const isMatch = text.includes(searchTerm);
                    
                    if (isMatch) {
                        row.style.display = '';
                        row.style.animation = 'none';
                        row.offsetHeight;
                        row.style.animation = 'fadeInUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Delete confirmation
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this customer?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection