<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $title; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url() . 'assets_user/images/icons/favicon.png' ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/bootstrap/css/bootstrap.min.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/fonts/font-awesome-4.7.0/css/font-awesome.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/fonts/fontawesome-free-5.15.3-web/css/all.min.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/fonts/themify/themify-icons.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/fonts/Linearicons-Free-v1.0.0/icon-font.min.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/fonts/elegant-font/html-css/style.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/animate/animate.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/css-hamburgers/hamburgers.min.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/animsition/css/animsition.min.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/select2/select2.min.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/daterangepicker/daterangepicker.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/slick/slick.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/lightbox2/css/lightbox.min.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/noui/nouislider.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/toastr/toastr.css' ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/util.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/main.css' ?>">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/owl.carousel.min.css' ?>">

	<?php if($this->uri->segment(1) == 'Auth' || $this->uri->segment(2) == 'register' || $this->uri->segment(2) == 'forgot_password') : ?>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/login.css' ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>    
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<?php endif; ?>
<!--===============================================================================================-->
</head>

<body class="animsition">

	<!-- header fixed -->
	<div class="wrap_header fixed-header2 trans-0-4">
		<!-- Logo -->
		<a href="index.html" class="logo">
			<img src="<?php echo base_url() . 'assets_user/images/icons/logo.png' ?>" alt="IMG-LOGO">
		</a>

		<!-- Menu -->
		<div class="wrap_menu">
			<nav class="menu">
				<ul class="main_menu">
					<li>
						<a href="<?php echo base_url() .'' ?>">Home</a>
					</li>

					<li>
						<a href="<?php echo base_url() . 'Product' ?>">Produk</a>
					</li>

					<li>
						<a>Kategori</a>
						<ul class="sub_menu">
							<?php foreach ($kategori as $k) : ?>
								<li>
									<a href="<?= base_url() . 'Product/product_kategori?kategori=' . $k->id_kategori ?>"><?php echo $k->nama_kategori ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</li>
					<?php if(!empty($user['email'])) : ?>
						<li class="sale-noti">
							<a href="<?php echo base_url() .'Cart' ?>">Keranjang</a>
						</li>
					<?php endif; ?>
					<li>
						<a href="<?php echo base_url() .'Blogs' ?>">Blog</a>
					</li>

					<li>
						<a href="<?php echo base_url() .'About' ?>">Tentang Kami</a>
					</li>

					<li>
						<a href="<?php echo base_url() .'Contact' ?>">Kontak</a>
					</li>
					<?php if(empty($user['username'])) : ?>
						<li>
							<a href="<?php echo base_url() .'Auth' ?>">Login</a>
						</li>
					<?php endif; ?>
				</ul>
			</nav>
		</div>

		<!-- Header Icon -->
		<div class="header-icons">
			<div class="header-wrapicon1 dis-block">
				<?php if(!empty($user['gambar'])) : ?>
				<img src="<?php echo base_url() . 'assets_user/images/fotoprofil/' . $user['gambar'] ?>" class="header-icon1 js-show-header-dropdown" alt="ICON">
				<div class="header-account header-dropdown">
					<ul class="header-cart-wrapitem">
						<li class="header-cart-item">
							<a href="<?= base_url() . 'Homeuser' ?>" class="header-cart-item-name">
								Akun saya
							</a>
						</li>

						<li class="header-cart-item">
							<a href="<?= base_url() . 'Homeuser/wishlist' ?>" class="header-cart-item-name">
								Wishlist
							</a>
						</li>

						<li class="header-cart-item">
							<a href="<?= base_url() . 'Homeuser/pemesanan' ?>" class="header-cart-item-name">
								Pemesanan
							</a>
						</li>

						<li class="header-cart-item">
							<a href="#" class="header-cart-item-name">
								Riwayat pemesanan
							</a>
						</li>
						<li class="header-cart-item">
							<a href="#" class="header-cart-item-name">
								Track order
							</a>
						</li>
						<li class="header-cart-item">
							<a href="<?= base_url() . 'Auth/logout' ?>" class="header-cart-item-name">
								Logout
							</a>
						</li>
					</ul>
				</div>
				<?php else : ?>	
					<a href="<?= base_url() . 'Auth'; ?>">
						<img src="<?php echo base_url() .'assets_user/images/icons/icon-header-01.png' ?>" class="header-icon1" alt="ICON">
					</a>
				<?php endif; ?>
			</div>

			<span class="linedivide1"></span>

			<div class="header-wrapicon2">
				<?php if(!empty($user['email'])) : ?>
					<img src="<?php echo base_url() .'assets_user/images/icons/icon-header-cart.png' ?>" class="header-icon1 js-show-header-dropdown" alt="ICON">
					<span class="header-icons-noti score">
						<?php if(!empty($notifcart)) : ?>
							<?= $notifcart; ?>
						<?php else : ?>
							0
						<?php endif; ?>
					</span>
					<!-- Header cart noti -->
					<!-- Dicontroller Cart get_cart -->
					<div class="header-cart header-dropdown" id="headerdesktop"></div>
				<?php else : ?>
					<a href="<?= base_url() . 'Auth'; ?>">
						<img src="<?php echo base_url() .'assets_user/images/icons/icon-header-cart.png' ?>" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">0</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- top noti -->
	<div class="flex-c-m size22 bg0 s-text21 pos-relative">
		20% off everything!
		<a href="product.html" class="s-text22 hov6 p-l-5">
			Shop Now
		</a>

		<button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
			<i class="fa fa-remove fs-13" aria-hidden="true"></i>
		</button>
	</div>

	<!-- Header -->
	<header class="header2">
		<!-- Header desktop -->
		<div class="container-menu-header-v2 p-t-26">
			<div class="topbar2">
				<div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
				</div>

				<!-- Logo2 -->
				<a href="index.html" class="logo2">
					<img src="<?php echo base_url() .'assets_user/images/icons/logo.png' ?>" alt="IMG-LOGO">
				</a>

				<div class="topbar-child2">
					<span class="topbar-email">
						fashe@example.com
					</span>

					<div class="topbar-language rs1-select2">
						<select class="selection-1" name="time">
							<option>USD</option>
							<option>EUR</option>
						</select>
					</div>

					<!--  -->
					<div class="header-wrapicon2 m-l-10">
						<?php if(!empty($user['gambar'])) : ?>
							<img src="<?php echo base_url() . 'assets_user/images/fotoprofil/' . $user['gambar'] ?>" class="header-icon1 js-show-header-dropdown" alt="ICON">
							<div class="header-account header-dropdown">
								<ul class="header-cart-wrapitem">
									<li class="header-cart-item">
										<a href="<?= base_url() . 'Homeuser' ?>" class="header-cart-item-name">
											Akun saya
										</a>
									</li>

									<li class="header-cart-item">
										<a href="<?= base_url() . 'Homeuser/wishlist' ?>" class="header-cart-item-name">
											Wishlist
										</a>
									</li>

									<li class="header-cart-item">
										<a href="<?= base_url() . 'Homeuser/pemesanan' ?>" class="header-cart-item-name">
											Pemesanan
										</a>
									</li>

									<li class="header-cart-item">
										<a href="#" class="header-cart-item-name">
											Riwayat pemesanan
										</a>
									</li>
									<li class="header-cart-item">
										<a href="#" class="header-cart-item-name">
											Track order
										</a>
									</li>
									<li class="header-cart-item">
										<a href="<?= base_url() . 'Auth/logout'; ?>" class="header-cart-item-name">
											Logout
										</a>
									</li>
								</ul>
							</div>	
						<?php else : ?>
							<a href="<?= base_url() . 'Auth'; ?>">
								<img src="<?php echo base_url() . 'assets_user/images/icons/icon-header-01.png' ?>" class="header-icon1" alt="ICON">
							</a>
						<?php endif; ?>
					</div>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2 m-r-13">
						<?php if(!empty($user['email'])) : ?>
							<img src="<?php echo base_url() . 'assets_user/images/icons/icon-header-cart.png' ?>" class="header-icon1 js-show-header-dropdown" alt="ICON">
		
							<span class="header-icons-noti score">
								<?php if(!empty($notifcart)) : ?>
									<?= $notifcart; ?>
								<?php else : ?>
									0
								<?php endif; ?>
							</span>
							<!-- Header cart noti -->
							<div class="header-cart header-dropdown" id="headerfixed">
							</div>
						<?php else : ?>
							<a href="<?= base_url() . 'Auth'; ?>">
								<img src="<?php echo base_url() . 'assets_user/images/icons/icon-header-cart.png' ?>" class="header-icon1 js-show-header-dropdown" alt="ICON">

								<span class="header-icons-noti">0</span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="wrap_header">

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="<?php echo base_url() .'' ?>">Home</a>
							</li>

							<li>
								<a href="<?php echo base_url() . 'Product' ?>">Produk</a>
							</li>

							<li>
								<a>Kategori</a>
								<ul class="sub_menu">
									<?php foreach ($kategori as $k) : ?>
									<li>
										<a href="<?= base_url() . 'Product/product_kategori?kategori=' . $k->id_kategori ?>"><?php echo $k->nama_kategori ?></a>
									</li>
									<?php endforeach; ?>
								</ul>
							</li>

							<?php if(!empty($user['email'])) : ?>
								<li class="sale-noti">
									<a href="<?php echo base_url() .'Cart' ?>">Keranjang</a>
								</li>
							<?php endif; ?>

							<li>
								<a href="<?php echo base_url() .'Blogs' ?>">Blog</a>
							</li>

							<li>
								<a href="<?php echo base_url() .'About' ?>">Tentang Kami</a>
							</li>

							<li>
								<a href="<?php echo base_url() .'Contact' ?>">Kontak</a>
							</li>
							
							<?php if(empty($user['username'])) : ?>
								<li>
									<a href="<?php echo base_url() .'Auth' ?>">Login</a>
								</li>
							<?php endif; ?>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">

				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="<?= base_url() . 'assets_user/images/icons/logo.png' ?>" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="<?= base_url() . 'assets_user/images/icons/icon-header-01.png' ?>" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<img src="<?= base_url() . 'assets_user/images/icons/icon-header-cart.png' ?>" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti score">
							<?php if(!empty($notifcart)) : ?>
								<?= $notifcart; ?>
							<?php else : ?>
								0
							<?php endif; ?>
						</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown" id="headermobile">
						</div> 
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								fashe@example.com
							</span>

							<div class="topbar-language rs1-select2">
								<select class="selection-1" name="time">
									<option>USD</option>
									<option>EUR</option>
								</select>
							</div>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url() .'' ?>">Home</a>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url() . 'Product' ?>">Produk</a>
					</li>

					<li class="item-menu-mobile">
						<a>Kategori</a>
						<ul class="sub-menu">
							<?php foreach ($kategori as $k) : ?>
								<li>
									<a href="<?= base_url() . 'Product/product_kategori?kategori=' . $k->id_kategori ?>"><?php echo $k->nama_kategori ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url() .'Cart' ?>">Keranjang</a>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url() .'Blogs' ?>">Blog</a>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url() .'About' ?>">Tentang Kami</a>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url() .'Contact' ?>">Kontak</a>
					</li>
					<li>
						<a href="<?php echo base_url() .'Auth' ?>">Login</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>
