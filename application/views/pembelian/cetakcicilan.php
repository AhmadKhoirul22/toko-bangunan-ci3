<?php
		$this->db->from('utang_pembelian a');
        $this->db->join('supplier b', 'b.id_supplier = a.id_supplier','left');
        $this->db->join('pembelian c', 'c.kode_pembelian = a.kode_pembelian','left');
		$this->db->where('c.status','SELESAI');
        $this->db->where('c.tanggal <=', $tanggal_2);
        $this->db->where('c.tanggal >=', $tanggal_1); 
        if ($status==1) {
            $this->db->where('a.sisa <=', 0); 
        } elseif ($status==2) {
            $this->db->where('a.sisa >', 0); 
        } else if($status == 0){

		}
		$this->db->order_by('c.kode_pembelian', 'ASC'); 
        $utang = $this->db->get()->result_array();

		error_reporting(0); 
        $pdf = new FPDF('L', 'mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'Laporan Cicilan Utang',0,1,'C');
        $pdf->Cell(0,7,tanggal_indo($tanggal_1).' sampai '.tanggal_indo($tanggal_2),0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(25,6,'No Nota',1,0,'C');
        $pdf->Cell(35,6,'Nama',1,0,'C');
        $pdf->Cell(40,6,'Tanggal',1,0,'C');
        $pdf->Cell(25,6,'Cicilan',1,0,'C');
        $pdf->Cell(35,6,'Bayar',1,0,'C');
        $pdf->Cell(35,6,'Total Tagihan',1,0,'C');
        $pdf->Cell(35,6,'Sisa Tagihan',1,0,'C');
        $pdf->Cell(35,6,'Keterangan',1,1,'C');
        $pdf->SetFont('Arial','',10);
        
        $no=0;
        $totalNominal=0;
		
        foreach ($utang as $data){
            $no++;
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(25,6,$data['kode_pembelian'],1,0);
            $pdf->Cell(35,6,$data['nama_supplier'],1,0);
			$this->db->select('*');
			$this->db->where('kode_pembelian',$data['kode_pembelian']);
			$this->db->from('detail_utang_pembelian');
			$detail = $this->db->get()->result_array();

			$firstRow = true; // Menandakan baris pertama dari detail
        	foreach ($detail as $det) {
            if (!$firstRow) {
                $pdf->Cell(10, 6, '', 1, 0); // Kosongkan kolom-kolom sebelumnya
                $pdf->Cell(60, 6, '', 1, 0); // Kosongkan kolom-kolom sebelumnya
            } else {
                $firstRow = false;
            }
			$pdf->Cell(40,6,tanggal_indo($det['tanggal']),1,0);
			$pdf->Cell(25,6,$det['cicilan_ke'],1,0,'C');
			$pdf->Cell(35,6,'Rp '.number_format($det['nominal']),1,0,'R');
            $pdf->Cell(35,6,'Rp '.number_format($data['total_harga']),1,0,'R');
            $pdf->Cell(35,6,'Rp '.number_format($data['sisa']),1,0,'R');
            $pdf->Cell(35,6,$data['keterangan'],1,1,'C');
            $total += $det['nominal'];
			$tagihan += $data['total_harga'];
			$total_utang += $data['sisa'];
		   }
        }
        $pdf->SetFont('Arial','B',10);
		if($status == 0){
		$pdf->Cell(240,6,'Total sudah bayar',1,0,'L');
		$pdf->Cell(35,6,'Rp '.number_format($total, 2),1,1,'R');
		$pdf->Cell(240,6,'Total sisa tagihan',1,0,'L');
		$pdf->Cell(35,6,'Rp '.number_format($total_utang, 2),1,1,'R');
		} else if($status == 1){
		$pdf->Cell(240,6,'Total uang dari tagihan',1,0,'L');
        $pdf->Cell(35,6,'Rp '.number_format($total, 2),1,1,'R');
		} else if($status == 2){
		$pdf->Cell(240,6,'Total sudah bayar',1,0,'L');
        $pdf->Cell(35,6,'Rp '.number_format($total, 2),1,1,'R');
		$pdf->Cell(240,6,'Total sisa tagihan',1,0,'L');
        $pdf->Cell(35,6,'Rp '.number_format($total_utang, 2),1,1,'R');
		}
        
        $pdf->Output();
?>
