<?php
class Chart_model extends CI_Model{
    public function chart($id_kategori){
		date_default_timezone_set('Asia/Jakarta');
		$bulan = date('Y-m');
		$this->db->select('sum(a.total_harga) as total');
		$this->db->from('penjualan a');
		$this->db->join('detail_penjualan b','b.kode_penjualan = a.kode_penjualan','left');
		$this->db->join('produk c','c.id_produk = b.id_produk','left');
		$this->db->where('a.status','SELESAI');
		$this->db->where('c.id_kategori',$id_kategori);
        return $this->db->get()->row()->total;

	}
}
?>
