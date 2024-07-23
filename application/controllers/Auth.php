<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');

	}

	public function index(){
		$data['title'] = 'Login';

		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$this->load->view('login',$data);
	}
	public function login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
	
		$this->db->from('user')->where('username', $username);
		$user = $this->db->get()->row();
	
		if ($user == NULL) {
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Username Tidak Terdaftar
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
			$this->session->set_flashdata('alert',$alert_html);
			redirect('auth');
		} elseif ($user->password == $password) {
			$data = array(
				'username' => $user->username,
				'nama'     => $user->nama,
				'level'    => $user->level,
				'id_user'  => $user->id_user,
			);
			$this->session->set_userdata($data);
			redirect('dashboard');
		} else {
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Password salah
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
			$this->session->set_flashdata('alert',$alert_html);
			redirect('auth');
		}
	}
	
    public function logout(){
		// $user_id = $this->session->userdata('id_user');
		// $date = date('Y-m-d H:i:s');
		// $this->db->set('last_login',$date);
		// $this->db->where('id_user', $user_id); 
		// $this->db->update('user');
			$this->session->sess_destroy();
			redirect('auth');
	}
}
