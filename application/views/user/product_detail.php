<!-- breadcrumb -->
<?php foreach ($ProdukDetail as $PD) : ?>
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
<!-- 	<a href="index.html" class="s-text16">
		Home
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
	</a>
 -->
	<a href="product.html" class="s-text16">
		Produk
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
	</a>

	<a href="#" class="s-text16">
		<?= $PD->nama_kategori; ?>
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
	</a>

	<span class="s-text17">
		<?= $PD->nama_produk; ?>
	</span>
</div>

<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
	<div class="flex-w flex-sb">
		<div class="w-size13 p-t-30 respon5">
			<div class="wrap-slick3 flex-sb flex-w">
				<div class="wrap-slick3-dots"></div>

				<div class="slick3">
					<div class="item-slick3" data-thumb="<?= base_url() . 'assets_admin/img/produk/' . $PD->gambar1; ?>">
						<div class="wrap-pic-w">
							<img src="<?= base_url() . 'assets_admin/img/produk/' . $PD->gambar1; ?>" alt="IMG-PRODUCT">
						</div>
					</div>

					<?php if ($PD->gambar2 != null) : ?>
						<div class="item-slick3" data-thumb="<?php echo base_url() .'assets_admin/img/produk/' . $PD->gambar2; ?>">
							<div class="wrap-pic-w">
								<img src="<?php echo base_url() .'assets_admin/img/produk/' . $PD->gambar2; ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					<?php endif; ?>
					<?php if ($PD->gambar3 != null) : ?>
						<div class="item-slick3" data-thumb="<?php echo base_url() .'assets_admin/img/produk/' . $PD->gambar3; ?>">
							<div class="wrap-pic-w">
								<img src="<?php echo base_url() .'assets_admin/img/produk/' . $PD->gambar3; ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					<?php endif; ?>
					<?php if ($PD->gambar4 != null) : ?>
						<div class="item-slick3" data-thumb="<?php echo base_url() .'assets_admin/img/produk/' . $PD->gambar4; ?>">
							<div class="wrap-pic-w">
								<img src="<?php echo base_url() .'assets_admin/img/produk/' . $PD->gambar4; ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					<?php endif; ?>
					<?php if ($PD->gambar5 != null) : ?>
						<div class="item-slick3" data-thumb="<?php echo base_url() .'assets_admin/img/produk/' . $PD->gambar5; ?>">
							<div class="wrap-pic-w">
								<img src="<?php echo base_url() .'assets_admin/img/produk/' . $PD->gambar5; ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="w-size14 p-t-30 respon5">
			<h4 class="product-detail-name m-text16 p-b-13">
				<?= $PD->nama_produk; ?>
			</h4>
			
			<span class="fa fa-star checked" style="color:#ffcc00;"></span>
			<span class="fa fa-star checked" style="color:#ffcc00;"></span>
			<span class="fa fa-star checked" style="color:#ffcc00;"></span>
			<span class="fa fa-star checked" style="color:#ffcc00;"></span>
			<span class="fa fa-star checked" style="color:#999999;"></span>
			<span class="m-text6">(5)</span>
			<br>
			<span class="m-text17">
				<?php if($PD->diskon_harga == 0) : ?>
					<span class="block2-newprice m-text8">
						Rp. <?= number_format($PD->harga) ?>								
					</span>
				<?php else : ?>
					<span class="block2-oldprice m-text7 p-r-5">								
						Rp.<?= number_format($PD->diskon_harga) ?>
					</span>					    			
					<span class="block2-newprice m-text8">
						Rp. <?= number_format($PD->harga) ?>								
					</span>
				<?php endif; ?>
			</span>

			<!--  -->
			<div class="p-t-10 p-b-30">

				<div class="flex-r-m flex-w p-t-10">
					<div class="w-size16 flex-m flex-w">
						<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
							<button class="btn-num-product-detail-down color1 flex-c-m size7 bg8 eff2">
								<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
							</button>

							<input class="size8 m-text18 t-center num-product" type="number" name="qty" value="1" id="cart-detail" productname="<?= $PD->nama_produk; ?>" price="<?= $PD->harga; ?>" productid="<?= $PD->id_produk; ?>" gambar="<?= $PD->gambar1; ?>">

							<button class="btn-num-product-detail-up color1 flex-c-m size7 bg8 eff2">
								<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
							</button>
						</div>

						<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
							<?php if(!empty($user['email'])) : ?>
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="btn-cart-detail">
									Add to Cart
								</button>
							<?php else : ?>
								<a href="<?= base_url() . 'Auth'; ?>" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="btn-cart-detail">
									Add to Cart
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				</form>
			</div>

			<div class="p-b-40">
				<span class="s-text23 m-r-20">Stok: <?= $PD->stok; ?></span>
				<span class="s-text23 m-r-20">Berat: <?= $PD->berat; ?></span>
				<span class="s-text23">Kategori: <?= $PD->nama_kategori; ?></span>
			</div>

			<!--  -->
			<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
				<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
					Description
					<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
					<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
				</h5>

				<div class="dropdown-content dis-none p-t-15 p-b-23">
					<p class="s-text8">
						<?= $PD->isi_produk; ?>
					</p>
				</div>
			</div>

			<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
				<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
					Additional information
					<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
					<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
				</h5>

				<div class="dropdown-content dis-none p-t-15 p-b-23">
					<p class="s-text8">
						Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
					</p>
				</div>
			</div>

			<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
				<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
					Reviews (0)
					<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
					<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
				</h5>

				<div class="dropdown-content dis-none p-t-15 p-b-23">
					<p class="s-text8">
						Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>

