<?php 
  session_start();
  include '../db_conn.php';
  $username = $_SESSION['user_username'];
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
   $name = $_POST['name'];
   $sql = "SELECT * FROM rfid WHERE rfid_fname LIKE '$name%' OR rfid_lname LIKE '$name%'";
   $result = $conn->query($sql);
   $data='';
   while($row = $result->fetch())
   {
       $data .=  "
       <tr>
        <td>$row[rfid_fname]</td>
        <td>$row[rfid_lname]</td>
        <td>$row[rfid_username]</td>
        <td>$row[rfid_carddata]</td>
        <td>
            <div class='row align-content-center' style='width: 13em; margin: auto; padding: 3px;'>
            <div class='col'>
                <a href='rfid_edit.php?id=$row[rfid_username]' class='btn btn-success btn-sm'>Edit</a>
                <a href='./rfid-actions/delete.php?id=$row[rfid_id]' class='btn btn-success btn-sm'>Delete</a>
                <a href='#print' class='btn btn-success btn-sm'>Print</a>
                </div>
            </div>
        </td>
       </tr>";
   }
    echo $data;
}
else{
    header("Location: ../logout.php");
  }
 ?>
