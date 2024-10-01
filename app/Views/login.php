<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baston - Responsive Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= $template ?>assets/media/image/favicon.png"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="<?= $template ?>vendors/bundle.css" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="<?= $template ?>assets/css/app.min.css" type="text/css">

    <!-- Plugin scripts -->
    <script src="<?= $template ?>vendors/bundle.js"></script>
</head>
<body class="form-membership"
      style="background: url(http://localhost/admin.dright.net/template/login-bg.png);background-repeat: no-repeat;background-position: top left;background-size: cover;">

<div class="form-wrapper">

    <!-- logo -->
    <div id="logo">
        <img class="logo" src="<?= $template ?>logo.png" style="width: 100%;" alt="logo">
    </div>
    <!-- ./ logo -->


    <h4>Master Control Panel</h4>

    <!-- form -->
    <form>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username or email" required autofocus>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group d-flex justify-content-between align-items-center">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember me</label>
            </div>
            <a class="small" href="recovery-password.html">Reset password</a>
        </div>
        <button class="btn btn-primary btn-block">Sign in</button>
    </form>
    <!-- ./ form -->
</div>
<!-- App scripts -->
<script src="<?= $template ?>assets/js/app.min.js"></script>
</body>
</html>
