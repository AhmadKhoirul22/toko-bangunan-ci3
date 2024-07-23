<?php 
class User extends CI_Controller{
	public function __construct(){
	parent::__construct();
	if($this->session->userdata('level')==NULL){
	redirect('auth');
	}
	$this->load->model('User_model');

	}
	public function index(){
		$data['title'] = 'User';

		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$this->db->from('user');
		$data['user'] = $this->db->get()->result_array();

		$this->load->view('user',$data);
	}

	public function tambah() {
		$this->db->from('user');
		$this->db->where('username', $this->input->post('username'));
		$cek = $this->db->get()->result_array();
		
		if ($cek != NULL) {
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Username Sudah di gunakan
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
			$this->session->set_flashdata('alert', $alert_html);
			redirect('user');
		}
	
		$this->User_model->tambah();
	
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
		$this->session->set_flashdata('alert', $alert_html);
		redirect('user');
	}
	
	public function update() {
		$this->User_model->update();
	
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
		$this->session->set_flashdata('alert', $alert_html);
		redirect('user');
	}
	
	public function delete($id) {
		$where = array('id_user' => $id);
		$this->db->delete('user', $where);
	
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
		$this->session->set_flashdata('alert', $alert_html);
		redirect('user');
	}
	
}

?>
