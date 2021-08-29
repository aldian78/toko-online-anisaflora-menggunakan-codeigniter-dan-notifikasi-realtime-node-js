 <!-- partial -->
 <div class="main-panel">
 	<div class="content-wrapper">
 		<div class="page-header">
 			<h3 class="page-title"> Pages Update Blog </h3>
 			<nav aria-label="breadcrumb">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="<?php echo base_url('admin/Blog/page_create') ?>">Update Blog</a></li>
 					<li class="breadcrumb-item active" aria-current="page">Pages</li>
 				</ol>
 			</nav>
 		</div>
 		<div class="row">
 			<div class="col-12 grid-margin stretch-card">
 				<div class="card">
 					<div class="card-body">
 						<h4 class="card-title">Form Update Blog</h4>
 						<p class="card-description"><i class="text-danger">*Pastikan semua field sudah terisi</i></p>
 						<form class="forms-sample" id="form-update" action="#" enctype="multipart/form-data">
 							<?php foreach ($blog as $bg) : ?>
 							<div class="form-group">
 								<label for="exampleInputName1">Judul</label>
 								<input type="hidden" name="id_blog" value="<?= $bg['id_blog']; ?>">
 								<input type="text" class="form-control" name="judul" id="judul" id="exampleInputName1" value="<?php echo $bg['judul']; ?>">
 								<span class="invalid-feedback" id="jdl"></span>
 							</div>
 							<div class="form-group">
 								<label for="exampleInputEmail3">Deskripsi blog</label>
 								<textarea class="texteditor" name="isi" id="isi"><?php echo $bg['isi']; ?></textarea>
 								<span class="invalid-feedback" id="des"></span>
 							</div>
 							<div class="form-group">
 								<label for="exampleSelectGender">Kategori</label>
 								<select class="custom-select" name="kategori" id="kategori">
 									 <option value="">--Kategori--</option>
 									<?php foreach ($kategori as $kat) : ?>
 										<option value="<?php echo $kat->id_kategori; ?>" <?php if($bg['id_kategori']==$kat->id_kategori) echo 'selected="selected"'; ?>><?php echo $kat->nama_kategori; ?></option>
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
 								<div id="fail_upload_msg"></div>
 							</div>
 							<div class="preview_holder">
 								<div id="preview">
 									<div id="uploadPreview" >
 										<img src="<?php echo base_url('assets_admin/img/blog/' . $bg['gambar1']); ?>" class="thumb" id="update">
 											<?php if($bg['gambar2'] != "") : ?>
 												<img src="<?php echo base_url('assets_admin/img/blog/' . $bg['gambar2']); ?>" class="thumb" id="update">
 											<?php endif; ?>
 											<?php if($bg['gambar3'] != "") : ?>
 												<img src="<?php echo base_url('assets_admin/img/blog/' . $bg['gambar3']); ?>" class="thumb" id="update">
 											<?php endif; ?>
 									</div>
 									<span id="preview_text" class="preview_text text-danger" style="display: none;"><p><strong>Maaf ! Silahkan upload ulang.</strong><i> Max 3 image
 									</i></p></span>
 								</div>
 							</div>
 							<?php endforeach; ?>

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
