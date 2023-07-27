<?php
  session_start();
  include 'db_conn.php';
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['user_name']?>!</title>
    <link href="/BIOMETRICS/css/bootstrap.min.css" rel="stylesheet">
    <link href="/BIOMETRICS/css/sidebars.css" rel="stylesheet">
</head>
<body class="">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-success col-auto min-vh-100 d-flex flex-column justify-content-between">
                <?php include "navbar.php"?>
            </div>
            <div class="col dashboard">
                <div class="fs-1 fw-bold mt-4">
                    Change Password
                </div>
                    <form action="/BIOMETRICS/admin-manage/change.php" method="post" class="mt-5 was-validated">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control form-control-md" placeholder="Juan_123" required>
                        <label for="password" class="mt-2">Password</label>
                        <input type="password" id="password" name="password" class="form-control form-control-md" placeholder="Passw0rd123" required>
                        <div class="mt-2 form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox1" onclick="showPassword()">
                            <label class="form-check-label" for="checkbox1">Show Password</label>
                        </div>
                        <div class="d-flex justify-content-center mt-5">
                            <button type="submit" class="btn btn-success w-25 align-self-center">Submit</button>
                        </div>
                  </form>
            </div>
        </div>
    </div>
    <script>
        function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
    <script src="/BIOMETRICS/bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/BIOMETRICS/js/sidebars.js"></script>
</body>
</html>
<?php
  }
  else{
    header("Location: logout.php");
  }
?>