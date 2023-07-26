<?php
  session_start();
  $username = $_SESSION['user_username'];
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
    include 'db_conn.php';
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
                <?php include "navbar.php"?>
            </div>
            <div class="col dashboard">
              <div class="fs-1 fw-bold mt-4 row">
                <span class="col-auto">Fingerprint Database</span>
                <div class="col"  class='btn btn-success btn-md rounded-2'>
                  <a href="rfid_attendance.php" class="btn btn-success">
                    <svg class="svg-icon" style="width: 20; height: 20;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                      <path d="M992 931.2V193.6c0-19.2-22.4-22.4-22.4-22.4H790.4V40c-59.2-60.8-108.8-1.6-108.8-1.6v134.4h-320V35.2c-59.2-59.2-108.8 0-108.8 0v136H52.8C32 171.2 32 193.6 32 193.6v739.2c0 78.4 65.6 67.2 65.6 67.2H928c65.6 0 64-68.8 64-68.8zM803.2 577.6c-60.8 73.6-304 305.6-304 305.6s-49.6 38.4-88 0-174.4-169.6-174.4-169.6-12.8-92.8 84.8-72l110.4 112s19.2 24 44.8 0L729.6 512s102.4-25.6 73.6 65.6z m97.6-228.8H121.6v-64c0-19.2 24-24 24-24h728c25.6 0 27.2 24 27.2 24v64z"  />
                    </svg>
                  </a>
              </div>
              <div class="col my-auto">
                <input type="text" id="getName" class="form-control form-control-md justify-content-center" placeholder="Search">
              </div>
              </div>
              <table class="table text-center mt-3">
                <thead>
                  <tr>
                    <!-- <td class="fw-bold">First Name</td>
                    <td class="fw-bold">Last Name</td> -->
                    <td class="fw-bold">ID Number</td>  
                    <td class="fw-bold">Fingerprint ID</td>               
                    <td class="fw-bold">Action</td>  
                  </tr>
                </thead>
                <tbody id="showdata">
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
      $(document).ready(function(){
      $('#getName').on("keyup", function(){
        clearInterval(refresh_page);
        var getName = $(this).val();
        $.ajax({
          method:'POST',
          url:'./fingerprint-actions/searchajax.php',
          data:{name:getName},
          success:function(response)
          {
                $("#showdata").html(response);
          } 
        });
      });

      function showData()
      {
        $.ajax({
          url: './fingerprint-actions/process.php',
          type: 'POST',
          data: {action : 'view_fingerprintdb'},
          dataType: 'html',
          success: function(result)
          {
            $('#showdata').html(result);
          },
        })
      }
      refresh_page=setInterval(function(){ showData(); }, 2500);
      });
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