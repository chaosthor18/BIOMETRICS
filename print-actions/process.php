<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){ 
	switch ($_POST['action']) {
		case 'view_employee':
			view_employee();
		break;
		default:
		break;
	}
}
else{
	header("Location: ../logout.php");
}


function view_employee()
{
	include '../db_conn.php';
	$sql = "SELECT * FROM rfid WHERE NOT rfid_fname='UNREGISTERED' AND NOT rfid_Lname='UNREGISTERED'";
	$result =  $conn->query($sql);
	while($row = $result->fetch()){
 		echo "<tr>
			<td>$row[rfid_fname]</td>
			<td>$row[rfid_lname]</td>
            <td>$row[rfid_username]</td>
			</tr>
			";	
			}
}

?>