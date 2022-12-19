<html>
<head>
	<title>Kruhay Animal Clinic - Client Registration</title>
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
	<link href="<?php echo base_url(); ?>static/css/sweetalert2.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>static/js/libraries/alpine/alpine.js" defer></script>
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
<div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1">
	<div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
		<div>
			<img src="<?php echo base_url(); ?>static/images/logo.png" class="w-32 mx-auto" style="border-radius: 50%;"/>
		</div>
		<div class="mt-5 flex flex-col items-center">
			<h1 class="text-2xl xl:text-3xl font-extrabold">
				Client Registration
			</h1>
			<div class="w-full flex-1 mt-8">
				<div class="mx-auto max-w-xs">
					<form id="frmRegisterClient" method="POST" action="<?php echo base_url(). 'client_registration/store'; ?>">
						<input name="email" type="email" placeholder="Email" required class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"/>
						<input name="first_name" type="text" placeholder="First name" required class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"/>
						<input name="last_name" type="text" placeholder="Last name" required class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"/>
						<input name="password" type="password" placeholder="Password" required class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"/>
						<input name="contact_number" type="text" placeholder="Contact Number" required class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"/>
						<br/><br/>Address:
						<textarea name="address" rows="4" style="resize: none;" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white">
						</textarea>
						<button type="submit" class="mt-5 tracking-wide font-semibold bg-green-500 text-gray-100 w-full py-4 rounded-lg hover:bg-green-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
							<svg
								class="w-6 h-6 -ml-2"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round">
								<path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
								<circle cx="8.5" cy="7" r="4"/>
								<path d="M20 8v6M23 11h-6"/>
							</svg>
							<span class="ml-3">Sign Up</span>
						</button>
					</form>

					<a href="<?php echo base_url(); ?>">
						<button class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                			<span class="ml-3">Back to Home</span>
						</button>
					</a>

					<p class="mt-6 text-xs text-gray-600 text-center">
						I agree to abide by Kruhay's
						<a href="#" class="border-b border-gray-500 border-dotted">Terms of Service</a>
						and its
						<a href="#" class="border-b border-gray-500 border-dotted">Privacy Policy</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
		<div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat" style="background-image: url('static/images/running_pets_bg.jpg');"></div>
	</div>
</div>
<script src="<?php echo base_url(); ?>static/SBAdmin/vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?php echo base_url(); ?>static/js/client_registration.js"></script>
</body>
</html>
