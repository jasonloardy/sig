<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kabupaten_model extends CI_Model {

	public function all_kabupaten()
	{
		$sql = "SELECT * FROM tb_kabupaten";
    return $this->db->query($sql)->result();
	}

	public function detail_penjualan($id, $from, $to)
	{
		$sql = "SELECT tp.kd_kabupaten, ti.kd_invoice, SUM(tid.qty*tid.harga) subtotal,
						IFNULL(ti.diskon, 0) diskon
						FROM tb_invoice ti
						JOIN tb_invoice_detail tid ON ti.kd_invoice = tid.kd_invoice
						JOIN tb_pelanggan tp ON ti.kd_pelanggan = tp.kd_pelanggan
						WHERE tp.kd_kabupaten = $id AND (tanggal BETWEEN '$from' and '$to')
						GROUP BY ti.kd_invoice";
		return $this->db->query($sql)->result();
	}

	public function update($params)
	{
		$this->db->where('kd_kabupaten', $params['kd_kabupaten']);
    return $this->db->update('tb_kabupaten',$params);
	}

	public function insert($geojson)
	{
		// $sql_kabupaten = "INSERT INTO tb_kabupaten (id) VALUES (?)";
		$sql_kabupaten = "INSERT IGNORE INTO tb_kabupaten (kd_kabupaten, tipe, kordinat, nama_kabupaten, provinsi) VALUES (?, ?, ?, ?, ?)";

		$this->db->trans_start();

		foreach ($geojson as $g) {
			$this->db->query($sql_kabupaten, array($g->properties->ID, $g->geometry->type, json_encode($g->geometry->coordinates),
			strtoupper($g->properties->Kabupaten_), strtoupper($g->properties->Provinsi)));
			// $this->db->query($sql_kabupaten, array($g['properties']['ID'], $g['geometry']['type'], $g['geometry']['coordinates'], $g['properties']['Kabupaten_']));
		}

		$this->db->trans_complete();

    return $this->db->trans_status();
	}

}
