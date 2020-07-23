<?php $this->load->view('_layout/header') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data barang</h1>
  <hr>

  <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Import Data barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="data_barang/import" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="userfile">File CSV barang</label>
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

  <div class="modal fade" id="barangModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="barangModalLabel">Detail barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="data_barang/update" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="kodebarang">Kode barang</label>
              <input type="text" class="form-control" id="kodebarang" name="kd_barang" readonly>
            </div>
            <div class="form-group">
              <label for="namabarang">Nama barang</label>
              <input type="text" class="form-control" id="namabarang" name="nama_barang">
            </div>
            <div class="form-group">
              <label for="noTelepon">No. Telepon</label>
              <input type="text" class="form-control" id="noTelepon" name="no_telepon">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
              <label for="geolocation">Geolocation</label>
              <input type="text" class="form-control" id="geolocation" name="geolocation" readonly>
            </div>
            <div id="map" style="height: 300px">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Update Data</button>
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

  <?php if ($this->session->flashdata('brgOk')) { ?>
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <strong><?= $this->session->flashdata('brgOk') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

  <?php if ($this->session->flashdata('brgError')) { ?>
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong><?= $this->session->flashdata('brgError') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar barang</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tabel_barang" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Kode barang</th>
              <th>Nama barang</th>
              <th>Alamat</th>
              <th>No. Telepon</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


<?php $this->load->view('_layout/footer') ?>
