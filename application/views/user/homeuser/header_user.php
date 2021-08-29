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
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/util.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/main.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/style.css' ?>">
	<?php if($this->uri->segment(1) == 'Homeuser') : ?>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/toastr/toastr.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/profile.css' ?>">
	<?php endif; ?>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/css/owl.carousel.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets_user/vendor/datatables/css/jquery.dataTables.min.css' ?>">
	<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header3">
		<!-- Header desktop -->
		<div class="container-menu-header-v3">
			<div class="wrap_header3 p-t-74">
				<!-- Logo -->
				<a href="index.html" class="logo3">
					<img src="<?= base_url() . 'assets_user/images/icons/logo.png' ?>" alt="IMG-LOGO">
				</a>

				<!-- Header Icon -->
				<div class="header-icons3 p-t-38 p-b-60 p-l-8">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="<?= base_url() . 'assets_user/images/fotoprofil/' . $user['gambar'] ?>" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>

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
						<div class="header-cart header-dropdown" id="headerdesktop"></div>
					</div>
				</div>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<!-- <li>
								<a href="index.html">Home</a>
								<ul class="sub_menu">
									<li><a href="index.html">Homepage V1</a></li>
									<li><a href="home-02.html">Homepage V2</a></li>
									<li><a href="home-03.html">Homepage V3</a></li>
								</ul>
							</li> -->

							<li>
								<a href="<?= base_url() . '' ?>">Home</a>
							</li>

							<li class="sale-noti">
								<a href="<?= base_url() . 'Homeuser' ?>">Akun saya</a>
							</li>

							<li>
								<a href="<?= base_url() . 'Homeuser/wishlist' ?>">Wishlist</a>
							</li>

							<li>
								<a href="<?= base_url() . 'Homeuser/pemesanan' ?>">Pemesanan</a>
							</li>

							<li>
								<a href="blog.html">Blog</a>
							</li>

							<li>
								<a href="about.html">About</a>
							</li>

							<li>
								<a href="<?= base_url() . 'Auth/logout' ?>">Logout</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>

			<div class="bottombar flex-col-c p-b-65">
				<div class="bottombar-social t-center p-b-8">
					<a href="#" class="topbar-social-item fab fa-facebook-f"></a>
					<a href="#" class="topbar-social-item fab fa-instagram"></a>
					<a href="#" class="topbar-social-item fab fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fab fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fab fa-youtube"></a>
				</div>

				<div class="bottombar-child2 p-r-20">
					<div class="topbar-language rs1-select2">
						<select class="selection-1" name="time">
							<option>USD</option>
							<option>EUR</option>
						</select>
					</div>
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
			<!-- 	Header Icon mobile -->
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
						<div class="header-cart header-dropdown" id="headermobile"></div>
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
		
	</header>
