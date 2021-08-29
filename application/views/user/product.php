<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo base_url() .'assets_user/images/heading-pages-02.jpg' ?>);">
	<!-- <h2 class="l-text2 t-center">
		Women
	</h2> -->
	<!-- <p class="m-text13 t-center">
		New Arrivals Women Collection 2018
	</p> -->
</section>


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
				<div class="leftbar p-r-20 p-r-0-sm">

					<!--  -->
					<h4 class="m-text14 p-b-32">
						Search
					</h4>

					<div class="p-b-32">
						<div class="search-product pos-relative bo4 of-hidden">
							<form action="<?= base_url() . 'Product/search' ?>" method="GET">
								<input class="s-text23 size6 p-l-23 p-r-50" type="text" name="keyword" value="<?= isset($keyword) ? $keyword : ''; ?>" placeholder="Cari Produk...">

								<button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4" onclick="getUrlParam();">
									<i class="fs-12 fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</div>
					</div>

					<!--  -->
					<h4 class="m-text14 p-b-32">
						Kategori
					</h4>

					<form action="<?= base_url() . 'Product/filter' ?>" method="GET">
					<div class="p-b-32">
						<div class="rs2-select2 search-product pos-relative bo4 of-hidden">
							<select class="selection-1" name="kategori">
								<option disabled selected>Kategori</option>
								<?php $ktgr = !empty($id_kat) ? $id_kat : ''; ?> 
								<?php foreach ($kategori as $kat) : ?>
										<option value="<?= $kat->id_kategori; ?>" <?php if($kat->id_kategori == $ktgr) echo 'selected="selected"'; ?>><?= $kat->nama_kategori; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="filter-price p-t-22 p-b-50 bo3">
						<div class="m-text15 p-b-17">
							Filter
						</div>

						<form action="<?= base_url() . 'Product/filter' ?>" method="GET">
							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<input type="hidden" name="min_harga" value="" id="min-harga">
								<input type="hidden" name="max_harga" value="" id="max-harga">
								<div class="s-text3 p-t-10 p-b-10">
									Harga: Rp <span id="value-lower"></span> - Rp <span id="value-upper">
									</span>
								</div>
								<div class="w-size11">
									<!-- Button -->
									<button type="submit" id="filter" class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
										Filter
									</button>
								</div>
							</div>
						</form>
					</div>
					</form>
					<div class="filter-color p-t-22 p-b-50 bo3">
						<div class="m-text15 p-b-12">
							Color
						</div>

						<ul class="flex-w">
							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
								<label class="color-filter color-filter1" for="color-filter1"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
								<label class="color-filter color-filter2" for="color-filter2"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
								<label class="color-filter color-filter3" for="color-filter3"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
								<label class="color-filter color-filter4" for="color-filter4"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
								<label class="color-filter color-filter5" for="color-filter5"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
								<label class="color-filter color-filter6" for="color-filter6"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
								<label class="color-filter color-filter7" for="color-filter7"></label>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
				<!--  -->
				<div class="flex-sb-m flex-w p-b-35">
					<div class="flex-w">
						<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
							<form action="<?= base_url() . 'Product/sortir' ?>" method="GET">
								<select class="selection-1" name="sort" onchange="this.form.submit();">
									<!-- ambil keyword sort -->
									<?php $key =  !empty($sort) ? $sort : ''; ?> 

									<option disabled selected>Sortir dari</option>
									<option value="sale" <?php if('sale' == $key) echo 'selected="selected"'; ?>>
									Produk Sale</option>
									<option value="new" <?php if('new' == $key) echo 'selected="selected"'; ?>>
									Produk New</option>
									<option value="DESC" <?php if('DESC' == $key) echo 'selected="selected"'; ?>>
									Terbaru - Terlama</option>
									<option value="ASC" <?php if('ASC' == $key) echo 'selected="selected"'; ?>>
									Terlama - Terbaru</option>
								</select>
							</form>
						</div>
								

						<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
							<form action="<?= base_url() . 'Product/sortir' ?>" method="GET" >
								<select class="selection-1" name="sort" onchange="this.form.submit();">
									<!-- ambil keyword sort -->
									<?php $key =  !empty($sort) ? $sort : ''; ?>

									<option disabled selected>Harga</option>
									<option value="low" <?php if('low' == $key) echo 'selected="selected"'; ?>>
									Terendah - Tertingi</option>
									<option value="high"<?php if('high' == $key) echo 'selected="selected"'; ?>>
									Tertinggi - Terendah</option>
								</select>
							</form>
						</div>
					</div>

					<span class="s-text23 p-t-5 p-b-5">
						Menampilkan 1 – <?= $total_limit; ?> dari <?= $total_rows; ?> hasil
					</span>
				</div>

				<!-- Product -->
				<div class="row">
					<?php if(!empty($ListProduk)) : ?>
					<?php foreach ($ListProduk as $LP) : ?>
					<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<?php if($LP->diskon_harga == null && $LP->tanggal == date('Y-m-d')) : ?>
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

								<a class="card-image" style="background-image: url(<?= base_url('assets_admin/img/produk/') . $LP->gambar1; ?>);" data-image-full="<?= base_url('assets_admin/img/produk/') . $LP->gambar1; ?>"> 
									<img src="<?= base_url('assets_admin/img/produk/') . $LP->gambar1; ?>" alt="IMG-PRODUCT" /> 
								</a>
								

								<div class="block2-overlay trans-0-4">
									<?php if(!empty($user['email'])) : ?>
										<?php $wishlist = ($this->Wishlist_m->wishlist($LP->id_produk)) ? "block2-btn-towishlist" : " block2-btn-addwishlist"; ?>
										<div class="<?= $wishlist; ?> hov-pointer trans-0-4 tambahwishlist" data-produk="<?= $LP->nama_produk; ?>" 
											data-harga="<?= $LP->harga; ?>" data-idproduk="<?= $LP->id_produk; ?>" data-gambar="<?= $LP->gambar1; ?>">

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
								<a href="<?= base_url() . 'Product/product_detail/' . $LP->id_produk; ?>" class="block2-name dis-block s-text3 p-b-5">
									<?= $LP->nama_produk; ?>
								</a>
								<span class="fa fa-star checked" style="color:#ffcc00;"></span>
								<span class="fa fa-star checked" style="color:#ffcc00;"></span>
								<span class="fa fa-star checked" style="color:#ffcc00;"></span>
								<span class="fa fa-star checked" style="color:#ffcc00;"></span>
								<span class="fa fa-star checked" style="color:#999999;"></span>
								<span class="m-text6">(5)</span>
								<br>
								<span class="block2-price m-text6 p-r-5">
									<?php if($LP->diskon_harga == 0 || $LP->diskon_harga == null) : ?>
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
								</span>

							</div>
						</div>
					</div>
					<?php endforeach; ?>
					<?php else : ?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<div class="flex-w">
								<div class="alert alert-danger" role="alert">
									Opss... Data produk kosong!
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</section>