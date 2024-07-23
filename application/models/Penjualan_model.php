<?php
class Penjualan_model extends CI_Model{
    public function penjualan_bulan_ini(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');
        $this->db->select('sum(total_harga) as total');
        $this->db->from('penjualan');
		$this->db->where('status','SELESAI');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        return $this->db->get()->row()->total;
    }
    public function penjualan_today(){
        date_default_timezone_set("Asia/Jakarta");
        // today pemasukan
        $tanggal = date('Y-m-d');
        $this->db->select('sum(total_harga) as total');
        $this->db->from('penjualan');
		$this->db->where('status','SELESAI');
        $this->db->where('tanggal', $tanggal);
        return $this->db->get()->row()->total;
     }
    // public function charts(){
    //     date_default_timezone_set("Asia/Jakarta");
    //     $tanggal = date('Y-m');
    //     $this->db->select('sum(total_harga) as total');
    //     $this->db->from('penjualan');
    //     $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
    //     return $this->db->get()->row()->total;
    // }
    // public function transaksi_today(){
    //     date_default_timezone_set("Asia/Jakarta");
    //     $tanggal = date('Y-m-d');
    //     $this->db->select('sum(total_harga) as total');
    //     $this->db->from('penjualan')->where("DATE_FORMAT(tanggal, '%Y-%m-%d')",$tanggal);
    //     $transaksi =  $this->db->count_all_results();
    // }
    // public function activity($limit = 5){
    //     $this->db->select('*');
    //     $this->db->from('penjualan');
    //     $this->db->order_by('tanggal','desc');
    //     $this->db->limit($limit);
    //     return $this->db->get()->result();
    // }

	public function pembelian_today(){
        date_default_timezone_set("Asia/Jakarta");
        // today pemasukan
        $tanggal = date('Y-m-d');
        $this->db->select('sum(total_harga) as total');
        $this->db->from('pembelian');
		$this->db->where('status','SELESAI');
        $this->db->where('tanggal', $tanggal);
        return $this->db->get()->row()->total;
     }

	 public function pembelian_month(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');
        $this->db->select('sum(total_harga) as total');
        $this->db->from('pembelian');
		$this->db->where('status','SELESAI');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        return $this->db->get()->row()->total;
    }

}
