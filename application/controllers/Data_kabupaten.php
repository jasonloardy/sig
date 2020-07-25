<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kabupaten extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('isLogin') == FALSE) {
      redirect('/');
    } else {
      $this->load->model('data_kabupaten_model');
    }
  }

	public function index()
	{
    $data = array(
      'title' => 'Data Kabupaten'
    );
    $this->load->view('pages/data_kabupaten', $data);
	}

  public function json_all()
  {
    $all_kabupaten = $this->data_kabupaten_model->all_kabupaten();
    echo json_encode($all_kabupaten);
  }

  public function geojson()
  {
    $response['type'] = 'FeatureCollection';

    $kabupaten = $this->data_kabupaten_model->all_kabupaten();


    $i = 0;
    foreach ($kabupaten as $k) {
      $jumlah = 0;
      $response['features'][$i]['type'] = 'Feature';
      $response['features'][$i]['geometry']['type'] = $k->tipe;
      $response['features'][$i]['geometry']['coordinates'] = json_decode($k->kordinat);
      $response['features'][$i]['properties']['ID'] = $k->kd_kabupaten;
      $response['features'][$i]['properties']['Kabupaten_'] = $k->nama_kabupaten;
      $penjualan = $this->data_kabupaten_model->detail_penjualan($k->kd_kabupaten);
      foreach ($penjualan as $p) {
        $setelah_diskon = $p->subtotal - ($p->subtotal * $p->diskon / 100);
        $setelah_pajak = $setelah_diskon + ($setelah_diskon * 0.1);
        $jumlah += intval($setelah_pajak);
      }
      $response['features'][$i]['properties']['total_faktur'] = $jumlah;

      switch (true) {
        case ($jumlah > 20000000):
          $color = '#ff0000';
          break;
        case (($jumlah > 15000000) && ($jumlah <= 20000000)):
          $color = '#ff5a00';
          break;
        case (($jumlah > 10000000) && ($jumlah <= 15000000)):
          $color = '#ff9a00';
          break;
        case (($jumlah > 5000000) && ($jumlah <= 10000000)):
          $color = '#ffce00';
          break;
        case ($jumlah > 0):
          $color = '#f0ff00';
          break;
        default:
          $color = "#ffffff";
          break;
      }
      $response['features'][$i]['properties']['color'] = $color;

      $i++;
    }

    echo json_encode($response);

  }

  public function update()
  {
    if (isset($_POST['submit'])) {
      $params = array(
        'kd_kabupaten' => $this->input->post('kd_kabupaten'),
        'nama_kabupaten' => strtoupper($this->input->post('nama_kabupaten'))
      );
      $update = $this->data_kabupaten_model->update($params);

      if ($update) {
        $this->session->set_flashdata('kbpOk', 'Data Berhasil di-Update!');
      } else {
        $this->session->set_flashdata('kbpError', 'Data Gagal di-Update!');
      }

      redirect('/data_kabupaten', 'refresh');
    }
  }

  public function import()
  {
    error_reporting(0);
    if (isset($_POST['submit'])) {

      $allowedFileType = ['application/json'];
      if (in_array($_FILES['userfile']['type'], $allowedFileType)) {
        $dir = 'uploads/kabupaten/';
        $file = $dir . time() . '.json';
        $output = $dir . 'output.json';
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file)) {
          copy($file, $output);

          $geojson = json_decode(file_get_contents($output));

          // echo json_encode($geojson->features);

          $insert = $this->data_kabupaten_model->insert($geojson->features);
          if ($insert) {
            $this->session->set_flashdata('kbpOk', 'Data Berhasil di-Import!');
          } else {
            $this->session->set_flashdata('kbpError', 'Data Gagal di-Import!');
          }
        } else {
          $this->session->set_flashdata('kbpError', 'Data Gagal di-Upload!');
        }
      } else {
        $this->session->set_flashdata('kbpError', 'Ekstensi File Salah!');
      }
      redirect('/data_kabupaten', 'refresh');
    }
  }

}
