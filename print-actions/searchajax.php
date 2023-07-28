<?php 
  session_start();
  include '../db_conn.php';
  $username = $_SESSION['user_username'];
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
   $name = $_POST['name'];
   $sql = "SELECT * FROM rfid WHERE rfid_fname LIKE '$name%' OR rfid_lname LIKE '$name%' OR rfid_username LIKE '$name%'";
   $result = $conn->query($sql);
   $data='';
   while($row = $result->fetch())
   {
       $data .=  "<tr>
       <td>$row[rfid_fname]</td>
       <td>$row[rfid_lname]</td>
       <td>$row[rfid_username]</td>
       </tr>
       ";
   }
    echo $data;
}
else{
    header("Location: ../logout.php");
  }
 ?>
