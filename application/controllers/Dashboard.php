<?php 
class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
		$this->load->model('Penjualan_model');
		$this->load->model('Pembelian_model');
		$this->load->model('Chart_model');
	}

	public function index(){
		$data['title'] = 'Dashboard';

		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$this->db->from('kategori');
		$data['kategori'] = $this->db->get()->result_array();

		$tanggal = date("Y-m");
		$this->db->select('sum(total_harga) as total');
		$this->db->from('penjualan');
		$this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')",$tanggal);
        $data['bulan_ini'] =  $this->db->get()->row()->total;

		$this->db->from('produk');
		$data['produk'] = $this->db->get()->result_array();

		$this->db->from('pelanggan');
		$data['pelanggan'] = $this->db->get()->result_array();

		$this->db->select('b.kode_produk, b.nama, SUM(a.jumlah) as total_penjualan');
		$this->db->from('detail_penjualan a');
		$this->db->join('produk b', 'a.id_produk = b.id_produk', 'left');
		$this->db->join('penjualan c', 'c.kode_penjualan = a.kode_penjualan','left');
		$this->db->where('c.status','SELESAI');
		$this->db->group_by('a.id_produk'); // Mengelompokkan hasil berdasarkan id_produk
		$this->db->order_by('total_penjualan', 'DESC'); // Mengurutkan berdasarkan total penjualan secara descending
		$this->db->limit(5);
		$data['penjualan_terbanyak'] = $this->db->get()->result_array();

		$this->db->from('penjualan a')->order_by('a.tanggal','DESC');
        $this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
		$this->db->limit(5);
		$data['activity'] = $this->db->get()->result_array();

		$this->load->view('dashboard',$data);
	}
}

?>
