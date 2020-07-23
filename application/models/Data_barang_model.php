<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_barang_model extends CI_Model {

	public function all_barang()
	{
		$sql = "SELECT * FROM tb_barang";
    return $this->db->query($sql)->result();
	}

	public function update($params)
	{
		$this->db->where('kd_barang', $params['kd_barang']);
    return $this->db->update('tb_barang',$params);
	}

	public function import()
	{
		$sql = <<<eof
						 LOAD DATA INFILE '../../www/sig/uploads/barang/output.csv'
						 INTO TABLE tb_barang_temp
						 FIELDS TERMINATED BY ','
						 ENCLOSED BY '"'
						 LINES TERMINATED BY '\r\n'
						 IGNORE 4 LINES
						 (@skip1, kd_barang, nama_barang, no_telepon)
eof;

		 return $this->db->query($sql);
	}

	public function insert()
	{
		$sql = "INSERT INTO tb_barang
						SELECT * FROM tb_barang_temp tpt
						WHERE tpt.kd_barang NOT IN
						(SELECT tp.kd_barang FROM tb_barang tp)
						AND tpt.kd_barang <> ''";

    return $this->db->query($sql);
	}

	public function truncate_temp()
	{
		$sql = "TRUNCATE TABLE tb_barang_temp";

    return $this->db->query($sql);
	}

}
