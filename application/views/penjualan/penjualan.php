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
                        <div class="intro-y flex items-center h-10">
						<div class="text-left w-full">
							<a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
								class="button mr-1 mb-2 inline-block bg-theme-1 text-white">Tambah Penjualan</a>
						</div>

						<div class="text-right w-full">
							<a href="javascript:;" data-toggle="modal" data-target="#datepicker-modal-preview"
								class="button mb-2 justify-end inline-block bg-theme-1 text-white">
								Cetak Data Penjualan</a>
						</div>
						
						<!-- modal add user -->
						<div class="modal" id="superlarge-modal-size-preview">
							<div class="modal__content modal__content--xl p-10">
							
							<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
								<h2 class="font-medium text-base mr-auto">
									Tambah Penjualan
								</h2>
							</div>
							<div class="intro-y datatable-wrapper box p-5 mt-5">
						<table
							class="table table-report table-report--bordered display datatable w-full dataTable no-footer dtr-inline collapsed"
							id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
							<thead>
								<tr>
									<th class="text-center" >No</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Alamat</th>
									<th class="text-center">Telp</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($pelanggan as $row){ ?>
								<tr class="intro-x">
									<td class="text-center" > <?= $no++; ?> </td>
									<td class="text-center" > <?= $row['nama'] ?> </td>
									<td class="text-center" > <?= $row['alamat'] ?> </td>
									<td class="text-center" > <?= $row['telp'] ?> </td>
									<td class="table-report__action w-56">
										<div class="flex justify-center items-center">
											<a class="flex items-center mr-3"
												href="<?= base_url('penjualan/transaksi/'.$row['id_pelanggan']) ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
													stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1">
													<polyline points="9 11 12 14 22 4"></polyline>
													<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
												</svg> Pilih </a>
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
							</div>
						</div>
						<!-- end modal add user -->
						 <!-- modal cetak penjualan -->
						 <div class="modal" id="datepicker-modal-preview">
						 	<div class="modal__content">
						 		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
						 			<h2 class="font-medium text-base mr-auto">
						 				Filter by Date
						 			</h2>
						 		</div>
							<form action="<?= base_url('pdfpenjualan/cetakpenjualan') ?>" method="post" target="_blank">
						 		<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
						 			<div class="col-span-12 sm:col-span-6">
						 				<label>From</label>
						 				<div class="relative w-56 mx-auto">
						 					<input type="date" class="input pl-12 border" name="tanggal_1" >
						 				</div>
						 			</div>
						 			<div class="col-span-12 sm:col-span-6">
						 				<label>To</label>
						 				<div class="relative w-56 mx-auto">
						 					<input type="date" class="input pl-12 border" name="tanggal_2" >
						 				</div>
						 			</div>
						 		</div>
						 		<div class="px-5 py-3 text-right border-t border-gray-200">
						 			<button type="submit" class="button w-20 bg-theme-1 text-white" >Submit</button>
						 		</div>
								 </form>
						 	</div>
						 </div>
						<!-- end cetak penjualan -->
                        </div>
                    </div>
					<div id="autohide" class="mt-3">
							<?= $this->session->flashdata('alert') ?>
						</div>
					<!-- table -->
					<div class="intro-y datatable-wrapper box p-5 mt-5">
						<h2 class="text-center font-medium text-lg" >Penjualan Hari ini</h2>
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
								<?php $no=1; foreach($penjualan as $row){ ?>
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
										<a class="flex items-center mr-3" data-toggle="modal" data-target=""
												href="<?= base_url('penjualan/invoice/'.$row['kode_penjualan']) ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
													stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1">
													<polyline points="9 11 12 14 22 4"></polyline>
													<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
												</svg> Invoice </a>
										<!-- <form action="<?= base_url('penjualan/delete/'.$row['kode_penjualan']) ?>" method="post" >
												<input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>" >
												<input type="hidden" name="jumlah" value="<?= $row['jumlah'] ?>" >
												<button class="flex items-center text-theme-6" type="submit" onclick="return confirm('yakin untuk mengcancel penjualan?')" >
												<svg xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
													stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1">
													<polyline points="3 6 5 6 21 6"></polyline>
													<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
													</path>
													<line x1="10" y1="11" x2="10" y2="17"></line>
													<line x1="14" y1="11" x2="14" y2="17"></line>
												</svg> Deleted 
												</button>
											</form> -->
											<?php if($row['status'] == 'SELESAI'){ ?>
											<form action="<?= base_url('penjualan/update/'.$row['kode_penjualan']) ?>" method="post" >
												<?php foreach($detail as $det){ ?>
												<input type="hidden" name="id_produk" value="<?= $det['id_produk'] ?>" >
												<input type="hidden" name="jumlah" value="<?= $det['jumlah'] ?>" >
												<?php } ?>
												<input type="hidden" name="status" value="DICANCEL" >
												<button class="flex items-center text-theme-6" type="submit" onclick="return confirm('yakin untuk mengcancel penjualan?')" >
												<svg xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
													stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1">
													<polyline points="3 6 5 6 21 6"></polyline>
													<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
													</path>
													<line x1="10" y1="11" x2="10" y2="17"></line>
													<line x1="14" y1="11" x2="14" y2="17"></line>
												</svg> Cancel 
												</button>
											</form>
											<?php } ?>
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
