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
				<?php foreach($utang_pembelian as $utang) { ?>
				<div class="intro-y box overflow-hidden mt-5">
                    <div class="border-b border-gray-200 text-center sm:text-left">
                        <div class="px-5 py-10 sm:px-20 sm:py-20">
                            <div class="text-theme-1 font-semibold text-3xl">Bayar Hutang</div>
                            <div class="mt-2"> Nota <span class="font-medium"><?= $utang['kode_pembelian'] ?></span> </div>
                            <div class="mt-1"><?= tanggal_indo($utang['tanggal']) ?></div>
                        </div>
                        <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
                        	<div class="">
                        		<div class="text-base text-gray-600">Supplier Details</div>
                        		<div class="text-lg font-medium text-theme-1 mt-2"><?= $profile->nama ?></div>
                        		<div class="mt-1"><?= $profile->email ?></div>
                        	</div>
                        	<div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                        		<div class="text-base text-gray-600">Payment to</div>
                        		<div class="text-lg font-medium text-theme-1 mt-2"><?= $utang['nama_supplier'] ?></div>
                        		<div class="mt-1"><?= $utang['alamat_supplier'] ?></div>
                        		<div class="mt-1"><?= $utang['telp_supplier'] ?>.</div>
                        	</div>
                        </div>
                    </div>
                    <div class="px-5 sm:px-16 py-10 sm:py-20">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 text-center whitespace-no-wrap">No</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Cicilan ke</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Pembayaran</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Nominal</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Sisa Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php $no=1; $total_harga = $utang['total_harga']; foreach($detail_pembelian as $detail){ ?>
                                    <tr>
                                        <td class="text-center border-b w-32"><?= $no++ ?></td>
                                        <td class="text-center border-b w-32"><?= $detail['cicilan_ke'] ?></td>
                                        <td class="text-center border-b w-32"><?= $detail['pembayaran'] ?></td>
                                        <td class="text-right border-b w-32 font-medium">Rp <?= number_format($detail['nominal'])  ?></td>
                                        <td class="text-right border-b w-32 font-medium">Rp <?= number_format($total_harga - $detail['nominal'])  ?></td>
                                    </tr>
									<?php } ?>
									<?php $total = $utang['total_harga'] - $detail['nominal'] ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- input -->
					 <div class="grid grid-cols-12 gap-6 mt-5" >
					 <div class="intro-y col-span-12 lg:col-span-4" >
					 </div>
						<div class="intro-y col-span-12 lg:col-span-4 mb-8" >
						<form action="<?= base_url('piutangpembelian/bayarcicilan') ?>" method="post">
							<input type="hidden" name="id_profile" value="<?= $profile->id_profile ?>">
							<div class="intro-y box p-5 mt-5">
								<div>
									<label>Nominal</label>
									<div class="relative">
									<input type="number" name="nominal" name="nominal" min="0" required class="input w-full border mt-2" required >
									</div>
									<input type="hidden" name="sisa" value="<?= $utang['sisa'] ?>" >
									<input type="hidden" name="kode_pembelian" value="<?= $utang['kode_pembelian'] ?>" >
								</div>
								<div class="mt-3">
									<label>Pembayaran</label>
									<select name="pembayaran" id="" class="input w-full">
										<option value="Tunai">Tunai</option>
										<option value="Bank">Bank</option>
									</select>
								</div>
								<div class="text-right mt-5">
									<button type="submit" class="button w-24 bg-theme-1 text-white">Bayar</button>
								</div>
							</div>
						</form>
						</div>
						<div class="intro-y col-span-12 lg:col-span-4 mt-8" >
							<table class="table" >
								<tr>
									<td>Total Harga</td>
									<td>Rp <?= number_format($utang['total_harga'])  ?></td>
								</tr>
								<tr>
									<td>Sudah Dibayar</td>
									<td>Rp <?= number_format($utang['total_harga']-$utang['sisa'])  ?></td>
								</tr>
								<tr>
									<td>Belum Dibayar</td>
									<td>Rp <?= number_format($utang['sisa'])  ?></td>
								</tr>
							</table>
						</div>
					 </div>
                </div>
				<?php } ?>
				<!-- END: konten -->
			</div>

		</div>
	</div>
	<!-- END: Content -->
	<!-- BEGIN: JS Assets-->
	<?php $this->load->view('layout/_js') ?>
	<!-- END: JS Assets-->
</body>

</html>
