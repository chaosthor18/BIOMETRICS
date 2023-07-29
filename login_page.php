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
    <div class="container-fluid min-vh-100">
        <form class="d-flex justify-content-center align-self-center min-vh-100 mt-5 mb-5" action="auth.php" method="post">
            <div class="login-container p-5 bg-white rounded-5 align-self-center shadow-lg">
                <div class="name-web text-center">
                    <img src="/BIOMETRICS/icons/mitsi-icon.png" class="img-fluid" height="150em" width="150em" alt="Responsive image">
                </div>
                <div class="text-center">
                    <span class="fs-3 fw-bold">RFID and Biometrics Attendance<span>
                </div>
                <?php error_reporting(0); 
                if($_GET['error']) {?>
                <div class="alert alert-danger" role="danger">
                    <?= $_GET['error'];?>
                </div>
                <?php }?>
                <?php error_reporting(0); 
                if($_GET['edit_success']) {?>
                <div class="alert alert-success" role="danger">
                    <?= $_GET['error'];?>
                </div>
                <?php }?>
                <div class="username-container" style="padding: 10px 30px 30px 30px">
                    <input type="text" name="username_login" class="form-control form-control-lg" placeholder="Username">
                </div>
                <div class="password-container" style="padding: 10px 30px 30px 30px">
                    <input type="password" name="password_login" class="form-control form-control-lg" placeholder="Password">
                </div>
                <div class="button-send text-center">
                    <button class="btn btn-success text-white">LOGIN</button>
                </div>
                <div class="button-viewattendance text-center mt-2">
                    <a class="btn btn-success text-white" href="view_todayattendance">ATTENDANCE</a>
                </div>
            </div>
        </form>
    </div>
    <script src="/BIOMETRICS/js/bootstrap.bundle.min.js"></script>
</body>
</html>