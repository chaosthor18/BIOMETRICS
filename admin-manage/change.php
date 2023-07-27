<?php
    session_start();
    include "../db_conn.php";
    if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
        $username=$_POST['username'];
        $password=$_POST['password'];
        if(!empty($username) && !empty($password)){
            $sql = "UPDATE users " . "SET username = '$username', password = '$password'" . "WHERE  name='Admin'";
            $result = $conn->query($sql);
            if(!$result){
                $errormessage = "Invalid query: " . $conn->error;
            }
            else{
                session_start();
                session_unset();
                session_destroy();
                header("Location: ../login_page.php?edit_success=Successfully Changed");
            }
            }
        else{
            header("Location: ../changepass_page.php?error=Empty Input");
        }
    }
    else{
        header("Location: ../logout.php");
    }
?>