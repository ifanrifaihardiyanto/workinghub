<?php
$user = $this->session->userdata('user');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Dashboard <?= $user[0]->role ?></title>
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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo_1/style.css">
	<!-- End layout styles -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png" />
</head>

<body>
	<div class="main-wrapper">

		<!-- partial:../../partials/_sidebar.html -->
		<?php
		$this->load->view('includes/dashboard/partials/sidebar.php');
		?>
		<!-- partial -->

		<div class="page-wrapper">

			<!-- partial:../../partials/_navbar.html -->
			<?php
			$this->load->view('includes/dashboard/partials/navbar.php');
			?>
			<!-- partial -->

			<div class="page-content">
				<?php
				$this->load->view($pageView);
				?>
			</div>

			<!-- partial:../../partials/_footer.html -->
			<?php
			$this->load->view('includes/dashboard/partials/footer.php');
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
	<script src="<?php echo base_url(); ?>assets/js/file-upload.js"></script>
	<!-- end custom js for this page -->
</body>

</html>