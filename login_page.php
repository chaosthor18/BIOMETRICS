<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biometrics</title>
    <link href="/BIOMETRICS/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media screen and (max-width: 679px) {
            .container {
                width: 500px;
                height: 500px;
            }
            .name-web{
                text-align: center;
            }
        }
    </style>
</head>
<body class="bg-success">
    <div class="container d-flex min-vh-100">
        <form class="justify-content-center align-self-center" action="auth.php" method="post">
            <div class="login-container p-4 row bg-white rounded-5">
                <div class="name-web text-center">
                    <img src="/BIOMETRICS/icons/mitsi-icon.png" class="img-fluid" height="400px" width="400px" alt="Responsive image">
                </div>
                <?php error_reporting(0); 
                if($_GET['error']) {?>
                <div class="alert alert-danger" role="danger">
                    <?= $_GET['error'];?>
                </div>
                <?php }?>
                <div class="username-container" style="padding: 10px 50px 50px 50px">
                    <input type="text" name="username_login" class="form-control form-control-lg" placeholder="Username">
                </div>
                <div class="password-container" style="padding: 10px 50px 50px 50px">
                    <input type="password" name="password_login" class="form-control form-control-lg" placeholder="Password">
                </div>
                <div class="button-send text-center">
                    <button class="btn btn-success text-white">LOGIN</button>
                </div>
            </div>
        </form>
    </div>
    <script src="/BIOMETRICS/js/bootstrap.bundle.min.js"></script>
</body>
</html>