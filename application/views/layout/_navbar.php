<?php $menu = $this->uri->segment(1); ?>
<nav class="top-nav">
            <ul>
                <li>
                    <a href="<?= base_url('dashboard') ?>" class="top-menu top-menu--<?php if($menu == 'dashboard'){echo 'active';} ?>">
                        <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="top-menu__title"> Dashboard </div>
                    </a>
                </li>
				<?php if($this->session->userdata('level') == 'Admin') { ?>
                <li>
                    <a href="<?= base_url('user') ?>" class="top-menu top-menu--<?php if($menu == 'user'){echo 'active';} ?>">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mx-auto"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> </div>
                        <div class="top-menu__title"> User </div>
                    </a>
                </li>
				<li>
					<a href="<?= base_url('pelanggan') ?>" class="top-menu top-menu--<?php if($menu == 'pelanggan'){echo 'active';} ?>">
						<div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
								stroke-linejoin="round" class="feather feather-user mx-auto">
								<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
								<circle cx="12" cy="7" r="4"></circle>
							</svg> </div>
						<div class="top-menu__title"> Pelanggan </div>
					</a>
				</li>
				<li>
					<a href="<?= base_url('supplier') ?>" class="top-menu top-menu--<?php if($menu == 'supplier'){echo 'active';} ?>">
						<div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
								stroke-linejoin="round" class="feather feather-user mx-auto">
								<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
								<circle cx="12" cy="7" r="4"></circle>
							</svg> </div>
						<div class="top-menu__title"> Supplier </div>
					</a>
				</li>
				<?php } ?>
                <li>
                    <a href="<?= base_url('produk') ?>" class="top-menu top-menu--<?php if($menu == 'produk'){echo 'active';} ?>">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag mx-auto"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> </div>
                        <div class="top-menu__title"> Produk  </div>
                    </a>
                    
                </li>
				<li>
                    <a href="<?= base_url('kategori') ?>" class="top-menu top-menu--<?php if($menu == 'kategori'){echo 'active';} ?>">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag mx-auto"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> </div>
                        <div class="top-menu__title"> Kategori  </div>
                    </a>
                    
                </li>
                <li>
                    <a href="<?= base_url('penjualan') ?>" class="top-menu top-menu--<?php if($menu == 'penjualan'){echo 'active';} ?>">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign mx-auto"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> </div>
                        <div class="top-menu__title"> Penjualan  </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('pembelian') ?>" class="top-menu top-menu--<?php if($menu == 'pembelian'){echo 'active';} ?>">
                        <div class="top-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart mx-auto"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> </div>
                        <div class="top-menu__title"> Pembelian </div>
                    </a>
                </li>
            </ul>
        </nav>
