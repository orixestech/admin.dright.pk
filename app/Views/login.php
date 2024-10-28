<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-Right aPanel</title>
    <link rel="shortcut icon" href="<?= $template ?>assets/media/image/favicon.png"/>
    <link rel="stylesheet" href="<?= $template ?>vendors/bundle.css" type="text/css">
    <link rel="stylesheet" href="<?= $template ?>assets/css/app.min.css" type="text/css">
    <script type="text/javascript" charset="utf-8">
        localStorage.setItem('path', '<?= $path ?>');
        localStorage.setItem('template', '<?= $template ?>');
    </script>
    <script type="text/javascript" src="<?= $template ?>custom.js"></script>
    <script src="<?= $template ?>vendors/bundle.js"></script>
</head>
<body class="form-membership"
      style="background: url(<?= $template ?>login-bg.png);background-repeat: no-repeat;background-position: top left;background-size: cover;">

<div class="form-wrapper">

    <!-- logo -->
    <div id="logo">
        <img class="logo" src="<?= $template ?>logo.png" style="width: 100%;" alt="logo">
    </div>
    <!-- ./ logo -->
<?php
$main = new \App\Models\Main();
//$main= $main->CRYPT('bNqNQMKwbrvSwPWq8wp6rtHcoA11xAbQxO0F3v9xBak=','show');




?>


?>

    <h4>Master Control Panel </h4>

    <!-- form -->
    <form class="validate" method="post" action="#" id="LoginForm" name="LoginForm">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username or email" id="inputEmail" name="inputEmail" required autofocus>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="inputPassword" name="Password" placeholder="Password" required>
        </div>
<!--        <div class="form-group d-flex justify-content-between align-items-center">-->
<!--            <div class="custom-control custom-checkbox">-->
<!--                <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">-->
<!--                <label class="custom-control-label" for="customCheck1">Remember me</label>-->
<!--            </div>-->
<!--            <a class="small" href="">Reset password</a>-->
<!--        </div>-->
        <button class="btn btn-primary btn-block">Sign in</button>
        <div class="text-center mt-3">
            <div class="LoginResponse" id="LoginResponse">

            </div>
    </form>
    <!-- ./ form -->
</div>
<script>
    document.getElementById('LoginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        LoginSubmit();
    });

    function LoginSubmit() {
        var Email = document.getElementById('inputEmail').value; // Use 'inputEmail' here
        var Password = document.getElementById('inputPassword').value; // Use 'inputPassword' here

        if (Email == '') {
            document.getElementById('inputEmail').focus();
        } else if (Password == '') {
            document.getElementById('inputPassword').focus();
        } else {
            var phpdata = new URLSearchParams(new FormData(document.getElementById('LoginForm'))).toString();
            var response = AjaxResponse("login-form-submit", phpdata);
            if (response.status == 'success') {
                document.getElementById('LoginResponse').innerHTML = '<div class="alert text-black bg-success" role="alert"> <div class="alert-text">Success ! ' + response.message + '</div> </div>';
                <?= (($page == 'login') ? 'location.href = "' . base_url() . '";' : 'location.reload();') ?>;
            } else {
                document.getElementById('LoginResponse').innerHTML = '<div class="alert text-black bg-danger" role="alert"> <div class="alert-text">Fail ! ' + response.message + '</div> </div>';
            }
        }
    }
</script>

<!-- App scripts -->
<script src="<?= $template ?>assets/js/app.min.js"></script>
</body>
</html>
