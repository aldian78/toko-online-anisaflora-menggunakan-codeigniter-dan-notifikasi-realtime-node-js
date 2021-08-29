 <!-- partial -->
 <div class="main-panel">
 	<div class="content-wrapper">
 		<div class="page-header">
 			<h3 class="page-title"> Pages Create Produk </h3>
 			<nav aria-label="breadcrumb">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="<?php echo base_url('admin/Blog/page_create') ?>">Create Produk</a></li>
 					<li class="breadcrumb-item active" aria-current="page">Pages</li>
 				</ol>
 			</nav>
 		</div>
 		<div class="row">
 			<div class="col-12 grid-margin stretch-card">
 				<div class="card">
 					<div class="card-body">
 						<h4 class="card-title">Form Create Produk</h4>
 						<p class="card-description"><i class="text-danger">*Pastikan semua field sudah terisi</i></p>
 						<form class="forms-sample" id="create" enctype="multipart/form-data">
 							<div class="form-group">
 								<label for="exampleInputName1">Nama produk</label>
 								<input type="text" class="form-control" name="nama" id="nama" id="exampleInputName1" placeholder="Nama produk">
 								<span class="invalid-feedback"></span>
 							</div>
 							<div class="form-row"> 
 								<div class="form-group col-md-3">
 									<label for="exampleInputName1">Diskon / (<i>*Harga coret</i> )</label>
 									<input type="text" name="diskon_harga" id="diskon" class="form-control col" placeholder="Diskon harga"/>
 									<span><p class="text-danger"><i>*Kosongkan atau beri nilai 0 jika tidak ada diskon !</i></p></span>
 								</div>
 								<div class="form-group col-md-3">
 									<label for="exampleInputName1">Harga</label>
 									<input type="text" name="harga" id="harga" class="form-control col" placeholder="Harga"/>
 									<span class="invalid-feedback"></span>
 								</div>
 								<div class="form-group col-md-3">
 									<label for="exampleInputName1">Berat</label>
 									<input type="text" name="berat" id="berat" class="form-control col" placeholder="Berat produk"/>
 									<span class="invalid-feedback"></span>
 								</div>
 								<div class="form-group col-md-3">
 									<label for="exampleInputName1">Stok</label>
 									<input type="number" name="stok" id="stok" class="form-control col" placeholder="Stok"/>
 									<span class="invalid-feedback"></span>
 								</div>
 							</div>         
 							<div class="form-group">
 								<label for="exampleInputEmail3">Deskripsi produk</label>
 								<textarea class="texteditor" name="isi" id="isi"></textarea>
 								<span class="invalid-feedback"></span>
 							</div>
 							<div class="form-group">
 								<label for="exampleSelectGender">Kategori</label>
 								<select class="custom-select" name="kategori" id="kategori">
 									 <option value="">--Kategori--</option>
 									<?php foreach ($kategori as $kat) : ?>
 										<option value="<?php echo $kat->id_kategori; ?>"><?php echo $kat->nama_kategori; ?></option>
 									<?php endforeach; ?>
 								</select>
 								<span class="invalid-feedback"></span> 
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
 								<input type="file" id="gambar" class="file-upload-default" multiple="multiple">
 								<span class="invalid-feedback" id="image"></span>
 								<span class="text-danger" id="fail_upload_msg"></span>
 							</div>
 							<div class="preview_holder">
 								<div id="preview">
 									<div id="uploadPreview"></div>
 									<span id="preview_text" class="preview_text"><p><strong>Upload image hanya sekali.</strong><i> Max 5 image
 									</i></p></span>
 									<span id="text_preview" class="preview_text text-danger"></span>
 								</div>
 							</div>
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
