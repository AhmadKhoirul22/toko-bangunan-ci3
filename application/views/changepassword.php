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
				<form action="<?= base_url('user/updatepassword') ?>" method="post">
					<input type="hidden" name="password" value="<?= $user->password ?>">
					<input type="hidden" name="id_user" value="<?= $user->id_user ?>">
					<div class="intro-y box p-5 mt-5">
					<div>
						<label>Username</label>
						<input type="text" name="username" readonly value="<?= $user->username ?>" class="input w-full border mt-2">
					</div>
					<div>
						<label>Nama</label>
						<input type="text" name="nama" readonly value="<?= $user->nama ?>" class="input w-full border mt-2">
					</div>
					<div>
						<label>Level</label>
						<input type="text" name="level" value="<?= $user->level ?>" readonly class="input w-full border mt-2">
					</div>
							<div>
								<label>Old Password</label>
								<input type="password" name="old_password" class="input w-full border mt-2">
							</div>
							<div class="mt-3">
								<label>New Password</label>
								<input type="password" name="new_password" class="input w-full border mt-2">
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
