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
    
    <!-- Suppliers -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ph ph-truck"></i> Suppliers
        </a>
    </li>

    <!-- Customers -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ph ph-users"></i> Customers
        </a>
    </li>

    <!-- Accounting / Invoices -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ph ph-receipt"></i> Accounting
        </a>
    </li>

</ul>