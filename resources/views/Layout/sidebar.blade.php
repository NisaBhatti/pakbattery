<div class="nav-category">Main Menu</div>

<ul class="nav flex-column">
    
    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="ph ph-squares-four"></i> Dashboard
        </a>
    </li>

    <!-- Products -->
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
            <i class="ph ph-package"></i> Products
        </a>
    </li>

</ul>

<div class="nav-category">Management</div>

<ul class="nav flex-column">
    
    <!-- Suppliers with Submenu -->
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('suppliers.*') || request()->routeIs('purchases.*') ? '' : 'collapsed' }}" 
           data-bs-toggle="collapse" 
           href="#supplierSubmenu" 
           role="button" 
           aria-expanded="{{ request()->routeIs('suppliers.*') || request()->routeIs('purchases.*') ? 'true' : 'false' }}">
            <span><i class="ph ph-truck"></i> Suppliers</span>
            <i class="ph ph-caret-down submenu-arrow"></i>
        </a>
        
        <div class="collapse {{ request()->routeIs('suppliers.*') || request()->routeIs('purchases.*') ? 'show' : '' }}" id="supplierSubmenu">
            <ul class="nav flex-column submenu">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('suppliers.index') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">
                        <i class="ph ph-list-dashes"></i> All Suppliers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('purchases.index') ? 'active' : '' }}" href="{{ route('purchases.index') }}">
                        <i class="ph ph-receipt"></i> All Invoices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('purchases.create') ? 'active' : '' }}" href="{{ route('purchases.create') }}">
                        <i class="ph ph-plus-circle"></i> Add Purchase
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- Customers with Submenu -->
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('customers.*') || request()->routeIs('bills.*') ? '' : 'collapsed' }}" 
           data-bs-toggle="collapse" 
           href="#customerSubmenu" 
           role="button" 
           aria-expanded="{{ request()->routeIs('customers.*') || request()->routeIs('bills.*') ? 'true' : 'false' }}">
            <span><i class="ph ph-users"></i> Customers</span>
            <i class="ph ph-caret-down submenu-arrow"></i>
        </a>
        
        <div class="collapse {{ request()->routeIs('customers.*') || request()->routeIs('bills.*') ? 'show' : '' }}" id="customerSubmenu">
            <ul class="nav flex-column submenu">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customers.index') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                        <i class="ph ph-list-dashes"></i> All Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('bills.index') ? 'active' : '' }}" href="{{ route('bills.index') }}">
                        <i class="ph ph-receipt"></i> All Bills
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('bills.create') ? 'active' : '' }}" href="{{ route('bills.create') }}">
                        <i class="ph ph-plus-circle"></i> Add Bill
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- Accounting / Reports -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ph ph-currency-dollar"></i> Accounting
        </a>
    </li>

</ul>

<!-- Enhanced Submenu Styling — Matching Electric Azure & Mint Theme -->
<style>
    /* Submenu Arrow Rotation */
    .nav-link[aria-expanded="true"] .submenu-arrow { 
        transform: rotate(180deg); 
    }
    
    .submenu-arrow { 
        font-size: 0.8rem; 
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        color: #94A3B8;
    }
    
    .nav-link:hover .submenu-arrow {
        color: var(--primary-electric);
    }

    .nav-link[aria-expanded="true"] .submenu-arrow {
        color: var(--primary-electric);
    }

    /* Submenu Container */
    .submenu { 
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.04) 0%, rgba(16, 185, 129, 0.03) 100%);
        border-radius: 14px; 
        margin: 4px 16px 8px 16px; 
        padding: 6px 0;
        border-left: 2px solid transparent;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    /* Animated left border on submenu */
    .submenu::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, var(--primary-electric), var(--accent-mint));
        border-radius: 0 4px 4px 0;
        opacity: 0.3;
        transition: opacity 0.3s ease;
    }

    .submenu:hover::before {
        opacity: 0.8;
    }

    /* Submenu Links */
    .submenu .nav-link { 
        padding: 10px 18px; 
        margin: 2px 8px; 
        font-size: 0.85rem; 
        color: #64748B; 
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }

    /* Sliding shine effect on submenu links */
    .submenu .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.08), transparent);
        transition: left 0.5s ease;
    }

    .submenu .nav-link:hover::before {
        left: 100%;
    }

    .submenu .nav-link i { 
        font-size: 1rem; 
        margin-right: 10px;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        color: #94A3B8;
    }

    /* Submenu Hover State */
    .submenu .nav-link:hover { 
        color: var(--primary-electric); 
        background: rgba(255, 255, 255, 0.8);
        transform: translateX(6px) scale(1.02);
        box-shadow: 0 4px 12px -4px rgba(59, 130, 246, 0.2);
        font-weight: 600;
    }

    .submenu .nav-link:hover i { 
        color: var(--primary-electric);
        transform: scale(1.15) rotate(-5deg);
    }

    /* Submenu Active State */
    .submenu .nav-link.active { 
        color: white; 
        background: linear-gradient(105deg, var(--primary-electric) 0%, var(--primary-deep) 100%);
        font-weight: 700;
        box-shadow: 0 6px 18px -4px rgba(59, 130, 246, 0.4);
        transform: translateX(4px) scale(1.02);
    }

    .submenu .nav-link.active i { 
        color: white;
    }

    /* Pulsing dot on active submenu item */
    .submenu .nav-link.active::after {
        content: '';
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 5px;
        background: var(--accent-mint-light);
        border-radius: 50%;
        box-shadow: 0 0 8px var(--accent-mint);
        animation: pulseDotSubmenu 2s infinite;
    }

    @keyframes pulseDotSubmenu {
        0%, 100% { opacity: 1; transform: translateY(-50%) scale(1); }
        50% { opacity: 0.6; transform: translateY(-50%) scale(1.5); }
    }

    /* Parent nav-link with open submenu gets subtle highlight */
    .nav-link[aria-expanded="true"] {
        color: var(--primary-electric);
        background: rgba(59, 130, 246, 0.05);
    }

    .nav-link[aria-expanded="true"] i:first-child {
        color: var(--primary-electric);
    }

    /* Smooth collapse animation */
    .collapse {
        transition: height 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .collapsing {
        transition: height 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
</style>