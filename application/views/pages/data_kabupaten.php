<?php $this->load->view('_layout/header') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data kabupaten</h1>
  <hr>

  <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Import Data kabupaten</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="data_kabupaten/import" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="userfile">Pilih File kabupaten :</label>
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

  <div class="modal fade" id="kabupatenModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kabupatenModalLabel">Detail kabupaten</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="data_kabupaten/update" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="kodekabupaten">Kode kabupaten</label>
              <input type="text" class="form-control" id="kodekabupaten" name="kd_kabupaten" readonly>
            </div>
            <div class="form-group">
              <label for="namakabupaten">Nama kabupaten</label>
              <input type="text" class="form-control" id="namakabupaten" name="nama_kabupaten">
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

  <?php if ($this->session->flashdata('kbpOk')) { ?>
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <strong><?= $this->session->flashdata('kbpOk') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

  <?php if ($this->session->flashdata('kbpError')) { ?>
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong><?= $this->session->flashdata('kbpError') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar kabupaten</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tabel_kabupaten" width="100%" cellspacing="0">
          <thead class="text-center">
            <tr>
              <th>Kode kabupaten</th>
              <th>Nama kabupaten</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


<?php $this->load->view('_layout/footer') ?>
