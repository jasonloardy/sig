<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('isLogin') == FALSE) {
      redirect('/');
    }
  }

	public function index()
	{
    $data = array(
      'title' => 'Dashboard'
    );
    $this->load->view('pages/peta_penjualan', $data);
	}

}
