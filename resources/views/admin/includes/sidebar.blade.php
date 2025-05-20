<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height:-webkit-fill-available;">
    <a href="#" class="brand-link">
        <img src="{{ asset('favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle" style="margin-top:2px">
        <span class="brand-text font-weight text-lg">FL BROILER</span>
    </a>

    <div class="sidebar" style="height: 100%; padding-bottom: 15px;">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item mt-2">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $page == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Master Section -->
                <li class="nav-header">Master</li>
                <li class="nav-item">
                    <a href="{{ route('product-categories.index') }}" class="nav-link {{ $page == 'product-categories' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ $page == 'products' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('partnerships.index') }}" class="nav-link {{ $page == 'partnerships' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Partnership</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guests.index') }}" class="nav-link {{ $page == 'guests' ? 'active' : '' }}">
                        <i class="nav-icon far fa-id-badge"></i>
                        <p>Tamu</p>
                    </a>
                </li>

                @if (Auth::user()->is_admin)
                    <li class="nav-item">
                        <a href="{{ route('expense-types.index') }}" class="nav-link {{ $page == 'expense-types' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>Jenis Biaya</p>
                        </a>
                    </li>
                @endif

                <!-- Sales by Company -->
                <li class="nav-header">PT FL MANDIRI SEJAHTRA</li>
                <li class="nav-item">
                    <a href="{{ route('sales.index', ['company_id' => '1']) }}" class="nav-link {{ $page == 'salesv1' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-plus mr-2"></i>
                        <p>Penjualan</p>
                    </a>
                </li>

                <li class="nav-header">CV. Dian Latippa</li>
                <li class="nav-item">
                    <a href="{{ route('sales.index', ['company_id' => '2']) }}" class="nav-link {{ $page == 'salesv2' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-plus mr-2"></i>
                        <p>Penjualan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sales.pending') }}" class="nav-link {{ $page == 'list-pending' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-arrow-down mr-2"></i>
                        <p>Penjualan Pending</p>
                    </a>
                </li>

                @if (Auth::user()->is_admin)
                    <li class="nav-header">Expense</li>
                    <li class="nav-item">
                        <a href="{{ route('expenses.index') }}" class="nav-link {{ $page == 'expenses' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-receipt mr-2"></i>
                            <p>Pengeluaran</p>
                        </a>
                    </li>
                @endif

                <!-- Report Section -->
                <li class="nav-header">Report</li>
                <li class="nav-item {{ in_array($page, ['product-report', 'statistic-report']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array($page, ['product-report', 'statistic-report']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report.product') }}" class="nav-link {{ $page == 'product-report' ? 'active bg-primary' : '' }}">
                                <i class="fas fa-coins mr-2 ml-3"></i>
                                <p>Penjualan Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.statistic') }}" class="nav-link {{ $page == 'statistic-report' ? 'active bg-primary' : '' }}">
                                <i class="fas fa-chart-bar mr-2 ml-3"></i>
                                <p>Statistik Data Penjualan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Setting / Logout -->
                <li class="nav-header">Setting</li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn-sm btn bg-white">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
