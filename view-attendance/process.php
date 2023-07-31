<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){ 
	switch ($_POST['action']) {
		case 'view_timein':
			view_timein();
		break;
		case 'view_timeout':
			view_timeout();
		break;
		default:
		break;
	}
}
else{
	header("Location: ../logout.php");
}

function view_timein()
{
	include '../db_conn.php';
	date_default_timezone_set("Asia/Singapore");
	$today = date("Y-m-d");
	$timein_sql = "SELECT * FROM time_in WHERE date='$today'";
	$result_timein =  $conn->query($timein_sql);
	  while($row = $result_timein->fetch()){
		echo "<tr>
		<td>$row[full_name]</td>
		<td>$row[rfid_att_cd]</td>
		<td>$row[time_in]</td>
		<td>$row[status]</td>
		</tr>
	  ";
	  }
}
function view_timeout()
{
	include '../db_conn.php';
	date_default_timezone_set("Asia/Singapore");
	$today = date("Y-m-d");
	$timeout_sql = "SELECT * FROM time_out WHERE date='$today'";
	$result_timeout =  $conn->query($timeout_sql);
	  while($row = $result_timeout->fetch()){
		echo "<tr>
		<td>$row[full_name]</td>
		<td>$row[rfid_att_cd]</td>
		<td>$row[time_out]</td>
		<td>$row[status]</td>
		</tr>
	  ";
	}
}
?>