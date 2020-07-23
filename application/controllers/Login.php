<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('isLogin') == TRUE) {
      redirect('dashboard');
    } else {
      $this->load->model('login_model');
    }
  }

	public function index()
	{
    if (isset($_POST['login'])) {
      $username = $_POST['username'];
      $password = md5($_POST['password']);
      $login = $this->login_model->login($username, $password);
      if ($login) {
        $session = array(
          'isLogin' => TRUE,
          'nama' => $login->nama
        );
        $this->session->set_userdata($session);
        redirect('dashboard');
      } else {
        $this->session->set_flashdata('msgLoginError', 'Username / Password salah!');
        redirect('/', 'refresh');
      }
    } else {
      $data = array(
        'title' => "Login"
      );
  		$this->load->view('pages/login', $data);
    }
	}

}
