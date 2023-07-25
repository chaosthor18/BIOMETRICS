<?php
  session_start();
  include 'db_conn.php';
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
    $id=$_GET['id'];
    $stmt = $conn -> prepare("SELECT * from rfid WHERE rfid_username=?");
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
                    RFID Edit
                </div>
                <form action="./rfid-actions/edit.php" method="post" class="mt-5 was-validated">
                  <div class="mt-2 is-invalid">
                  <input type="hidden" name="rfid-id" value="<?php echo $row['rfid_id']?>">
                    <label for="rfid-fname">First Name</label>
                    <input type="text" name="rfid-fname" class="form-control form-control-md" placeholder="Juan" value="<?php echo $row['rfid_fname']?>" required>
                    <div class="invalid-feedback">
                      Please enter First Name
                    </div>
                  </div>
                  <div class="mt-2 is-invalid">
                    <label for="rfid-lname">Last Name</label>
                    <input type="text" name="rfid-lname" class="form-control form-control-md" value="<?php echo $row['rfid_lname']?>" placeholder="Dela Cruz" required>
                    <div class="invalid-feedback">
                      Please enter Last Name
                    </div>
                  </div>
                  <div class="mt-2 is-invalid">
                    <label for="rfid-username">ID Number (Example:"MITSI-1234")</label>
                    <input type="text" name="rfid-username" class="form-control form-control-md" value="<?php echo $row['rfid_username']?>" placeholder="MITSI-XXXX" required>
                    <div class="invalid-feedback">
                      Please enter ID Number(Example:"MITSI-1234")
                    </div>
                  </div>
                  <div class="mt-2 is-invalid">
                    <label for="rfid-carddata">RFID Card Number</label>
                    <input type="text" name="rfid-carddata" class="form-control form-control-md" value="<?php echo $row['rfid_carddata']?>" placeholder="juandelacruz888" readonly>
                    <div class="invalid-feedback">
                      Please enter Card Number
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-success w-25 align-self-center">Submit</button>
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
  else{
    header("Location: ./rfid_page.php");
  }
  }
  else{
    header("Location: logout.php");
  }
?>