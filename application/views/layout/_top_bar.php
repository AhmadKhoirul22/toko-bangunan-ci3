<?php $menu = $this->uri->segment(1); ?>

<div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="<?= base_url('Dashboard') ?>" class="flex mr-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="<?= base_url('assets/midone/') ?>dist/images/logo.svg">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-theme-24 py-5 hidden">
                <li>
                    <a href="<?= base_url('Dashboard') ?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="home"></i> </div>
                        <div class="menu__title"> Dashboard </div>
                    </a>
                </li>
				<?php if($this->session->userdata('level') == 'Admin') { ?>
                <li>
                    <a href="<?= base_url('user') ?>" class="menu">
                        <div class="menu__icon"> <i data-feather="user"></i> </div>
                        <div class="menu__title"> User <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?= base_url('Pelanggan') ?>" class="menu">
                                <div class="menu__icon"> <i data-feather="user"></i> </div>
                                <div class="menu__title"> Pelanggan </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('Supplier') ?>" class="menu">
                                <div class="menu__icon"> <i data-feather="user"></i> </div>
                                <div class="menu__title"> Supplier </div>
                            </a>
                        </li>
                    </ul>
                </li>
				<?php } ?>
                <li>
                    <a href="<?= base_url('Produk') ?>" class="menu">
                        <div class="menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="menu__title"> Produk </div>
                    </a>
                </li>
                <li class="menu__devider my-6"></li>
                <li>
                    <a href="<?= base_url('Penjualan') ?>" class="menu">
                        <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                        <div class="menu__title"> Penjualan <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?= base_url('Piutang_penjualan') ?>" class="menu">
                                <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                                <div class="menu__title"> Piutang Penjualan </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('penjualan/data_lengkap') ?>" class="menu">
                                <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                                <div class="menu__title"> Data Lengkap </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('Pembelian') ?>" class="menu">
                        <div class="menu__icon"> <i data-feather="shopping-cart"></i> </div>
                        <div class="menu__title"> Pembelian <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?= base_url('piutang/pembelian') ?>" class="menu">
                                <div class="menu__icon"> <i data-feather="shopping-cart"></i> </div>
                                <div class="menu__title"> Piutang Pembelian </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('pembelian/data_lengkap') ?>" class="menu">
                                <div class="menu__icon"> <i data-feather="shopping-cart"></i> </div>
                                <div class="menu__title"> Data Lengkap </div>
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
<div class="border-b border-theme-24 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
            <div class="top-bar-boxed flex items-center">
                <!-- BEGIN: Logo -->
                <a href="" class="-intro-x hidden md:flex">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="<?= base_url('assets/midone/') ?>dist/images/logo.svg">
                    <span class="text-white text-lg ml-3"> <?= $profile->nama ?><span class="font-medium"></span> </span>
                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb breadcrumb--light mr-auto"> <a href="<?= base_url('Dashboard') ?>" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active"><?= $title ?></a> </div>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Notifications -->
                <div class="intro-x dropdown relative mr-4 sm:mr-6">
                    
                </div>
                <!-- END: Notifications -->
                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8 relative">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110">
                        <img alt="Midone Tailwind HTML Admin Template" src="<?= base_url('assets/midone/') ?>dist/images/profile-9.jpg">
                    </div>
                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                        <div class="dropdown-box__content box bg-theme-38 text-white">
                            <div class="p-4 border-b border-theme-40">
                                <div class="font-medium"><?= $this->session->userdata('username') ?></div>
                                <div class="text-xs text-theme-41"><?= $this->session->userdata('level') ?></div>
                            </div>
							<?php if($this->session->userdata('level') == 'Admin'){ ?>
                            <div class="p-2">
                                <a href="<?= base_url('profile') ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                            </div>
							<?php } ?>
                            <div class="p-2 border-t border-theme-40">
                                <a href="<?= base_url('auth/logout') ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
        </div>
