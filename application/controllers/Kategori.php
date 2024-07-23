<?php
class Kategori extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}
	public function index(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal_1 = date('Y-m-d');
		$this->db->select('d.id_kategori, d.nama_kategori, SUM(a.jumlah) as total_penjualan');
		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk = b.id_produk','left');
		$this->db->join('penjualan c','c.kode_penjualan = a.kode_penjualan','left');
		$this->db->join('kategori d','d.id_kategori = b.id_kategori','left');
		$this->db->where('c.status','SELESAI');
		$this->db->where('c.tanggal',$tanggal_1);
		$this->db->group_by('d.id_kategori');
		$this->db->order_by('total_penjualan', 'DESC'); 
		$data['hari_ini'] = $this->db->get()->result_array();

		date_default_timezone_set("Asia/Jakarta");
		$tanggal_2 = date('Y-m');
		$this->db->select('d.id_kategori, d.nama_kategori, SUM(a.jumlah) as total_penjualan');
		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk = b.id_produk','left');
		$this->db->join('penjualan c','c.kode_penjualan = a.kode_penjualan','left');
		$this->db->join('kategori d','d.id_kategori = b.id_kategori','left');
		$this->db->where('c.status','SELESAI');
        $this->db->where("DATE_FORMAT(c.tanggal,'%Y-%m')",$tanggal_2);
		$this->db->group_by('d.id_kategori');
		$this->db->order_by('total_penjualan','DESC'); 
		$data['bulan_ini'] = $this->db->get()->result_array();

		// date_default_timezone_set("Asia/Jakarta");
		// $tanggal_1 = date('Y-m-d');
		$this->db->select('d.id_kategori, d.nama_kategori, SUM(a.jumlah) as total_penjualan');
		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk = b.id_produk','left');
		$this->db->join('penjualan c','c.kode_penjualan = a.kode_penjualan','left');
		$this->db->join('kategori d','d.id_kategori = b.id_kategori','left');
		$this->db->where('c.status','SELESAI');
		$this->db->group_by('d.id_kategori');
		$this->db->order_by('total_penjualan', 'DESC'); 
		$data['all'] = $this->db->get()->result_array();

		$data['title'] = 'Page of Kategori';

		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();
		
		$this->db->from('kategori');
		$data['kategori'] = $this->db->get()->result_array();

		$this->load->view('kategori',$data);
	}

	public function tambah(){
        $this->db->from('kategori');
        $this->db->where('nama_kategori',$this->input->post('nama_kategori'));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Nama kategori Sudah di gunakan
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
            $this->session->set_flashdata('alert',$alert_html);
      redirect('kategori');
        }
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori')
        );
        $this->db->insert('kategori',$data);
		$alert_html = '
			<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle w-6 h-6 mr-2">
					<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
					<line x1="12" y1="9" x2="12" y2="13"></line>
					<line x1="12" y1="17" x2="12.01" y2="17"></line>
				</svg>
				Data Berhasil ditambahkan
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</div>';
        $this->session->set_flashdata('alert',$alert_html);
      redirect('kategori');
    }
    public function delete($id){
            $where = array(
                'id_kategori' => $id);
            $this->db->delete('kategori', $where);
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Data berhasil dihapus
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
            $this->session->set_flashdata('alert',$alert_html);
            redirect('kategori');
    }
	public function update(){
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori')
        );
        $where = array(
            'id_kategori' => $this->input->post('id_kategori')
        );
        $this->db->update('kategori',$data, $where);
		$alert_html = '
			<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle w-6 h-6 mr-2">
					<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
					<line x1="12" y1="9" x2="12" y2="13"></line>
					<line x1="12" y1="17" x2="12.01" y2="17"></line>
				</svg>
				Data Berhasil diupdate
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</div>';
		$this->session->set_flashdata('alert',$alert_html);
		redirect('kategori');
    }
}
?>
