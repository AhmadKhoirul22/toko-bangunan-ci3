<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('pdf');
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}
    
	public function index(){
        date_default_timezone_set('Asia/Jakarta');
		$tanggal = date('Y-m-d');
		$bulan_ini = date('m'); // Ambil bulan saat ini
		$tahun_ini = date('Y'); // Ambil tahun saat ini

		$data['judul_halaman'] = 'Page of Penjualan';
		$data['title'] = 'Page of Penjualan';

		$this->db->from('produk');
		$data['produk'] = $this->db->get()->result_array();

		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		// Query untuk menampilkan penjualan bulan ini saja
		$this->db->from('penjualan a')->order_by('a.kode_penjualan', 'DESC');
		$this->db->join('pelanggan b', 'a.id_pelanggan=b.id_pelanggan', 'left');
		$this->db->where('MONTH(a.tanggal)', $bulan_ini); // Membandingkan bulan
		$this->db->where('YEAR(a.tanggal)', $tahun_ini);  // Membandingkan tahun
		$data['penjualan'] = $this->db->get()->result_array();

		$this->db->from('penjualan s');
		$this->db->join('detail_penjualan d', 'd.kode_penjualan = s.kode_penjualan', 'left');
		$data['detail'] = $this->db->get()->result_array();

		$this->db->from('pelanggan');
		$data['pelanggan'] = $this->db->get()->result_array();

		$this->load->view('penjualan/penjualan', $data);
	}

	public function datalengkap(){
		date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $data['judul_halaman'] = 'Page of Penjualan';
        $data['title'] = 'Data Lengkap Penjualan';

        $this->db->from('produk');
        $data['produk'] = $this->db->get()->result_array();

		$this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

        // $this->db->from('detail_penjualan a')->order_by('a.kode_penjualan','DESC');
		$this->db->from('penjualan c','c.kode_penjualan = a.kode_penjualan','left');
        $this->db->join('pelanggan b','c.id_pelanggan=b.id_pelanggan','left');
        $data['penjualan'] = $this->db->get()->result_array();

		$this->db->from('penjualan s');
		$this->db->join('detail_penjualan d','d.kode_penjualan = s.kode_penjualan','left');
		$data['detail'] = $this->db->get()->result_array();

        $this->db->from('pelanggan');
        $data['pelanggan'] = $this->db->get()->result_array();

		$this->load->view('penjualan/datalengkap',$data);
	}
    
    public function transaksi($id_pelanggan){
		$this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');

        $this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        $jumlah = $this->db->count_all_results();
        
        $nota  = date('ymd').$jumlah+1;
        $data['nota'] = $nota;

        $data['id_pelanggan'] = $id_pelanggan;

        $this->db->from('pelanggan')->where('id_pelanggan',$id_pelanggan);
        $data['nama_pelanggan'] = $this->db->get()->row()->nama;

        $this->db->from('produk')->where('stok >',0)->order_by('nama','ASC');
        $data['produk'] = $this->db->get()->result_array();

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.kode_penjualan',$nota);
        $data['detail'] = $this->db->get()->result_array();

        $this->db->from('temp a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.id_user',$this->session->userdata('id_user'));
        $this->db->where('a.id_pelanggan',$id_pelanggan);
        $data['temp'] = $this->db->get()->result_array();

        $data['title'] = 'Tambah Penjualan';
        $this->load->view('penjualan/transaksi',$data);
    }
    
    public function tambahtemp(){
        $this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
        $stok_lama =  $this->db->get()->row()->stok;

        $this->db->from('temp');
        $this->db->where('id_produk',$this->input->post('id_produk'));
        $this->db->where('id_user',$this->session->userdata('id_user'));
        $this->db->where('id_pelanggan',$this->input->post('id_pelanggan'));
        $cek = $this->db->get()->result_array();

        if($stok_lama<$this->input->post('jumlah')){
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Stok Produk tidak mencukupi
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
            $this->session->set_flashdata('alert',$alert_html);
        } else if($this->input->post('jumlah') == 0){
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Stok Minimal 1
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
            $this->session->set_flashdata('alert',$alert_html);
		}
		else if($cek<>NULL){
			$alert_html = '
				<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
						<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
					Produk sudah dipilih
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</div>';
            $this->session->set_flashdata('alert',$alert_html);
            
        } else {
            $data = array(
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_produk' => $this->input->post('id_produk'),
                'id_user' => $this->session->userdata('id_user'),
                'jumlah' => $this->input->post('jumlah')
            );
            $this->db->insert('temp',$data);
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
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }
    public function deletetemp($id_temp){
        $where = array(
            'id_temp' => $id_temp);
        $this->db->delete('temp', $where);
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
        redirect($_SERVER["HTTP_REFERER"]);
    }
    public function bayartemp(){
        //pembuatan nota
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');
        $this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        $jumlah = $this->db->count_all_results();
        $nota  = date('ymd').$jumlah+1;

        $this->db->from('temp a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.id_user',$this->session->userdata('id_user'));
        $this->db->where('a.id_pelanggan',$this->input->post('id_pelanggan'));
        $temp = $this->db->get()->result_array();
        $total = 0;
        $total_beli = 0;
        foreach($temp as $ar){
            //cek stok apakah melebihi jumlah
            if($ar['stok']<$ar['jumlah']){
                $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                Stok Produk Tidak Mencukupii
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect($_SERVER["HTTP_REFERER"]);
            }
            $total = $total+$ar['jumlah']*$ar['harga_jual'];
            $total_beli = $total_beli+$ar['jumlah']*$ar['harga_beli'];
            //input ke tabel detail penjualan
            $data = array(
                'kode_penjualan' => $nota,
                'id_produk' => $ar['id_produk'],
                'jumlah' => $ar['jumlah'],
                'harga_beli' => $ar['harga_beli'],
                'harga_jual' => $ar['harga_jual'],
            );
            $this->db->insert('detail_penjualan',$data);
            //update stok produk
            $data2 = array('stok' => $ar['stok']-$ar['jumlah']);
            $where = array('id_produk' => $ar['id_produk']);
            $this->db->update('produk',$data2,$where);
            //update tabel temp
            $aaa = array(
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_user' => $this->session->userdata('id_user'),
            );
            $this->db->delete('temp',$aaa);
        }
					// detail utang
					$sisa_tagihan = $total - $this->input->post('bayar');
					if($sisa_tagihan < 1){
						$keterangan = 'LUNAS';
						$sisa_tagihan = 0;
						$data = array(
							'kode_penjualan' => $nota,
							'cicilan_ke' => 'DP',
							'nominal' => $this->input->post('bayar'),
							'tanggal' => date('Y-m-d'),
							'pembayaran' => $this->input->post('pembayaran')
						);
						$this->db->insert('detail_utang_penjualan',$data);
						$data = array(
							'kode_penjualan' => $nota,
							'total_harga' => $total,
							'sisa' => $sisa_tagihan,
							'id_pelanggan' => $this->input->post('id_pelanggan'),
						);
						$this->db->insert('utang_penjualan',$data);
					} else if($sisa_tagihan > 0){
						$keterangan = 'UTANG';
						$data = array(
							'kode_penjualan' => $nota,
							'cicilan_ke' => 'DP',
							'nominal' => $this->input->post('bayar'),
							'tanggal' => date('Y-m-d'),
							'pembayaran' => $this->input->post('pembayaran')
						);
						$this->db->insert('detail_utang_penjualan',$data);
						$data = array(
							'kode_penjualan' => $nota,
							'total_harga' => $total,
							'sisa' => $sisa_tagihan,
							'id_pelanggan' => $this->input->post('id_pelanggan'),
						);
						$this->db->insert('utang_penjualan',$data);
					}
        //bagian penjualan
        $data = array(
            'kode_penjualan' => $nota,
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'total_harga' => $total,
            'tanggal' => date('Y-m-d'),
			'bayar' => $this->input->post('bayar'),
			'pembayaran' => $this->input->post('pembayaran'),
			'keterangan' => $keterangan,
			'status' => 'SELESAI',
        );
        $this->db->insert('penjualan',$data);
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
        redirect('penjualan/invoice/'.$nota);
        // redirect('admin/penjualan/invoice/'.$nota);
    }
	public function update($kode_penjualan){
		// Ambil data produk dan jumlah dari detail pembelian
		$this->db->from('detail_penjualan');
		$this->db->where('kode_penjualan',$kode_penjualan);
		$detail_penjualan = $this->db->get()->result_array();
	
		foreach ($detail_penjualan as $detail) {
			$id_produk = $detail['id_produk'];
			$jumlah = $detail['jumlah'];
			
			// Ambil stok lama dari tabel produk
			$this->db->from('produk');
			$this->db->where('id_produk', $id_produk);
			$query = $this->db->get();
			$stok_lama = $query->row();
			
			if ($stok_lama) {
				// Jika produk ditemukan, update stok
				$penjumlahan = $stok_lama->stok + $jumlah;
				
				// Siapkan data untuk update stok
				$data = array(
					'stok' => $penjumlahan
				);
				$this->db->where('id_produk', $id_produk);
				$this->db->update('produk', $data);
			}
		}
	
		// Update status pembelian
		$data2 = array(
			'status' => $this->input->post('status'),
		);
		$this->db->where('kode_penjualan', $kode_penjualan);
		$this->db->update('penjualan', $data2);
	
		// Set flash data untuk notifikasi
		$alert_html = '
			<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle w-6 h-6 mr-2">
					<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
					<line x1="12" y1="9" x2="12" y2="13"></line>
					<line x1="12" y1="17" x2="12.01" y2="17"></line>
				</svg>
				Pembelian berhasil dicancel
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4 ml-auto">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</div>';
		$this->session->set_flashdata('alert', $alert_html);
		redirect($_SERVER["HTTP_REFERER"]);
	}
    public function invoice($kode_penjualan){
		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$data['title'] = 'Invoice Penjualan';

		$this->db->from('penjualan a');
		$this->db->join('pelanggan b','b.id_pelanggan = a.id_pelanggan','left');
		$this->db->join('utang_penjualan c','c.kode_penjualan = a.kode_penjualan','left');
		$this->db->where('a.kode_penjualan',$kode_penjualan);
		$data['utang'] = $this->db->get()->result_array();

		$this->db->from('detail_penjualan y');
		$this->db->join('produk x','x.id_produk = y.id_produk','left');
		$this->db->where('y.kode_penjualan',$kode_penjualan);
		$data['detail_penjualan'] = $this->db->get()->result_array();

		$this->db->select('*');
		$this->db->where('kode_penjualan',$kode_penjualan);
		$this->db->from('detail_utang_penjualan');
		$data['detail'] = $this->db->get()->result_array();

		$this->load->view('penjualan/invoice',$data);
    }
    public function delete($id){
	$id_produk = $this->input->post('id_produk');
	$jumlah = $this->input->post('jumlah');
	
	$this->db->from('produk');
    $this->db->where('id_produk', $id_produk);
    $query = $this->db->get();
    $stok_lama = $query->row();

    if ($stok_lama) {
        // If product is found, proceed with updating the stock
        $penjumlahan = $stok_lama->stok + $jumlah;

        // Prepare data for update
        $data = array(
            'stok' => $penjumlahan
        );
		$this->db->where('id_produk', $id_produk);
        $this->db->update('produk', $data);
	
        $where = array(
            'kode_penjualan' => $id);
        $this->db->delete('penjualan', $where);

		$where = array(
            'kode_penjualan' => $id);
        $this->db->delete('detail_utang_penjualan', $where);

		$where = array(
            'kode_penjualan' => $id);
        $this->db->delete('utang_penjualan', $where);

		$where = array(
            'kode_penjualan' => $id);
        $this->db->delete('detail_penjualan', $where);
		
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
        redirect($_SERVER["HTTP_REFERER"]);
		}
    }

	public function cetakinvoice($kode_penjualan){
		error_reporting(0);
	
		// Ambil data dari database
		$this->db->from('profile');
		$profile = $this->db->get()->row();
	
		$this->db->from('penjualan a');
		$this->db->join('pelanggan b','b.id_pelanggan = a.id_pelanggan','left');
		$this->db->join('utang_penjualan c','c.kode_penjualan = a.kode_penjualan','left');
		$this->db->where('a.kode_penjualan',$kode_penjualan);
		$utang = $this->db->get()->row();
	
		$this->db->from('detail_penjualan y');
		$this->db->join('produk x','x.id_produk = y.id_produk','left');
		$this->db->where('y.kode_penjualan',$kode_penjualan);
		$detail_penjualan = $this->db->get()->result();
	
		// Set up PDF
		$pdf = new FPDF('L', 'mm','Letter');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(0,20,$profile->nama,0,1,'C');
	
		$pdf->SetFont('Arial','',12);
		// baris
		$pdf->SetX(10);
		$pdf->Cell(60, 7, 'From:', 0, 0, 'L');
		$pdf->SetX(215);
		$pdf->Cell(60, 7, 'To:', 0, 1, 'L');
		// $pdf->SetX(215);
		// $pdf->Cell(60, 7, '-', 0, 1, 'L');

		$pdf->SetX(10);
		$pdf->Cell(60, 7, $profile->nama, 0, 0, 'L');
		$pdf->SetX(215);
		$pdf->Cell(60, 7, $utang->nama, 0, 1, 'L');
		// $pdf->SetX(215);
		// $pdf->Cell(60, 7,'No Nota : '.$utang->kode_penjualan, 0, 1, 'L');

		$pdf->SetX(10);
		$pdf->Cell(60, 7, $profile->alamat, 0, 0, 'L');
		$pdf->SetX(215);
		$pdf->Cell(60, 7, $utang->alamat, 0,  1,'L');
		

		$pdf->SetX(10);
		$pdf->Cell(60, 7,'Telp : '. $profile->telp, 0, 0, 'L');
		$pdf->SetX(215);
		$pdf->Cell(60, 7,'Telp : '.$utang->telp, 0, 1, 'L');
		// $pdf->SetX(215);
		// $pdf->Cell(60, 7,'Tanggal : '.tanggal_indo($utang->tanggal), 0, 1, 'L');

		$pdf->SetX(10);
		$pdf->Cell(60, 7,'Email : '.$profile->email, 0, 0, 'L');
		$pdf->SetX(215);
		$pdf->Cell(60, 7,'Nota : '.$utang->kode_penjualan, 0, 1, 'L');
		$pdf->SetX(10);
		$pdf->Cell(60, 7,'BCA : '.$profile->no_rekening, 0, 0, 'L');
		$pdf->Cell(0, 7, '', 0, 0, 'R'); 
		$pdf->SetX(215);
		$pdf->Cell(60, 7,'Pembayaran : '.$utang->pembayaran, 0, 1, 'L');

		
	
		// Tabel detail penjualan
		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,6,'No',1,0,'C');
		$pdf->Cell(85,6,'kode produk',1,0,'C');
		$pdf->Cell(27,6,'produk',1,0,'C');
		$pdf->Cell(25,6,'jumlah',1,0,'C');
		$pdf->Cell(45,6,'harga',1,0,'C');
		$pdf->Cell(45,6,'total',1,1,'C');
		$pdf->SetFont('Arial','',10);
	
		$no=0;
		$totalNominal=0;
		foreach ($detail_penjualan as $data){
			$no++;
			$pdf->Cell(20,6,$no,1,0, 'C');
			$pdf->Cell(85,6,$data->kode_produk,1,0);
			$pdf->Cell(27,6,$data->nama,1,0);
			$pdf->Cell(25,6,$data->jumlah,1,0);
			$pdf->Cell(45,6,'Rp '.number_format($data->harga),1,0,'R');
			$pdf->Cell(45,6,'Rp '.number_format($data->sub_total),1,1,'R');
			$totalNominal = $totalNominal+$data->jumlah*$data->harga;
		}
	
		// Total Harga
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(202,6,'Total Harga',1,0,'L');
		$pdf->Cell(45,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
	
		$pdf->Cell(202,6,'Sudah Dibayar',1,0,'L');
		$pdf->Cell(45,6,'Rp '.number_format($utang->bayar, 2),1,1,'R');
	
		if($utang->keterangan == 'LUNAS'){
			$pdf->Cell(202,6,'Kembalian',1,0,'L');
			$pdf->Cell(45,6,'Rp '.number_format($utang->bayar-$utang->total_harga, 2),1,1,'R');
			$pdf->Cell(247,6,'Lunas',1,0,'C');
		} else if ($utang->keterangan != 'LUNAS'){
			$pdf->Cell(202,6,'Kekurangan',1,0,'L');
			$pdf->Cell(45,6,'Rp '.number_format($utang->sisa, 2),1,1,'R');
		}
	
		$pdf->Output();
	}	
	public function cetaknota($kode_penjualan){
		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$data['title'] = 'Cetak Nota';

		$this->db->from('penjualan a');
		$this->db->join('pelanggan b','b.id_pelanggan = a.id_pelanggan','left');
		$this->db->join('utang_penjualan c','c.kode_penjualan = a.kode_penjualan','left');
		$this->db->where('a.kode_penjualan',$kode_penjualan);
		$data['utang'] = $this->db->get()->result_array();

		$this->db->from('detail_penjualan y');
		$this->db->join('produk x','x.id_produk = y.id_produk','left');
		$this->db->where('y.kode_penjualan',$kode_penjualan);
		$data['detail_penjualan'] = $this->db->get()->result_array();

		$this->db->select('*');
		$this->db->where('kode_penjualan',$kode_penjualan);
		$this->db->from('detail_utang_penjualan');
		$data['detail'] = $this->db->get()->result_array();

		$this->load->view('penjualan/cetaknota',$data);
	}
	
}
