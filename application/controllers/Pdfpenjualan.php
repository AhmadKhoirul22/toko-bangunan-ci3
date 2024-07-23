<?php 
class Pdfpenjualan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}

	public function cetakpenjualan(){
		$tanggal_1 = $this->input->post('tanggal_1');
		$tanggal_2 = $this->input->post('tanggal_2');
		$kategori = $this->input->post('kategori');

		// $this->db->from('penjualan');
		$this->db->where('tanggal >=',$tanggal_1);
		$this->db->where('tanggal <=',$tanggal_2);

		$this->penjualan($tanggal_1,$tanggal_2);
	}

	public function penjualan($tanggal_1,$tanggal_2){
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('L', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'Laporan Penjualan',0,1,'C');
        $pdf->Cell(0,7,tanggal_indo($tanggal_1).' sampai '.tanggal_indo($tanggal_2),0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'No',1,0,'C');
        $pdf->Cell(25,6,'No Nota',1,0,'C');
        $pdf->Cell(35,6,'Nama',1,0,'C');
        $pdf->Cell(45,6,'tanggal',1,0,'C');
        $pdf->Cell(45,6,'Pembayaran',1,0,'C');
        $pdf->Cell(45,6,'Keterangan',1,0,'C');
        $pdf->Cell(45,6,'Bayar',1,1,'C');
        $pdf->SetFont('Arial','',10);
        
		$this->db->from('penjualan a');
        $this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
		$this->db->where('a.status','SELESAI');
        $penjualan = $this->db->get()->result();
        $no=0;
        $totalNominal=0;
        foreach ($penjualan as $data){
            $no++;
            $pdf->Cell(20,6,$no,1,0, 'C');
            $pdf->Cell(25,6,$data->kode_penjualan,1,0);
            $pdf->Cell(35,6,$data->nama,1,0);
            $pdf->Cell(45,6,tanggal_indo($data->tanggal),1,0);
            $pdf->Cell(45,6,$data->pembayaran,1,0,'C');
            $pdf->Cell(45,6,$data->keterangan,1,0,'C');
            $pdf->Cell(45,6,'Rp '.number_format($data->bayar),1,1,'R');
            $totalNominal += $data->bayar;
        }
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(215,6,'Total Penjualan',1,0,'L');
        $pdf->Cell(45,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
        $pdf->Output();
	}

	public function status(){
		$tanggal_1 = $this->input->post('tanggal_1');
		$tanggal_2 = $this->input->post('tanggal_2');
		$status = $this->input->post('status');

		$this->db->from('utang_penjualan a');
        $this->db->join('pelanggan b', 'b.id_pelanggan = a.id_pelanggan','left');
        $this->db->join('penjualan c', 'c.kode_penjualan = a.kode_penjualan','left');
		$this->db->where('c.status','SELESAI');
        $this->db->where('c.tanggal <=', $tanggal_2);
        $this->db->where('c.tanggal >=', $tanggal_1); 
        if ($status==1) {
            $this->db->where('a.sisa <=', 0); 
        } elseif ($status==2) {
            $this->db->where('a.sisa >', 0); 
        } else if($status == 0){
			
		}
		$this->db->order_by('c.kode_penjualan', 'ASC'); 
        $data = $this->db->get()->result();

		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('L', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'Laporan Piutang',0,1,'C');
        $pdf->Cell(0,7,tanggal_indo($tanggal_1).' sampai '.tanggal_indo($tanggal_2),0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'No',1,0,'C');
        $pdf->Cell(30,6,'No Nota',1,0,'C');
        $pdf->Cell(35,6,'Nama',1,0,'C');
        $pdf->Cell(45,6,'Tanggal',1,0,'C');
        $pdf->Cell(45,6,'Total Tagihan',1,0,'C');
        $pdf->Cell(45,6,'Sisa Tagihan',1,0,'C');
        $pdf->Cell(45,6,'Keterangan',1,1,'C');
        $pdf->SetFont('Arial','',10);
        
        $no=0;
        $totalNominal=0;
		$total_utang=0;
        foreach ($data as $data){
            $no++;
            $pdf->Cell(20,6,$no,1,0, 'C');
            $pdf->Cell(30,6,$data->kode_penjualan,1,0);
            $pdf->Cell(35,6,$data->nama,1,0);
            $pdf->Cell(45,6,tanggal_indo($data->tanggal),1,0);
            $pdf->Cell(45,6,'Rp '.number_format($data->total_harga),1,0,'R');
            $pdf->Cell(45,6,'Rp '.number_format($data->sisa),1,0,'R');
            $pdf->Cell(45,6,$data->keterangan,1,1,'C');
            $totalNominal += $data->total_harga;
			$total_utang += $data->sisa;
        }
        $pdf->SetFont('Arial','B',10);
		if($status == 1){
		$pdf->Cell(220,6,'Total tagihan',1,0,'L');
        $pdf->Cell(45,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
		} else if($status == 2){
		$pdf->Cell(220,6,'Total Tagihan',1,0,'L');
        $pdf->Cell(45,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
		$pdf->Cell(220,6,'Total tagihan yang belum dibayar',1,0,'L');
        $pdf->Cell(45,6,'Rp '.number_format($total_utang, 2),1,1,'R');
		$pdf->Cell(220,6,'Total tagihan yang sudah dibayar',1,0,'L');
        $pdf->Cell(45,6,'Rp '.number_format($totalNominal-$total_utang, 2),1,1,'R');
		} else if($status == 0){
		$pdf->Cell(220,6,'Total dari tagihan',1,0,'L');
        $pdf->Cell(45,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
		$pdf->Cell(220,6,'Total tagihan yang belum dibayar',1,0,'L');
        $pdf->Cell(45,6,'Rp '.number_format($total_utang, 2),1,1,'R');
		$pdf->Cell(220,6,'Total tagihan yang sudah dibayar',1,0,'L');
        $pdf->Cell(45,6,'Rp '.number_format($totalNominal-$total_utang, 2),1,1,'R');
		}
        
        $pdf->Output();
	}

	public function cetakcicilan(){
		$tanggal_1 = $this->input->post('tanggal_1');
		$tanggal_2 = $this->input->post('tanggal_2');
		$status = $this->input->post('status');

		$data = array(
			// 'utang' => $utang,
			'tanggal_1' => $tanggal_1,
			'tanggal_2' => $tanggal_2,
			'status' => $status,
		);
		$this->load->view('penjualan/cetakcicilan',$data);
	}

	public function cetakpembayaran(){
		$tanggal_1 = $this->input->post('tanggal_1');
		$tanggal_2 = $this->input->post('tanggal_2');
		$status = $this->input->post('status');

		$data = array(
			// 'utang' => $utang,
			'tanggal_1' => $tanggal_1,
			'tanggal_2' => $tanggal_2,
			'status' => $status,
		);
		$this->load->view('penjualan/cetakpembayaran',$data);
	}
}
?>
