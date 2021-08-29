<!-- Slide1 -->
<section class="slide1">
	<div class="wrap-slick1">
		<div class="slick1">
			<div class="item-slick1 item1-slick1" style="background-image: url(<?php echo base_url() .'assets_admin/img/banner/slide4.jpg' ?>);">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
						Leather Bags
					</h2>

					<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
						New Collection 2018
					</span>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
						<!-- Button -->
						<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
							Shop Now
						</a>
					</div>
				</div>
			</div>

			<div class="item-slick1 item2-slick1" style="background-image: url(<?php echo base_url() .'assets_admin/img/banner/slide5.jpg' ?>);">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rollIn">
						Leather Bags
					</h2>

					<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="lightSpeedIn">
						New Collection 2018
					</span>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
						<!-- Button -->
						<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
							Shop Now
						</a>
					</div>
				</div>
			</div>

			<div class="item-slick1 item3-slick1" style="background-image: url(<?php echo base_url() .'assets_admin/img/banner/slide6.png' ?>);">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rotateInDownLeft">
						Leather Bags
					</h2>

					<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="rotateInUpRight">
						New Collection 2018
					</span>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
						<!-- Button -->
						<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
							Shop Now
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Banner -->
<!-- New Product -->
<section class="newproduct bgwhite p-t-45 p-b-105">
	<div class="container">
		<div class="sec-title p-b-60">
			<h3 class="m-text5 t-center">
				Kategori Produk
			</h3>
		</div>
		<!-- Button Slick js -->
		<div class="wrap-slick2">
			<div class="slick2">
				<?php foreach ($kategori as $kat) : ?>
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">									
								<img src="<?php echo base_url() . 'assets_admin/img/kategori/' . $kat->gambar ?> " alt="IMG-PRODUCT">
								<div class="block2-overlay1 trans-0-4">
									<!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a> -->
									<div class="block1-wrapbtn w-size2">
										<!-- Button -->
										<a href="<?php echo base_url() .'Product/detail_kategori/' . $kat->id_kategori; ?>" class="flex-c-m size2 m-text2 bg3 hov8 trans-0-4">
											<?php echo $kat->nama_kategori; ?>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- New Product -->
