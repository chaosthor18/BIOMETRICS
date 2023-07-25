<?php
  session_start();
  include 'db_conn.php';
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
    $id=$_GET['id'];
    $stmt = $conn -> prepare("SELECT * from fingerprint WHERE fingerprint_id=?");
    $stmt->execute([$id]);
    if(isset($id) && $stmt->rowCount()==1){   
      $row = $stmt->fetch();
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
              <?php
                if(!empty($_GET['success'])){
                if($_GET['success']) {
              ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?=$_GET['success'];?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }}?>
              <?php
                if(!empty($_GET['error'])){
                if($_GET['error']) {
              ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <?=$_GET['error'];?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }}?>
                <div class="fs-1 fw-bold mt-4">
                    Fingerprint Register
                </div>
                <form action="/BIOMETRICS/fingerprint-actions/read.php" method="post" class="mt-5 was-validated">
                  <div class="mt-2 is-invalid">
                    <label for="fingerprint-username">ID Number (Example:"MITSI-1234")</label>
                    <input type="text" name="fingerprint-username" class="form-control form-control-md" placeholder="MITSI-XXXX" value="<?php echo $row['fingerprint_username'];?>" required>
                    <div class="invalid-feedback">
                      Please enter ID Number(Example:"MITSI-1234")
                    </div>
                  </div>
                  <div class="mt-2 is-invalid">
                    <label for="fingerprint-fingerid">Fingerprint ID</label>
                    <input type="hidden" name="fingerprint-id" class="form-control form-control-md" value="<?php echo $_GET['id'];?>">
                    <input type="text" name="fingerprint-fingerid" class="form-control form-control-md" value="<?php echo $row['fingerprint_fingerid'];?>" readonly required>
                  </div>
                  <div class="mt-5">
                    <div class="row justify-content-center">
                      <div class="col-auto">
                        <button type="submit" class="btn btn-success w-100 align-self-center">Capture Fingerprint</button>
                      </div>
                    </div>
                  </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/BIOMETRICS/bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/BIOMETRICS/js/sidebars.js"></script>
</body>
</html>
<?php
    }
    else{header("Location: fingerprint_page.php?error=invalid id");}
  }
  else{
    header("Location: logout.php");
  }
?>