<?php
class Pembelian_model extends CI_Model{
	public function bayar_today(){
		date_default_timezone_set("Asia/Jakarta");
        // today pemasukan
        $tanggal = date('Y-m-d');
        $this->db->select('sum(bayar) as total');
        $this->db->from('penjualan');
        $this->db->where('tanggal', $tanggal);
        return $this->db->get()->row()->total;
	}

	public function bayar_month(){
		date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');
        $this->db->select('sum(bayar) as total');
        $this->db->from('penjualan');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        return $this->db->get()->row()->total;
	}
}
?>
