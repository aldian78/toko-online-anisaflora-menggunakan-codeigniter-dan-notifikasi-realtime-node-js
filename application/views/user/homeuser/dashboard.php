<div class="container1-page">
	<div class="main-content">
    <!-- Page content -->
    <div class="container-fluid m-t-80">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?= base_url() . 'assets_user/images/fotoprofil/' . $user['gambar']; ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
              	<button type="button" class="btn btn-sm btn-warning mr-4" data-toggle="modal" data-target="#changepassword">
              		<i class="fas fa-redo-alt"></i>
              	</button>
                <a href="<?php echo base_url() . 'Homeuser/edit_profile'; ?> " class="btn btn-sm btn-primary float-right"><i class="fas fa-user-edit"></i></a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Friends</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Photos</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Comments</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?= $user['username']; ?>                
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?= $user['tanggal']; ?>
                </div>
                <div class="h5 mt-4" style="text-transform: uppercase;">
                  <i class="ni business_briefcase-24 mr-2"></i>happy shooping - anisaflora sidoarjo
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Akun profil</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Informasi akun</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-email">Email address</label>
                      	<p class="s-text23 m-t-5"><?= $user['email']; ?></p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <p class="s-text23 m-t-5"><?= $user['username']; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">No telepon</label>
                       	<p class="s-text23 m-t-5"><?= $user['notlp']; ?></p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Akun terdaftar</label>
                        <p class="s-text23 m-t-5"><?= $user['tanggal']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Informasi alamat</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Alamat</label>
                        <?php if(!empty($user['alamat'])) : ?>
                        	<p class="s-text23 m-t-5"><?= $user['alamat']; ?></p>
                        <?php else : ?>
                        	<p class="s-text23 m-t-5"><i>Alamat belum diisi</i></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">Provinsi</label>
                        <?php if(!empty($user['provinsi'])) : ?>
                        	<p class="s-text23 m-t-5"><?= $user['provinsi']; ?></p>
                        <?php else : ?>
                        	<p class="s-text23 m-t-5"><i>Provinsi belum diisi</i></p>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Kabupaten atau Kota</label>
                       <?php if(!empty($user['kabataukota'])) : ?>
                        	<p class="s-text23 m-t-5"><?= $user['kabataukota']; ?></p>
                        <?php else : ?>
                        	<p class="s-text23 m-t-5"><i>Kabupaten atau kota belum diisi</i></p>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Kodepos</label>
                        <?php if(!empty($user['kodepos'])) : ?>
                        	<p class="s-text23 m-t-5"><?= $user['kodepos']; ?></p>
                        <?php else : ?>
                        	<p class="s-text23 m-t-5"><i>Kodepos belum diisi</i></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
			  <!-- Modal -->
			  <div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog">
			  		<div class="modal-content">
			  			<div class="modal-header">
			  				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  					<span aria-hidden="true">&times;</span>
			  				</button>
			  			</div>
			  			<form id="ubahpassword">
			  			<div class="modal-body">
			  				<label for="passwordlama">Password lama</label>
			  				<div class="bo12 size15 m-b-25">
			  					<input class="form-control" type="password" name="passwordlama" id="isipasswordlama">
			  					<small class="text-danger" id="passwordlama"></small>
			  				</div>

			  				<label for="passwordbaru">Password baru</label>
			  				<div class="bo12 size15 m-b-25">
			  					<input class="form-control" type="password" name="passwordbaru" id="isipasswordbaru">
			  					<small class="text-danger" id="passwordbaru"></small>
			  				</div>

			  				<label for="konfirmasipassword">Konfirmasi password</label>
			  				<div class="bo12 size15 m-b-5">
			  					<input class="form-control" type="password" name="konfirmasipassword" id="isikonfirmasi">
			  					<small class="text-danger" id="konfirmasipassword"></small>
			  				</div>
			  				<div class="size15 m-b-25">
			  					<input type="checkbox" class="form-checkbox"> Tampilkan semua password
			  				</div>
			  			</div>
			  			<div class="modal-footer">
			  				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			  				<button type="submit" class="btn btn-success">Simpan</button>
			  			</div>
			  			</form>
			  		</div>
			  	</div>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
