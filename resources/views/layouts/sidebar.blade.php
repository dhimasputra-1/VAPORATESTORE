<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="bi bi-shop"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Vape Store</div>
    </a>

    <hr class="sidebar-divider my-0">

    {{-- Dashboard --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- Kasir Section --}}
    @if(Auth::user()->role === 'kasir')
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Data Master</div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/products') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Produk</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/categories') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kategori</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/suppliers') }}">
            <i class="fas fa-fw fa-truck"></i>
            <span>Supplier</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/transactions') }}">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Transaksi</span>
        </a>
    </li>
    @endif

    {{-- Pemilik Section --}}
    @if(Auth::user()->role === 'pemilik')
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Laporan</div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/laporan/harian') }}">
            <i class="fas fa-fw fa-calendar-day"></i>
            <span>Laporan Harian</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/laporan/bulanan') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Laporan Bulanan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/laporan/tahunan') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Laporan Tahunan</span>
        </a>
    </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">
</ul>
