<?php
        session_start();
        include 'db_conn.php';
        if(isset($_POST['username_login']) && isset($_POST['password_login'])){
            $username = $_POST['username_login'];
            $password = $_POST['password_login'];
            if (empty($username)){
                header("Location: login_page?error=Please Enter Username");
            }
            else if (empty($password)){
                header("Location: login_page?error=Please Enter Password");
            }
            else {
                $stmt = $conn -> prepare("SELECT * FROM users WHERE username=?");
                $stmt->execute([$username]);
                if ($stmt->rowCount() === 1) {
                    $user = $stmt->fetch();
                    $user_id = $user['id'];
                    $user_name= $user['name'];
                    $user_username = $user['username'];
                    $user_password = $user['password'];
                    $user_adminrights = $user['admin_rights'];
                    if ($username === $user_username) {
                        if ($password === $user_password) {
                            if(password_verify('admin123',$user_adminrights)){
                                $_SESSION['user_username'] = $user_username;
                                $_SESSION['user_name'] = $user_name;
                                $_SESSION['user_password'] = $user_password;
                                $_SESSION['user_adminrights'] = $user_adminrights;
                                $_SESSION['user_type'] = 'admin789123';
                                header("Location: index");
                            }
                        }
                        else {
                            header("Location: login_page?error=Incorrect User name or password&username_login=$username");
                        }
                    }
                }
                else {
                    header("Location: login_page?error=Incorrect User name or password&username_login=$username");
                }
            }
        }
        else{
            session_start();
            session_unset();
            session_destroy();
            header("Location:login_page");
        }
?>