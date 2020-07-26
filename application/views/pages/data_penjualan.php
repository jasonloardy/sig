<?php $this->load->view('_layout/header') ?>

<style>
  td.details-control {
    background: url('assets/img/details_open.png') no-repeat center center;
    cursor: pointer;
  }
  tr.shown td.details-control {
    background: url('assets/img/details_close.png') no-repeat center center;
  }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Penjualan</h1>
  <hr>

  <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Import Data Penjualan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="data_penjualan/import" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="userfile">Pilih File Penjualan</label>
              <input type="file" class="form-control-file" id="userfile" name="userfile">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Upload Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#importModal">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Import Data</span>
  </button>

  <?php if ($this->session->flashdata('pjlOk')) { ?>
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <strong><?= $this->session->flashdata('pjlOk') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

  <?php if ($this->session->flashdata('pjlError')) { ?>
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong><?= $this->session->flashdata('pjlError') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

  <div class="card shadow mt-3">
    <div class="card-body">
      <label for="periode">Periode Penjualan</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        </div>
        <input type="text" class="form-control" id="periode">
      </div>
    </div>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Penjualan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tabel_penjualan" width="100%" cellspacing="0">
          <thead class="text-center">
            <tr>
              <th></th>
              <th>Kode Invoice</th>
              <th>Tanggal</th>
              <th>Pelanggan</th>
              <th>Diskon (%)</th>
              <th class="text-center">Total Faktur</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th colspan="4"></th>
                <th>Total Penjualan :</th>
                <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


<?php $this->load->view('_layout/footer') ?>
