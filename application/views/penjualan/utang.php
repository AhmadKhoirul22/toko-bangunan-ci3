<!DOCTYPE html>

<html lang="en">
<!-- BEGIN: Head -->

<head>
	<?php $this->load->view('layout/_css.php') ?>
</head>
<!-- END: Head -->

<body class="app">
	<!-- BEGIN: Top Bar -->
	<?php $this->load->view('layout/_top_bar.php') ?>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<?php $this->load->view('layout/_navbar.php') ?>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="card">
			<div class="card-body">
				<div id="autohide" class="mt-3">
					<?= $this->session->flashdata('alert') ?>
				</div>
				<div class="text-right w-full">
					<a href="javascript:;" data-toggle="modal" data-target="#datepicker-modal-preview"
						class="button mt-3 inline-block bg-theme-1 text-white">Cetak Data Piutang</a>
					<a href="javascript:;" data-toggle="modal" data-target="#datepicker-modal-preview_cicilan"
						class="button mt-3 inline-block bg-theme-1 text-white">Cetak Data Cicilan</a>
					<!-- <a href="javascript:;" data-toggle="modal" data-target="#datepicker-modal-preview_pembayaran"
						class="button mt-3 inline-block bg-theme-6 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="15"
							height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
							stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer mx-auto">
							<polyline points="6 9 6 2 18 2 18 9"></polyline>
							<path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
							<rect x="6" y="14" width="12" height="8"></rect>
						</svg>Cetak Data Pembayaran</a> -->
				</div>
				
				<!-- modal cetak Pembelian -->
				<div class="modal" id="datepicker-modal-preview">
					<div class="modal__content">
						<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
							<h2 class="font-medium text-base mr-auto">
								Cetak Data Piutang
							</h2>
						</div>
						<form action="<?= base_url('pdfpenjualan/status') ?>" method="post" target="_blank">
							<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
								<div class="col-span-12 sm:col-span-6">
									<label>From</label>
									<div class="relative w-56 mx-auto">
										<input type="date" class="input pl-12 border" name="tanggal_1">
									</div>
								</div>
								<div class="col-span-12 sm:col-span-6">
									<label>To</label>
									<div class="relative w-56 mx-auto">
										<input type="date" class="input pl-12 border" name="tanggal_2">
									</div>
								</div>
								<div class="col-span-12 sm:col-span-6">
									<div class="relative w-56 mx-auto">
										<select name="status" id="" class="input w-full" >
											<option value="0">Semua</option>
											<option value="1">Lunas</option>
											<option value="2">Belum Lunas</option>
										</select>
									</div>
								</div>
							</div>
							<div class="px-5 py-3 text-right border-t border-gray-200">
								<button type="submit" class="button w-20 bg-theme-1 text-white">Submit</button>
							</div>
						</form>
					</div>
				</div>
				<!-- end cetak pembelian -->

				<!-- modal cetak cicilan pembelian -->
				<div class="modal" id="datepicker-modal-preview_cicilan">
					<div class="modal__content">
						<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
							<h2 class="font-medium text-base mr-auto">
								Cetak Data Cicilan
							</h2>
						</div>
						<form action="<?= base_url('pdfpenjualan/cetakcicilan') ?>" method="post" target="_blank">
							<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
								<div class="col-span-12 sm:col-span-6">
									<label>From</label>
									<div class="relative w-56 mx-auto">
										<input type="date" class="input pl-12 border" name="tanggal_1">
									</div>
								</div>
								<div class="col-span-12 sm:col-span-6">
									<label>To</label>
									<div class="relative w-56 mx-auto">
										<input type="date" class="input pl-12 border" name="tanggal_2">
									</div>
								</div>
								<div class="col-span-12 sm:col-span-6">
									<div class="relative w-56 mx-auto">
										<select name="status" id="" class="input w-full" >
											<option value="0">Semua</option>
											<option value="1">Lunas</option>
											<option value="2">Belum Lunas</option>
										</select>
									</div>
								</div>
							</div>
							<div class="px-5 py-3 text-right border-t border-gray-200">
								<button type="submit" class="button w-20 bg-theme-1 text-white">Submit</button>
							</div>
						</form>
					</div>
				</div>
				<!-- end cetak cicilan pembelian -->

				<!-- modal cetak pembayaran pembelian -->
				<div class="modal" id="datepicker-modal-preview_pembayaran">
					<div class="modal__content">
						<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
							<h2 class="font-medium text-base mr-auto">
								Cetak Data Pembayaran
							</h2>
						</div>
						<form action="<?= base_url('pdfpenjualan/cetakpembayaran') ?>" method="post" target="_blank">
							<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
								<div class="col-span-12 sm:col-span-6">
									<label>From</label>
									<div class="relative w-56 mx-auto">
										<input type="date" class="input pl-12 border" name="tanggal_1">
									</div>
								</div>
								<div class="col-span-12 sm:col-span-6">
									<label>To</label>
									<div class="relative w-56 mx-auto">
										<input type="date" class="input pl-12 border" name="tanggal_2">
									</div>
								</div>
								<div class="col-span-12 sm:col-span-6">
									<div class="relative w-56 mx-auto">
										<select name="status" id="" class="input w-full" >
											<option value="0">Semua</option>
											<option value="1">Lunas</option>
											<option value="2">Belum Lunas</option>
										</select>
									</div>
								</div>
							</div>
							<div class="px-5 py-3 text-right border-t border-gray-200">
								<button type="submit" class="button w-20 bg-theme-1 text-white">Submit</button>
							</div>
						</form>
					</div>
				</div>
				<!-- end cetak pembayaran pembelian -->

				<!-- BEGIN: General Report -->
				<div class="intro-y datatable-wrapper box p-5 mt-5">
						<table
							class="table table-report table-report--bordered display datatable w-full dataTable no-footer dtr-inline collapsed"
							id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
							<thead>
								<tr>
									<th class="text-center" >No</th>
									<th class="text-center">Nota</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Total Tagihan</th>
									<th class="text-center">Total Sisa</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($utang as $row){ ?>
								<tr class="intro-x">
									<td class="text-center" > <?= $no++; ?> </td>
									<td class="text-center" > <?= $row['kode_penjualan'] ?> </td>
									<td class="text-center" > <?= $row['nama'] ?> </td>
									<td class="text-right" >Rp <?= number_format($row['total_harga'])  ?> </td>
									<td class="text-right" >Rp <?= number_format($row['sisa'])  ?> </td>
									<td class="table-report__action w-56">
										<div class="flex justify-center items-center">
											<a class="flex items-center mr-3"
												href="<?= base_url('piutangpenjualan/cicilan/'.$row['kode_penjualan']) ?>">
												<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
													stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
													class="feather feather-dollar-sign mx-auto">
													<line x1="12" y1="1" x2="12" y2="23"></line>
													<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
												</svg>
												Bayar </a>
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<!-- END: General Report -->
			</div>

		</div>
	</div>
	<!-- END: Content -->
	<!-- BEGIN: JS Assets-->
	<?php $this->load->view('layout/_js.php') ?>
	<!-- END: JS Assets-->
</body>

</html>
