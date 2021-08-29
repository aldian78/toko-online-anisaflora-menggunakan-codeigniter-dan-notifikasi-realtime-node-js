
  <main class="d-flex align-items-center p-t-30 p-b-30 py-md-30">
    <div class="container">
      <div class="login-card-login">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="<?= base_url() . 'assets_user/images/icons/fotologin.jpg'; ?>" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="<?= base_url() . 'assets_user/images/icons/logo.svg'; ?>" alt="logo" class="logologin">
              </div>
              <p class="login-card-description">Change password</p>
              <form action="<?php base_url() . 'Auth/'; ?>" method="POST">
               <?= $this->session->flashdata('success'); ?>
               <?= $this->session->flashdata('gagal'); ?>

              <div class="form-group">
                <h5><?= $this->session->userdata('reset_email'); ?></h5>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password1" id="password1" class="form-control" placeholder="***********">
                <?= form_error('password1', '<small class="msg-error">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="password">Konfirmasi password</label>
                <input type="password" name="password2" id="password2" class="form-control" placeholder="***********">
                <?= form_error('password2', '<small class="msg-error">', '</small>'); ?>
              </div>
              <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input"> Tampilkan password
              </div>
              <button class="btn btn-block login-btn mb-4" type="submit">Ubah password</button>
              </form>
            <nav class="login-card-footer-nav">
              <a href="#!">Terms of use.</a>
              <a href="#!">Privacy policy</a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script type="text/javascript">
    $(document).ready(function(){   
      $('.form-check-input').click(function(){
        if($(this).is(':checked')){
          $('#password1').attr('type','text');
          $('#password2').attr('type','text');
        }else{
          $('#password1').attr('type','password');
          $('#password2').attr('type','password');
        }
      });
    });
  </script>
