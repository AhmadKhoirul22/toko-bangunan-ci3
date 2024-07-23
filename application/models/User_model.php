<?php
class User_model extends CI_Model{
    public function tambah()
	{
        $data = array(
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'password' => md5($this->input->post('username')),
            'level' => $this->input->post('level'),
        );
        $this->db->insert('user',$data);
	}
    public function update(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'level' => $this->input->post('level')
        );
        $where = array(
            'id_user' => $this->input->post('id_user')
        );
        $this->db->update('user',$data, $where);
    }
}


?>