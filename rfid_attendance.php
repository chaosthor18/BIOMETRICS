<?php
  session_start();
  include 'db_conn.php';
  $username = $_SESSION['user_username'];
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
    <script src="/BIOMETRICS/js/jquery-3.7.0.min.js"></script>
</head>
<body class="">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-success col-auto min-vh-100 d-flex flex-column justify-content-between">
                <?php include "./navbar.php"?>
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
                if(!empty($_GET['fail'])){
                if($_GET['fail']) {
              ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <?=$_GET['fail'];?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }}?>
              <div class="fs-1 fw-bold mt-4 row">
                <span class="col-auto">Today Attendance</span>
                <div class="col-auto">
                  <a href='rfid_add.php' class='btn btn-success btn-md rounded-3'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus-circle align-self-center" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                  </a>
                </div>
                <div class="col"  class='btn btn-success btn-md rounded-2'>
                  <a href="rfid_attendance.php" class="btn btn-success">
                    <svg class="svg-icon" style="width: 20; height: 20;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                      <path d="M992 931.2V193.6c0-19.2-22.4-22.4-22.4-22.4H790.4V40c-59.2-60.8-108.8-1.6-108.8-1.6v134.4h-320V35.2c-59.2-59.2-108.8 0-108.8 0v136H52.8C32 171.2 32 193.6 32 193.6v739.2c0 78.4 65.6 67.2 65.6 67.2H928c65.6 0 64-68.8 64-68.8zM803.2 577.6c-60.8 73.6-304 305.6-304 305.6s-49.6 38.4-88 0-174.4-169.6-174.4-169.6-12.8-92.8 84.8-72l110.4 112s19.2 24 44.8 0L729.6 512s102.4-25.6 73.6 65.6z m97.6-228.8H121.6v-64c0-19.2 24-24 24-24h728c25.6 0 27.2 24 27.2 24v64z"  />
                    </svg>
                  </a>
              </div>
              </div>
              <span class="fs-3 fw-bold mt-5"><p>Time In</p></span>
              <table class="table text-center mt-3">
                <thead>
                  <tr>
                    <td class="fw-bold">Full Name</td>
                    <td class="fw-bold">ID Number</td>
                    <td class="fw-bold">Time In</td>  
                    <td class="fw-bold">Status</td> 
                    <td class="fw-bold">Action</td>
                  </tr>
                </thead>
                <tbody id="showTimein">
                </tbody>
                </table>
                <span class="fs-3 fw-bold mt-5"><p>Time Out</p></span>
                <table class="table text-center">
                <thead>
                  <tr>
                    <td class="fw-bold">Full Name</td>
                    <td class="fw-bold">ID Number</td>
                    <td class="fw-bold">Time Out</td> 
                    <td class="fw-bold">Status</td> 
                    <td class="fw-bold">Action</td>
                  </tr>
                </thead>
                <tbody id="showTimeout">
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="/BIOMETRICS/bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/BIOMETRICS/js/sidebars.js"></script>
    <script>
      $(document).ready(function(){
      function showData()
      { 
        $.ajax({
          url: './rfid-actions/process.php',
          type: 'POST',
          data: {action : 'view_attendanceti'},
          dataType: 'html',
          success: function(result)
          {
            $('#showTimein').html(result);
          },
        })
        $.ajax({
          url: './rfid-actions/process.php',
          type: 'POST',
          data: {action : 'view_attendanceto'},
          dataType: 'html',
          success: function(result)
          {
            $('#showTimeout').html(result);
          },
        })
      }
      setInterval(function(){ showData(); }, 2500);
      });
    </script>
</body>
</html>
<?php
  }
  else{
    header("Location: logout.php");
  }
?>
