<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Nota Pembelian</title>
</head>
<body>
	<!-- <table>
		<tr>
			<th><?= $profile->nama ?></th>
		</tr>
		<tr>
			<th><?= $profile->alamat ?></th>
		</tr>
		<tr>
			<th>Telp: <?= $profile->telp ?></th>
		</tr>
	</table> -->
	<table>
	<td>===========================================</td>
	</table>
	<?= $profile->nama ?> <br>
	<?= $profile->alamat ?> <br>
	Telp : <?= $profile->telp ?> <br>
	<table>
	<td>===========================================</td>
	</table>
	<?php foreach($utang_pembelian as $utang){ ?>
	<table>
		<tr>
			<td>Supplier</td>
			<td></td>
			<td></td>
			<td>:</td>
			<td></td>
			<td></td>
			<td><?= $utang['nama_supplier'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td></td>
			<td></td>
			<td>:</td>
			<td></td>
			<td></td>
			<td><?= $utang['alamat_supplier'] ?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td></td>
			<td></td>
			<td>:</td>
			<td></td>
			<td></td>
			<td><?= tanggal_indo($utang['tanggal']) ?></td>
		</tr>
		<tr>
			<td>Nota</td>
			<td></td>
			<td></td>
			<td>:</td>
			<td></td>
			<td></td>
			<td><?= $utang['kode_pembelian'] ?></td>
		</tr>
	</table>
	<?php } ?>
	<table>
	<td>===========================================</td>
	</table>
	<table>
		<tr>
		<td>Kode - Nama Produk</td>
		</tr>
	</table>
	<table>
	<tr>
		<td>No</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Jumlah</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Harga</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Total</td>
		</tr>
	</table>
	<table>
	<td>===========================================</td>
	</table>
	<table>
		<?php $no=1; foreach($pembelian as $detail){?>
		<tr>
		<td><?= $detail['kode_produk'] ?> - <?= $detail['nama'] ?></td>
		</tr>
		
	</table>
	<table>
	<tr>
		<td><?= $no++; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?= $detail['jumlah'] ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?= number_format($detail['harga']) ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?= number_format($detail['harga']*$detail['jumlah']) ?></td>
		</tr>
	</table>
	<?php } ?>
	<table>
	<td>===========================================</td>
	</table>
	<table>
		<tr>
			<td>Grand total</td>
			<td></td>
			<td></td>
			<td>:</td>
			<td></td>
			<td></td>
			<td><?= number_format($utang['total_harga']) ?></td>
		</tr>
		<tr>
			<td>Bayar</td>
			<td></td>
			<td></td>
			<td>:</td>
			<td></td>
			<td></td>
			<td><?= number_format($utang['total_harga']-$utang['sisa']) ?></td>
		</tr>
		<tr>
			<?php if($utang['keterangan'] == 'LUNAS'){ ?>
			<td></td>
			<td>L</td>
			<td>U</td>
			<td>N</td>
			<td>A</td>
			<td>S</td>
			<!-- <td><?= number_format($utang['sisa']) ?></td> -->
			<?php } else { ?>
			<td>Hutang</td>
			<td></td>
			<td></td>
			<td>:</td>
			<td></td>
			<td></td>
			<td><?= number_format($utang['sisa']) ?></td>
			<?php } ?>
		</tr>
	</table>
	<script>
		window.print();
	</script>
</body>
</html>
