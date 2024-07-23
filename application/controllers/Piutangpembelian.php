<?php 
class Piutangpembelian extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}
	public function index(){
		$this->db->from('utang_pembelian a');
		$this->db->join('supplier b','b.id_supplier = a.id_supplier','left');
		$this->db->join('pembelian c','c.kode_pembelian = a.kode_pembelian','left');
		$this->db->where('c.status','SELESAI');
		$this->db->where('a.sisa >',0);
		$data['utang_pembelian'] = $this->db->get()->result_array();

		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$data['title'] = 'Utang Pembelian';

		$this->load->view('pembelian/utang',$data);
	}

	public function cicilan($kode_pembelian){
		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$data['title'] = 'Utang Pembelian';

		$this->db->from('pembelian a');
		$this->db->join('supplier b','b.id_supplier = a.id_supplier','left');
		$this->db->join('utang_pembelian c','c.kode_pembelian = a.kode_pembelian','left');
		$this->db->where('a.kode_pembelian',$kode_pembelian);
		$data['utang_pembelian'] = $this->db->get()->result_array();

		$this->db->select('*');
		$this->db->where('kode_pembelian',$kode_pembelian);
		$this->db->from('detail_utang_pembelian');
		$data['detail_pembelian'] = $this->db->get()->result_array();

		$this->load->view('pembelian/cicilan',$data);
	}

	public function bayarcicilan(){
		date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("y-m-d");

		$sisa = $this->input->post('sisa')-$this->input->post('nominal');
		if($sisa < 1){
			$sisa = 0;
		}
		$data = array(
			'sisa' => $sisa,
		);
		$where = array(
			'kode_pembelian' => $this->input->post('kode_pembelian'),
		);
		$this->db->update('utang_pembelian',$data,$where);

		// Mendapatkan total harga dan total bayar dari penjualan
		$this->db->select('total_harga, bayar');
		$this->db->from('pembelian');
		$this->db->where('kode_pembelian', $this->input->post('kode_pembelian'));
		$penjualan = $this->db->get()->row();
	
		// Menghitung total bayar
		$total_bayar = $penjualan->bayar+$this->input->post('nominal');
	
		// Mengupdate keterangan dan total bayar pada tabel penjualan
		if($penjualan->total_harga > $total_bayar){
			$keterangan = 'UTANG';
		} else {
			$keterangan = 'LUNAS';
		}
	
		$data = array(
			'bayar' => $total_bayar,
			'keterangan' => $keterangan
		);
		$where = array('kode_pembelian' => $this->input->post('kode_pembelian'));
		$this->db->update('pembelian', $data, $where);

		$this->db->select('*');
        $this->db->from('detail_utang_pembelian');
        $this->db->where('kode_pembelian', $this->input->post('kode_pembelian')); 
        $count = $this->db->count_all_results();
		if($sisa > 0){
			$data = array(
                'kode_pembelian' => $this->input->post('kode_pembelian'),
                'cicilan_ke' => $count,
                'nominal' => $this->input->post('nominal'),
                'tanggal' => $tanggal,
                'pembayaran' => $this->input->post('pembayaran')
             ); 
			 $this->db->insert('detail_utang_pembelian',$data);
			 $alert_html = '
			<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle w-6 h-6 mr-2">
					<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
					<line x1="12" y1="9" x2="12" y2="13"></line>
					<line x1="12" y1="17" x2="12.01" y2="17"></line>
				</svg>
				Pembayaran selesai dilakukan
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</div>';
			$this->session->set_flashdata('alert',$alert_html);
			redirect('piutang_pembelian');
		} else{
			$data = array(
                'kode_pembelian' => $this->input->post('kode_pembelian'),
                'cicilan_ke' => $count,
                'nominal' => $this->input->post('nominal'),
                'tanggal' => $tanggal,
                'pembayaran' => $this->input->post('pembayaran')
             ); 
			 $this->db->insert('detail_utang_pembelian',$data);
			 $alert_html = '
			<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle w-6 h-6 mr-2">
					<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
					<line x1="12" y1="9" x2="12" y2="13"></line>
					<line x1="12" y1="17" x2="12.01" y2="17"></line>
				</svg>
				Hutang Telah Dilunasi
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</div>';
			$this->session->set_flashdata('alert',$alert_html);
			
			redirect('piutangpembelian');
		}
	}
}
?>
