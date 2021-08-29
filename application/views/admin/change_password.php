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
                <h6 class="font-weight-light">Change Password</h6>
                <br>
                <?php echo $this->session->flashdata('massage'); ?>
                <form action="<?php echo base_url() . 'admin/login/change_password' ?>" class="pt-3" method="post">
                  <div class="form-group">
                    <input type="password" id="password" name="password1" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Password">
                    <?php echo form_error('password1', '<small class="text-danger pt-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" id="password" name="password2" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Ulangi password">
                    <?php echo form_error('password2', '<small class="text-danger pt-3">', '</small>'); ?>
                  </div>
                  <div class="mt-3">
                    <button type="submit" name="forgot_password" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Reset Password</button>
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