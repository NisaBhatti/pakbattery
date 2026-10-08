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
    
    <!-- Suppliers with Submenu (AMBER THEME) -->
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
            <ul class="nav flex-column submenu submenu-suppliers">
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

    <!-- Customers with Submenu (PINK THEME) -->
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
            <ul class="nav flex-column submenu submenu-customers">
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

    <!-- Shops with Submenu (CYAN THEME) -->
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('shops.*') ? '' : 'collapsed' }}" 
           data-bs-toggle="collapse" 
           href="#shopSubmenu" 
           role="button" 
           aria-expanded="{{ request()->routeIs('shops.*') ? 'true' : 'false' }}">
            <span><i class="ph ph-storefront"></i> Shops</span>
            <i class="ph ph-caret-down submenu-arrow"></i>
        </a>
        
        <div class="collapse {{ request()->routeIs('shops.*') ? 'show' : '' }}" id="shopSubmenu">
            <ul class="nav flex-column submenu submenu-shops">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shops.index') ? 'active' : '' }}" href="{{ route('shops.index') }}">
                        <i class="ph ph-list-dashes"></i> All Shops
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shops.batteries') ? 'active' : '' }}" href="{{ route('shops.batteries') }}">
                        <i class="ph ph-battery-charging"></i> Batteries
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shops.send-stock') || request()->routeIs('shops.create-transfer') || request()->routeIs('shops.view-transfer') ? 'active' : '' }}" href="{{ route('shops.send-stock') }}">
                        <i class="ph ph-paper-plane-tilt"></i> Send Stock
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

<!-- Enhanced Submenu Styling — Multi-Color Theme -->
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
        color: #3B82F6;
    }

    .nav-link[aria-expanded="true"] .submenu-arrow {
        color: #3B82F6;
    }

    /* ============================================
       BASE SUBMENU STYLING
       ============================================ */
    .submenu { 
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
        border-radius: 0 4px 4px 0;
        opacity: 0.4;
        transition: opacity 0.3s ease;
    }

    .submenu:hover::before {
        opacity: 1;
    }

    /* Submenu Links (Base) */
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

    /* Sliding shine effect */
    .submenu .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
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

    /* Pulsing dot on active item */
    .submenu .nav-link.active::after {
        content: '';
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 5px;
        border-radius: 50%;
        animation: pulseDotSubmenu 2s infinite;
    }

    @keyframes pulseDotSubmenu {
        0%, 100% { opacity: 1; transform: translateY(-50%) scale(1); }
        50% { opacity: 0.6; transform: translateY(-50%) scale(1.5); }
    }

    /* Parent open highlight */
    .nav-link[aria-expanded="true"] {
        color: #3B82F6;
        background: rgba(59, 130, 246, 0.05);
    }

    .nav-link[aria-expanded="true"] i:first-child {
        color: #3B82F6;
    }

    /* Smooth collapse animation */
    .collapse, .collapsing {
        transition: height 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* ============================================
       SUPPLIERS SUBMENU — AMBER/GOLD THEME
       ============================================ */
    .submenu-suppliers {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.06) 0%, rgba(251, 191, 36, 0.04) 100%);
    }
    .submenu-suppliers::before {
        background: linear-gradient(180deg, #F59E0B, #FBBF24);
    }
    .submenu-suppliers .nav-link::before {
        background: linear-gradient(90deg, transparent, rgba(245, 158, 11, 0.1), transparent);
    }
    .submenu-suppliers .nav-link:hover {
        color: #D97706;
        background: rgba(254, 243, 199, 0.6);
        transform: translateX(6px) scale(1.02);
        box-shadow: 0 4px 12px -4px rgba(245, 158, 11, 0.3);
        font-weight: 600;
    }
    .submenu-suppliers .nav-link:hover i {
        color: #D97706;
        transform: scale(1.15) rotate(-5deg);
    }
    .submenu-suppliers .nav-link.active {
        color: white;
        background: linear-gradient(105deg, #F59E0B 0%, #D97706 100%);
        font-weight: 700;
        box-shadow: 0 6px 18px -4px rgba(245, 158, 11, 0.5);
        transform: translateX(4px) scale(1.02);
    }
    .submenu-suppliers .nav-link.active i {
        color: white;
    }
    .submenu-suppliers .nav-link.active::after {
        background: #FEF3C7;
        box-shadow: 0 0 8px #F59E0B;
    }

    /* ============================================
       CUSTOMERS SUBMENU — PINK/ROSE THEME
       ============================================ */
    .submenu-customers {
        background: linear-gradient(135deg, rgba(236, 72, 153, 0.06) 0%, rgba(244, 114, 182, 0.04) 100%);
    }
    .submenu-customers::before {
        background: linear-gradient(180deg, #EC4899, #F472B6);
    }
    .submenu-customers .nav-link::before {
        background: linear-gradient(90deg, transparent, rgba(236, 72, 153, 0.1), transparent);
    }
    .submenu-customers .nav-link:hover {
        color: #DB2777;
        background: rgba(252, 231, 243, 0.6);
        transform: translateX(6px) scale(1.02);
        box-shadow: 0 4px 12px -4px rgba(236, 72, 153, 0.3);
        font-weight: 600;
    }
    .submenu-customers .nav-link:hover i {
        color: #DB2777;
        transform: scale(1.15) rotate(-5deg);
    }
    .submenu-customers .nav-link.active {
        color: white;
        background: linear-gradient(105deg, #EC4899 0%, #DB2777 100%);
        font-weight: 700;
        box-shadow: 0 6px 18px -4px rgba(236, 72, 153, 0.5);
        transform: translateX(4px) scale(1.02);
    }
    .submenu-customers .nav-link.active i {
        color: white;
    }
    .submenu-customers .nav-link.active::after {
        background: #FCE7F3;
        box-shadow: 0 0 8px #EC4899;
    }

    /* ============================================
       SHOPS SUBMENU — CYAN/TEAL THEME
       ============================================ */
    .submenu-shops {
        background: linear-gradient(135deg, rgba(6, 182, 212, 0.06) 0%, rgba(20, 184, 166, 0.04) 100%);
    }
    .submenu-shops::before {
        background: linear-gradient(180deg, #06B6D4, #14B8A6);
    }
    .submenu-shops .nav-link::before {
        background: linear-gradient(90deg, transparent, rgba(6, 182, 212, 0.1), transparent);
    }
    .submenu-shops .nav-link:hover {
        color: #0891B2;
        background: rgba(207, 250, 254, 0.6);
        transform: translateX(6px) scale(1.02);
        box-shadow: 0 4px 12px -4px rgba(6, 182, 212, 0.3);
        font-weight: 600;
    }
    .submenu-shops .nav-link:hover i {
        color: #0891B2;
        transform: scale(1.15) rotate(-5deg);
    }
    .submenu-shops .nav-link.active {
        color: white;
        background: linear-gradient(105deg, #06B6D4 0%, #0891B2 100%);
        font-weight: 700;
        box-shadow: 0 6px 18px -4px rgba(6, 182, 212, 0.5);
        transform: translateX(4px) scale(1.02);
    }
    .submenu-shops .nav-link.active i {
        color: white;
    }
    .submenu-shops .nav-link.active::after {
        background: #CFFAFE;
        box-shadow: 0 0 8px #06B6D4;
    }
</style>