<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
	<div class="container">
		<div class="sec-title p-b-60">
			<h3 class="m-text5 t-center">
				Katalog Produk
			</h3>
		</div>

		<!-- owl cousel // main.js -->
		<div class="product-slider owl-carousel">
			<?php foreach ($ListProduk as $LP) { ?>
				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative">
							<?php if($LP->diskon_harga == 0 && $LP->diskon_harga == null && $LP->tanggal == date('Y-m-d')) : ?>
								<p class="block2-img wrap-pic-w of-hidden pos-relative block2-label block2-labelnew">New</p>
							<?php elseif($LP->diskon_harga != 0 && $LP->diskon_harga != null) : ?>
							<!-- PRESENTASE HITUNG PERSEN JIKA ADA DISKON -->
							<?php 
								$hargaAsli = $LP->diskon_harga;
								$hargaBaru = $LP->harga;
								$total = $hargaAsli - $hargaBaru;
								$bagi = $total / $hargaAsli;
								$persen = $bagi * 100;
							?>
								<p class="block2-img wrap-pic-w of-hidden pos-relative block2-label block2-labelsale">Sale <?= "$persen %"; ?></p>
							<?php else : ?>
								<p class="block2-img wrap-pic-w of-hidden pos-relative"></p>
							<?php endif; ?>		
							<img src="<?php echo base_url() .'assets_admin/img/produk/' . $LP->gambar1; ?>" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<?php if(!empty($user['email'])) : ?>
									<?php $wishlist = ($this->Wishlist_m->wishlist($LP->id_produk)) ? "block2-btn-towishlist" : " block2-btn-addwishlist"; ?>

									<div class="tambahwishlist <?= $wishlist; ?> hov-pointer trans-0-4" data-produk="<?= $LP->nama_produk; ?>" data-harga="<?= $LP->harga; ?>" data-idproduk="<?= $LP->id_produk; ?>" data-gambar="<?= $LP->gambar1; ?>">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</div>
								<?php else : ?>
									<a href="<?= base_url() .'Auth'; ?>">
										<div class="tambahwishlist block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</div>
									</a>
								<?php endif; ?>
								<div class="block2-btn-addcart w-size1 trans-0-4">
									<?php if(!empty($user['email'])) : ?>
										<!-- Button -->
										<button class="tambahcart flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" data-iduser="<?= $user['id_user']; ?>" data-productname="<?= $LP->nama_produk; ?>" data-price="<?= $LP->harga; ?>" data-productid="<?= $LP->id_produk; ?>" data-qty="1" data-gambar="<?= $LP->gambar1; ?>">
											Add to Cart
										</button>
									<?php else : ?>
										<a href="<?= base_url() .'Auth'; ?>" class="tambahcart flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="<?php echo base_url() .'Product/product_detail/' . $LP->id_produk; ?>" class="block2-name dis-block s-text3 p-b-5">
								<?php echo $LP->nama_produk; ?>
							</a>
							<span class="block2-price m-text6 p-r-5">
								<p> 
									<?php if($LP->diskon_harga == 0) : ?>
									<span class="block2-newprice m-text8">
										Rp. <?= number_format($LP->harga) ?>								
									</span>
									<?php else : ?>
									<span class="block2-oldprice m-text7 p-r-5">
										Rp.<?= number_format($LP->diskon_harga) ?>
									</span>					    			
									<span class="block2-newprice m-text8">
										Rp. <?= number_format($LP->harga) ?>								
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

	</div>
</section>