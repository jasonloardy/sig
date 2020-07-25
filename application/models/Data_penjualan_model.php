<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_penjualan_model extends CI_Model {

	public function all_penjualan()
	{
		$sql = "SELECT tb.kd_invoice, tb.tanggal, CONCAT_WS(' - ', tp.kd_pelanggan, tp.nama_pelanggan) pelanggan,
						IFNULL(tb.diskon, 0) diskon
						FROM tb_invoice tb
						JOIN tb_pelanggan tp ON tb.kd_pelanggan = tp.kd_pelanggan
						GROUP BY tb.kd_invoice";
    return $this->db->query($sql)->result_array();
	}

	public function penjualan_detail($id)
	{
		$sql = "SELECT tid.kd_barang, tb.nama_barang, tid.qty, tid.harga, tid.qty*tid.harga jumlah
						FROM tb_invoice_detail tid
						JOIN tb_barang tb ON tid.kd_barang = tb.kd_barang
						WHERE tid.kd_invoice = '$id'";
		return $this->db->query($sql)->result_array();
	}

	public function insert($invoice)
	{
		$sql_invoice = "INSERT INTO tb_invoice (kd_invoice, tanggal, kd_pelanggan, diskon) VALUES (?, ?, ?, ?)";
		$sql_invoice_detail = "INSERT INTO tb_invoice_detail (kd_invoice, kd_barang, qty, harga) VALUES (?, ?, ?, ?)";
		$sql_pelanggan = "INSERT INTO tb_pelanggan (kd_pelanggan, nama_pelanggan, alamat) VALUES (?, ?, ?)
											ON DUPLICATE KEY UPDATE alamat = IF(alamat IS NOT NULL, alamat, ?)";
		$sql_barang = "INSERT IGNORE INTO tb_barang (kd_barang, nama_barang) VALUES (?, ?)
										ON DUPLICATE KEY UPDATE nama_barang = IF(nama_barang IS NOT NULL, nama_barang, ?)";
		$sql_cek = "SELECT kd_invoice FROM tb_invoice WHERE kd_invoice = ?";

		$this->db->trans_start();

		foreach ($invoice as $i) {

			$cek = $this->db->query($sql_cek, array($i['INVOICENO']))->row();

			if ($i['ITEMLINE']['KeyID']) {
				$this->db->query($sql_barang, array($i['ITEMLINE']['ITEMNO'], $i['ITEMLINE']['ITEMOVDESC'],  $i['ITEMLINE']['ITEMOVDESC']));
			} else {
				foreach ($i['ITEMLINE'] as $id) {
					$this->db->query($sql_barang, array($id['ITEMNO'], $id['ITEMOVDESC'], $id['ITEMOVDESC']));
				}
			}

			if (!$cek) {
				if ($i['ITEMLINE']['KeyID']) {
					$this->db->query($sql_invoice_detail, array($i['INVOICENO'], $i['ITEMLINE']['ITEMNO'], $i['ITEMLINE']['QUANTITY'],  $i['ITEMLINE']['UNITPRICE']));
				} else {
					foreach ($i['ITEMLINE'] as $id) {
						$this->db->query($sql_invoice_detail, array($i['INVOICENO'], $id['ITEMNO'], $id['QUANTITY'], $id['UNITPRICE']));
					}
				}

				$this->db->query($sql_invoice, array($i['INVOICENO'], $i['INVOICEDATE'], $i['CUSTOMERID'], $i['CASHDISCPC'][0]));
			}

			$this->db->query($sql_pelanggan, array($i['CUSTOMERID'], $i['SHIPTO1'], $i['SHIPTO2'] . ' ' .$i['SHIPTO3'], $i['SHIPTO2'] . ' ' .$i['SHIPTO3']));

		}

		$this->db->trans_complete();

    return $this->db->trans_status();
	}

}
