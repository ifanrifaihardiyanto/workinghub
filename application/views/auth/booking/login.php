<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Log in</title>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<!-- core:css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/core/core.css">
	<!-- endinject -->
  <!-- plugin css for this page -->
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->
  <!-- Layout styles -->  
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pemesan/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png" />
</head>
<body>
	<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('<?php echo base_url(); ?>images/Image.jpg');"></div>
    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="branding"><span class="text1">Working</span><span class="text2">Hub.</span></div>
            <div class="login">Login</div>
            <form action="<?php echo base_url(); ?>index.php/authenticate/logging_in" method="post">
              <div class="form-group first">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="your-email@gmail.com" id="email">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Your Password" id="password">
              </div>
              <div class="d-flex mb-5 align-items-center">
                <span class="ml-auto"><a href="#" class="forgot-pass">Lupa Password?</a></span> 
              </div>
              <input type="submit" value="Log In" class="btn btn-block btn-primary">
              <div class="d-block mt-3 text-muted">Belum punya akun? <a href="<?php echo base_url(); ?>index.php/authenticate/register" class="choose-register">Register</a></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

	<!-- core:js -->
	<script src="<?php echo base_url(); ?>assets/vendors/core/core.js"></script>
	<!-- endinject -->
  <!-- plugin js for this page -->
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="<?php echo base_url(); ?>assets/vendors/feather-icons/feather.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/template.js"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
	<!-- end custom js for this page -->
</body>
</html>