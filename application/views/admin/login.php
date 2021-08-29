<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/css/style.css') ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url('assets_admin/images/favicon.ico') ?>" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="<?php echo base_url('assets_admin/images/logo.svg') ?>">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <br>
                <?php echo $this->session->flashdata('massage'); ?>
                <form id="loginForm" action="<?php echo base_url() . 'admin/login/process' ?>" class="pt-3" method="post">
                  <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>">
                    <?php echo form_error('email', '<small class="text-danger pt-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" value="<?php if(isset($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>">
                    <?php echo form_error('password', '<small class="text-danger pt-3">', '</small>'); ?>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                   <!--  <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" name="remember" class="form-check-input"> Keep me signed in 
                      </label>
                    </div> -->
                    <a href="<?php echo base_url('admin/login/forgot_password') ?>" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="mt-3">
                    <button type="submit" name="login" class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <br>
                  <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="mdi mdi-facebook mr-2"></i>Connect using facebook </button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? 
                    <a href="<?php echo base_url('admin/login/register') ?>" class="text-success">Register</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url('assets_admin/vendors/js/vendor.bundle.base.js') ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url('assets_admin/js/off-canvas.js') ?>"></script>
    <script src="<?php echo base_url('assets_admin/js/hoverable-collapse.js') ?>"></script>
    <script src="<?php echo base_url('assets_admin/js/misc.js') ?>"></script>
    <!-- endinject -->
  </body>
</html>