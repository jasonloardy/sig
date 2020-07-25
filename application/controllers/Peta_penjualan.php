<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class peta_penjualan extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('isLogin') == FALSE) {
      redirect('/');
    } else {
      // $this->load->model('peta_penjualan_model');
    }
  }

	public function index()
	{
    $data = array(
      'title' => 'Peta Penjualan'
    );
    $this->load->view('pages/peta_penjualan', $data);
	}

}
