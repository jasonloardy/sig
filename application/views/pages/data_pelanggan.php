<?php $this->load->view('_layout/header') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Pelanggan</h1>
  <hr>

  <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Import Data Pelanggan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="data_pelanggan/import" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="userfile">Pilih File Pelanggan</label>
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

  <div class="modal fade" id="pelangganModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pelangganModalLabel">Detail Pelanggan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="data_pelanggan/update" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="kodePelanggan">Kode Pelanggan</label>
              <input type="text" class="form-control" id="kodePelanggan" name="kd_pelanggan" readonly>
            </div>
            <div class="form-group">
              <label for="namaPelanggan">Nama Pelanggan</label>
              <input type="text" class="form-control" id="namaPelanggan" name="nama_pelanggan">
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
            <div class="form-group">
              <label for="shortlink">Google Maps Shortlink (Optional)</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="shortlink">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" onclick="get_googleMaps()">Get Geolocation</button>
                </div>
              </div>
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

  <?php if ($this->session->flashdata('plgOk')) { ?>
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <strong><?= $this->session->flashdata('plgOk') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

  <?php if ($this->session->flashdata('plgError')) { ?>
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong><?= $this->session->flashdata('plgError') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Pelanggan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tabel_pelanggan" width="100%" cellspacing="0">
          <thead class="text-center">
            <tr>
              <th width="15%">Kode Pelanggan</th>
              <th width="25%">Nama Pelanggan</th>
              <th width="30%">Alamat</th>
              <th width="15%">Geolocation</th>
              <th width="15%">No. Telepon</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


<?php $this->load->view('_layout/footer') ?>
