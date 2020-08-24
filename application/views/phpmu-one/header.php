<?php
$img = $this->model_app->view_ordering_limit('logo', 'id_logo', 'DESC', 0, 1);
foreach ($img->result_array() as $row) {
	$logo = $row[gambar];
}
?>
<header>
	<?php if ($this->uri->segment(1) == 'keranjang') { ?>
		<div id="main-nav-container" class="fixed cart-fixed">
			<div id="header" class="main-header header-cart">
				<div id="inner-cart">
					<div class="container">
						<div class="row">
							<!--<div class="col-md-6 col-sm-6 col-xs-12 logo-container-2">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12 daleman-logo">
										<a href="<?= base_url() ?>"><img src="<?= base_url() ?>asset/images/<?= $logo ?>" height="45"></a>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="keranjang-name"><a href="<?= base_url() ?>"><i class="ri-arrow-left-line"></i></a>
											<p>Keranjang Belanja</p>
										</div>
									</div>
								</div>
							<div class="col-md-6 col-sm-6 col-xs-12 header-inner-right search-cart-header">
								<div class="header-inner-right-wrapper clearfix">
									
									<div class="input-group input-cart-search-2">
										<input type="text" class="form-control border-none" placeholder="cari barang...">
										<span class="input-group-btn">
											<button class="btn btn-border-oren active" type="submit">
												<i class="icon-magnifier"></i>
											</button>
										</span>
									</div>
								</div>
							</div> -->
							<div class="col-md-3 daleman-logo logo-container">
								<a href="<?= base_url() ?>">
									<img src="<?= base_url() ?>asset/images/<?= $logo ?>" height="45">
								</a>
							</div>
							<div class="col-md-4 col-8 px-0">
							<div class="keranjang-name"><a href="<?= base_url() ?>"><i class="ri-arrow-left-line"></i></a>
											<p>Keranjang Belanja</p>
										</div>
							</div>
							<div class="col-md-5 col-4">
							<div class="input-group input-cart-search-2">
										<input type="text" class="form-control border-none" placeholder="cari barang...">
										<span class="input-group-btn">
											<button class="btn btn-border-oren active" type="submit">
												<i class="icon-magnifier"></i>
											</button>
										</span>
									</div>
							</div>
						</div><!-- End .row -->
					</div><!-- End .container -->
				</div><!-- End #inner-header -->
			</div><!-- End #header -->
		</div>
	<?php } else if ($this->uri->segment(1) == 'login' OR $this->uri->segment(1) == 'daftar') { ?>
		<div id="main-nav-container" class="fixed">
			<div id="header" class="main-header header-cart">
				<div id="inner-cart">
					<div class="container">
						<div class="row">
							<?php
							if($this->uri->segment_array()[1] == 'login'){
								$teks = 'Login';
								$btn = "<a href='".base_url()."daftar' style='border-radius: 40px;display: block;margin: 10px!important;' class='btn btn-oren btn-sm'>Daftar</a>";
							}else{
								$teks = 'Daftar';
								$btn = "<a href='".base_url()."login' style='border-radius: 40px;display: block;margin: 10px!important;' class='btn btn-oren btn-sm'>Login</a>";
							}
							?>
							<!--
							<div class="col-md-6 col-sm-6 col-xs-12 logo-container-2">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12 daleman-logo">
										<a href="<?= base_url() ?>"><img src="<?= base_url() ?>asset/images/<?= $logo ?>" height="45"></a>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="keranjang-name"><a href="<?= base_url() ?>"><i class="ri-arrow-left-line"></i></a>
											<p>Login User</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 header-inner-right search-cart-header">
								<div class="header-inner-right-wrapper clearfix">
									
									<a style="border-radius: 40px;display: block;margin: 1.1em 1em!important;" class="btn btn-oren btn-sm">Register</a>
								</div>
							</div> -->
							<div class="col-md-3 daleman-logo logo-container">
								<a href="<?= base_url() ?>">
									<img src="<?= base_url() ?>asset/images/<?= $logo ?>" height="45">
								</a>
							</div>
							<div class="col-md-7 col-8 px-0">
							<div class="keranjang-name"><a href="<?= base_url() ?>"><i class="ri-arrow-left-line"></i></a>
											<p><?= $teks ?> User</p>
										</div>
							</div>
							<div class="col-md-2 col-4">
								<?= $btn ?>
							</div>
						</div><!-- End .row -->
					</div><!-- End .container -->
				</div><!-- End #inner-header -->
			</div><!-- End #header -->
		</div>
	<?php } else {
	?>
		<div id="main-nav-container" class="fixed">
			<div id="header" class="main-header">
				<div id="inner-header">
					<div class="container">
						<div class="row">
							<div class="col-3 logo-container">
								<a href="<?= base_url() ?>">
									<img src="<?= base_url() ?>asset/images/<?= $logo ?>" height="45">
								</a>
							</div>
							<div class="col-5 col-md-6 header-inner-right">
								<div class="input-group">
									<input type="text" class="form-control border-none" placeholder="cari barang..."> <span class="input-group-btn"> <button class="btn btn-default btn-border-putih active" type="submit"> <i class="icon-magnifier"></i> </button> </span>
								</div>
							</div>
							<div class="col-4 col-md-3 header-inner-right">
								<div class="header-inner-right-wrapper clearfix">
									<div class="dropdown-cart-menu-container float-left icon-dekstop-top-hide">
										<div class="btn-group dropdown-cart">
											<button class="btn btn-trans dropdown-toggle" id="btn-search-bottom"> <i class="icon-magnifier ic-md"></i>
											</button>
										</div>
									</div>
									<div class="dropdown-cart-menu-container float-left icon-dekstop-top-hide">
										<div class="btn-group dropdown-cart">
											<button class="btn btn-trans dropdown-toggle" id="btn-search-bottom"> <i class="icon-bell ic-md"></i>
											</button>
										</div>
									</div>
									<div class="mx-2 dropdown-cart-menu-container float-left icon-top-hide">
										<div class="btn-group dropdown-cart">
											<a class="btn btn-trans dropdown-toggle" id="bell" href='<?= base_url() ?>keranjang/'> <i class="icon-bell ic-md"></i> <span class='badge badge-warning' id='lblCartCount'></span>
											</a>
											<div class="dropdown-menu dropdown-bell-menu pull-right clearfix" role="menu" aria-labelledby="dropdownMenuButton">

												<ul class="dropdown-cart-product-list">
													<li class="item clearfix">
														<div class="dropdown-cart-details">
															<p class="item-name"> <a href="product.html">Xiaomi Redmi Note 8 </a>
															</p>
															<p>1x <span class="item-price">Rp 3.500.000</span>
															</p>
														</div>
													</li>
													<li class="item clearfix">

														<div class="dropdown-cart-details">
															<p class="item-name"> <a href="product.html">Minyak Goreng Bi...</a>
															</p>
															<p>1x <span class="item-price">Rp 10.000<span class="sub-price">.99</span></span>
															</p>
														</div>
													</li>
												</ul>
												<hr>
												<p class="dropdown-bell-description">Lihat semua notifikasi</p>
											</div>
										</div>
									</div>
									<div class="mx-2 dropdown-cart-menu-container float-left icon-top-hide">
										<div class="btn-group dropdown-cart">
											<a class="btn btn-trans dropdown-toggle" href='#'> <i class="icon-envolope ic-md"></i> <span class='badge badge-warning' id='lblCartCount'></span>
											</a>
											<div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
												<p class="dropdown-cart-description">Baru ditambahkan.</p>
												<ul class="dropdown-cart-product-list">
													<li class="item clearfix"> <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a> <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
														<figure>
															<a href="product.html">
																<img src="asset/images/products/thumbnails/item12.jpg" alt="phone 4">
															</a>
														</figure>
														<div class="dropdown-cart-details">
															<p class="item-name"> <a href="product.html">Xiaomi Redmi Note 8 </a>
															</p>
															<p>1x <span class="item-price">Rp 3.500.000</span>
															</p>
														</div>
													</li>
													<li class="item clearfix"> <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a> <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
														<figure>
															<a href="product.html">
																<img src="asset/images/products/thumbnails/item13.jpg" alt="phone 2">
															</a>
														</figure>
														<div class="dropdown-cart-details">
															<p class="item-name"> <a href="product.html">Minyak Goreng Bi...</a>
															</p>
															<p>1x <span class="item-price">Rp 10.000<span class="sub-price">.99</span></span>
															</p>
														</div>
													</li>
												</ul>
												<div class="dropdown-cart-action">
													<p><a href="<?= base_url() ?>keranjang" class="btn btn-oren btn-block">Keranjang Belanja</a>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="mx-2 dropdown-cart-menu-container float-left">
										<div class="btn-group dropdown-cart">
											<a class="btn btn-trans dropdown-toggle" href='<?= base_url() ?>keranjang/'> <i class="icon-basket ic-md"></i> <span class='icon-top-hide badge badge-warning' id='lblCartCount'></span>
											</a>
											<div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
												<p class="dropdown-cart-description">Baru ditambahkan.</p>
												<ul class="dropdown-cart-product-list">
													<li class="item clearfix"> <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a> <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
														<figure>
															<a href="product.html">
																<img src="asset/images/products/thumbnails/item12.jpg" alt="phone 4">
															</a>
														</figure>
														<div class="dropdown-cart-details">
															<p class="item-name"> <a href="product.html">Xiaomi Redmi Note 8 </a>
															</p>
															<p>1x <span class="item-price">Rp 3.500.000</span>
															</p>
														</div>
													</li>
													<li class="item clearfix"> <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a> <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
														<figure>
															<a href="product.html">
																<img src="asset/images/products/thumbnails/item13.jpg" alt="phone 2">
															</a>
														</figure>
														<div class="dropdown-cart-details">
															<p class="item-name"> <a href="product.html">Minyak Goreng Bi...</a>
															</p>
															<p>1x <span class="item-price">Rp 10.000<span class="sub-price">.99</span></span>
															</p>
														</div>
													</li>
												</ul>
												<div class="dropdown-cart-action">
													<p><a href="<?= base_url() ?>keranjang" class="btn btn-oren btn-block">Keranjang Belanja</a>
													</p>
												</div>
											</div>
										</div>
									</div>


									<!-- <div id="quick-access"> <form class="form-inline quick-search-form" role="form" action="#"> <div class="input-group form-group"> <input type="text" class="form-control" placeholder="Search here"> </div><button type="submit" id="quick-search" class="btn btn-custom"></button> </form> </div>-->
								</div>
							</div>
						</div>
						<div class="row" id="show" style="display: none;">
							<div class="col-12 py-3">
								<div class="input-group">
									<input type="text" class="form-control border-none" placeholder="cari barang..."> <span class="input-group-btn"> <button class="btn btn-default btn-border-putih active" type="submit"> <i class="icon-magnifier"></i> </button> </span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</header>