<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pelanggan_model extends CI_Model {

	public function all_pelanggan()
	{
		$sql = "SELECT * FROM tb_pelanggan";
    return $this->db->query($sql)->result();
	}

	public function update($params)
	{
		$this->db->where('kd_pelanggan', $params['kd_pelanggan']);
    return $this->db->update('tb_pelanggan',$params);
	}

	public function import()
	{
		$sql = <<<eof
						 LOAD DATA INFILE '../../www/sig/uploads/pelanggan/output.csv'
						 INTO TABLE tb_pelanggan_temp
						 FIELDS TERMINATED BY ','
						 ENCLOSED BY '"'
						 LINES TERMINATED BY '\r\n'
						 IGNORE 4 LINES
						 (@skip1, kd_pelanggan, nama_pelanggan, no_telepon)
eof;

		 return $this->db->query($sql);
	}

	public function insert()
	{
		$sql = "INSERT INTO tb_pelanggan
						SELECT * FROM tb_pelanggan_temp tpt
						WHERE tpt.kd_pelanggan NOT IN
						(SELECT tp.kd_pelanggan FROM tb_pelanggan tp)
						AND tpt.kd_pelanggan <> ''";

    return $this->db->query($sql);
	}

	public function truncate_temp()
	{
		$sql = "TRUNCATE TABLE tb_pelanggan_temp";

    return $this->db->query($sql);
	}

}
