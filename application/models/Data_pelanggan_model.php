<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pelanggan_model extends CI_Model {

	public function all_pelanggan()
	{
		$sql = "SELECT * FROM tb_pelanggan";
    return $this->db->query($sql)->result();
	}

	public function all_kabupaten()
	{
		$sql = "SELECT * FROM tb_kabupaten";
    return $this->db->query($sql)->result();
	}

	public function all_pelanggan_penjualan($from, $to)
	{
		$sql = "SELECT * FROM tb_pelanggan tp
						JOIN tb_invoice ti ON tp.kd_pelanggan = ti.kd_pelanggan
						WHERE tp.geolocation IS NOT NULL AND (tanggal BETWEEN '$from' and '$to')
						GROUP BY tp.kd_pelanggan";
    return $this->db->query($sql)->result();
	}

	public function detail_penjualan($id, $from, $to)
	{
		$sql = "SELECT ti.kd_invoice, IFNULL(ti.diskon, 0) diskon, SUM(qty*harga) subtotal
						FROM tb_invoice ti
						JOIN tb_invoice_detail tid ON ti.kd_invoice = tid.kd_invoice
						JOIN tb_pelanggan tp ON ti.kd_pelanggan = tp.kd_pelanggan
						WHERE tp.kd_pelanggan = '$id' AND (tanggal BETWEEN '$from' and '$to')
						GROUP BY ti.kd_invoice";
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
		$sql_insert = "INSERT INTO tb_pelanggan
										SELECT * FROM tb_pelanggan_temp tpt
										WHERE tpt.kd_pelanggan NOT IN
										(SELECT tp.kd_pelanggan FROM tb_pelanggan tp)
										AND tpt.kd_pelanggan <> ''";
		$sql_update = "UPDATE tb_pelanggan tp
										INNER JOIN tb_pelanggan_temp tpt ON tp.kd_pelanggan = tpt.kd_pelanggan
										SET tp.no_telepon = tpt.no_telepon";

		$this->db->trans_start();

		$this->db->query($sql_insert);
		$this->db->query($sql_update);

		$this->db->trans_complete();

    return $this->db->trans_status();
	}

	public function truncate_temp()
	{
		$sql = "TRUNCATE TABLE tb_pelanggan_temp";

    return $this->db->query($sql);
	}

}
