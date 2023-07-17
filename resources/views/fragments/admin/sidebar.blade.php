<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <span class="brand-text font-weight-bold">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.index') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.product-category') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.product-category') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Products Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.product') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.product') active @endif">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.reseller') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.reseller') active @endif">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Reseller Information
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.order') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.order') active @endif">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Order Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.user') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.user') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.admin') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.admin') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>