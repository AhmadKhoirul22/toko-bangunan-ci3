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
				<?php foreach($utang as $utang) { ?>
				<div class="intro-y box overflow-hidden mt-5">
                    <div class="border-b border-gray-200 text-center sm:text-left">
                        <div class="px-5 py-10 sm:px-20 sm:py-20">
                            <div class="text-theme-1 font-semibold text-3xl"><?= $profile->nama ?></div>
                            <!-- <div class="mt-2"> Nota <span class="font-medium"><?= $utang['kode_penjualan'] ?></span> </div> -->
                            <div class="mt-1 text-right"><?= tanggal_indo($utang['tanggal'])  ?></div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5 lg:ml-10">
                            <div class="intro-y col-span-12 lg:col-span-4">
                                <div class="text-base text-gray-600">From</div>
								<div class="text-lg font-medium text-theme-1 mt-2"><?= $profile->nama ?></div>
                                <div class="mt-1"><?= $profile->alamat ?></div>
                                <div class="mt-1">Telp : <?= $profile->telp ?></div>
                                <div class="mt-1">Email : <?= $profile->email ?></div>
                                <div class="mt-1">BCA : <?= $profile->nama ?> <?= $profile->no_rekening ?> </div>
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-4">
                                <div class="text-base text-gray-600">To</div>
								<div class="text-lg font-medium text-theme-1 mt-2"><?= $utang['nama'] ?></div>
                                <div class="mt-1"><?= $utang['alamat'] ?></div>
                                <div class="mt-1">Telp : <?= $utang['telp'] ?>.</div>
                            </div>
							<div class="intro-y col-span-12 lg:col-span-4">
                                <div class="text-base text-gray-600">-</div>
                                <div class="mt-1">No Nota : <?= $utang['kode_penjualan'] ?></div>
								<!-- <div class="text-lg font-medium text-theme-1 mt-2">No Nota : <?= $utang['kode_penjualan'] ?></div> -->
                                <div class="mt-1">Pembayaran : <?= $utang['pembayaran'] ?></div>
                                <div class="mt-1">Tanggal : <?= tanggal_indo($utang['tanggal'])  ?>.</div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 sm:px-16 py-10 sm:py-20">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 text-center whitespace-no-wrap">No</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Kode Produk	</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Produk</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Jumlah</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Harga</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php $no=1; $total_harga = $utang['total_harga']; foreach($detail_penjualan as $detail){ ?>
                                    <tr>
                                        <td class="text-center border-b w-32"><?= $no++ ?></td>
                                        <td class="text-center border-b w-32"><?= $detail['kode_produk'] ?></td>
                                        <td class="text-center border-b w-32"><?= $detail['nama'] ?></td>
                                        <td class="text-center border-b w-32 font-medium"> <?= $detail['jumlah']  ?></td>
                                        <td class="text-right border-b w-32 font-medium">Rp <?= number_format($detail['harga_jual'])  ?></td>
                                        <td class="text-right border-b w-32 font-medium">Rp <?= number_format($detail['harga_jual']*$detail['jumlah'])  ?></td>
                                    </tr>
									<?php } ?>
									<!-- <?php $total = $utang['total_harga'] - $detail['nominal'] ?> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- input -->
					 <div class="grid grid-cols-12 gap-6 mt-5" >
						<div class="intro-y col-span-12 lg:col-span-8" >
						</div>
						<div class="intro-y col-span-12 lg:col-span-4" >
							<table class="table" >
								<tr>
									<td>Total Harga</td>
									<td>Rp <?= number_format($utang['total_harga'])  ?></td>
								</tr>
								<tr>
									<td>Bayar</td>
									<td>Rp <?= number_format($utang['bayar'])  ?></td>
								</tr>
								<?php if($utang['keterangan'] == 'LUNAS' ) { ?>
								<tr>
									<td>Kembalian</td>
									<td>Rp <?= number_format($utang['bayar']-$utang['total_harga']) ?></td>
								</tr>
								<tr>
									<td></td>
									<td> <p class="font-medium" >Lunas</p> </td>
								</tr>
								<?php } else if ($utang['keterangan'] != 'LUNAS'){ ?>
									<td>Kekurangan</td>
									<td>Rp <?= number_format($utang['sisa'])  ?></td>
									</tr>
									
								<?php } ?>
								<tr>
									<td></td>
									<td>
									<a target="_blank" href="<?= base_url('penjualan/cetakinvoice/'.$utang['kode_penjualan']) ?>" class="button w-24 inline block mr-1 mb-5 bg-theme-1 text-white" >Print PDF</a>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
									<a target="_blank" href="<?= base_url('penjualan/cetaknota/'.$utang['kode_penjualan']) ?>" class="button w-24 inline block mr-1 mb-5 bg-theme-1 text-white" >Print Nota</a>
									</td>
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
