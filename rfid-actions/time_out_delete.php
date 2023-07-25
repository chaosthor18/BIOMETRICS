<?php
    session_start();
    include "../db_conn.php";
    if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
        if(isset($_GET['id'])){
            $id= $_GET['id'];
            $sql = "DELETE FROM time_out WHERE id=$id";
            $stmt=$conn->query($sql);
            header("Location: ../rfid_attendance.php?success=Successfully Deleted");
        }
        else{
            header("Location: ../rfid_attendance.php?fail=Error!");
        }
    }
    else{
        header("Location: ../logout.php");
    }
?>