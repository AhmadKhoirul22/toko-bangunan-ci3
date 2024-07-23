<?php
class Supplier extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
		$this->load->model('Penjualan_model');
	}
	public function index(){
		$this->db->from('supplier')->order_by('nama_supplier', 'ASC');
        $data['supplier']= $this->db->get()->result_array();

        $data['title'] = 'Page of Supplier';

		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();
		$this->load->view('supplier',$data);
	}

	public function tambah(){
		$this->db->from('supplier');
		$this->db->where('nama_supplier',$this->input->post('nama_supplier'));
		$cek = $this->db->get()->result_array();
		if($cek<>NULL){
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Nama Supplier Sudah di gunakan
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
			$this->session->set_flashdata('alert',$alert_html);
      	redirect('supplier');
		} else {
			$data = array(
				'nama_supplier' => $this->input->post('nama_supplier'),
				'alamat_supplier' => $this->input->post('alamat_supplier'),
				'telp_supplier' => $this->input->post('telp_supplier'),
			);
			$this->db->insert('supplier',$data);
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
			redirect('supplier');
		}
	}

	public function update(){
		$data = array(
			'nama_supplier' => $this->input->post('nama_supplier'),
			'alamat_supplier' => $this->input->post('alamat_supplier'),
			'telp_supplier' => $this->input->post('telp_supplier'),
		);
		$where = array(
			'id_supplier' => $this->input->post('id_supplier'),
		);

		$this->db->update('supplier',$data,$where);
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
			redirect('supplier');
	}

	public function delete($id){
		$data = array(
			'id_supplier' => $id
		);
		$this->db->delete('supplier',$data);
		$alert_html = '
			<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
					<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
					<line x1="12" y1="8" x2="12" y2="12"></line>
					<line x1="12" y1="16" x2="12.01" y2="16"></line>
				</svg>
				Data Berhasil dihapus
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</div>';
		$this->session->set_flashdata('alert',$alert_html);
			redirect('supplier');
	}

	public function transaksi($id_supplier){
        $this->db->select('*');
        $this->db->from('pembelian a');
        $this->db->join('supplier b','a.id_supplier=b.id_supplier');
        $this->db->where('a.id_supplier', $id_supplier);
        $transaksi = $this->db->get()->result_array();
        $data['transaksi'] = $transaksi;

		$this->db->from('profile');
		$profile = $this->db->get()->row();
		$data['profile'] = $profile;
    
        $data['title'] = 'Transaksi Supplier';
        $this->load->view('pembelian/supplier',$data);
    }
}
?>
