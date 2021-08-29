 <!-- partial -->
 <div class="main-panel">
 	<div class="content-wrapper">
 		<div class="page-header">
 			<h3 class="page-title"> Pages Create Blog </h3>
 			<nav aria-label="breadcrumb">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="<?php echo base_url('admin/Blog/page_create') ?>">Create Blog</a></li>
 					<li class="breadcrumb-item active" aria-current="page">Pages</li>
 				</ol>
 			</nav>
 		</div>
 		<div class="row">
 			<div class="col-12 grid-margin stretch-card">
 				<div class="card">
 					<div class="card-body">
 						<h4 class="card-title">Form Create Blog</h4>
 						<p class="card-description"><i class="text-danger">*Pastikan semua field sudah terisi</i></p>
 						<form class="forms-sample" id="form-create" action="#" enctype="multipart/form-data">
 							<div class="form-group">
 								<label for="exampleInputName1"><strong>Judul</strong></label>
 								<input type="text" class="form-control" name="judul" id="judul" id="exampleInputName1" placeholder="Judul Blog">
 								<span class="invalid-feedback"></span>
 							</div>
 							<div class="form-group">
 								<label for="exampleInputEmail3"><strong>Deskripsi blog</strong></span></label>
 								<textarea class="texteditor" name="isi" id="isi"></textarea>
 								<span class="invalid-feedback"></span>
 							</div>
 							<div class="form-group">
 								<label for="exampleSelectGender"><strong>Kategori</strong></label>
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
 								<label><strong>Upload image</strong></label>
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
 									<span id="preview_text" class="preview_text"><p><strong>Upload image hanya sekali.</strong><i> Max 3 image
 									</i></p></span>
 									<span id="text_preview" class="preview_text text-danger"></span>
 								</div>
 							</div>
 							<div class="form-group">
 							<button type="submit" id="submit" class="btn btn-gradient-success mr-2" >Publish</button>
 							<a href="<?php echo base_url('admin/Blog'); ?>" class="btn btn-secondary">Cancel</a>
 							</div>
 							<br></br>
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
