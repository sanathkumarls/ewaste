<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 4:37 PM
 */

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ewaste - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="../../assets/sb-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../../assets/sb-admin/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="post" action="../controllers/LoginController.php">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus" autocomplete="true">
                        <label for="inputEmail">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required" autocomplete="true">
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me">
                            Remember Password
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" name="submit" type="submit">Login</button>
            </form>
            <!--            <div class="text-center">-->
            <!--                <a class="d-block small mt-3" href="register.html">Register an Account</a>-->
            <!--                <a class="d-block small" href="forgot-password.html">Forgot Password?</a>-->
            <!--            </div>-->
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../../assets/sb-admin/vendor/jquery/jquery.min.js"></script>
<script src="../../assets/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../assets/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>

