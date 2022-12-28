<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WorkingHub.</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- core:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/core/core.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/vendors/core/core.js"></script>
</head>

<body>
    <div class="main-wrapper">

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            <?php
      $this->load->view('includes/booking/partials/navbar.php');
      ?>
            <!-- partial -->

            <!-- <div class="head">
          <div class="row">
            <div class="col-12">
              <div class="card card-head">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="assets/images/bg.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="assets/images/bg.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="assets/images/bg.png" class="d-block w-100" alt="...">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
      </div> -->

            <div class="page-content">
                <?php
        $this->load->view($pageView);
        ?>
            </div>

            <!-- partial:partials/_footer.html -->
            <?php
      $this->load->view('includes/booking/partials/footer.php');
      ?>
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script> -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- endinject -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.0-beta.3/dist/iconify-icon.min.js"></script>
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
    <script src="<?php echo base_url(); ?>assets/js/file-upload.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- end custom js for this page -->

</body>

</html>