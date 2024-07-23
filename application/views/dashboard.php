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
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                General Report
                            </h2>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
								<a href="<?= base_url('penjualan') ?>">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="dollar-sign" class="report-box__icon text-theme-10"></i>
                                            <div class="ml-auto">
                                                <!-- <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4"></i> </div> -->
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">Rp <?= number_format($this->load->Penjualan_model->penjualan_today()) ?></div>
                                        <div class="text-base text-gray-600 mt-1">Penjualan | Hari ini</div>
                                    </div>
                                </div>
								</a>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
								<a href="<?= base_url('penjualan/datalengkap') ?>">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="dollar-sign" class="report-box__icon text-theme-10"></i> 
                                            <div class="ml-auto">
                                                <!-- <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-feather="chevron-down" class="w-4 h-4"></i> </div> -->
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">Rp <?= number_format($this->load->Penjualan_model->penjualan_bulan_ini())  ?></div>
                                        <div class="text-base text-gray-600 mt-1">Penjualan | Bulan ini</div>
                                    </div>
                                </div>
								</a>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
								<a href="<?= base_url('produk') ?>">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="shopping-bag" class="report-box__icon text-theme-12"></i> 
                                            <div class="ml-auto">
                                                <!-- <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4"></i> </div> -->
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6"><?= count($produk) ?></div>
                                        <div class="text-base text-gray-600 mt-1">Total Produk</div>
                                    </div>
                                </div>
								</a>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
								<a href="<?= base_url('pelanggan') ?>">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="user" class="report-box__icon text-theme-9"></i> 
                                            <div class="ml-auto">
                                                <!-- <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div> -->
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6"><?= count($pelanggan) ?></div>
                                        <div class="text-base text-gray-600 mt-1">Total Pelanggan</div>
                                    </div>
                                </div>
								</a>
                            </div>
                        </div>
                    </div>
                    <!-- END: General Report -->
                </div>
                <!-- laporan -->
				<div class="col-span-12 lg:col-span-6 mt-8">
					<div class="intro-y flex items-center h-10">
						<h2 class="text-lg font-medium truncate mr-5">
							Top 5 Produk Terlaris
						</h2>
					</div>
					<a href="<?= base_url('produk') ?>">
					<div class="mt-5">
						<?php foreach($penjualan_terbanyak as $ter){ ?>
						<div class="intro-y">
							<div class="box px-4 py-4 mb-3 flex items-center zoom-in">
								<div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
									<img alt="Midone Tailwind HTML Admin Template" src="<?= base_url('assets/midone/') ?>dist/images/profile-14.jpg">
								</div>
								<div class="ml-4 mr-auto">
									<div class="font-medium"><?= $ter['nama'] ?></div>
									<div class="text-gray-600 text-xs"><?= $ter['kode_produk'] ?></div>
								</div>
								<div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium"><?= $ter['total_penjualan'] ?>
									Produk</div>
							</div>
						</div>
						<?php } ?>
					</div>
					</a>
				</div>

				<div class="col-span-12 lg:col-span-6 mt-8">
					<div class="intro-y flex items-center h-10">
						<h2 class="text-lg font-medium truncate mr-5">
							Aktivitas Penjualan Terbaru
						</h2>
					</div>
					<div class="mt-5">
						<?php foreach($activity as $ak){ ?>
					<a href="<?= base_url('penjualan/invoice/'.$ak['kode_penjualan']) ?>">
						<div class="intro-y">
							<div class="box px-4 py-4 mb-3 flex items-center zoom-in">
								<div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
									<img alt="Midone Tailwind HTML Admin Template" src="<?= base_url('assets/midone/') ?>dist/images/profile-14.jpg">
								</div>
								<div class="ml-4 mr-auto">
									<div class="font-medium">
										<?= $ak['nama'] ?>
									</div>
									<div class="text-gray-600 text-xs"><?= $ak['tanggal'] ?></div>
									
								</div>
								<div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">+Rp <?= number_format($ak['total_harga'])  ?>
									</div>
								
							</div>
						</div>
						<?php } ?>
					</div>
					</a>
				</div>
				 <!-- laporan -->
				 
					<!--laporan pembelian  -->
					<!-- <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y mt-5">
						<a href="<?= base_url('piutangpenjualan') ?>">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-feather="dollar-sign" class="report-box__icon text-theme-10"></i>
									<p class="font-medium text-center ml-5" >Penjualan</p>
									<div class="ml-auto">
										<div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
									</div>
								</div>
								<div class="text-3xl font-bold leading-8 mt-6">Rp <?= number_format($this->load->Pembelian_model->bayar_today())  ?></div>
								<div class="text-base text-gray-600 mt-1">Pembayaran Utang Hari ini</div>
							</div>
						</div>
						</a>
					</div>
					<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y mt-5">
						<a href="<?= base_url('piutangpenjualan') ?>">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-feather="dollar-sign" class="report-box__icon text-theme-10"></i>
									<p class="font-medium text-center ml-5" >Penjualan</p>
									<div class="ml-auto">
										<div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
									</div>
								</div>
								<div class="text-3xl font-bold leading-8 mt-6">Rp <?= number_format($this->load->Pembelian_model->bayar_month())  ?></div>
								<div class="text-base text-gray-600 mt-1">Pembayaran Utang Bulan ini</div>
							</div>
						</div>
						</a>
					</div> -->
					<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y mt-5">
						<a href="<?= base_url('pembelian') ?>">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-feather="shopping-cart" class="report-box__icon text-theme-9"></i>
									<div class="ml-auto">
										<!-- <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div> -->
									</div>
								</div>
								<div class="text-3xl font-bold leading-8 mt-6">Rp <?= number_format($this->load->Penjualan_model->pembelian_today())  ?></div>
								<div class="text-base text-gray-600 mt-1">Pembelian Hari ini</div>
							</div>
						</div>
						</a>
					</div>
					<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y mt-5">
						<a href="<?= base_url('pembelian/datalengkap') ?>">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-feather="shopping-cart" class="report-box__icon text-theme-9"></i>
									<div class="ml-auto">
										<!-- <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div> -->
									</div>
								</div>
								<div class="text-3xl font-bold leading-8 mt-6">Rp <?= number_format($this->load->Penjualan_model->pembelian_month())  ?></div>
								<div class="text-base text-gray-600 mt-1">Pembelian Bulan ini</div>
							</div>
						</div>
						</a>
					</div>
					<!-- laporan pembelian -->
					  <!-- chart -->
					  <div class="col-span-12 lg:col-span-6 mt-5">
				  	<div class=" bg-white p-4 rounded-lg shadow-lg">
				  		<h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Penjualan 5 Bulan Terakhir</h2>
						  <?php
							date_default_timezone_set("Asia/Jakarta");

							// $id_kategori = 3;
							// $kategori3 = $this->Chart_model->chart($id_kategori);

							// $id_kategori = 4;
							// $kategori4 = $this->Chart_model->chart($id_kategori);

							// $id_kategori = 5;
							// $kategori5 = $this->Chart_model->chart($id_kategori);

							// $id_kategori = 7;
							// $kategori7 = $this->Chart_model->chart($id_kategori);

							// $id_kategori = 8;
							// $kategori8 = $this->Chart_model->chart($id_kategori);

							// $id_kategori = 9;
							// $kategori9 = $this->Chart_model->chart($id_kategori);
							// $i = 0;

							// foreach($kategori as $kategori){
							// 	$nama[$i] = $kategori['nama_kategori'];
							// 	$i++;
							// }

							$nama_now = date('M');
							$nama_1 = date('M', strtotime("-1 Months"));
							$nama_2 = date('M', strtotime("-2 Months"));
							$nama_3 = date('M', strtotime("-3 Months"));
							$nama_4 = date('M', strtotime("-4 Months"));
							$nama_5 = date('M', strtotime("-5 Months"));

							$tanggal = date('Y-m', strtotime("-1 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$this->db->where('status','SELESAI');
							$bulan_1 = $this->db->get()->row()->total;

							$tanggal = date('Y-m', strtotime("-2 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$this->db->where('status','SELESAI');
							$bulan_2 = $this->db->get()->row()->total;

							$tanggal = date('Y-m', strtotime("-3 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$this->db->where('status','SELESAI');
							$bulan_3 = $this->db->get()->row()->total;

							$tanggal = date('Y-m', strtotime("-4 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$this->db->where('status','SELESAI');
							$bulan_4 = $this->db->get()->row()->total;

							$tanggal = date('Y-m', strtotime("-5 Months"));
							$this->db->select('sum(total_harga) as total');
							$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
							$this->db->where('status','SELESAI');
							$bulan_5 = $this->db->get()->row()->total;

							if($bulan_1==null){ $bulan_1=0; }
							if($bulan_2==null){ $bulan_2=0; }
							if($bulan_3==null){ $bulan_3=0; }
							if($bulan_4==null){ $bulan_4=0; }
							if($bulan_5==null){ $bulan_5=0; }

							?>
				  		<canvas id="barChart" style="max-height: 400px; display: block; box-sizing: border-box;"></canvas>
				  	</div>
				  </div>
				  <script>
				  	document.addEventListener("DOMContentLoaded", () => {
				  		new Chart(document.querySelector('#barChart'), {
				  			type: 'bar',
				  			data: {
				  				labels: ['<?= $nama_5 ?>', '<?= $nama_4 ?>', '<?= $nama_3 ?>', '<?= $nama_2 ?>',
				  					'<?= $nama_1 ?>', '<?= $nama_now ?>'
				  				],
				  				datasets: [{
				  					label: 'Grafik Penjualan',
				  					data: [ <?= $bulan_5 ?> , <?= $bulan_4 ?> , <?= $bulan_3 ?>
				  						, <?= $bulan_2 ?> , <?= $bulan_1 ?> , <?= $this->Penjualan_model->penjualan_bulan_ini() ?>
				  					],
				  					backgroundColor: [
				  						'rgba(255, 99, 132, 0.2)',
				  						'rgba(255, 159, 64, 0.2)',
				  						'rgba(255, 205, 86, 0.2)',
				  						'rgba(75, 192, 192, 0.2)',
				  						'rgba(54, 162, 235, 0.2)',
				  						'rgba(153, 102, 255, 0.2)',
				  						'rgba(201, 203, 207, 0.2)'
				  					],
				  					borderColor: [
				  						'rgb(255, 99, 132)',
				  						'rgb(255, 159, 64)',
				  						'rgb(255, 205, 86)',
				  						'rgb(75, 192, 192)',
				  						'rgb(54, 162, 235)',
				  						'rgb(153, 102, 255)',
				  						'rgb(201, 203, 207)'
				  					],
				  					borderWidth: 1
				  				}]
				  			},
				  			options: {
				  				scales: {
				  					y: {
				  						beginAtZero: true
				  					}
				  				}
				  			}
				  		});
				  	});
				  </script>
				   <!-- chart -->
            </div>
        </div>
        <!-- END: Content -->
        <!-- BEGIN: JS Assets-->
        <?php include('layout/_js.php') ?>
        <!-- END: JS Assets-->
    </body>
</html>
