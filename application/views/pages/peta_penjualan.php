<?php $this->load->view('_layout/header') ?>

<style>
	.legend {
	background-color: #fff;
	border-radius: 3px;
	bottom: 30px;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
	font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
	padding: 10px;
	position: absolute;
	right: 10px;
	z-index: 1;
	}

	.legend h4 {
	margin: 0 0 10px;
	}

	.legend div span {
	border-radius: 50%;
	display: inline-block;
	height: 10px;
	margin-right: 5px;
	width: 10px;
	}
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Peta Penjualan</h1>
  <hr>

	<div class="card shadow mt-3 mb-3">
    <div class="card-body">
      <label for="periode">Periode Peta Penjualan</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        </div>
        <input type="text" class="form-control" id="periode">
      </div>
    </div>
  </div>

	<?php
		$from = date("Y-m-d");
		$to = date("Y-m-d");
		if (isset($_GET['from'])) {
			$from = str_replace('/', '-', $_GET['from']);
		}
		if (isset($_GET['to'])) {
			$to = str_replace('/', '-', $_GET['to']);;
		}
	?>

	<iframe src="assets/html/peta_penjualan.html<?= '?from=' . $from . '&to=' . $to ?>" width="100%" height="600px"></iframe>


</div>
<!-- /.container-fluid -->


<?php $this->load->view('_layout/footer') ?>
