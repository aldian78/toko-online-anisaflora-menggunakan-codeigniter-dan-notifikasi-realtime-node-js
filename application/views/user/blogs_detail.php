<!-- breadcrumb -->
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
	<a href="index.html" class="s-text16">
		Blog detail
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
	</a>

	<?php foreach($blogDetail as $BD) : ?>
		<a href="blog.html" class="s-text16">
			<?= $BD->nama_kategori; ?>
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			<?= $BD->judul; ?>
		</span>
	<?php endforeach; ?>
</div>

<!-- content page -->
<section class="bgwhite p-t-60 p-b-25">
	<div class="container">
		<div class="row">
			<?php foreach ($blogDetail as $detail) : ?>
			<div class="col-md-8 col-lg-9 p-b-80">
				<div class="p-r-50 p-r-0-lg">
					<div class="p-b-40">
						<div class="wrap-slick1">
							<div class="blog-detail-img wrap-pic-w slick4 item-slick4 item1-slick4">
								<img src="<?= base_url() . 'assets_admin/img/blog/' . $detail->gambar1 ?>" alt="IMG-BLOG">
								<?php if($detail->gambar2 != null) : ?>
									<img src="<?= base_url() . 'assets_admin/img/blog/' . $detail->gambar2 ?>" alt="IMG-BLOG">
								<?php endif; ?>
								<?php if($detail->gambar2 != null) : ?>
									<img src="<?= base_url() . 'assets_admin/img/blog/' . $detail->gambar3 ?>" alt="IMG-BLOG">
								<?php endif; ?>
							</div>
						</div>
						<div class="blog-detail-txt p-t-33">
							<h4 class="p-b-11 m-text24">
								<?= $detail->judul; ?>
							</h4>

							<div class="s-text23 flex-w flex-m p-b-21">
								<span>
									By Admin
									<span class="m-l-3 m-r-6">|</span>
								</span>

								<span>
									<?= mediumdate_indo($detail->tanggal); ?>
									<span class="m-l-3 m-r-6">|</span>
								</span>

								<span>
									Kategori : <?= $detail->nama_kategori; ?>
									<span class="m-l-3 m-r-6">|</span>
								</span>

								<span>
									<?= $detail->komen; ?> Komentar
								</span>
							</div>

							<p class="p-b-25">
								<?= $detail->isi; ?>
							</p>
						</div>
					</div>

					<!-- Leave a comment -->
					<h4 class="m-text25 p-b-14">
						Leave a Comment
					</h4>

					<?php foreach ($komentar as $comment) : ?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<span class="js-toggle-dropdown-content flex-sb-m cs-pointer color0-hov trans-0-4">- <?= $comment->nama; ?>
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</span>
						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<div class="blog-quote">
								<p>“ <?= $comment->komentar; ?>” 
								</p>
							</div>
							<div class="reply">
								<span>- Steven Jobs</span>
								<p>“ Technology is nothing. What's important is that you have a faith in people, that
									they're basically good and smart, and if you give them tools, they'll do wonderful
									things with them.” 
								</p>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
					<br>
					<form class="leave-comment" id="comment" method="POST">
						<div class="bo12 size15 m-b-25">
							<input type="hidden" name="id" id="id" value="<?= $detail->id_blog; ?>">
							<input class="sizefull s-text23 p-l-18 p-r-18" type="text" name="nama" id="isinama" placeholder="Nama *"> 
							<small class="text-danger" id="nama"></small>
						</div>

						<div class="bo12 size15 m-b-25">
							<input class="sizefull s-text23 p-l-18 p-r-18" type="text" name="email" id="isiemailblog" placeholder="Email *">
							<small class="text-danger" id="email"></small>
						</div>

						<textarea class="dis-block s-text23 size18 bo12 p-l-18 p-r-18 p-t-13" name="komentar" id="isikomen" placeholder="Silahkan berkomentar..."></textarea>
						<small class="text-danger" id="komentar"></small>
						<div class="w-size24 p-t-20">
							<!-- Button -->
							<button id="sendcomment" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								Kirim komentar
							</button>
						</div>
					</form>
				</div>
			</div>
			<?php endforeach; ?>
		

			<div class="col-md-4 col-lg-3 p-b-80">
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

					<!-- kategori -->
					<h4 class="m-text23 p-t-56 p-b-34">
						Kategori
					</h4>

					<div class="wrap-tags flex-w">
						<?php foreach ($kategori as $kateg) : ?>
							<?php $key =  !empty($id_kat) ? $id_kat : ''; ?> 
							<a href="<?= base_url() . 'Blogs/filter_blog?katBlog=' . $kateg->id_kategori; ?>" class="tag-item">
								<?= $kateg->nama_kategori; ?>
							</a>
						<?php endforeach; ?>
					</div>

					<!-- Produk unggulan -->
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
						Archive
					</h4>

					<ul>
						<?php foreach ($arsipBlog as $AB) : ?>
							<li class="flex-sb-m">
								<?php $key =  !empty($tglactive) ? $tglactive : ''; ?> 
								<a href="<?= base_url() . 'Blogs/arsip_blog?arsip=' . $AB->tanggal; ?>" class="s-text13 p-t-5 p-b-5">
									<?= date_indo($AB->tanggal); ?>
								</a>

								<span class="s-text13">
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