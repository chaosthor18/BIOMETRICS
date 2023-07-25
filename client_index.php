<?php
  session_start();
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'user789123'){
    include 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['user_name']?>!</title>
    <link href="/BIOMETRICS/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-success">
    <div class="container-fluid d-flex min-vh-100 justify-content-center align-items-center">
        <div class="bg-white rounded-4" style="height:70%; width: 70%;">
            <div class="name-web text-center">
                <img src="/BIOMETRICS/icons/mitsi-icon.png" class="img-fluid" height="400px" width="400px" alt="Responsive image">
             </div>
             <div class="row p-5">
                <div class="col button-send text-center">
                    <div class="">
                        <a href="./rfid-actions/time_in.php" class="btn btn-success text-white mt-2">TIME IN</a>
                    </div>
                </div>
                <div class="col button-send text-center">
                    <div class="">
                        <a href="./rfid-actions/time_out.php" class="btn btn-success text-white mt-2">TIME OUT</a>
                    </div>
                </div>
             </div>
             <div class="row d-flex justify-content-center pb-5">
                <a href="./logout.php" class="btn btn-danger text-white" style="width: 10em;">Logout</a>
            </div>
        </div>
    </div>
    <script src="/BIOMETRICS/bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
  }
else{
    header("Location: logout.php");
  }
?>