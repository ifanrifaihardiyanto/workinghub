<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lupa Password</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- core:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/core/core.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/feather-font/css/iconfont.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pemesan/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png" />
</head>

<body>
    <div class="main-wrapper">

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->

            <!-- partial -->

            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <?php
                                        // print_r($gedung);
                                        $this->load->helper('form');
                                        $error = $this->session->flashdata('error');
                                        $success = $this->session->flashdata('success');
                                        ?>
                                        <?php if ($error) : ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">×</button>
                                            <?= $error; ?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if ($success) : ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">×</button>
                                            <?= $success; ?>
                                        </div>
                                        <?php endif; ?>
                                        <!-- <a href="#" class="noble-ui-logo d-block mb-2">Noble<span>UI</span></a> -->
                                        <div class="branding-lupa-passwd"><span class="text1">Working</span><span
                                                class="text2">Hub.</span></div>
                                        <h5 class="text-muted font-weight-normal mb-4">
                                            Lupa Password
                                        </h5>
                                        <form class="forms-sample"
                                            action="<?php echo base_url(); ?>index.php/authenticate/lupa_password"
                                            method="POST">
                                            <div class="form-group first">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control"
                                                    placeholder="your-email@gmail.com" id="email" name="email"
                                                    value="<?= set_value('email'); ?>">
                                                <small class="text-danger"><?= form_error('email'); ?></small>
                                            </div>
                                            <div class="form-group last mb-3">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" placeholder="Your Password"
                                                    id="password" name="password">
                                                <small class="text-danger"><?= form_error('password'); ?></small>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <input style="width: 50%;" type="submit" value="Simpan"
                                                    class="btn btn-block btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- partial:partials/_footer.html -->
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
                <p class="text-muted text-center text-md-left">Copyright © 2022 <a href="#" target="#">WorkingHub.</a>
                    All rights reserved</p>
            </footer>
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="<?php echo base_url(); ?>assets/vendors/core/core.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/inputmask/jquery.inputmask.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/select2/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js">
    </script>
    <!-- end plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url(); ?>assets/vendors/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/template.js"></script>
    <!-- endinject -->
    <!-- custom js for this page -->
    <script src="<?php echo base_url(); ?>assets/js/form-validation.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-maxlength.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/inputmask.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/timepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table.js"></script>
    <!-- end custom js for this page -->
</body>

</html>