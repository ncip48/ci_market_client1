<?php 
    $img = $this->model_app->view_ordering_limit('logo','id_logo','DESC',0,1);
    foreach ($img->result_array() as $row) {
        $logo = $row[gambar];
    }
?>
<header>
<?php if($this->uri->segment(1) == 'keranjang'){ ?>
    <div id="main-nav-container" class="fixed cart-fixed">
            <div id="header" class="main-header header-cart">
                <div id="header-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <p class="header-text">Ikuti kami di <a href="#"><i class="fab fa-instagram fa-lg"></i></a> <a href="#"><i class="fab fa-facebook fa-lg"></i></a> <a href="#"><i class="fab fa-twitter fa-lg"></i></a></p>
                                </div><!-- End .header-top-left -->
                                <div class="float-right">
                                    <div class="header-text-container pull-right">
                                        <p class="header-link"><a href="#"><i class="far fa-bell"></i> Notifikasi</a></p>
                                        <p class="header-link"><a href="#"><i class="far fa-question-circle"></i> Bantuan</a></p>
                                        <p class="header-link"><b><a href="#">Daftar | Login</a></b></p>
                                    </div><!-- End .pull-right -->
                                </div><!-- End .header-top-right -->
                            </div><!-- End .col-md-12 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End #header-top -->
                
                <div id="inner-cart">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 logo-container-2">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 daleman-logo">
                                        <a href="<?= base_url() ?>"><img src="<?= base_url() ?>asset/images/<?= $logo ?>" height="45"></a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="keranjang-name"><a href="<?= base_url() ?>"><i class="ri-arrow-left-line"></i></a> <p>Keranjang Belanja</p></div>
                                    </div>
                                </div>
                            </div><!-- End .col-md-3 -->
                            <div class="col-md-6 col-sm-6 col-xs-12 header-inner-right">
                                <div class="header-inner-right-wrapper clearfix">
                                    <!-- <div id="quick-access">
                                        <form class="form-inline quick-search-form" role="form" action="#">
                                            <div class="input-group form-group">
                                                <input type="text" class="form-control" placeholder="Search here">
                                            </div>
                                            <button type="submit" id="quick-search" class="btn btn-custom"></button>
                                        </form>
                                    </div> -->
                                    <div class="input-group input-cart-search-2">
                                    <input type="text" class="form-control border-none" placeholder="cari barang...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-border-oren active" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div><!-- End .header-inner-right-wrapper -->
                            </div><!-- End .col-md-7 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End #inner-header -->
            </div><!-- End #header -->
            </div>
<?php }else{
?>
	<div id="main-nav-container" class="fixed">
		<div id="header" class="main-header">
			<div id="header-top">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="float-left">
								<p class="header-text">Ikuti kami di <a href="#"><i class="fab fa-instagram fa-lg"></i></a>  <a href="#"><i class="fab fa-facebook fa-lg"></i></a>  <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
								</p>
							</div>
							<div class="float-right">
								<div class="header-text-container pull-right">
									<p class="header-link"><a href="#"><i class="far fa-bell"></i> Notifikasi</a>
									</p>
									<p class="header-link"><a href="#"><i class="far fa-question-circle"></i> Bantuan</a>
									</p>
									<p class="header-link"><b><a href="#">Daftar | Login</a></b>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="inner-header">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12 logo-container">
							<a href="<?= base_url() ?>">
								<img src="<?= base_url() ?>asset/images/<?= $logo ?>" height="45">
							</a>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12 header-inner-right">
							<div class="header-inner-right-wrapper clearfix">
								<div class="user-menu-container">
									<div class="btn-group dropdown-cart">
										<a class="btn btn-trans"> <i class="ri-user-3-line ri-xl"></i> 
										</a>
									</div>
								</div>
								<div class="dropdown-cart-menu-container float-right">
									<div class="btn-group dropdown-cart">
										<a class="btn btn-trans dropdown-toggle" href='<?=base_url() ?>keranjang/'> <i class="ri-shopping-cart-line ri-xl"></i>  <span class='badge badge-warning' id='lblCartCount'> 2 </span> 
										</a>
										<div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
											<p class="dropdown-cart-description">Baru ditambahkan.</p>
											<ul class="dropdown-cart-product-list">
												<li class="item clearfix"> <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a>  <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a> 
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
												<li class="item clearfix"> <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a>  <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a> 
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
								<div class="input-group">
									<input type="text" class="form-control border-none" placeholder="cari barang..."> <span class="input-group-btn"> <button class="btn btn-default btn-border-putih active" type="submit"> <i class="fa fa-search"></i> </button> </span> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
</header>