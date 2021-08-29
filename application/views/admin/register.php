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
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <br>
                <?php echo $this->session->flashdata('massage'); ?>
                <form id="loginForm" action="<?php echo base_url(). 'admin/login/register' ?>" class="pt-3" method="post">
                  <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control form-control-lg" id="exampleInputUsername1" value="<?php echo set_value('name'); ?>" placeholder="Nama lengkap">
                    <?php echo form_error('name', '<small class="text-danger pt-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control form-control-lg" id="exampleInputEmail1" value="<?php echo set_value('email'); ?>" placeholder="Email">
                    <?php echo form_error('email', '<small class="text-danger pt-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password1" id="password1" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                    <?php echo form_error('password1', '<small class="text-danger pt-3">', '</small>'); ?>
                  </div>
                   <div class="form-group">
                    <input type="password" name="password2" id="password2" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Ulangi password">
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                      </div>
                    </div>
                    <div class="mt-3">
                      <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Register</button>
                    </div>
                    <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="<?php echo base_url('admin/login') ?>" class="text-primary">Login</a>
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