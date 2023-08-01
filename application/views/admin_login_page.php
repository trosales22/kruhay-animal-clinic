<?php
	if ($this->session->userdata('admin_session')) {
		redirect(base_url('admin_home'));
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kruhay Animal Clinic | Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="static/images/logo.ico"/>
	<link rel="stylesheet" type="text/css" href="static/Login_v18/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/Login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="static/Login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="static/Login_v18/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="static/Login_v18/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="static/Login_v18/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="static/Login_v18/css/util.css">
	<link rel="stylesheet" type="text/css" href="static/Login_v18/css/main.css">
	<link rel="stylesheet" href="static/css/flatpickr.min.css">
	<link href="static/css/sweetalert2.min.css" rel="stylesheet">
</head>
<body style="background-color: #666666;">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="frmLoginAdmin" method="POST" action="<?php echo base_url(). 'admin_login/process_login'; ?>">
					<span class="login100-form-title p-b-43">
						<img src="<?php echo base_url(); ?>static/images/logo.png" style="height: 100px; width: 100px; border-radius: 50%;">
						Admin Login
					</span>
					
					<div class="wrap-input100 validate-input" data-validate = "Email or Username is required">
						<input class="input100" type="text" name="username_or_email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email or Username</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" style="margin-bottom: 10px; background-color: #006400;">
							<i class="fa fa-sign-in fa-lg" style="margin-right: 5px;"></i> Login
						</button>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('<?php echo base_url(); ?>static/Login_v18/images/background_image.jpeg');">
				</div>
			</div>
		</div>
	</div>

	<script src="static/Login_v18/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="static/Login_v18/vendor/animsition/js/animsition.min.js"></script>
	<script src="static/Login_v18/vendor/bootstrap/js/popper.js"></script>
	<script src="static/Login_v18/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="static/Login_v18/js/main.js"></script>
	<script src="static/js/libraries/flatpickr/flatpickr.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="static/js/admin_login.js"></script>
</body>
</html>
