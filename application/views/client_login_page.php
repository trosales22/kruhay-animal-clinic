<?php
	$sessionData = $this->session->userdata('logged_in');

    if($sessionData){
        redirect(base_url());
    }
?>
<html>
<head>
	<title>Kruhay Animal Clinic - Client Login</title>
	<link href="<?php echo base_url(); ?>static/css/tailwind.min.css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>static/images/logo.ico"/>
	<style>
		body {
			font-family: "Inter", sans-serif;
		}

		input::-webkit-input-placeholder { /* WebKit browsers */
			color: #fff;
		}

		input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
			color: #fff;
		}

		input::-moz-placeholder { /* Mozilla Firefox 19+ */
			color: #fff;
		}

		input:-ms-input-placeholder { /* Internet Explorer 10+ */
			color: #fff;
		}
	</style>
	<script src="<?php echo base_url(); ?>static/js/libraries/alpine/alpine.js" defer></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>static/js/libraries/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css">
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
<div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1">
	<div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
		<div>
			<img src="<?php echo base_url(); ?>static/images/logo.png" class="w-32 mx-auto" style="border-radius: 50%;"/>
		</div>
		<div class="mt-5 flex flex-col items-center">
			<h1 class="text-2xl xl:text-3xl font-extrabold">
				Client Login
			</h1>
			<div class="w-full flex-1 mt-3">
				<div class="mx-auto max-w-xs">
					<form class="login100-form validate-form" id="frmLoginClient" method="POST" action="<?php echo base_url(). 'client_login/login'; ?>">
						<input name="email" type="email" placeholder="Email" required class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"/>
						<input name="password" type="password" placeholder="Password" required class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"/>
						<button type="submit" class="mt-2 tracking-wide font-semibold bg-green-500 text-gray-100 w-full py-4 rounded-lg hover:bg-green-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
							<span class="ml-3">Login</span>
						</button>
					</form>

					<a href="<?php echo base_url(); ?>">
						<button class="mt-2 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
							<span class="ml-3">Back to Home</span>
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
		<div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat" style="background-image: url('static/images/pets_bg.jpg');"></div>
	</div>
</div>
<script src="<?php echo base_url(); ?>static/SBAdmin/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>static/js/libraries/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js"></script>
<script src="<?php echo base_url(); ?>static/js/client_login.js"></script>
</body>
</html>
