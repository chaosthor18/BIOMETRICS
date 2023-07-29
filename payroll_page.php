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
    <style>
        option{
            background-color: #198754;
        }
    </style>
</head>
<body class="">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-success col-auto min-vh-100 d-flex flex-column justify-content-between">
                <?php include "navbar.php"?>
            </div>
            <div class="col dashboard">
            <form action="/BIOMETRICS/print-actions/payroll-print.php" method="post">
                <?php if(isset($_GET['error'])) {?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?=$_GET['error'];?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                    <?php }?>
                <div class="fs-1 fw-bold mt-4 row">
                    <span class="col-auto">Payroll Calculator</span>
                    <div class="col"  class='btn btn-success btn-md rounded-2'></div>
                </div>
                <div class="mt-4">
                <label for = "form-select">Select Employee</label>
                <select class="form-control form-select" name="employee-option">
                    <option selected style="color: white;">Select Employee</option>
                    <?php
                        $employee = "SELECT * FROM rfid WHERE NOT rfid_fname='UNREGISTERED' && NOT rfid_lname='UNREGISTERED'";
                        $employee_result =  $conn->query($employee);
                        while($row = $employee_result->fetch()){
                             $data="<option value='$row[rfid_carddata]'style='color: white;'>$row[rfid_fname] $row[rfid_lname] ($row[rfid_username])</option>";
                             echo $data;	
                        }
                    ?>
                </select>
                </div>
                <div class="mt-3">
                    <label for="basic-salaryrate">Basic Pay</label>
                    <input type="text" name="basic-salaryrate" class="form-control form-control-md" placeholder="520" required>
                </div>
                <div class="mt-3">
                    <label for="fromDate">From</label>
                    <input type="datetime-local" name="fromDate" class="form-control form-control-md justify-content-center" placeholder="Start Date" required>
                </div>
                <div class="mt-3">
                    <label for="toDate">To</label>
                    <input type="datetime-local" name="toDate" class="form-control form-control-md justify-content-center" placeholder="End Date" required>
                </div>
                <div class="mt-4">
                    <div class="mt-2 form-check">
                        <input type="checkbox" class="form-check-input" name="chkbox_sss" id="checkbox1" style="background-color: #198754;" value="sss_checked">
                        <label class="form-check-label" for="checkbox1">SSS CONTRIBUTION</label>
                    </div>
                    <div class="mt-2 form-check">
                        <input type="checkbox" class="form-check-input" name="chkbox_phlhealth" id="checkbox2" style="background-color: #198754;" value="philhealth_checked">
                        <label class="form-check-label" for="checkbox1">PHIL-HEALTH CONTRIBUTION</label>
                    </div>
                    <div class="mt-2 form-check">
                        <input type="checkbox" class="form-check-input" name="chkbox_pagibig" id="checkbox3" style="background-color: #198754;" value="pagibig_checked">
                        <label class="form-check-label" for="checkbox1">PAG-IBIG CONTRIBUTION</label>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-success w-25 align-self-center">Print and Compute</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        config = {
                enableTime: true,
                dateFormat: "Y-m-d",
            }
        $("input[type=datetime-local]").flatpickr();
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