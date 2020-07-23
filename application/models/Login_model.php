<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function login($username, $password)
	{
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    return $this->db->get('tb_user')->row();
	}

}
