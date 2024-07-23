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
						<h2 class="text-center font-medium text-lg" >Histori Pembelian <?= $profile->nama ?></h2>
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
										<a href="<?= base_url('pembelian/invoice/'.$row['kode_pembelian']) ?>">
										<?= $row['kode_pembelian'] ?> 
										</a>
									</td>
									<td class="text-center" > <?= $row['nama_supplier'] ?> </td>
									<td class="text-center" > <?= tanggal_indo($row['tanggal']) ?> </td>
									<td class="text-center" > <?= $row['keterangan'] ?> </td>
									<td class="text-center" > <?= $row['status'] ?> </td>
									<td class="text-center">
										<div class="flex justify-center items-center">
										<a class="flex text-center" href="<?= base_url('pembelian/invoice/'.$row['kode_pembelian'])?>"><svg
												xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-shopping-cart mx-auto">
												<circle cx="9" cy="21" r="1"></circle>
												<circle cx="20" cy="21" r="1"></circle>
												<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
											</svg>Invoice </a>
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
