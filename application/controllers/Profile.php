<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}
	public function index(){
        $data['title'] = 'Page of Profile';
        $data['header'] = 'Profile';

        $this->db->from('profile');
        $data['profile'] = $this->db->get()->row();
		
		$this->load->view('profile',$data);
	}

    public function update(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp'),
            'email' => $this->input->post('email'),
            'no_rekening' => $this->input->post('no_rekening'),
        );
        $where = array('id_profile' => 1);
        $this->db->update('profile',$data,$where);
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
        
		redirect('profile');
    }
}
