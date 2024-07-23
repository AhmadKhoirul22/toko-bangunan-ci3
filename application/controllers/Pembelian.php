<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

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

        $data['title'] = 'Page of Penjualan';

        $this->db->from('produk');
        $data['produk'] = $this->db->get()->result_array();

		$this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

        $this->db->from('pembelian a')->order_by('a.kode_pembelian','DESC');
        $this->db->join('supplier b','a.id_supplier=b.id_supplier','left');
		// $this->db->join('detail_pembelian c','c.kode_pembelian = a.kode_pembelian','left');
        $this->db->where('a.tanggal',$tanggal);
        $data['pembelian'] = $this->db->get()->result_array();

		$this->db->from('pembelian y')->order_by('y.kode_pembelian','DESC');
        $this->db->join('detail_pembelian x','x.kode_pembelian = y.kode_pembelian','left');
		$data['detail'] = $this->db->get()->result_array();

        $this->db->from('supplier');
        $data['supplier'] = $this->db->get()->result_array();

		$this->load->view('pembelian/pembelian',$data);
	}

	public function datalengkap(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');

        $data['title'] = 'Data Lengkap Pembelian';

        $this->db->from('produk');
        $data['produk'] = $this->db->get()->result_array();

		$this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

        $this->db->from('pembelian a')->order_by('a.kode_pembelian','DESC');
        $this->db->join('supplier b','a.id_supplier=b.id_supplier','left');
		// $this->db->join('detail_pembelian c','c.kode_pembelian = a.kode_pembelian','left');
        $data['pembelian'] = $this->db->get()->result_array();

		$this->db->from('pembelian y')->order_by('y.kode_pembelian','DESC');
        $this->db->join('detail_pembelian x','x.kode_pembelian = y.kode_pembelian','left');
		$data['detail'] = $this->db->get()->result_array();

        $this->db->from('supplier');
        $data['supplier'] = $this->db->get()->result_array();

		$this->load->view('pembelian/datalengkap',$data);
	}
    
    public function transaksi($id_supplier){
		$this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');

        $this->db->from('pembelian')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        $jumlah = $this->db->count_all_results();
        
        $nota  = date('ymd').$jumlah+1;
        $data['nota'] = $nota;

        $data['id_supplier'] = $id_supplier;

        $this->db->from('supplier')->where('id_supplier',$id_supplier);
        $data['nama_supplier'] = $this->db->get()->row()->nama_supplier;

        $this->db->from('produk')->where('stok >',0)->order_by('nama','ASC');
        $data['produk'] = $this->db->get()->result_array();

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.kode_penjualan',$nota);
        $data['detail'] = $this->db->get()->result_array();

        $this->db->from('temporary a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.id_user',$this->session->userdata('id_user'));
        $this->db->where('a.id_supplier',$id_supplier);
        $data['temporary'] = $this->db->get()->result_array();

        $data['title'] = 'Tambah Pembelian';
        $this->load->view('pembelian/transaksi',$data);
    }
    
    public function tambahtemp(){
        // $this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
        // $stok_lama =  $this->db->get()->row()->stok;

        $this->db->from('temporary');
        $this->db->where('id_produk',$this->input->post('id_produk'));
        $this->db->where('id_user',$this->session->userdata('id_user'));
        $this->db->where('id_supplier',$this->input->post('id_supplier'));
        $cek = $this->db->get()->result_array();

        if($cek<>NULL){
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
		else {
            $data = array(
                'id_supplier' => $this->input->post('id_supplier'),
                'id_produk' => $this->input->post('id_produk'),
                'id_user' => $this->session->userdata('id_user'),
                'jumlah' => $this->input->post('jumlah')
            );
            $this->db->insert('temporary',$data);
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
    public function deletetemp($id_temporary){
        $where = array(
            'id_temporary' => $id_temporary);
        $this->db->delete('temporary', $where);
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
        $this->db->from('pembelian')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        $jumlah = $this->db->count_all_results();
        $nota  = date('ymd').$jumlah+1;

        $this->db->from('temporary a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.id_user',$this->session->userdata('id_user'));
        $this->db->where('a.id_supplier',$this->input->post('id_supplier'));
        $temporary = $this->db->get()->result_array();
        $total = 0;
        foreach($temporary as $ar){
           
            $total = $total+$ar['jumlah']*$ar['harga'];
            //input ke tabel detail penjualan
            $data = array(
                'kode_pembelian' => $nota,
                'id_produk' => $ar['id_produk'],
                'jumlah' => $ar['jumlah'],
                'sub_total' => $ar['jumlah']*$ar['harga'],
            );
            $this->db->insert('detail_pembelian',$data);
            //update stok produk
            $data2 = array('stok' => $ar['stok']+$ar['jumlah']);
            $where = array('id_produk' => $ar['id_produk']);
            $this->db->update('produk',$data2,$where);
            //update tabel temp
            $aaa = array(
                'id_supplier' => $this->input->post('id_supplier'),
                'id_user' => $this->session->userdata('id_user'),
            );
            $this->db->delete('temporary',$aaa);
        }
					// detail utang
					$sisa_tagihan = $total - $this->input->post('bayar');
					if($sisa_tagihan < 1){
						$keterangan = 'LUNAS';
						$sisa_tagihan = 0;
						$data = array(
							'kode_pembelian' => $nota,
							'cicilan_ke' => 'DP',
							'nominal' => $this->input->post('bayar'),
							'tanggal' => date('Y-m-d'),
							'pembayaran' => $this->input->post('pembayaran')
						);
						$this->db->insert('detail_utang_pembelian',$data);
						$data = array(
							'kode_pembelian' => $nota,
							'total_harga' => $total,
							'sisa' => $sisa_tagihan,
							'id_supplier' => $this->input->post('id_supplier'),
						);
						$this->db->insert('utang_pembelian',$data);
					} else if($sisa_tagihan > 0){
						$keterangan = 'UTANG';
						$data = array(
							'kode_pembelian' => $nota,
							'cicilan_ke' => 'DP',
							'nominal' => $this->input->post('bayar'),
							'tanggal' => date('Y-m-d'),
							'pembayaran' => $this->input->post('pembayaran')
						);
						$this->db->insert('detail_utang_pembelian',$data);
						$data = array(
							'kode_pembelian' => $nota,
							'total_harga' => $total,
							'sisa' => $sisa_tagihan,
							'id_supplier' => $this->input->post('id_supplier'),
						);
						$this->db->insert('utang_pembelian',$data);
					}
        //bagian penjualan
        $data = array(
            'kode_pembelian' => $nota,
            'id_supplier' => $this->input->post('id_supplier'),
            'total_harga' => $total,
            'tanggal' => date('Y-m-d'),
			'bayar' => $this->input->post('bayar'),
			'pembayaran' => $this->input->post('pembayaran'),
			'keterangan' => $keterangan,
			'status' => 'SELESAI',
        );
        $this->db->insert('pembelian',$data);
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
        redirect('pembelian/invoice/'.$nota);
        // redirect('admin/penjualan/invoice/'.$nota);
    }
	public function update($kode_pembelian){
		// Ambil data produk dan jumlah dari detail pembelian
		$this->db->from('detail_pembelian');
		$this->db->where('kode_pembelian', $kode_pembelian);
		$detail_pembelian = $this->db->get()->result_array();
	
		foreach ($detail_pembelian as $detail) {
			$id_produk = $detail['id_produk'];
			$jumlah = $detail['jumlah'];
			
			// Ambil stok lama dari tabel produk
			$this->db->from('produk');
			$this->db->where('id_produk', $id_produk);
			$query = $this->db->get();
			$stok_lama = $query->row();
			
			if ($stok_lama) {
				// Jika produk ditemukan, update stok
				$penjumlahan = $stok_lama->stok - $jumlah;
				
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
		$this->db->where('kode_pembelian', $kode_pembelian);
		$this->db->update('pembelian', $data2);
	
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
	
    public function invoice($kode_pembelian){
		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$data['title'] = 'Invoice Pembelian';

		$this->db->from('pembelian a');
		$this->db->join('supplier b','b.id_supplier = a.id_supplier','left');
		$this->db->join('utang_pembelian c','c.kode_pembelian = a.kode_pembelian','left');
		$this->db->where('a.kode_pembelian',$kode_pembelian);
		$data['utang_pembelian'] = $this->db->get()->result_array();

		$this->db->from('detail_pembelian y');
		$this->db->join('produk x','x.id_produk = y.id_produk','left');
		$this->db->where('y.kode_pembelian',$kode_pembelian);
		$data['pembelian'] = $this->db->get()->result_array();

		$this->db->select('*');
		$this->db->where('kode_pembelian',$kode_pembelian);
		$this->db->from('detail_utang_pembelian');
		$data['detail_pembelian'] = $this->db->get()->result_array();

		$this->load->view('pembelian/invoice',$data);
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
        $penjumlahan = $stok_lama->stok - $jumlah;

        // Prepare data for update
        $data = array(
            'stok' => $penjumlahan
        );
		$this->db->where('id_produk', $id_produk);
        $this->db->update('produk', $data);

        $where = array(
            'kode_pembelian' => $id);
        $this->db->delete('pembelian', $where);

		$where = array(
            'kode_pembelian' => $id);
        $this->db->delete('detail_utang_pembelian', $where);

		$where = array(
            'kode_pembelian' => $id);
        $this->db->delete('utang_pembelian', $where);

		$where = array(
            'kode_pembelian' => $id);
        $this->db->delete('detail_pembelian', $where);

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

	public function cetakinvoice($kode_pembelian){
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
	
		$this->db->from('profile');
		$profile = $this->db->get()->row();
	
		$title = 'Invoice Penjualan';
	
		$this->db->from('pembelian a');
		$this->db->join('supplier b','b.id_supplier = a.id_supplier','left');
		$this->db->join('utang_pembelian c','c.kode_pembelian = a.kode_pembelian','left');
		$this->db->where('a.kode_pembelian',$kode_pembelian);
		$utang = $this->db->get()->row();
	
		$this->db->from('detail_pembelian y');
		$this->db->join('produk x','x.id_produk = y.id_produk','left');
		$this->db->where('y.kode_pembelian',$kode_pembelian);
		$detail_pembelian = $this->db->get()->result();
	
		$this->db->select('*');
		$this->db->where('kode_pembelian',$kode_pembelian);
		$this->db->from('detail_utang_pembelian');
		$detail = $this->db->get()->result();
	
		$pdf = new FPDF('L', 'mm','Letter');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(0,20,$profile->nama,0,1,'C');
	
		$pdf->SetFont('Arial','',12);
	
		// Baris untuk "From:", "To:", dan "NOTA:"
		$pdf->SetX(10);
		$pdf->Cell(60, 7, 'From:', 0, 0, 'L');
		$pdf->SetX(125);
		$pdf->Cell(60, 7, 'To:', 0, 0, 'L');
		$pdf->SetX(230);
		$pdf->Cell(60, 7, '-', 0, 1, 'L');
		
		$pdf->SetX(125);
		$pdf->Cell(60, 7, $profile->nama, 0, 0, 'L');
		$pdf->SetX(10);
		$pdf->Cell(60, 7, $utang->nama_supplier, 0, 0, 'L');
		$pdf->SetX(230);
		$pdf->Cell(60, 7,'No Nota : '.$utang->kode_pembelian, 0, 1, 'L');
		
		$pdf->SetX(125);
		$pdf->Cell(60, 7, $profile->alamat, 0, 0, 'L');
		$pdf->SetX(10);
		$pdf->Cell(60, 7, $utang->alamat_supplier, 0, 0, 'L');
		$pdf->SetX(230);
		$pdf->Cell(60, 7,'Pembayaran : '.$utang->pembayaran, 0, 1, 'L');
		
		$pdf->SetX(125);
		$pdf->Cell(60, 7,'Telp : '. $profile->telp, 0, 0, 'L');
		$pdf->SetX(10);
		$pdf->Cell(60, 7,'Telp : '.$utang->telp_supplier, 0, 0, 'L');
		$pdf->SetX(230);
		$pdf->Cell(60, 7,'Tanggal : '.tanggal_indo($utang->tanggal), 0, 1, 'L');
		
		$pdf->SetX(125);
		$pdf->Cell(60, 7,'Email : '.$profile->email, 0, 1, 'L');
		$pdf->SetX(125);
		$pdf->Cell(60, 7,'BCA : '.$profile->nama.$profile->no_rekening, 0, 0, 'L');
		$pdf->Cell(0, 7, '', 0, 1, 'R'); 
	
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
		foreach ($detail_pembelian as $data){
			$no++;
			$pdf->Cell(20,6,$no,1,0, 'C');
			$pdf->Cell(85,6,$data->kode_produk,1,0);
			$pdf->Cell(27,6,$data->nama,1,0);
			$pdf->Cell(25,6,$data->jumlah,1,0);
			$pdf->Cell(45,6,'Rp '.number_format($data->harga),1,0,'R');
			$pdf->Cell(45,6,'Rp '.number_format($data->sub_total),1,1,'R');
			$totalNominal = $totalNominal+$data->jumlah*$data->harga;
		}
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(202,6,'Total Harga',1,0,'L');
		$pdf->Cell(45,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
	
		$pdf->Cell(202,6,'Sudah Dibayar',1,0,'L');
		$pdf->Cell(45,6,'Rp '.number_format($utang->total_harga-$utang->sisa, 2),1,1,'R');
		if($utang->keterangan == 'LUNAS'){
			$pdf->Cell(247,6,'Lunas',1,0,'C');
		} else if ($utang->keterangan != 'LUNAS'){
			$pdf->Cell(202,6,'Belum Dibayar',1,0,'L');
			$pdf->Cell(45,6,'Rp '.number_format($utang->sisa, 2),1,1,'R');
		}
		$pdf->Output();
	}

	public function cetaknota($kode_pembelian){
		$this->db->from('profile');
		$data['profile'] = $this->db->get()->row();

		$data['title'] = 'Invoice Pembelian';

		$this->db->from('pembelian a');
		$this->db->join('supplier b','b.id_supplier = a.id_supplier','left');
		$this->db->join('utang_pembelian c','c.kode_pembelian = a.kode_pembelian','left');
		$this->db->where('a.kode_pembelian',$kode_pembelian);
		$data['utang_pembelian'] = $this->db->get()->result_array();

		$this->db->from('detail_pembelian y');
		$this->db->join('produk x','x.id_produk = y.id_produk','left');
		$this->db->where('y.kode_pembelian',$kode_pembelian);
		$data['pembelian'] = $this->db->get()->result_array();

		$this->db->select('*');
		$this->db->where('kode_pembelian',$kode_pembelian);
		$this->db->from('detail_utang_pembelian');
		$data['detail_pembelian'] = $this->db->get()->result_array();

		$this->load->view('pembelian/cetaknota',$data);
	}
}
