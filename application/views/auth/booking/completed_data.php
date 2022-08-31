<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register - Lengkapi Data</title>
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
      <div class="branding lengkapi-data"><span class="text1">Working</span><span class="text2">Hub.</span></div>
      <!-- partial -->

      <div class="page-content pemesan">

        <div class="row">
					<div class="col-md-12 stretch-card">
						<div class="card">
							<div class="card-body">
								<h6 class="card-title">Lengkapi Data</h6>
									<form method="" action="<?php echo base_url(); ?>index.php/authenticate/logging_in">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nomor Telepon</label>
													<input type="number" class="form-control" placeholder="Nomor Telepon">
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nomor Rekening Bank BNI</label>
													<input type="number" class="form-control" placeholder="Nomor Rekening Bank BNI">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Tempat Lahir</label>
													<input type="text" class="form-control" placeholder="Tempat Lahir">
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nomor Rekening Bank BRI</label>
													<input type="text" class="form-control" placeholder="Nomor Rekening Bank BRI">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                    					<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Tanggal Lahir</label>
													<input type="date" class="form-control" placeholder="Tanggal Lahir">
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nomor Rekening Bank Mandiri</label>
													<input type="number" class="form-control" placeholder="Nomor Rekening Bank Mandiri">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                    					<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Alamat</label>
													<input type="text" class="form-control" placeholder="Alamat">
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nomor Rekening Bank BCA</label>
													<input type="number" class="form-control" placeholder="Nomor Rekening Bank BCA">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
									<div class="d-flex justify-content-center">
									<a href="<?php echo base_url(); ?>index.php/authenticate/logging_in" role="button" class="btn btn-primary btn-pemesan">Simpan</a>
									</div>
							</div>
						</div>
					</div>
				</div>

      </div>

      <!-- partial:partials/_footer.html -->
      <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
        <p class="text-muted text-center text-md-left">Copyright © 2022 <a href="#" target="#">WorkingHub.</a> All rights reserved</p>
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