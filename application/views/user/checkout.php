<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?= base_url(). 'assets_user/images/heading-pages-06.jpg' ?>);">
	<h2 class="l-text2 t-center">
		Contact
	</h2>
</section>

<!-- content page -->
<section class="bgwhite p-t-66 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-6 p-b-30">
				<div class="p-r-20 p-r-0-lg">
					<form class="leave-comment">
					<h4 class="m-text26 p-b-36 p-t-15">
						Send us your message
					</h4>
					<div class="rs2-select2 search-product pos-relative bo4 of-hidden m-b-20" id="checkout">
						<select class="selection-1" name="kategori">
							<option value="0">- Pilih Alamat Tujuan -</option>
							<option value="1">+ Tambah alamat lain</option>
							<option value="2"> <?= $user['username']; ?> ( <?= $user['kabataukota']; ?> - <?= $user['provinsi']; ?> ) - Alamat Utama</option>
						</select>
					</div>

					<div id="valueAlamat"></div>

					<div class="bo4 of-hidden size15 m-b-20 dis-none" id="jenisAlamat">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" id="jenAlamat" placeholder="Jenis Alamat? ex: Alamat Rumah, Alamat Kantor, Dll">
					</div>

					<div class="bo4 of-hidden size15 m-b-20 dis-none" id="namaPenerima">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="text" id="namPenerima" placeholder="Nama Penerima">
					</div>

					<div class="bo4 of-hidden size15 m-b-20 dis-none" id="notlpPenerima">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="text" id="tlpPenerima" placeholder="No Tlp Penerima">
					</div>

					<textarea class="s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20 dis-none" id="AlamatPenerima" name="message" placeholder="Alamat lengkap"></textarea>

					<div class="bo4 of-hidden size15 m-b-20 dis-none" id="provPenerima">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="text" id="proPenerima" placeholder="Provinsi">
					</div>

					<div class="bo4 of-hidden size15 m-b-20 dis-none" id="kabataukotaPenerima">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="text" id="kabkotmPenerima" placeholder="Kabupaten atau Kota">
					</div>

					<div class="bo4 of-hidden size15 m-b-20 dis-none" id="kodeposPenerima">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="text" id="posPenerima" placeholder="Kodepos">
					</div>

					<div class="flex-w flex-m w-full-sm">
						<div class="size-custom rs2-select2 search-product pos-relative bo4 of-hidden m-r-10 m-b-20" id="checkout">
							<select class="selection-1" name="kategori">
								<option value="0">Pilih Ekspedisi</option>
								<option value="1">+ Tambah alamat lain</option>
							</select>
						</div>

						<div class="size-custom rs2-select2 search-product pos-relative bo4 of-hidden m-b-20" id="checkout">
							<select class="selection-1" name="kategori">
								<option value="0">Pilih Paket Pengiriman</option>
								<option value="1">+ Tambah alamat lain</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 p-b-30 m-t-20">
				<h5 class="m-text20 p-b-24">
					Total Pembayaran
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						$39.00
					</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Shipping:
					</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						$39.00
					</span>
				</div>

				<div class="size15 trans-0-4">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Proceed to Checkout
					</button>
				</div>
			</div>
		</div>
	</div>
</section>
