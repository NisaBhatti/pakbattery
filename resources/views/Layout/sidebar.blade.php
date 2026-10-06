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

<!-- Custom Submenu Styling -->
<style>
    .nav-link[aria-expanded="true"] .submenu-arrow { transform: rotate(180deg); }
    .submenu-arrow { font-size: 0.8rem; transition: transform 0.2s ease; }
    .submenu { background-color: #f8fafc; border-radius: 12px; margin: 4px 16px; padding: 4px 0; }
    .submenu .nav-link { padding: 10px 16px; margin: 0; font-size: 0.875rem; color: #94a3b8; border-radius: 8px; }
    .submenu .nav-link i { font-size: 1rem; margin-right: 10px; }
    .submenu .nav-link:hover { color: #1e293b; background: #ffffff; }
    .submenu .nav-link:hover i { color: #4f46e5; }
    .submenu .nav-link.active { color: #4f46e5; background: #eef2ff; font-weight: 600; }
    .submenu .nav-link.active i { color: #4f46e5; }
</style>