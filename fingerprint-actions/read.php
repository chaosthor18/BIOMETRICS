<?php
    session_start();
    include "../db_conn.php";
    //server end
    if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
        $fingerprint_fingerid = $_POST['fingerprint-fingerid'];
        $change_status = "UPDATE fingerprint_signalread " . "SET currently_editing='$fingerprint_fingerid', status = 'ready'" . "WHERE  fingerprint_deviceid='finger_1'";
        $conn->query($change_status);
        $fingerprint_username = $_POST['fingerprint-username'];
        if(isset($_POST['fingerprint-username'])){
            $duplicate = $conn->prepare("SELECT * FROM fingerprint WHERE fingerprint_username='$fingerprint_username'");
	        $duplicate->execute();
            if($duplicate->rowCount()!=1){
                // $insert_f = $conn->prepare("INSERT INTO fingerprint (fingerprint_username) VALUES ('$fingerprint_username')");
	            // $insert_f->execute();
                $finger_id=$_POST['fingerprint-id'];
                $insert_sql = "UPDATE fingerprint " . "SET fingerprint_username = '$fingerprint_username'" . "WHERE fingerprint_id='$finger_id'";
                $conn->query($insert_sql);
            }
        }
        sleep(5);
    }


    //sensor read
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){//read and stand-by fingerprint
            if($_POST["action"]=="register_fingerprint"){
                $signal_sql = "SELECT * FROM fingerprint_signalread";
                $signal_result =  $conn->query($signal_sql);
                $signal_row = $signal_result->fetch();
                echo $signal_row['status'];
            }
            if($_POST["action"]=="get_fingerprintid"){
                $getfingerid_sql = "SELECT * FROM fingerprint_signalread";
                $getfingerid_result =  $conn->query($getfingerid_sql);
                $getfingerid_row = $getfingerid_result->fetch();
                echo $getfingerid_row['currently_editing'];
            }
            if($_POST["action"]=="register_off"){
                $change_status = "UPDATE fingerprint_signalread " .  "SET currently_editing='0', status = 'stand-by'" . "WHERE  fingerprint_deviceid='finger_1'";
                $conn->query($change_status);
                header("Location: /BIOMETRICS/fingerprint_page.php");
            }
    }
    else{
        // $change_status = "UPDATE fingerprint_signalread " . "SET status = 'stand-by'" . "WHERE  fingerprint_deviceid='finger_1'";
        // $conn->query($change_status);
        header("Location: /BIOMETRICS/fingerprint_page.php");
    }
?>