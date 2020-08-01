<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT. SMS <sup>SIG</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <?php
        $segment = $this->uri->segment(1);
      ?>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= ($segment == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url() ?>dashboard">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        DATA MASTER
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item <?= ($segment == 'data_barang') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url() ?>data_barang">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Barang</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item <?= ($segment == 'data_pelanggan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url() ?>data_pelanggan">
          <i class="fas fa-fw fa-address-card"></i>
          <span>Data Pelanggan</span></a>
      </li>

      <li class="nav-item <?= ($segment == 'data_penjualan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url() ?>data_penjualan">
          <i class="fas fa-fw fa-handshake"></i>
          <span>Data Penjualan</span></a>
      </li>

      <li class="nav-item <?= ($segment == 'data_kabupaten') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url() ?>data_kabupaten">
          <i class="fas fa-fw fa-map"></i>
          <span>Data Kabupaten</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
