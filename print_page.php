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
    <link rel="stylesheet" href="/BIOMETRICS/css/flatpicker.min.css">
    <script src="/BIOMETRICS/js/flatpicker.js"></script>
</head>
<body class="">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-success col-auto min-vh-100 d-flex flex-column justify-content-between">
                <?php include "navbar.php"?>
            </div>
            <div class="col dashboard">
            <?php if(isset($_GET['error'])) {?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?=$_GET['error'];?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php }?>
              <div class="fs-1 fw-bold mt-4 row">
                <span class="col-auto">Print</span>
                <div class="col"  class='btn btn-success btn-md rounded-2'></div>
              <div class="col my-auto">
                <input type="text" name="search" id="search" class="form-control form-control-md justify-content-center" placeholder="Search">
              </div>
              </div>
             <form action="/BIOMETRICS/print-actions/print" method="post">
                <div class="row">
                    <p class="fs-4 fw-bold">Select Date and ID Number</p>
                </div>
                <div class="row">
                    <div class="col">
                    <select class="form-control form-select" name="id">
                    <option selected>Select Employee</option>
                    <?php
                        $employee = "SELECT * FROM rfid WHERE NOT rfid_fname='UNREGISTERED' && NOT rfid_lname='UNREGISTERED'";
                        $employee_result =  $conn->query($employee);
                        while($row = $employee_result->fetch()){
                             $data="<option value='$row[rfid_username]'>$row[rfid_fname] $row[rfid_lname] ($row[rfid_username])</option>";
                             echo $data;	
                        }
                    ?>
                </select>
                    </div>
                    <div class="col">
                        <input type="datetime-local" name="fromDate" class="form-control form-control-md justify-content-center" placeholder="From" required>
                    </div>
                    <div class="col-auto align-items-start"><p class="fs-4 fw-bold">-</p></div>
                    <div class="col">
                        <input type="datetime-local" name="toDate" class="form-control form-control-md" placeholder="To" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class='btn btn-success btn-md'>Print</button>
                    </div>
                </div>
              
              <table class="table text-center">
                <thead>
                  <tr>
                    <td class="fw-bold">First Name</td>
                    <td class="fw-bold">Last Name</td>
                    <td class="fw-bold">ID Number</td>                 
                  </tr>
                </thead>
                <tbody id="showdata">
                </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
    <script>
    config = {
                enableTime: true,
                dateFormat: "Y-m-d",
            }
      $("input[type=datetime-local]").flatpickr();
      $(document).ready(function(){
        $('#search').on("keyup", function(){
        clearInterval(refresh_page);
        var getName = $(this).val();
        $.ajax({
          method:'POST',
          url:'./print-actions/searchajax.php',
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
          url: './print-actions/process.php',
          type: 'POST',
          data: {action : 'view_employee'},
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