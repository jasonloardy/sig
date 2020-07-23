<?php $this->load->view('_layout/header') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat datang, <?= $this->session->userdata('nama') ?></h1>
  </div>

</div>
<!-- /.container-fluid -->

<?php $this->load->view('_layout/footer') ?>
