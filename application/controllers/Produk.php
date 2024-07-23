<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Produk extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}

	public function index(){
        $this->db->from('produk x');
		$this->db->join('kategori y','y.id_kategori = x.id_kategori','left');
        $data['produk'] = $this->db->get()->result_array();

        $data['title'] = 'Page of Produk';

        $this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

		$this->db->select('b.kode_produk, b.nama, SUM(a.jumlah) as total_penjualan');
		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk = b.id_produk','left');
		$this->db->join('penjualan c','c.kode_penjualan = a.kode_penjualan','left');
		$this->db->where('c.status','SELESAI');
		$this->db->group_by('a.id_produk'); // Mengelompokkan hasil berdasarkan id_produk
		$this->db->order_by('total_penjualan', 'DESC'); // Mengurutkan berdasarkan total penjualan secara descending
		$data['penjualan_terbanyak'] = $this->db->get()->result_array();

		$this->db->select('b.kode_produk, b.nama, SUM(a.jumlah) as total_penjualan');
		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk = b.id_produk','left');
		$this->db->join('penjualan c','c.kode_penjualan = a.kode_penjualan','left');
		$this->db->where('c.status','DICANCEL');
		$this->db->group_by('a.id_produk'); // Mengelompokkan hasil berdasarkan id_produk
		$this->db->order_by('total_penjualan', 'DESC'); // Mengurutkan berdasarkan total penjualan secara descending
		$data['dicancel'] = $this->db->get()->result_array();

		$this->db->from('kategori');
		$data['kategori'] = $this->db->get()->result_array();

		$this->load->view('produk',$data);
	}
    public function tambah(){
        date_default_timezone_set('Asia/Jakarta');

        $currentDateTime = new DateTime();
        $year = $currentDateTime->format('y'); // Mendapatkan tahun (2 digit)
        $month = $currentDateTime->format('m'); // Mendapatkan bulan (3 karakter)
        $day = $currentDateTime->format('d');
        
        $currentHour = $currentDateTime->format('H');
        $currentMinute = $currentDateTime->format('i');
        $currentSecond = $currentDateTime->format('s');

        $currentDateTime->setTime($currentHour, $currentMinute, $currentSecond);

        $data = array(
            // 'kode_produk' => $year.$month.$day.$currentDateTime->format('His'),
            'nama' => $this->input->post('nama'),
            'id_kategori' => $this->input->post('id_kategori'),
            'kode_produk' => $this->input->post('kode_produk'),
            'stok' => $this->input->post('stok'),
            'harga' => $this->input->post('harga')
        );
        $this->db->insert('produk',$data);
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
    	redirect('produk');
    }
    public function delete($id){
	$this->db->select('kode_penjualan');
    $this->db->from('detail_penjualan');
    $this->db->where('id_produk', $id);
    $kode_penjualan_list = $this->db->get()->result_array();

    // Hapus semua entri pada detail_penjualan yang memiliki id_produk yang akan dihapus
    $this->db->where('id_produk', $id);
    $this->db->delete('detail_penjualan');

    // Hapus entri terkait di penjualan berdasarkan kode_penjualan
    if (!empty($kode_penjualan_list)) {
        foreach ($kode_penjualan_list as $kode_penjualan) {
            $this->db->where('kode_penjualan', $kode_penjualan['kode_penjualan']);
            $this->db->delete('penjualan');
        }
    } 

	$this->db->select('kode_pembelian');
    $this->db->from('detail_pembelian');
    $this->db->where('id_produk', $id);
    $kode_pembelian_list = $this->db->get()->result_array();

    // Hapus semua entri pada detail_pembelian yang memiliki id_produk yang akan dihapus
    $this->db->where('id_produk', $id);
    $this->db->delete('detail_pembelian');

    // Hapus entri terkait di pembelian berdasarkan kode_pembelian
    if (!empty($kode_pembelian_list)) {
        foreach ($kode_pembelian_list as $kode_pembelian) {
            $this->db->where('kode_pembelian', $kode_pembelian['kode_pembelian']);
            $this->db->delete('pembelian');
        }
    }
	
        $where = array(
            'id_produk' => $id);
        $this->db->delete('produk', $where);
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
        redirect('produk');
    }
    public function update(){
        $data = array(
            'kode_produk' => $this->input->post('kode_produk'),
            'nama' => $this->input->post('nama'),
            'stok' => $this->input->post('stok'),
            'id_kategori' => $this->input->post('id_kategori'),
            'harga' => $this->input->post('harga'),
        );
        $where = array(
            'id_produk' => $this->input->post('id_produk')
        );
        $this->db->update('produk',$data,$where);
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
    	redirect('produk');
    }
	// import excel
	public function excel() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$upload_status = $this->uploadDoc();
			if ($upload_status != false) {
				$inputFileName = 'assets/upload/excel/' . $upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet = $spreadsheet->getSheet(0);
				$count_Rows = 0;
				$success_count = 0;
				$error_count = 0;
	
				// Ambil nilai header dari baris pertama
				$header = [
					'A' => $spreadsheet->getActiveSheet()->getCell('A1')->getValue(),
					'B' => $spreadsheet->getActiveSheet()->getCell('B1')->getValue(),
					'C' => $spreadsheet->getActiveSheet()->getCell('C1')->getValue(),
					'D' => $spreadsheet->getActiveSheet()->getCell('D1')->getValue(),
					'E' => $spreadsheet->getActiveSheet()->getCell('E1')->getValue()
				];
	
				foreach ($sheet->getRowIterator() as $row) {
					// Lewati baris pertama (header)
					if ($row->getRowIndex() == 1) {
						continue;
					}
	
					$kode_produk = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex())->getValue();
					$nama = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex())->getValue();
					$id_kategori = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex())->getValue();
					$stok = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex())->getValue();
					$harga = $spreadsheet->getActiveSheet()->getCell('E' . $row->getRowIndex())->getValue();
	
					// Jika data di baris sama dengan header, lewati
					if ($kode_produk == $header['A'] && $nama == $header['B'] && $id_kategori == $header['C'] && $stok == $header['D'] && $harga == $header['E']) {
						$error_count++;
						continue;
					}
	
					if (!$this->isDataImported($kode_produk, $nama)) {
						$data = array(
							'kode_produk' => $kode_produk,
							'nama' => $nama,
							'stok' => $stok,
							'harga' => $harga,
							'id_kategori' => $id_kategori
						);
						$this->db->insert('produk', $data);
						$success_count++;
					} else {
						$error_count++;
					}
					$count_Rows++;
				}
	
				if ($success_count > 0) {
					$alert_html = '
					<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
							stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
							class="feather feather-alert-triangle w-6 h-6 mr-2">
							<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
							<line x1="12" y1="9" x2="12" y2="13"></line>
							<line x1="12" y1="17" x2="12.01" y2="17"></line>
						</svg>
						' . $success_count . ' Data Berhasil ditambahkan
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
							stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
							class="feather feather-x w-4 h-4 ml-auto">
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg>
					</div>';
				} else {
					$alert_html = '
					<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
							stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
							class="feather feather-alert-octagon w-6 h-6 mr-2">
							<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
							<line x1="12" y1="8" x2="12" y2="12"></line>
							<line x1="12" y1="16" x2="12.01" y2="16"></line>
						</svg>
						Tidak ada data yang ditambahkan karena sudah pernah ada atau data adalah header
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
							stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
							class="feather feather-x w-4 h-4 ml-auto">
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg>
					</div>';
				}
				$this->session->set_flashdata('alert', $alert_html);
				redirect('produk');
			} else {
				$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
						stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
						class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					File tidak valid
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
						stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
						class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
				$this->session->set_flashdata('alert', $alert_html);
				redirect('produk');
			}
		} else {
			$this->load->view('produk');
		}
	}
	
	
    public function uploadDoc(){
        $uploadPath = 'assets/upload/excel/';
        if(!is_dir($uploadPath)){
            mkdir($uploadPath,0777,true); //untuk membuat directori
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 100000;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->upload->do_upload('upload_excel')){ //upload excel itu nama pada form nya
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

	private function isDataImported($kode_produk, $nama){
		$this->db->where('kode_produk', $kode_produk);
		$this->db->where('nama', $nama);
		$query = $this->db->get('produk');
		return $query->num_rows() > 0;
	}
}
