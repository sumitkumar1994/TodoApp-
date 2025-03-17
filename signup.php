<?php
session_start();
if (isset($_SESSION['loginId'])) {
	header('Location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up - Todo App</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="./assets/css/signup.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<style>

	</style>
</head>

<body>
	<div class="signup-card mt-4 mb-4">
		<h2 class="text-center"><a href="index.php" class=" text-decoration-none text-black">To Do</a></h2>
		<form action="./congfig/server.php" method="POST" id="Sing_form">
			<input type="text" name="submit" value="signup" class="d-none">
			<div class="mb-1">
				<label for="fullname" class="form-label">Full Name</label>
				<input type="text" class="form-control " id="fullname" placeholder="Enter your full name" name="name"
					value="<?php echo $_POST['name'] ?? ''; ?>">

				<span class="fullname_error text-danger d-none"></span>
			</div>
			<div class="mb-1">
				<label for="email" class="form-label">Email</label>
				<input type="email" class="form-control" id="email" placeholder="Enter your email" name="email"
					value="<?php echo $_POST['email'] ?? ''; ?>">
				<span class="email_error text-danger d-none"></span>

			</div>
			<div class="mb-1">
				<label for="phoneno" class="form-label">PhoneNo</label>
				<input type="number" class="form-control" id="phoneno" placeholder="Enter phone no" name="mobileno"
					value="<?php echo $_POST['mobileno'] ?? ''; ?>">
				<span class="mobileno_error text-danger d-none"></span>
			</div>
			<!-- <div class="mb-1">
			<label for="password" class="form-label">Password</label>
			<input type="password" class="form-control" id="password" placeholder="Create a password"
				name="password">
			<span class="password_error text-danger d-none"></span>
		</div> -->
			<!-- <div class="mb-1">
			<label for="confirmpassword" class="form-label">Confirm Password</label>
			<input type="password" class="form-control" id="confirmpassword" placeholder="Re-enter your password"
				name="confpassword">
			<span class="confpassword_error text-danger d-none"></span>
		</div> -->
			<div class="mb-1">
				<label for="password" class="form-label">Password</label>
				<div class="input-group">
					<input type="password" class="form-control" id="password" placeholder="Enter your password"
						name="password" value="<?php echo $_POST['password'] ?? ''; ?>">
					<button class="btn btn btn-outline-success" type="button" id="togglePassword">
						<i class="fa fa-eye" id="togglePasswordIcon"></i>
					</button>
				</div>
				<span class="password_error text-danger d-none"></span>
			</div>
			<div class="mb-1">
				<label for="confirmpassword" class="form-label">Confirm Password</label>
				<div class="input-group">
					<input type="password" class="form-control" id="confirmpassword"
						placeholder="Re-enter your password" name="confpassword"
						value="<?php echo $_POST['confpassword'] ?? ''; ?>">
					<button class="btn btn btn-outline-success" type="button" id="toggleConfirmPassword">
						<i class="fa fa-eye" id="toggleConfirmPasswordIcon"></i>
					</button>
				</div>
				<span class="confpassword_error text-danger d-none"></span>
			</div>
			<button type="submit" class="btn btn-success w-100 mt-3" name="submit" id="signup_btn">Sign Up</button>
		</form>
		<span id="data" m-0></span>
		<p class="text-center text-muted mt-3  ">Already have an account? <a href="login.php"
				class="text-black ">Login</a></p>
	</div>
	<!-- Bootstrap JS -->
	<!-- <script src=".assets/js/signup.js"></script> -->
	<script src="./assets/js/popper.min.js"></script>
	<script src="./assets/js/bootstrap.bundle.min.js"></script>
	<script src="./assets/css/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<script type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	<script>


		$(document).on("click", "#signup_btn", function (e) {
			toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-right',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
			e.preventDefault(); // Prevent form submission
			let fullname = $('#fullname').val().trim();
			let email = $('#email').val().trim();
			let phoneno = $('#phoneno').val().trim();
			let password = $('#password').val().trim();
			let confirmpassword = $('#confirmpassword').val().trim();

			let error = 0;

			if (fullname === '') {
				$('.fullname_error').text('Full name is required').removeClass('d-none');
				$('#fullname').addClass('border-danger');
				error++;
			} else {
				$('.fullname_error').text('').addClass('d-none');
				$('#fullname').removeClass('border-danger');
			}
			if (email === '') {
				$('.email_error').text('Email is required').removeClass('d-none');
				$('#email').addClass('border-danger');
				error++;
			} else {
				$('.email_error').text('').addClass('d-none');
				$('#email').removeClass('border-danger');
			}
			if (phoneno === '') {
				$('.mobileno_error').text('Phone number is required').removeClass('d-none');
				$('#phoneno').addClass('border-danger');
				error++;
			} else {
				$('.mobileno_error').text('').addClass('d-none');
				$('#phoneno').removeClass('border-danger');
			}
			if (password === '') {
				$('.password_error').text('Password is required').removeClass('d-none');
				$('#password').addClass('border-danger');
				error++;
			} else {
				$('.password_error').text('').addClass('d-none');
				$('#password').removeClass('border-danger');
			}
			if (confirmpassword === '') {
				$('.confpassword_error').text('Confirm password is required').removeClass('d-none');
				$('#confirmpassword').addClass('border-danger');
				error++;
			} else if (confirmpassword !== password) {
				$('.confpassword_error').text('password do not match').removeClass('d-none');
				$('#confirmpassword').addClass('border-danger');
				error++;
			} else {
				$('.confpassword_error').text('').addClass('d-none');
				$('#confirmpassword').removeClass('border-danger');
			}
			// console.log('Error count:', error);
			// If no errors, proceed
			if (error === 0) {
				let form = $("#Sing_form"); // Corrected form ID, ensure this matches your HTML
				let url = form.attr('action');
				// Ensure action attribute is set in your form
				// // Submit the form via AJAX
				$.ajax({
					url: url, // Change to your backend endpoint
					type: 'POST',
					data: form.serialize(),

					success: function (returndata) {
						let arr = JSON.parse(returndata)

						if (arr.success == true) {
							toastr.success(arr.msg);
							setTimeout(() => {
								location.href = 'index2.php', 'index2.php';
							}, 1500)
						}
						else {
							if (arr.emailError) {
								$('.email_error').text(arr.emailError).removeClass('d-none');
								$('#email').addClass('border-danger');
							} else {
								$('.email_error').text('').removeClass('d-none');
								$('#email').addClass('border-danger');
							}

							if (arr.passwordMismatchError) {
								$('.confpassword_error').text(arr.passwordMismatchError).removeClass('d-none');
								$('#confirmpassword').addClass('border-danger');

							} else {
								$('.confpassword_error').text('').removeClass('d-none');
								$('#confirmpassword').addClass('border-danger');
							} if (arr.mobilenoError) {
								$('.mobileno_error').text(arr.mobilenoError).removeClass('d-none');
								$('#phoneno').addClass('border-danger');
							} else {
								$('.mobileno_error').text('').removeClass('d-none');
								$('#phoneno').addClass('border-danger');
							}
							if (arr.msg) {
								toastr.error(arr.msg);
							}

							// $("#data").html(response); // Update the target element with the response
							//
							//  form[].reset(); // Reset the form fields
						}

					},
					error: function (returndata) {
						console.error('An error occurred:');
					}
				});

			}
		});
		$(document).on('keyup', '#fullname', function (e) {
			let fullname = $(this).val().trim();

			// Check if input contains only letters and spaces
			if (!/^[a-zA-Z\s]*$/.test(fullname)) {
				$('.fullname_error').text('Only letters are allowed in the full name');
				$('.fullname_error').removeClass('d-none');
				$('#fullname').addClass('border-danger');
			} else if (fullname === '') {
				$('.fullname_error').text('Full name is required ');
				$('.fullname_error').removeClass('d-none');
				$('#fullname').addClass('border-danger');
			} else if (fullname.length < 3) {
				$('.fullname_error').text('Full name must be at least 3 characters');
				$('.fullname_error').removeClass('d-none');
				$('#fullname').addClass('border-danger');
			} else {
				$('.fullname_error').text('');
				$('.fullname_error').addClass('d-none');
				$('#fullname').removeClass('border-danger');
			}
		});
		$(document).on('keyup', '#email', function (e) {
			let email = $(this).val().trim();

			// Email validation regex
			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

			if (email === '') {
				$('.email_error').text('Email is required');
				$('.email_error').removeClass('d-none');
				$('#email').addClass('border-danger');
			} else if (!emailRegex.test(email)) {
				$('.email_error').text('Please enter a valid email address');
				$('.email_error').removeClass('d-none');
				$('#email').addClass('border-danger');
			} else {
				$('.email_error').text('');
				$('.email_error').addClass('d-none');
				$('#email').removeClass('border-danger');
			}
		});
		$(document).on('keyup', '#phoneno', function (e) {
			let phoneno = $(this).val().trim();

			// Mobile number validation regex
			const phoneRegex = /^[6-9]\d{9}$/;

			if (phoneno === '') {
				$('.mobileno_error').text('Phone number is required');
				$('.mobileno_error').removeClass('d-none');
				$('#phoneno').addClass('border-danger');
			} else if (!phoneRegex.test(phoneno)) {
				$('.mobileno_error').text('Please enter a valid 10-digit mobile number starting with 6-9');
				$('.mobileno_error').removeClass('d-none');
				$('#phoneno').addClass('border-danger');
			} else {
				$('.mobileno_error').text('');
				$('.mobileno_error').addClass('d-none');
				$('#phoneno').removeClass('border-danger');
			}
		});
		$(document).on('keyup', '#password', function (e) {
			let password = $(this).val().trim();

			// Password validation regex
			const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;

			if (password === '') {
				$('.password_error').text('Password is required');
				$('.password_error').removeClass('d-none');
				$('#password').addClass('border-danger');
			} else if (!passwordRegex.test(password)) {
				$('.password_error').text('Password must be at least 6 characters long and include at least one letter, one number, and one special character');
				$('.password_error').removeClass('d-none');
				$('#password').addClass('border-danger');
			} else {
				$('.password_error').text('');
				$('.password_error').addClass('d-none');
				$('#password').removeClass('border-danger');
			}
		});
		$(document).on('keyup', '#confirmpassword', function (e) {
			let password = $('#password').val().trim();
			let confirmpassword = $(this).val().trim();

			if (confirmpassword === '') {
				$('.confpassword_error').text('Confirmation password is required');
				$('.confpassword_error').removeClass('d-none');
				$('#confirmpassword').addClass('border-danger');
			} else if (confirmpassword !== password) {
				$('.confpassword_error').text('Passwords do not match');
				$('.confpassword_error').removeClass('d-none');
				$('#confirmpassword').addClass('border-danger');
			} else {
				$('.confpassword_error').text('');
				$('.confpassword_error').addClass('d-none');
				$('#confirmpassword').removeClass('border-danger');
			}
		});

		$(document).on('click', '#togglePassword', function () {
			let passwordField = $('#password');
			let icon = $('#togglePasswordIcon');

			// Toggle input type
			let type = passwordField.attr('type') === 'password' ? 'text' : 'password';
			passwordField.attr('type', type);

			// Toggle icon
			icon.toggleClass('fa-eye fa-eye-slash');
		});

		$(document).on('click', '#toggleConfirmPassword', function () {
			let confirmPasswordField = $('#confirmpassword');
			let icon = $('#toggleConfirmPasswordIcon');

			// Toggle input type
			let type = confirmPasswordField.attr('type') === 'password' ? 'text' : 'password';
			confirmPasswordField.attr('type', type);

			// Toggle icon
			icon.toggleClass('fa-eye fa-eye-slash');
		});

	</script>
	</script>
</body>

</html>