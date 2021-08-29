 <!-- partial -->
 <div class="main-panel">
 	<div class="content-wrapper">
 		<div class="page-header">
 			<h3 class="page-title"> Pages Update Produk </h3>
 			<nav aria-label="breadcrumb">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="<?php echo base_url('admin/Blog/page_create') ?>">Update Produk</a></li>
 					<li class="breadcrumb-item active" aria-current="page">Pages</li>
 				</ol>
 			</nav>
 		</div>
 		<div class="row">
 			<div class="col-12 grid-margin stretch-card">
 				<div class="card">
 					<div class="card-body">
 						<h4 class="card-title">Form Update Produk</h4>
 						<p class="card-description"><i class="text-danger">*Pastikan semua field sudah terisi</i></p>
 						<form class="forms-sample" id="update" enctype="multipart/form-data">
 							<?php foreach ($produk as $pr) : ?>
 							<div class="form-group">
 								<label for="exampleInputName1">Nama produk</label>
 								<input type="hidden" name="id_produk" value="<?= $pr['id_produk']; ?>">
 								<input type="text" class="form-control" name="nama" id="nama" id="exampleInputName1" value="<?php echo $pr['nama_produk']; ?>">
 								<span class="invalid-feedback" id="nma"></span>
 							</div>
 							<div class="form-row"> 
 								<div class="form-group col-md-3">
 									<label for="exampleInputName1">Diskon / (<i>*Harga coret</i> )</label>
 									<input type="text" name="diskon_harga" id="diskon" class="form-control col"/>
 									<span><p class="text-danger"><i>*Kosongkan atau beri nilai 0 jika tidak ada diskon !</i></p></span>
 								</div>
 								<div class="form-group col-md-3">
 									<label for="exampleInputName1">Harga</label>
 									<input type="text" name="harga" id="harga" class="form-control col" value="<?= rupiah($pr['harga']); ?>"/>
 									<span class="invalid-feedback" id="hrg"></span>
 								</div>
 								<div class="form-group col-md-3">
 									<label for="exampleInputName1">Berat</label>
 									<input type="text" name="berat" id="berat" class="form-control col" value="<?= $pr['berat']; ?>"/>
 									<span class="invalid-feedback" id="brt"></span>
 								</div>
 								<div class="form-group col-md-3">
 									<label for="exampleInputName1">Stok</label>
 									<input type="number" name="stok" id="stok" class="form-control col" value="<?= $pr['stok']; ?>"/>
 									<span class="invalid-feedback" id="stk"></span>
 								</div>
 							</div> 
 							<div class="form-group">
 								<label for="exampleInputEmail3">Deskripsi produk</label>
 								<textarea class="texteditor" name="isi" id="isi"><?php echo $pr['isi_produk']; ?></textarea>
 								<span class="invalid-feedback" id="des"></span>
 							</div>
 							<div class="form-group">
 								<label for="exampleSelectGender">Kategori</label>
 								<select class="custom-select" name="kategori" id="kategori">
 									 <option value="">--Kategori--</option>
 									<?php foreach ($kategori as $kat) : ?>
 										<option value="<?php echo $kat->id_kategori; ?>" <?php if($pr['id_kategori']==$kat->id_kategori) echo 'selected="selected"'; ?>><?php echo $kat->nama_kategori; ?></option>
 									<?php endforeach; ?>
 								</select>
 								<span class="invalid-feedback" id="kat"></span> 
 								<!-- invalid-feedback class bawaan bosstrap -->
 							</div>
 							<div class="form-group">
 								<label>Upload image</label>
 								<div class="input-group col-xs-12">
 									<input type="text" id="imgerror" class="form-control file-upload-info" disabled placeholder="Gambar 1">
 									<span class="input-group-append">
 										<button class="file-upload-browse btn btn-gradient-success" type="button">Upload</button>
 									</span>
 								</div>
 								<input type="file" id="gambarupdate" class="file-upload-default" multiple="multiple">
 								<span class="invalid-feedback" id="remove"></span>
 								<span class="text-danger" id="fail_upload_msg"></span>
 							</div>
 							<div class="preview_holder">
 								<div id="preview">
 									<div id="uploadPreview" >
 										<img src="<?php echo base_url('assets_admin/img/produk/' . $pr['gambar1']); ?>" class="thumb" id="gambar1">
 											<?php if($pr['gambar2'] != "") : ?>
 												<img src="<?php echo base_url('assets_admin/img/produk/' . $pr['gambar2']); ?>" class="thumb" id="gambar2">
 											<?php endif; ?>
 											<?php if($pr['gambar3'] != "") : ?>
 												<img src="<?php echo base_url('assets_admin/img/produk/' . $pr['gambar3']); ?>" class="thumb" id="gambar3">
 											<?php endif; ?>
 											<?php if($pr['gambar4'] != "") : ?>
 												<img src="<?php echo base_url('assets_admin/img/produk/' . $pr['gambar4']); ?>" class="thumb" id="gambar4">
 											<?php endif; ?>
 											<?php if($pr['gambar5'] != "") : ?>
 												<img src="<?php echo base_url('assets_admin/img/produk/' . $pr['gambar5']); ?>" class="thumb" id="gambar5">
 											<?php endif; ?>
 									</div>
 									<span id="preview_text" class="preview_text text-danger" style="display: none;"><p><strong>Maaf ! Silahkan upload ulang.</strong><i> Max 5 image
 									</i></p></span>
 								</div>
 							</div>
 							<?php endforeach; ?>

 							<div class="form-group">
 							<button type="submit" id="submit" class="btn btn-gradient-success mr-2" >Publish</button>
 							<a href="<?php echo base_url('admin/Produk'); ?>" class="btn btn-secondary">Cancel</a>
 							</div>
 							<br></br>
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
