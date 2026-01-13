<?php
include '../db.php';
session_start();

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);

    $q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($q) > 0) {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login | CarsDekho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #ddd6d7ff, #343a40);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        }

        .login-box h3 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #000000ff;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .btn-login {
            background: #000;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-login:hover {
            background: #000;
        }

        
    </style>
</head>

<body>

<div class="login-box">
    <h3>CarsDekho Admin</h3>

    
    <form method="post" id="loginForm">
        <div class="mb-3">
            <input type="text" name="user" class="form-control" placeholder="Username">
        </div>

        <div class="mb-3">
            <input type="password" name="pass" class="form-control" placeholder="Password">
        </div>

        <button name="login" class="btn btn-login w-100 text-white">
            Login
        </button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    $('#loginForm').on('submit', function (e) {

        let isValid = true;

        $('.error').remove();
        $('.form-control').removeClass('border-danger');

        if ($('input[name="user"]').val().trim() === '') {
            $('input[name="user"]')
                .addClass('border-danger')
                .after('<small class="error text-danger">Username is required</small>');
            isValid = false;
        }

        if ($('input[name="pass"]').val().trim() === '') {
            $('input[name="pass"]')
                .addClass('border-danger')
                .after('<small class="error text-danger">Password is required</small>');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    $('.form-control').on('keyup', function () {
        $(this).removeClass('border-danger');
        $(this).next('.error').remove();
    });

});
</script>

</body>
</html>
