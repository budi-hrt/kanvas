<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kanvas App <sup>1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('admin'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('sales'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Sales</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('produk'); ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Produk</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('stok'); ?>">
            <i class="fas fa-fw fa-edit"></i>
            <span>Stok Awal</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('stok/list_awl'); ?>">
            <i class="fas fa-fw fa-edit"></i>
            <span>List Stok Awal</span></a>
    </li>

    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('stok_akhir'); ?>">
            <i class="fas fa-fw fa-edit"></i>
            <span>Stok Akhir</span></a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('penjualan'); ?>">
            <i class="fas fa-fw fa-edit"></i>
            <span>List Penjualan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->