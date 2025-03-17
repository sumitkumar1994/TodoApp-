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
  <title>Login - Todo App</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <link rel="stylesheet" href="./assets/css/login.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <!-- Google Fonts -->
  <link href="./assets/css/swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="./assets/css/all.min.css" rel="stylesheet">
  <style>

  </style>
</head>

<body>

  <div class="login-card">
    <h2 class="text-center "><a href="index.php" class="text-decoration-none"> To-Do</a> </h2>
    <form action="./congfig/server.php" method="post" id="login_form">
      <input type="hidden" name="login" value="1" class="d-none">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
        <span class="email_error text-danger d-none"></span>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password"
            required>
          <button class="btn btn-outline-success" type="button" id="togglePassword">
            <i class="fa fa-eye" id="togglePasswordIcon"></i>
          </button>
        </div>
        <span class="password_error text-danger d-none"></span>
      </div>


      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <input type="checkbox" id="remember" class="form-check-input">
          <label for="remember" class="form-check-label">Remember Me</label>
        </div>
        <a href="#" class="text-muted">Forgot Password?</a>
      </div>
      <button type="submit" class="btn  btn-success w-100" id="login_btn" name="login">Login</button>
    </form>
    <p class="text-center text-muted mt-3">Don't have an account? <a href="signup.php">Sign Up</a></p>
  </div>

  <!-- Bootstrap JS -->
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/css/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script></script>
  <script>
    $(document).on('click', '#login_btn', function (e) {
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
      e.preventDefault();
      let email = $('#email').val();
      let password = $('#password').val();
      let error = 0;

      if (email == "") {
        $('.email_error').text('Email is required');
        $('.email_error').removeClass('d-none');
        $('#email').addClass('border-danger');
        error++;
      }
      if (password == "") {
        $('.password_error').text('pls enter your pasword');
        $('.password_error').removeClass('d-none');
        $('#password').addClass('border-danger');
        error++;
      }
      if (error === 0) {
        let form = $("#login_form");
        let url = form.attr('action');
        $.ajax({
          url: url, // Change to your backend endpoint
          type: 'POST',
          data: form.serialize(),

          success: function (returnData) {
            let arr = JSON.parse(returnData)
            if (arr.success == true) {
              toastr.success(arr.msg);
              setTimeout(() => {
                location.href = 'index2.php', 'index.php';
              }, 1500)
            }
            else {
              if (arr.emailError) {
                $('.email_error').text(arr.emailError).removeClass('d-none');
                $('#email').addClass('border-danger');
              } else {
                $('.email_error').text('').addClass('d-none');
                $('#email').removeClass('border-danger');
              }
              if (arr.passwordError) {
                $('.password_error').text(arr.passwordError).removeClass('d-none');
                $('#password').addClass('border-danger');
              } else {
                $('.password_error').text('').removeClass('d-none');
                $('#password').addClass('border-danger');
              }
            }

          }
        });
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
    $(document).on('click', '#togglePassword', function () {
      let passwordField = $('#password');
      let icon = $('#togglePasswordIcon');

      // Toggle input type between password and text
      let type = passwordField.attr('type') === 'password' ? 'text' : 'password';
      passwordField.attr('type', type);

      // Toggle the eye icon between show and hide
      icon.toggleClass('fa-eye fa-eye-slash');
    });




  </script>



</body>

</html>