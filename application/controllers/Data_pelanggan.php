<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pelanggan extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('isLogin') == FALSE) {
      redirect('/');
    } else {
      $this->load->model('data_pelanggan_model');
    }
  }

	public function index()
	{
    $data = array(
      'title' => 'Data Pelanggan'
    );
    $this->load->view('pages/data_pelanggan', $data);
	}

  public function json_all()
  {
    $all_pelanggan = $this->data_pelanggan_model->all_pelanggan();
    echo json_encode($all_pelanggan);
  }

  public function update()
  {
    if (isset($_POST['submit'])) {
      $params = array(
        'kd_pelanggan' => $this->input->post('kd_pelanggan'),
        'nama_pelanggan' => strtoupper($this->input->post('nama_pelanggan')),
        'alamat' => strtoupper($this->input->post('alamat')),
        'no_telepon' => $this->input->post('no_telepon'),
        'geolocation' => $this->input->post('geolocation')
      );
      $update = $this->data_pelanggan_model->update($params);

      if ($update) {
        $this->session->set_flashdata('plgOk', 'Data Berhasil di-Update!');
      } else {
        $this->session->set_flashdata('plgError', 'Data Gagal di-Update!');
      }

      redirect('/data_pelanggan', 'refresh');
    }
  }

  public function redirect()
  {
    // From URL to get redirected URL
    $url = $_POST['url'];

    // Initialize a CURL session.
    $ch = curl_init();

    // Grab URL and pass it to the variable.
    curl_setopt($ch, CURLOPT_URL, $url);

    // Catch output (do NOT print!)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    // Return follow location true
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    $html = curl_exec($ch);

    // Getinfo or redirected URL from effective URL
    $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

    // Close handle
    curl_close($ch);

    $uri_path = parse_url($redirectedUrl, PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    // echo "Original URL:   " . $url . "<br/>";
    // echo "Redirected URL: " . $redirectedUrl . "<br/>";

    $geolocation = strstr($uri_segments[5], "!3d");
    $geolocation = substr($geolocation, 3);
    $geolocation = str_replace("!4d", ",", $geolocation);
    $geolocation = explode(',', $geolocation);

    echo $geolocation[1] . ', ' . $geolocation[0];
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
        $dir = 'uploads/pelanggan/';
        $file = $dir . time() . '.xls';
        $output = $dir . 'output.csv';
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file)) {
          convertXLStoCSV($file, $output);
          if (strpos(file_get_contents($output), '"Daftar Pelanggan","","","","","","","",""') !== false)
          {
            $import = $this->data_pelanggan_model->import();
            if ($import) {
              $this->data_pelanggan_model->insert();
              $this->session->set_flashdata('plgOk', 'Data Berhasil di-Import!');
            } else {
              $this->session->set_flashdata('plgError', 'Data Gagal di-Import!');
            }
          } else {
            $this->session->set_flashdata('plgError', 'Format File Tidak Cocok!');
          }
        } else {
          $this->session->set_flashdata('plgError', 'Data Gagal di-Upload!');
        }
        $this->data_pelanggan_model->truncate_temp();
      } else {
        $this->session->set_flashdata('plgError', 'Ekstensi File Salah!');
      }
      redirect('/data_pelanggan', 'refresh');
    }
  }

}
