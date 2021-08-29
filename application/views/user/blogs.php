<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?= base_url() . 'assets_user/images/heading-pages-05.jpg' ?>);">
	<h2 class="l-text2 t-center">
		Blog
	</h2>
</section>

<!-- content page -->
<section class="bgwhite p-t-60">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-9 p-b-75">
				<div class="p-r-50 p-r-0-lg">
					<!-- item blog -->
					<?php if(!empty($blog)) : ?>
					<?php foreach($blog as $bg) : ?>
					<div class="item-blog p-b-80">
						<a class="item-blog-img pos-relative dis-block hov-img-zoom">
							<img src="<?= base_url() . 'assets_admin/img/blog/' . $bg->gambar1 ?>" alt="IMG-BLOG">

							<span class="item-blog-date dis-block flex-c-m pos1 size17 bg4 s-text1">
								<?= mediumdate_indo($bg->tanggal); ?>
							</span>
						</a>

						<div class="item-blog-txt p-t-33">
							<h4 class="p-b-11">
								<a href="<?= base_url() . 'Blogs/blogs_detail/' . $bg->id; ?>" class="m-text24">
									<?= $bg->judul; ?>
								</a>
							</h4>

							<div class="s-text23 flex-w flex-m p-b-21">
								<span>
									By Admin
									<span class="m-l-3 m-r-6">|</span>
								</span>

								<span>
									Kategori : <?= $bg->nama_kategori; ?>
									<span class="m-l-3 m-r-6">|</span>
								</span>

								<span>
									<?= $bg->komen; ?> Komentar
								</span>
							</div>

							<p class="p-b-12">
								<?= (str_word_count($bg->isi) > 50 ? substr($bg->isi,0,200) . " [...]" : $bg->isi) ?>
							</p>
							<br>
							<a href="<?= base_url() . 'Blogs/blogs_detail/' . $bg->id; ?>" class="s-text20">
								Selengkapnya
								<i class="fa fa-long-arrow-right m-l-8" aria-hidden="true"></i>
							</a>
						</div>
					</div>
					<?php endforeach; ?>
					<?php else : ?>
						<div class="alert alert-danger" role="alert">
							Opss... Blog ini belum tersedia !
						</div>
					<?php endif; ?>
				</div>
				<?php echo $this->pagination->create_links(); ?>
			</div>

			<div class="col-md-4 col-lg-3 p-b-75">
				<div class="rightbar">
					<!-- Search -->
					<div class="pos-relative bo11 of-hidden">
						<form action="<?= base_url() . 'Blogs/search_blog'; ?>" method="GET">
							<input class="s-text23 size16 p-l-23 p-r-50" type="text" name="keyword" placeholder="Search">

							<button class="flex-c-m size5 ab-r-m color1 color0-hov trans-0-4">
								<i class="fs-13 fa fa-search" aria-hidden="true"></i>
							</button>
						</form>
					</div>

					<!-- Categories -->
					<h4 class="m-text23 p-t-56 p-b-34">
						Kategori
					</h4>

					<div class="wrap-tags flex-w">
						<?php foreach ($kategori as $kateg) : ?>
						<?php $key =  !empty($id_kat) ? $id_kat : ''; ?> 
						<a href="<?= base_url() . 'Blogs/filter_blog?katBlog=' . $kateg->id_kategori; ?>" <?php if($kateg->id_kategori == $key) echo 'class="tag-item active"'; ?> class="tag-item">
							<?= $kateg->nama_kategori; ?>
						</a>
						<?php endforeach; ?>
					</div>

					<!-- Featured Products -->
					<h4 class="m-text23 p-t-65 p-b-34">
						Produk unggulan
					</h4>

					<ul class="bgwhite">
						<?php foreach($katalogProduk as $KT) : ?>
						<li class="flex-w p-b-20">
							<a href="<?= base_url() . 'Product/product_detail/' . $KT->id_produk; ?>" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
								<img src="<?= base_url() . 'assets_admin/img/produk/' . $KT->gambar1 ?>" alt="IMG-PRODUCT">
							</a>

							<div class="w-size23 p-t-5">
								<a href="<?= base_url() . 'Product/product_detail/' . $KT->id_produk; ?>" class="s-text20">
									<?= $KT->nama_produk; ?>
								</a>

								<span class="dis-block s-text17 p-t-6">
									<?php if($KT->diskon_harga == 0 || $KT->diskon_harga == null) : ?>
									<span class="dis-block s-text17 p-t-6">
										Rp. <?= number_format($KT->harga) ?>								
									</span>
									<?php else : ?>
									<span class="block2-oldprice s-textcustom p-t-6">
										<del>Rp.<?= number_format($KT->diskon_harga) ?></del>
									</span>					    			
									<span class="dis-block s-text17 p-t-6">
										Rp. <?= number_format($KT->harga) ?>								
									</span>
									<?php endif; ?>
								</span>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>

					<!-- Archive -->
					<h4 class="m-text23 p-t-50 p-b-16">
						Arsip blog
					</h4>

					<ul>
						<?php foreach ($arsipBlog as $AB) : ?>
							<li class="flex-sb-m">
								<?php $key =  !empty($tglactive) ? $tglactive : ''; ?> 
								<a href="<?= base_url() . 'Blogs/arsip_blog?arsip=' . $AB->tanggal; ?>" <?php if($AB->tanggal == $key) echo 'class="s-text13 active p-t-5 p-b-5"'; ?> class="s-text13 p-t-5 p-b-5">
									<?= date_indo($AB->tanggal); ?>
								</a>

								<span <?php if($AB->tanggal == $key) echo 'class="s-text13 active"'; ?> class="s-text13">
									(<?= $AB->tgl; ?>)
								</span>
							</li>
						<?php endforeach; ?>
					</ul>

				</div>
			</div>
		</div>
	</div>
</section>