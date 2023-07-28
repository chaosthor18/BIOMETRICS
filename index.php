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
    <link href="/BIOMETRICS/css/sidebars.css" rel="stylesheet">
    <link href="/BIOMETRICS/css/bootstrap.min.css" rel="stylesheet">
    <script src="/BIOMETRICS/js/jquery-3.7.0.min.js"></script>
</head>
<body class="">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-success col-auto min-vh-100 d-flex flex-column justify-content-between">
                <?php include "navbar.php"?>
            </div>
            <div class="col dashboard">
                <div class="fs-1 fw-bold mt-4">
                    Dashboard
                </div>
                <div class="fs-3 fw-bold mt-3">
                    Welcome <?=$username;?>!
                </div>
                <div class="row align-items-center mt-4">
                    <div class="col">
                        <p class="h1 fw-bold text-center"><?php $Now = new DateTime('now', new DateTimeZone('Asia/Taipei')); echo  $Now->format('Y-M-d h:ia');?></p>
                    </div>
                </div>
                <div class="row mt-5 justify-content-around">
                    <div class="col-3 bg-success text-center p-4">
                        <p class="h5 fw-bold text-white text-center">Total number of workers: <?php
                            $sql = "SELECT count(1) FROM rfid WHERE NOT rfid_fname='UNREGISTERED' AND NOT rfid_lname='UNREGISTERED'";
                            $result = $conn->query($sql);
                            $row = $result->fetchColumn();
                            echo $row;
                        ?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-person-circle mt-2" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                    </div>
                    <div class="col-3 bg-success text-center p-4">
                        <p class="h5 fw-bold text-white text-center">Total number of present:
                        <?php
                            $today = date("Y-m-d");
                            $sql = "SELECT count(1) FROM time_in WHERE date = '$today'";
                            $result = $conn->query($sql);
                            $row = $result->fetchColumn();
                            if($row<1)
                            {
                                echo "0";
                            }
                            else{
                                echo $row;
                            }
                        ?>
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-check-square mt-2" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                        </svg>
                    </div>
                    <div class="col-3 bg-success text-center p-4">
                        <p class="h5 fw-bold text-white text-center">Total number of absent: 
                        <?php
                            $today = date("Y-m-d");
                            $sql1 = "SELECT count(1) FROM time_in WHERE date='$today'";
                            $sql2 = "SELECT count(1) FROM rfid WHERE NOT rfid_fname='UNREGISTERED' AND NOT rfid_lname='UNREGISTERED'";
                            $result1 = $conn->query($sql1);
                            $result2 = $conn->query($sql2);
                            $row1 = $result1->fetchColumn();
                            $row2 = $result2->fetchColumn();
                            if($row1<1 and $row2<1 and $row2<$row1)
                            {
                                echo "0";
                            }
                            else{
                                echo ($row2-$row1);
                            }
                        ?>
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-x-square mt-2" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/BIOMETRICS/bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/BIOMETRICS/js/sidebars.js"></script>
    <script>
      $(document).ready(function(){
        setTimeout(function(){
        window.location.reload(1);
        }, 5000);
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