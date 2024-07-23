<!DOCTYPE html>

<html lang="en">
<!-- BEGIN: Head -->

<head>
	<?php include('layout/_css.php') ?>
</head>
<!-- END: Head -->

<body class="app">
	<!-- BEGIN: Top Bar -->
	<?php include('layout/_top_bar.php') ?>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<?php include('layout/_navbar.php') ?>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="card">
			<div class="card-body">
				<div id="autohide" class="mt-3">
					<?= $this->session->flashdata('alert') ?>
				</div>
				<!-- BEGIN: General Report -->
				<form action="<?= base_url('profile/update') ?>" method="post">
					<input type="hidden" name="id_profile" value="<?= $profile->id_profile ?>">
					<div class="intro-y box p-5 mt-5">
						<div>
							<label>Nama Perusahaan</label>
							<input type="text" name="nama" value="<?= $profile->nama ?>"
								class="input w-full border mt-2">
						</div>
						<div class="mt-3">
							<label>Alamat</label>
							<input type="text" name="alamat" class="input w-full border mt-2"
								value="<?= $profile->alamat ?>">
						</div>
						<div class="mt-3">
							<label>Email</label>
							<input type="email" name="email" class="input w-full border mt-2"
								value="<?= $profile->email ?>">
						</div>
						<div class="mt-3">
							<label>Telp</label>
							<input type="number" name="telp" class="input w-full border mt-2"
								value="<?= $profile->telp ?>">
						</div>
						<div class="mt-3">
							<label>No Rekening</label>
							<input type="text" name="no_rekening" class="input w-full border mt-2"
								value="<?= $profile->no_rekening ?>">
						</div>
						<div class="text-right mt-5">
							<button type="submit" class="button w-24 bg-theme-1 text-white">Update</button>
						</div>
					</div>
				</form>
				<!-- END: General Report -->
			</div>

		</div>
	</div>
	<!-- END: Content -->
	<!-- BEGIN: JS Assets-->
	<?php include('layout/_js.php') ?>
	<!-- END: JS Assets-->
</body>

</html>
