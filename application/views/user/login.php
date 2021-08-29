
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
              <form action="<?php base_url() . 'Auth'; ?>" method="POST">
               <?= $this->session->flashdata('success'); ?>
               <?= $this->session->flashdata('gagal'); ?>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= set_value('email'); ?>" placeholder="Email address">
                <?= form_error('email', '<small class="msg-error">', '</small>'); ?>
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="***********">
               <?= form_error('password', '<small class="msg-error">', '</small>'); ?>
              </div>
              <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input"> Tampilkan password
              </div>

              <button class="btn btn-block login-btn mb-4" type="submit">Login</button>
              </form>
            <a href="<?= base_url() . 'Auth/forgot_password'; ?>" class="forgot-password-link">Lupa password?</a>
            <p class="login-card-footer-text"> Belum mempunyai akun ? <a href="<?= base_url() . 'Auth/register'; ?>" class="text-reset">Daftar</a></p>
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
          $('#password').attr('type','text');
        }else{
          $('#password').attr('type','password');
        }
      });
    });
  </script>
