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
				<div id="autohide" class="mt-3">
					<?= $this->session->flashdata('alert') ?>
				</div>
				<!-- BEGIN: konten -->
				 <div class="grid grid-cols-12 gap-6 mt-5">
				 	<div class="intro-y col-span-12 lg:col-span-4">
				 		<form action="<?= base_url('pembelian/tambahtemp') ?>" method="post">
				 			<input type="hidden" name="id_supplier" value="<?= $id_supplier ?>">
				 			<input type="hidden" name="kode_penjualan" value="<?= $nota ?>">
				 			<div class="intro-y box p-5 mt-5">
				 				<div>
				 					<label>Nama Supplier</label>
				 					<input type="text" name="nama" value="<?= $nama_supplier ?>" class="input w-full border mt-2"
				 						readonly>
				 				</div>
				 				<div class="mt-3">
				 					<label>Produk</label>
				 					<select class="select2 w-full" name="id_produk" >
				 						<?php foreach($produk as $produk){ ?>
				 						<option value="<?= $produk['id_produk'] ?>"><?= $produk['nama'] ?> | Stok <?= $produk['stok'] ?></option>
				 						<?php } ?>
				 					</select>

				 				</div>
				 				<div class="mt-3">
				 					<label>Jumlah</label>
				 					<input type="number" name="jumlah" class="input w-full border mt-2">
				 				</div>
				 				<div class="text-right mt-5">
				 					<button type="submit" class="button w-24 bg-theme-1 text-white">Submit</button>
				 				</div>
				 			</div>
				 		</form>
				 	</div>
				 	<div class="intro-y box col-span-12 lg:col-span-8 mt-5">
				 			<table
				 				class="table table-report table-report--bordered display datatable w-full dataTable no-footer dtr-inline collapsed">
				 				<thead>
				 					<tr>
				 						<th class="text-center">Kode Produk</th>
				 						<th class="text-center">Produk</th>
				 						<th class="text-center">Jumlah</th>
				 						<th class="text-center">Harga</th>
				 						<th class="text-center">Total</th>
				 						<th class="text-center">Aksi</th>
				 					</tr>
				 				</thead>
				 				<tbody>
				 					<?php $total=0; foreach($temporary as $row){ ?>
				 					<tr>
				 						<td class="text-center"> <?= $row['kode_produk'] ?> </td>
				 						<td class="text-center"> <?= $row['nama'] ?> </td>
				 						<td class="text-center"> <?= $row['jumlah'] ?> </td>
				 						<td class="text-right">Rp <?= number_format($row['harga'])  ?> </td>
				 						<td class="text-right">Rp <?= number_format($row['harga']*$row['jumlah'])  ?> </td>
				 						<td class="table-report__action">
				 							<div class="flex justify-center items-center">
										<a class=" flex items-center text-theme-6" onClick="return confirm('apakah yakin untuk hapus data')"
				 								href="<?= base_url('pembelian/deletetemp/'.$row['id_temporary']) ?>"
				 								data-toggle="modal" data-target="#delete-confirmation-modal"> <svg
				 									xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
				 									fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
				 									stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1">
				 									<polyline points="3 6 5 6 21 6"></polyline>
				 									<path
				 										d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
				 									</path>
				 									<line x1="10" y1="11" x2="10" y2="17"></line>
				 									<line x1="14" y1="11" x2="14" y2="17"></line>
				 								</svg> Delete </a>
				 							</div>
				 						</td>
				 					</tr>
									<?php $total=$total+$row['harga']*$row['jumlah']; } ?>
									<tr>
										<td class="text-center" >
											total harga
										</td>
										<td colspan="4" class="text-right" >Rp <?= number_format($total)  ?></td>
									</tr>
				 				</tbody>
				 			</table>
				 		
						<!-- form -->
						<form action="<?= base_url('pembelian/bayartemp') ?>" method="post">
				 			<input type="hidden" name="id_supplier" value="<?= $id_supplier ?>">
							<?php if($temporary != NULL){ ?>
				 			<div class="intro-y box p-5 mt-5">
				 				<div>
				 					<label>Bayar</label>
				 					<div class="relative" id="input-groups" >
				 						<input type="number" id="bayar" oninput="hitungUang()" name="bayar" class="input w-full border mt-2" required >
				 					</div>
				 				</div>
								 <div class="mt-3" >
				 					<label>Pembayaran</label>
				 					<select name="pembayaran" id="" class="input w-full" >
										<option value="Tunai">Tunai</option>
										<option value="Bank">Bank</option>
									</select>
				 				</div>
								 <div class="mt-3">
									<label for="" id="labelUang" >Uang</label>
									<input type="number" name="uang" id="uang" readonly value="" class="input w-full border mt-2" >
								</div>
				 				<div class="text-right mt-5">
				 					<button type="submit" class="button w-24 bg-theme-1 text-white">Bayar</button>
				 				</div>
				 			</div>
							<?php } ?>
				 		</form>
				 	</div>
				 </div>
				<!-- END: konten -->
			</div>

		</div>
	</div>
	<!-- END: Content -->
	<!-- BEGIN: JS Assets-->
	<?php $this->load->view('layout/_js') ?>
	<script>
	function hitungUang() {
		// Ambil nilai total dan bayar
		var total = <?= $total ?>;
		var bayar = parseFloat(document.getElementById("bayar").value);

		// Pastikan bayar ada nilainya sebelum melakukan perhitungan
		if (isNaN(bayar)) {
			document.getElementById("uang").value = '';
			document.getElementById("labelUang").innerText = "Uang";
			return;
		}

		// Hitung hasil
		var hasil = bayar - total;

		// Update nilai uang secara dinamis
		document.getElementById("uang").value = hasil;

		// Update label berdasarkan hasil
		if (hasil < 0) {
			document.getElementById("labelUang").innerText = "Piutang";
		} else {
			document.getElementById("labelUang").innerText = "Kembalian";
		}
	}
</script>
	<!-- END: JS Assets-->
</body>

</html>
