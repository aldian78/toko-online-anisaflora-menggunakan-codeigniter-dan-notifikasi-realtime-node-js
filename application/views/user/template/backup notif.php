	<?php foreach($this->cart->contents() as $key => $value) {
		?> 

		<ul class="header-cart-wrapitem app">
			<li class="header-cart-item">
				<div class="header-cart-item-img imgproduk">
					<img src="<?php echo base_url() . 'assets_admin/img/produk/' . $value['gambar'] ?>" alt="IMG">
				</div>

				<div class="header-cart-item-txt">
					<a href="#" class="header-cart-item-name namaproduk">
						<?= $value['name']; ?>
					</a>

					<span class="header-cart-item-info jumlah">
						<?= $value['qty']; ?> x <?= number_format($value['price']); ?>
					</span>
				</div>
			</li>
		</ul>
	<?php } ?>

	<?php if(!empty($totalcart)) : ?>
		<div class="header-cart-total totalharga">
			Total: Rp. <?= number_format($this->cart->total()); ?>
		</div>

		<?php else : ?>
			<div class="s-text3" style="text-align: center;">
				Tidak ada produk dikeranjang
			</div>
			<?php endif; ?>




			<div class="tambahwishlist block2-btn-addwishlist hov-pointer trans-0-4" data-iduser="<?= $user['id_user']; ?>" data-produk="<?= $kp->nama_produk; ?>" data-harga="<?= $kp->harga; ?>" data-idproduk="<?= $kp->id_produk; ?>" data-gambar="<?= $kp->gambar1; ?>">

				<?php foreach ($wishlist as $key => $value) : ?>
											<tr>
												<td>
													<img src="<?= base_url() . 'assets_admin/img/produk/' . $value->gambar; ?>" alt="image">
												</td>
												<td> <?= $value->nama_produk; ?></td>
												<td>Rp. <?= number_format($value->harga) ?></td>
												<td><?= $value->tanggal; ?></td>
												<td>
													<?php if($value->stok == 0 ) : ?>
														<label class="badge badge-gradient-danger">Habis</label>
													<?php elseif ($value->stok < 3) : ?>
														<label class="badge badge-gradient-warning">Sisa <?= $value->stok; ?></label>
													<?php else : ?>
														<a href="<?= base_url() . 'Product/product_detail/' . $value->id_produk; ?>" class="badge badge-gradient-primary"><i class="fas fa-eye"></i></a>
														<button class="hapuswishlist badge badge-gradient-danger" id="<?= $value->id_produk; ?>" nama="<?= $value->nama_produk; ?>"><i class="fas fa-trash-alt"></i></button>
													<?php endif; ?>
												</td>
											</tr>
										<?php endforeach; ?>
