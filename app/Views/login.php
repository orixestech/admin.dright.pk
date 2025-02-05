<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-Right aPanel</title>
    <link rel="shortcut icon" href="<?= $template ?>assets/media/image/favicon.png" />
    <link rel="stylesheet" href="<?= $template ?>vendors/bundle.css" type="text/css">
    <link rel="stylesheet" href="<?= $template ?>assets/css/app.min.css" type="text/css">
    <script src="<?= $template ?>vendors/bundle.js"></script>
    <script type="text/javascript" charset="utf-8">
        localStorage.setItem('path', '<?= $path ?>');
        localStorage.setItem('template', '<?= $template ?>');
    </script>
    <script type="text/javascript" src="<?= $template ?>custom.js"></script>
</head>

<body class="form-membership"
    style="background: url(<?= $template ?>login-bg.png);background-repeat: no-repeat;background-position: top left;background-size: cover;">

    <div class="form-wrapper">

        <!-- logo -->
        <div id="logo">
            <!-- <img class="logo" src="<?= $template ?>logo.png" style="width: 100%;" alt="logo"> -->
            D-Right Admin Panel
        </div>
        <!-- ./ logo -->


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
            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
            <div class="text-center mt-3">
                <div class="ajaxResponse" id="ajaxResponse">

                </div>
        </form>
        <!-- ./ form -->
    </div>
    <script>
        document.getElementById('LoginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            LoginSubmit();
        });

        // Detect Enter key inside input fields and trigger form submission
        document.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent default form submission
                LoginSubmit(); // Call your submit function
            }
        });
        function LoginSubmit() {
            var Email = document.getElementById('inputEmail').value; // Use 'inputEmail' here
            var Password = document.getElementById('inputPassword').value; // Use 'inputPassword' here

            if (Email == '') {
                document.getElementById('inputEmail').focus();
            } else if (Password == '') {
                document.getElementById('inputPassword').focus();
            } else {

                var formdata = new window.FormData($("form#LoginForm")[0]);
                response = AjaxUploadResponse("login-form-submit", formdata);

                if (response.status === 'success') {
                    $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
                    setTimeout(function() {
                        // location.reload();
                         location.href = '<?= $path ?>';
                    }, 500);
                } else {
                    $("#ajaxResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.message + ' </div>');
                }

            }
        }
    </script>

    <!-- App scripts -->
    <script src="<?= $template ?>assets/js/app.min.js"></script>
</body>

</html>