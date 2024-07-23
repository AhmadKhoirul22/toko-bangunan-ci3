<!DOCTYPE html>

<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        
		<?php $this->load->view('layout/_css') ?>
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Top Bar -->
        <?php $this->load->view('layout/_top_bar') ?>
        <!-- END: Top Bar -->
        <!-- BEGIN: Top Menu -->
        <?php $this->load->view('layout/_navbar') ?>
        <!-- END: Top Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-8">
					<div id="autohide" class="mt-3">
							<?= $this->session->flashdata('alert') ?>
						</div>
					<!-- table -->
					<div class="intro-y datatable-wrapper box p-5 mt-5">
						<h2 class="text-center font-medium text-lg" >Histori Pembelian Pelanggan</h2>
						<table
							class="table table-report table-report--bordered display datatable w-full dataTable no-footer dtr-inline collapsed"
							id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
							<thead>
								<tr>
									<th class="text-center" >No</th>
									<th class="text-center">Nota</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Tanggal</th>
									<th class="text-center">Keterangan</th>
									<th class="text-center">Status</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($transaksi as $row){ ?>
								<tr class="intro-x">
									<td class="text-center" > <?= $no++; ?> </td>
									<td class="text-center" > 
										<a href="<?= base_url('penjualan/invoice/'.$row['kode_penjualan']) ?>">
										<?= $row['kode_penjualan'] ?> 
										</a>
									</td>
									<td class="text-center" > <?= $row['nama'] ?> </td>
									<td class="text-center" > <?= tanggal_indo($row['tanggal']) ?> </td>
									<td class="text-center" > <?= $row['keterangan'] ?> </td>
									<td class="text-center" > <?= $row['status'] ?> </td>
									<td class="table-report__action w-56">
										<div class="flex justify-center items-center">
										<a class="flex text-center" href="<?= base_url('penjualan/invoice/'.$row['kode_penjualan'])?>"><svg
												xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-dollar-sign">
												<line x1="12" y1="1" x2="12" y2="23"></line>
												<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
											</svg> Invoice </a>
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- table -->
                    <!-- END: General Report -->
                </div>
               
            </div>
        </div>
        <!-- END: Content -->
        <!-- BEGIN: JS Assets-->
        <?php $this->load->view('layout/_js') ?>
        <!-- END: JS Assets-->
    </body>
</html>
