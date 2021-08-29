
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
              <p class="login-card-description">Sign into your account</p>
              <form action="<?php base_url() . 'Auth/register'; ?>" method="POST">
               <?= $this->session->flashdata('success'); ?>
               <?= $this->session->flashdata('gagal'); ?>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="emailregis" id="email" class="form-control" value="<?= set_value('emailregis'); ?>" placeholder="Email address">
                <?= form_error('emailregis', '<small class="msg-error">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>" placeholder="Username">
                <?= form_error('username', '<small class="msg-error">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="notlp">No telepon</label>
                <input type="text" name="notlp" id="notlp" class="form-control" value="<?= set_value('notlp'); ?>" placeholder="No telepon">
                <?= form_error('notlp', '<small class="msg-error">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" name="password1" id="password1" class="form-control" placeholder="***********">
                <?= form_error('password1', '<small class="msg-error">', '</small>'); ?>
              </div>
              <div class="form-group mb-4">
                <label for="password2">Konfirmasi password</label>
                <input type="password" name="password2" id="password2" class="form-control" placeholder="***********">
                <input type="checkbox" class="form-checkboxregister"> Tampilkan password
              </div>
              <button class="btn btn-block login-btn mb-4" type="submit">Login</button>
              </form>
            <a href="<?= base_url() . 'Auth/forgot_password'; ?>" class="forgot-password-link">Lupa password?</a>
            <p class="login-card-footer-text"> Kembali ke <a href="<?= base_url() . 'Auth'; ?>" class="text-reset">Login</a></p>
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
      $('.form-checkboxregister').click(function(){
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
