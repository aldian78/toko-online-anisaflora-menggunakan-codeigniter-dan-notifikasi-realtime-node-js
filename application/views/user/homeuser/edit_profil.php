<div class="container1-page">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Edit akun</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Login</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit akun</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Pembaruan akun</h4>
            <form class="leave-comment" id="edit_profil" enctype="multipart/form-data">
              <label for="exampleFormControlInput1">Email</label>
              <div class="bo12 size15 m-b-25">
                <input class="sizefull s-text5 p-l-18 p-r-18 read" type="text" name="email" id="isiemail" value="<?= $user['email']; ?>" readonly>
              </div>

              <label for="exampleFormControlInput1">Username</label>
              <div class="bo12 size15 m-b-25">
                <input class="sizefull s-text5 p-l-18 p-r-18" type="text" name="username" id="isiusername" value="<?= $user['username']; ?>">
                <small class="text-danger" id="username"></small>
              </div>

              <label for="exampleFormControlInput1">No telepon</label>
              <div class="bo12 size15 m-b-25">
                <input class="sizefull s-text5 p-l-18 p-r-18" type="text" name="notlp" id="isinotlp" value="<?= $user['notlp']; ?>">
                <small class="text-danger" id="notlp"></small>
              </div>

              <label for="exampleFormControlInput1">Provinsi</label>
              <div class="rs2-select2 bo12 size15 m-b-25">
                <select class="selection-2" name="provisiprofile" id="isiprovinsi" onchange="id_provinsi()">
                  <option disabled selected="">Silahkan pilih provinsi</option>
                  <?php foreach ($province as $value) : ?>
                    <option value="<?= $value['province']; ?>" id_provinsi="<?= $value['province_id']; ?>" <?php if($value['province'] == $user['provinsi']) echo 'selected'; ?>><?= $value['province']; ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="text-danger" id="provisiprofile"></small>
              </div>

              <label for="exampleFormControlInput1">Kabupaten / kota</label>
              <div class="rs2-select2 bo12 size15 m-b-25">
                <select class="selection-2" name="kotaprofile" id="kabataukota">
                </select>
                <small class="text-danger" id="kotaprofile"></small>
              </div>

              <label for="exampleFormControlInput1">Kodepos</label>
              <div class="bo12 size15 m-b-25">
                <input class="sizefull s-text5 p-l-18 p-r-18" type="text" name="kodepos" id="isikodepos" value="<?= $user['kodepos']; ?>">
                <small class="text-danger" id="kodepos"></small>
              </div>

              <label for="exampleFormControlInput1">Alamat lengkap</label>
              <textarea class="dis-block s-text5 size20 bo12 p-l-18 p-r-18 p-t-13" name="alamat" id="isialamat"><?= $user['alamat']; ?></textarea>
              <small class="text-danger" id="alamat"></small>
              <br>
              
              <label for="fotoakun">Foto akun</label>
              <div class="size15 m-b-40">
              <img src="<?= base_url() . 'assets_user/images/fotoprofil/' . $user['gambar']; ?>" style="width: 80px; height: 80px;">
              </div>
              <div class="bo12 size15 m-b-25">
                <input class="sizefull s-text5 p-l-18 p-r-18 m-t-15" type="file" name="gambar" id="isifoto">
                <small class="text-danger" id="foto"></small>
              </div>
              <div class="w-size25">
                <!-- Button -->
                <button type="submit" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                  Send
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>