<?php
  session_start();
  include 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Today</title>
    <link href="/BIOMETRICS/css/bootstrap.min.css" rel="stylesheet">
    <link href="/BIOMETRICS/css/sidebars.css" rel="stylesheet">
    <script src="/BIOMETRICS/js/jquery-3.7.0.min.js"></script>
</head>
<body class="">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col">
              <div class="fs-1 fw-bold mt-4 row">
                <span class="col-auto">Today Attendance</span>
                <div class='col-auto'>
                  <a href="login_page" class="btn btn-success rounded-2">
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="width: 20; height: 20;vertical-align: middle;fill: currentColor;overflow: hidden;" width="20px" height="10%" x="0px" y="0px" viewBox="0 0 440.5 291.1" style="enable-background:new 0 0 440.5 291.1;" xml:space="preserve" fill="white">
                    <path d="M418.1,120.4H87.8l82-82.1c8.8-8.8,8.8-23,0-31.7c-8.8-8.8-22.9-8.8-31.7,0L0,144.8l139.5,139.7c4.4,4.4,10.1,6.6,15.9,6.6 s11.5-2.2,15.9-6.5c8.8-8.8,8.8-22.9,0-31.7l-87.4-87.6h334.3c12.4,0,22.4-10,22.4-22.4S430.5,120.4,418.1,120.4z"/>
                   </svg>
                  </a>
              </div>
              </div>
              <span class="fs-3 fw-bold mt-5"><p>Time In</p></span>
              <table class="table text-center mt-3">
                <thead>
                  <tr>
                    <td class="fw-bold">Full Name</td>
                    <td class="fw-bold">RFID Number</td>
                    <td class="fw-bold">Time In</td>  
                    <td class="fw-bold">Status</td> 
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
                    <td class="fw-bold">RFID Number</td>
                    <td class="fw-bold">Time Out</td> 
                    <td class="fw-bold">Status</td> 
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
          url: './view-attendance/process.php',
          type: 'POST',
          data: {action : 'view_timein'},
          dataType: 'html',
          success: function(result)
          {
            $('#showTimein').html(result);
          },
        })
        $.ajax({
          url: './view-attendance/process.php',
          type: 'POST',
          data: {action : 'view_timeout'},
          dataType: 'html',
          success: function(result)
          {
            $('#showTimeout').html(result);
          },
        })
      }
      setInterval(function(){ showData(); }, 500);
      });
    </script>
</body>
</html>
