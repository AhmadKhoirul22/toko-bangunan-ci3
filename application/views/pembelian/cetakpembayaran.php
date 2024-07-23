<?php
		 $this->db->select('*');
		 $this->db->from('detail_utang_pembelian a');
		 $this->db->join('utang_pembelian b', 'b.kode_pembelian = a.kode_pembelian','left');
		 $this->db->join('supplier c', 'c.id_supplier = b.id_supplier','left');
		 $this->db->where('a.tanggal <=', $tanggal_2);
		 $this->db->where('a.tanggal >=', $tanggal_1); 

		 if ($status==1) {
			 $this->db->where('b.sisa <=', 0); 
		 } elseif ($status==2) {
			 $this->db->where('b.sisa >', 0); 
		 } else if($status == 0){

		 }
		 $this->db->order_by('a.kode_pembelian', 'ASC'); 
		 $data3 = $this->db->get()->result_array();

		error_reporting(0); 
        $pdf = new FPDF('L', 'mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'Laporan Pembayaran Utang',0,1,'C');
        $pdf->Cell(0,7,tanggal_indo($tanggal_1).' sampai '.tanggal_indo($tanggal_2),0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(40,6,'No Nota',1,0,'C');
        $pdf->Cell(40,6,'Nama',1,0,'C');
        $pdf->Cell(40,6,'Tanggal',1,0,'C');
        $pdf->Cell(40,6,'Dibayar',1,0,'C');
        $pdf->Cell(40,6,'Sisa Tagihan',1,0,'C');
        $pdf->Cell(40,6,'Pembayaran',1,1,'C');
        // $pdf->Cell(40,6,'Sisa Tagihan',1,0,'C');
        // $pdf->Cell(40,6,'Keterangan',1,1,'C');
        $pdf->SetFont('Arial','',10);
        
        $no=0;
        $totalNominal=0;
        foreach ($data3 as $data){
            $no++;
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(40,6,$data['kode_pembelian'],1,0);
            $pdf->Cell(40,6,$data['nama_supplier'],1,0);
			$pdf->Cell(40,6,tanggal_indo($data['tanggal']),1,0);
			$pdf->Cell(40,6,'Rp '.number_format($data['nominal']),1,0,'R');
			$pdf->Cell(40,6,'Rp '.number_format($data['sisa']),1,0,'R');
            $pdf->Cell(40,6,$data['pembayaran'],1,1,'C');
            
            $totalNominal += $data['nominal'];
            $total_sisa += $data['sisa'];
		}
		if($status == 1){
		$pdf->SetFont('Arial','B',10);
        $pdf->Cell(210,6,'Total Pembayaran',1,0,'L');
        $pdf->Cell(40,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
		} else if($status == 2){
		$pdf->SetFont('Arial','B',10);
        $pdf->Cell(210,6,'Total Sisa Tagihan',1,0,'L');
        $pdf->Cell(40,6,'Rp '.number_format($total_sisa, 2),1,1,'R');
		$pdf->Cell(210,6,'Total Bayar',1,0,'L');
        $pdf->Cell(40,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
		// $pdf->Cell(210,6,'Total Hutang',1,0,'L');
        // $pdf->Cell(40,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
		} else if($status == 0){
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(210,6,'Total Bayar',1,0,'L');
        $pdf->Cell(40,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
		$pdf->Cell(210,6,'Total Sisa Tagihan',1,0,'L');
        $pdf->Cell(40,6,'Rp '.number_format($total_sisa, 2),1,1,'R');
		}
        
        $pdf->Output();
?>
