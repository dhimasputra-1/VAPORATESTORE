<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-text mx-3">Vape Store</div>
  </a>

  <hr class="sidebar-divider my-0">

  @if(Auth::user()->role == 'kasir')
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

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
      <i class="fas fa-fw fa-box"></i>
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

  @if(Auth::user()->role == 'pemilik')
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/laporan') }}">
      <i class="fas fa-fw fa-file-alt"></i>
      <span>Laporan</span>
    </a>
  </li>
   <li class="nav-item">
    <a class="nav-link" href="{{ url('/laporan') }}">
      <i class="fas fa-fw fa-file-alt"></i>
      <span>Laporan Harian</span>
    </a>
     <li class="nav-item">
    <a class="nav-link" href="{{ url('/laporan') }}">
      <i class="fas fa-fw fa-file-alt"></i>
      <span>Laporan Bulan</span>
       <li class="nav-item">
    <a class="nav-link" href="{{ url('/laporan') }}">
      <i class="fas fa-fw fa-file-alt"></i>
      <span>Laporan Tahun</span>
    </a>
    </a>
  @endif

  <hr class="sidebar-divider d-none d-md-block">

</ul>
