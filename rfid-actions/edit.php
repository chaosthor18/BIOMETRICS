<?php
    session_start();
    include "../db_conn.php";
    if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
        $firstname=$_POST['rfid-fname'];
        $lastname=$_POST['rfid-lname'];
        $username=$_POST['rfid-username'];
        $id=$_POST['rfid-id'];
        echo $usernameold;
        if(!empty($firstname) && !empty($lastname) && !empty($username)){
            $stmt = $conn -> prepare("SELECT * FROM rfid WHERE rfid_id=?");
            $stmt->execute([$id]);
            if ($stmt->rowCount() === 1) {
                $sql = "UPDATE rfid " . "SET rfid_fname = '$firstname', rfid_lname = '$lastname'" . "WHERE  rfid_id='$id'";
                $result = $conn->query($sql);
                if(!$result){
                    $errormessage = "Invalid query: " . $conn->error;
                }
                else{
                    header("Location: ../rfid_edit.php?success=Successfully Edited&id=$username");
                    exit;
                }
            }
            else{
                header("Location: ../rfid_edit.php?error=Can't find the data&id=$username");
            }
        }
        else{
            header("Location: ../rfid_edit.php?&id=$username");
        }
    }
    else{
        header("Location: ../logout.php");
    }
?>