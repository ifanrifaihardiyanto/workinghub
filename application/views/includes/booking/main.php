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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/select2/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
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

        <div class="grid-margin">
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card bg-card">
                  <img src="<?php echo base_url(); ?>assets/images/bg.png" alt="background-image" class="bg-pemesan">
                  <div class="bg" style="background-image: url('assets/images/bg.png');"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- row -->

        <div class="booking-area">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <form action="">
                  <div class="booking-wrap searching-home d-flex justify-content-between align-items-center">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Kota / Lokasi</label>
                        <select class="js-example-basic-single w-100">
                          <option value="TX">Jakarta</option>
                          <option value="NY">Bandung</option>
                          <option value="FL">Yogyakarta</option>
                          <option value="KN">Surabaya</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="Tanggal Penyewaan">Tanggal Penyewaan</label>
                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Durasi</label>
                        <select class="js-example-basic-single w-100">
                          <option value="TX">Jam</option>
                          <option value="NY">Harian</option>
                          <option value="FL">Mingguan</option>
                          <option value="KN">Bulanan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Kapasitas</label>
                        <select class="js-example-basic-single w-100">
                          <option value="KN">Semua Kapasitas</option>
                          <option value="TX">1 - 5 Orang</option>
                          <option value="NY">6 - 10 Orang</option>
                          <option value="FL">11 - 20 Orang</option>
                          <option value="KN">21 - 30 Orang</option>
                          <option value="TX">31 - 50 Orang</option>
                          <option value="NY">51 - 100 Orang</option>
                          <option value="FL">100+ Orang</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <a role="button" href="pages/pemesan/pencarian.html" class="btn btn-block btn-primary">Cari</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- booking area -->

        <div class="pilihan-ruangan">
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-center">
                <div class="judul">Pilihan kota dengan penyewaan terbanyak</div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="card text-white">
                  <img src="https://via.placeholder.com/410x251" class="card-img" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title text-white font-weight-bold">Jakarta</h5>
                    <p class="card-text">Last updated 3 mins ago</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card text-white">
                  <img src="https://via.placeholder.com/410x251" class="card-img" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title text-white font-weight-bold">Bandung</h5>
                    <p class="card-text">Last updated 3 mins ago</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card text-white">
                  <img src="https://via.placeholder.com/410x251" class="card-img" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title text-white font-weight-bold">Yogyakarta</h5>
                    <p class="card-text">Last updated 3 mins ago</p>
                  </div>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <!-- pilihan ruangan -->

        <hr>

        <div class="pilihan-ruangan">
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-center">
                <div class="judul"><span class="text1">Working</span><span class="text2">Hub.</span> solusi bagi anda untuk dapatkan ruangan terbaik</div>
              </div>
            </div>
            <div class="col-12">
              <div class="d-flex justify-content-center">
                <div class="keterangan">WorkingHub. adalah aplikasi penyewaan ruangan berbasis online di Indonesia yang bisa menjadi pilihan terbaik Anda untuk menyewa ruangan di berbagai kota favorit.</div>
              </div>
            </div>
          </div>
        </div>
        <!-- tentang workinghub. -->

        

      </div>

      <!-- partial:partials/_footer.html -->
      <!-- <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between"> -->
      <?php
        $this->load->view('includes/booking/partials/footer.php');
      ?>
      <!-- partial -->

    </div>
  </div>

  <!-- core:js -->
	<script src="<?php echo base_url(); ?>assets/vendors/core/core.js"></script>
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
	<script src="<?php echo base_url(); ?>assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js"></script>
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