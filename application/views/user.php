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
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-8">
                        <div class="intro-y flex items-center h-10">
						<a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview" class="button mr-1 mb-2 inline-block bg-theme-1 text-white">Tambah User</a>
						
						<!-- modal add user -->
						<div class="modal" id="superlarge-modal-size-preview">
							<div class="modal__content modal__content--xl p-10">
							
							<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
								<h2 class="font-medium text-base mr-auto">
									Tambah Users
								</h2>
							</div>
								<form action="<?= base_url('user/tambah')?>" method="post">
									<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
										<div class="col-span-12 sm:col-span-6">
											<label>Nama</label>
											<input type="text" name="nama" class="input w-full border mt-2 flex-1" required >
										</div>
										<div class="col-span-12 sm:col-span-6">
											<label>Username</label>
											<input type="text" class="input w-full border mt-2 flex-1" name="username" required >
										</div>
										<div class="col-span-12 sm:col-span-6">
											<label>Password</label>
											<input type="password" class="input w-full border mt-2 flex-1" name="password" required >
										</div>
										<div class="col-span-12 sm:col-span-6">
											<label>Level</label>
											<select name="level" id="" class="input w-full border mt-2 flex-1">
												<option value="Admin">Admin</option>
												<option value="Kasir">Kasir</option>
											</select>
										</div>
									</div>
									<div class="px-5 py-3 text-right border-t border-gray-200">
										<button type="button" data-dismiss="modal"
											class="button w-20 border text-gray-700 mr-1">Cancel</button>
										<button type="submit" class="button w-20 bg-theme-1 text-white">Submit</button>
									</div>
								</form>
							</div>
						</div>
						<!-- end modal add user -->
                        </div>
                    </div>
					<div id="autohide" class="mt-3">
							<?= $this->session->flashdata('alert') ?>
						</div>
					<!-- table -->
					<div class="intro-y datatable-wrapper box p-5 mt-5">
						<table
							class="table table-report table-report--bordered display datatable w-full dataTable no-footer dtr-inline collapsed"
							id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
							<thead>
								<tr>
									<th class="text-center" >No</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Username</th>
									<th class="text-center">Level</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($user as $row){ ?>
								<tr class="intro-x">
									<td class="text-center" > <?= $no++; ?> </td>
									<td class="text-center" > <?= $row['nama'] ?> </td>
									<td class="text-center" > <?= $row['username'] ?> </td>
									<td class="text-center" > <?= $row['level'] ?> </td>
									<td class="table-report__action w-56">
										<div class="flex justify-center items-center">
											<a class="flex items-center mr-3" data-toggle="modal" data-target="#superlarge-modal-size-preview<?= $row['id_user']?>"
												href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
													stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1">
													<polyline points="9 11 12 14 22 4"></polyline>
													<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
												</svg> Edit </a>
											<a class="flex items-center text-theme-6" onClick="return confirm('apakah yakin untuk hapus data')"
												href="<?= base_url('user/delete/'.$row['id_user'])?>" data-toggle="modal"
												data-target="#delete-confirmation-modal"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
													stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1">
													<polyline points="3 6 5 6 21 6"></polyline>
													<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
													</path>
													<line x1="10" y1="11" x2="10" y2="17"></line>
													<line x1="14" y1="11" x2="14" y2="17"></line>
												</svg> Delete </a>
										</div>
									</td>
								</tr>
															<!-- modal add user -->
						<div class="modal" id="superlarge-modal-size-preview<?= $row['id_user']?>">
							<div class="modal__content modal__content--xl p-10">
								<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
									<h2 class="font-medium text-base mr-auto">
										Update Users
									</h2>
								</div>
								<form action="<?= base_url('user/update')?>" method="post">
									<input type="hidden" name="id_user" value="<?= $row['id_user'] ?>" >
									<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
										<div class="col-span-12 sm:col-span-6">
											<label>Nama</label>
											<input type="text" name="nama" value="<?= $row['nama'] ?>" class="input w-full border mt-2 flex-1" placeholder="Admin">
										</div>
										<div class="col-span-12 sm:col-span-6">
											<label>Username</label>
											<input type="text" class="input w-full border mt-2 flex-1" placeholder="Mimin Ganteng"
												name="username" value="<?= $row['username'] ?>" >
										</div>
										<div class="col-span-12 sm:col-span-6">
											<label>Password</label>
											<input type="password" value="<?= $row['password'] ?>" class="input w-full border mt-2 flex-1" name="password">
										</div>
										<div class="col-span-12 sm:col-span-6">
											<label>Level</label>
											<select name="level" id="" class="input w-full border mt-2 flex-1">
												<option value="Admin" <?php if($row['level']=='Admin'){echo "selected";}?>>Admin</option>
												<option value="Admin" <?php if($row['level']=='Kasir'){echo "selected";}?>>Kasir</option>
											</select>
										</div>
									</div>
									<div class="px-5 py-3 text-right border-t border-gray-200">
										<button type="button" data-dismiss="modal"
											class="button w-20 border text-gray-700 mr-1">Cancel</button>
										<button type="submit" class="button w-20 bg-theme-1 text-white">Submit</button>
									</div>
								</form>
							</div>
						</div>
						<!-- end modal add user -->
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
        <?php include('layout/_js.php') ?>
        <!-- END: JS Assets-->
    </body>
</html>
