<?php 
  session_start();
  include '../db_conn.php';
  $username = $_SESSION['user_username'];
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
   $name = $_POST['name'];
   $sql = "SELECT * FROM fingerprint WHERE fingerprint_username LIKE '$name%'";
   $result = $conn->query($sql);
   $data='';
   while($row = $result->fetch())
   {
       $data .=  "
       <tr>
        <td>$row[fingerprint_username]</td>
        <td>$row[fingerprint_fingerid]</td>
        <td>
            <div class='row align-content-center' style='width: 13em; margin: auto; padding: 3px;'>
                <div class='col'>
                    <a href='/BIOMETRICS/fingerprint_edit.php?id=$row[fingerprint_id]' class='btn btn-success btn-sm'>Edit</a>
                    <a href='/BIOMETRICS/fingerprint-actions/reset.php?id=$row[fingerprint_id]&fingerid=$row[fingerprint_fingerid]' class='btn btn-success btn-sm'>Reset</a>
                </div>
            </div>
        </td>
       </tr>
			";
   }
    echo $data;
}
else{
    header("Location: ../logout.php");
  }
 ?>
