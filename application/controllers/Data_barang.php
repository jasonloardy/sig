<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_barang extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('isLogin') == FALSE) {
      redirect('/');
    } else {
      $this->load->model('data_barang_model');
    }
  }

	public function index()
	{
    $data = array(
      'title' => 'Data barang'
    );
    $this->load->view('pages/data_barang', $data);
	}

  public function json_all()
  {
    $all_barang = $this->data_barang_model->all_barang();
    echo json_encode($all_barang);
  }

  public function update()
  {
    if (isset($_POST['submit'])) {
      $params = array(
        'kd_barang' => $this->input->post('kd_barang'),
        'nama_barang' => strtoupper($this->input->post('nama_barang')),
        'alamat' => strtoupper($this->input->post('alamat')),
        'no_telepon' => $this->input->post('no_telepon'),
        'geolocation' => $this->input->post('geolocation')
      );
      $update = $this->data_barang_model->update($params);

      if ($update) {
        $this->session->set_flashdata('brgOk', 'Data Berhasil di-Update!');
      } else {
        $this->session->set_flashdata('brgError', 'Data Gagal di-Update!');
      }

      redirect('/data_barang', 'refresh');
    }
  }

  public function import()
  {
    error_reporting(0);
    if (isset($_POST['submit'])) {
      require_once('application/libraries/PHPExcel/PHPExcel.php');

      function convertXLStoCSV($infile,$outfile)
      {
          $fileType = PHPExcel_IOFactory::identify($infile);
          $objReader = PHPExcel_IOFactory::createReader($fileType);

          $objPHPExcel = $objReader->load($infile);

          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
          $objWriter->save($outfile);
      }

      $allowedFileType = ['application/vnd.ms-excel','text/plain','text/csv','text/tsv'];
      if (in_array($_FILES['userfile']['type'], $allowedFileType)) {
        $dir = 'uploads/barang/';
        $file = $dir . time();
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file . '.xls')) {
          convertXLStoCSV($file . '.xls', $file . '.csv');
          if (strpos(file_get_contents($file . '.csv'), 'Daftar barang') !== false)
          {
            $import = $this->data_barang_model->import();
            if ($import) {
              $this->data_barang_model->insert();
              $this->session->set_flashdata('brgOk', 'Data Berhasil di-Import!');
            } else {
              $this->session->set_flashdata('brgError', 'Data Gagal di-Import!');
            }
          } else {
            $this->session->set_flashdata('brgError', 'Format File Tidak Cocok!');
          }
        } else {
          $this->session->set_flashdata('brgError', 'Data Gagal di-Upload!');
        }
        $this->data_barang_model->truncate_temp();
      } else {
        $this->session->set_flashdata('brgError', 'Ekstensi File Salah!');
      }
      redirect('/data_barang', 'refresh');
    }
  }

}