<section class="newproduct bgwhite p-t-45 p-b-105">
	<div class="container">
		<div class="sec-title p-b-60">
			<h3 class="m-text5 t-center">
				Katalog Produk
			</h3>
		</div>

		<!-- owl cousel // main.js -->
		<div class="product-slider owl-carousel">
			<?php foreach ($katalogProduk as $kp) { ?>
				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative">
							<?php if($kp->diskon_harga == 0 && $kp->diskon_harga == null && $kp->tanggal == date('Y-m-d')) : ?>
								<p class="block2-img wrap-pic-w of-hidden pos-relative block2-label block2-labelnew">Baru</p>
							<?php elseif($kp->diskon_harga != 0 && $kp->diskon_harga != null) : ?>
							<!-- PRESENTASE HITUNG PERSEN JIKA ADA DISKON -->
							<?php 
								$hargaAsli = $kp->diskon_harga;
								$hargaBaru = $kp->harga;
								$total = $hargaAsli - $hargaBaru;
								$bagi = $total / $hargaAsli;
								$persen = $bagi * 100;
							?>
								<p class="block2-img wrap-pic-w of-hidden pos-relative block2-label block2-labelsale">Sale <?= "$persen %"; ?></p>
							<?php else : ?>
								<p class="block2-img wrap-pic-w of-hidden pos-relative"></p>
							<?php endif; ?>		
							<img src="<?php echo base_url() .'assets_admin/img/produk/' . $kp->gambar1; ?>" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<!-- TAMBAH WISHLIST -->
								<?php $wishlist = ($this->Wishlist_m->wishlist($kp->id_produk)) ? "block2-btn-towishlist" : " block2-btn-addwishlist"; ?>

								<div class="tambahwishlist <?= $wishlist; ?> hov-pointer trans-0-4" data-produk="<?= $kp->nama_produk; ?>" data-harga="<?= $kp->harga; ?>" data-idproduk="<?= $kp->id_produk; ?>" data-gambar="<?= $kp->gambar1; ?>">

									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</div>
								<!-- END -->

								<?php if(!empty($user['email'])) : ?>
								<div class="block2-btn-addcart w-size1 trans-0-4">
									<button class="tambahcart flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" data-iduser="<?= $user['id_user']; ?>"
									data-productname="<?= $kp->nama_produk; ?>" data-price="<?= $kp->harga; ?>" data-productid="<?= $kp->id_produk; ?>" data-qty="1" data-gambar="<?= $kp->gambar1; ?>">
										Add to Cart
									</button>
								</div>
								<?php else : ?>
								<div class="block2-btn-addcart w-size1 trans-0-4">
									<a href="<?= base_url() . 'Auth'; ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</a>
								</div>
								<?php endif; ?>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="<?php echo base_url() .'Product/product_detail/' . $kp->id_produk; ?>" class="block2-name dis-block s-text3 p-b-5">
								<?php echo $kp->nama_produk; ?>
							</a>
							<span class="block2-price m-text6 p-r-5">
								<p> 
									<?php if($kp->diskon_harga == 0) : ?>
									<span class="block2-newprice m-text8">
										Rp. <?= number_format($kp->harga) ?>								
									</span>
									<?php else : ?>
									<span class="block2-oldprice m-text7 p-r-5">
										Rp.<?= number_format($kp->diskon_harga) ?>
									</span>					    			
									<span class="block2-newprice m-text8">
										Rp. <?= number_format($kp->harga) ?>								
									</span>
									<?php endif; ?>
								</p>
								</span>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<!-- Banner video -->
	<section class="parallax0 parallax100" style="background-image: url(<?php echo base_url() .'assets_admin/img/banner/slide2.jpg' ?>);">
		<div class="overlay0 p-t-190 p-b-200">
			<div class="flex-col-c-m p-l-15 p-r-15">
				<span class="m-text9 p-t-45 fs-20-sm">
					The Beauty
				</span>

				<h3 class="l-text1 fs-35-sm">
					Lookbook
				</h3>

				<span class="btn-play s-text4 hov5 cs-pointer p-t-25" data-toggle="modal" data-target="#modal-video-01">
					<i class="fa fa-play" aria-hidden="true"></i>
					Play Video
				</span>
			</div>
		</div>
	</section>

	<!-- Blog -->
	<section class="blog bgwhite p-t-94 p-b-65">
		<div class="container">
			<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
					Blog
				</h3>
			</div>

			<div class="row">
				<?php foreach ($blogHome as $blog) : ?>
					<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
						<!-- Block3 -->
						<div class="block3">
							<a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
								<img src="<?= base_url('assets_admin/img/blog/') . $blog->gambar1; ?>" alt="IMG-BLOG">
							</a>

							<div class="block3-txt p-t-14">
								<h4 class="p-b-7">
									<a href="blog-detail.html" class="m-text11">
										<?= $blog->judul; ?>
									</a>
								</h4>

								<span class="s-text6">Kategori</span> <span class="s-text23">: <?= $blog->nama_kategori; ?></span>&nbsp
								<span class="s-text6">tanggal</span> <span class="s-text23">: <?= $blog->tanggal; ?></span>

								<p class="s-text8 p-t-16">
									<?= (str_word_count($blog->isi) > 40 ? substr($blog->isi,0,200) . " [...]" : $blog->isi) ?>
								</p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Instagram -->
	<section class="instagram p-t-20">
		<div class="sec-title p-b-52 p-l-15 p-r-15">
			<h3 class="m-text5 t-center">
				@ follow us on Instagram
			</h3>
		</div>

		<div class="flex-w">
			<!-- Block4 -->
			<div class="block4 wrap-pic-w">
				<img src="assets_user/images/gallery-03.jpg" alt="IMG-INSTAGRAM">

				<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
					<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
						<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
						<span class="p-t-2">39</span>
					</span>

					<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
						<p class="s-text10 m-b-15 h-size1 of-hidden">
							Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
						</p>

						<span class="s-text9">
							Photo by @nancyward
						</span>
					</div>
				</a>
			</div>

			<!-- Block4 -->
			<div class="block4 wrap-pic-w">
				<img src="assets_user/images/gallery-07.jpg" alt="IMG-INSTAGRAM">

				<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
					<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
						<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
						<span class="p-t-2">39</span>
					</span>

					<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
						<p class="s-text10 m-b-15 h-size1 of-hidden">
							Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
						</p>

						<span class="s-text9">
							Photo by @nancyward
						</span>
					</div>
				</a>
			</div>

			<!-- Block4 -->
			<div class="block4 wrap-pic-w">
				<img src="assets_user/images/gallery-09.jpg" alt="IMG-INSTAGRAM">

				<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
					<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
						<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
						<span class="p-t-2">39</span>
					</span>

					<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
						<p class="s-text10 m-b-15 h-size1 of-hidden">
							Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
						</p>

						<span class="s-text9">
							Photo by @nancyward
						</span>
					</div>
				</a>
			</div>

			<!-- Block4 -->
			<div class="block4 wrap-pic-w">
				<img src="assets_user/images/gallery-13.jpg" alt="IMG-INSTAGRAM">

				<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
					<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
						<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
						<span class="p-t-2">39</span>
					</span>

					<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
						<p class="s-text10 m-b-15 h-size1 of-hidden">
							Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
						</p>

						<span class="s-text9">
							Photo by @nancyward
						</span>
					</div>
				</a>
			</div>

			<!-- Block4 -->
			<div class="block4 wrap-pic-w">
				<img src="assets_user/images/gallery-15.jpg" alt="IMG-INSTAGRAM">

				<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
					<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
						<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
						<span class="p-t-2">39</span>
					</span>

					<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
						<p class="s-text10 m-b-15 h-size1 of-hidden">
							Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
						</p>

						<span class="s-text9">
							Photo by @nancyward
						</span>
					</div>
				</a>
			</div>
		</div>
	</section>

	<!-- Shipping -->
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Free Delivery Worldwide
				</h4>

				<a href="#" class="s-text11 t-center">
					Click here for more info
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					30 Days Return
				</h4>

				<span class="s-text11 t-center">
					Simply return it within 30 days for an exchange.
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Store Opening
				</h4>

				<span class="s-text11 t-center">
					Shop open from Monday to Sunday
				</span>
			</div>
		</div>
	</section>
