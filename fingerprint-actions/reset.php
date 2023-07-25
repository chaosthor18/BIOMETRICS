<?php
    session_start();
    include "../db_conn.php";
    ////////SERVER SIDE///////
    if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $reset_sql = "UPDATE fingerprint " . "SET fingerprint_username='MITSI-$id'" . "WHERE  fingerprint_id='$id'";
            $conn->query($reset_sql);
            $fingerid = $_GET['fingerid'];
            $signal_sql = "UPDATE fingerprint_signalread " . "SET currently_editing='$fingerid', status = 'yes'" . "WHERE  fingerprint_deviceid='finger_1'";
            $conn->query($signal_sql);
            sleep(5);
            header("Location: ../fingerprint_page.php?success=Successfully Deleted");
        }
        else{
            header("Location: ../fingerprint_page.php?fail=Error!");
        }
    }
    else{
        header("Location: ../logout.php");
    }
    /////////////Sensor Side//////////////
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){//read and stand-by fingerprint
        if($_POST["action"]=="delete_fingerprint"){ ///identify if selected
            $signal_sql = "SELECT * FROM fingerprint_signalread";
            $signal_result =  $conn->query($signal_sql);
            $signal_row = $signal_result->fetch();
            echo $signal_row['status'];
        }
        if($_POST["action"]=="get_fingerprintid"){ ///identify what is selected
            $getfingerid_sql = "SELECT * FROM fingerprint_signalread";
            $getfingerid_result =  $conn->query($getfingerid_sql);
            $getfingerid_row = $getfingerid_result->fetch();
            echo $getfingerid_row['currently_editing'];
        }
    }
    else{
        // $change_status = "UPDATE fingerprint_signalread " . "SET status = 'stand-by'" . "WHERE  fingerprint_deviceid='finger_1'";
        // $conn->query($change_status);
        header("Location: /BIOMETRICS/fingerprint_page.php?error=unsuccessful");
    }
    
?>