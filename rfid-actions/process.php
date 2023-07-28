<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){ 
	switch ($_POST['action']) {
		case 'getmitsi_Id':
			getmitsi_Id();
		break;
		case 'view_rfid':
			view_rfid();
		break;
		case 'view_attendanceto':
			view_attendanceto();
		break;
		case 'view_attendanceti':
			view_attendanceti();
		break;
		case 'getfingerId':
			getfingerId();
		break;
		default:
		break;
	}
}
else{
	header("Location: ../logout.php");
}

function getfingerId(){
	include '../db_conn.php';
	$rfid_carddata=$_POST['uid'];
	$getmitsiid_sql = $conn -> prepare("SELECT * FROM rfid WHERE rfid_carddata='$rfid_carddata'");
    $getmitsiid_sql->execute();
	if($getmitsiid_sql->rowCount()===1){
		$row_getmitsiid = $getmitsiid_sql->fetch();
		$mitsi_id=$row_getmitsiid['rfid_username'];
		$getfingerid_sql = $conn -> prepare("SELECT * FROM fingerprint WHERE fingerprint_username='$mitsi_id'");
		$getfingerid_sql->execute();
		if($getfingerid_sql->rowCount()==1){
			$row_fingerid=$getfingerid_sql->fetch();
			echo $row_fingerid['fingerprint_fingerid'];
		}
		else{
			echo "0";
		}
	}
	else{
		echo "0";
	}
}



function generate_id(){
	include '../db_conn.php';
	while(True){
		$username='MITSI-'.strval(rand(10000,99999));
		$stmt = $conn->prepare("SELECT * FROM rfid WHERE rfid_username=?");
		$stmt->execute([$username]);
		if($stmt->rowCount()==1){
			continue;
		}
		else{
			return $username;
		}
	}
}
function unregistered_rfid($cardid){
	include '../db_conn.php';
	$name_sql = $conn -> prepare("SELECT * FROM rfid WHERE rfid_carddata='$cardid'");
    $name_sql->execute();
	if($name_sql->rowCount()==1){
		$row = $name_sql->fetch();
		if($row['rfid_fname']==="UNREGISTERED" && $row['rfid_lname']==="UNREGISTERED"){
			return True;
		}
		else{
			return False;
		}
	}
}

function getmitsi_Id() {
    include '../db_conn.php';
	date_default_timezone_set("Asia/Singapore");
    $cardid = $_POST['uid'];
	$username=generate_id();
	$carddata_sql = $conn -> prepare("SELECT rfid_fname, rfid_lname FROM rfid WHERE rfid_carddata=?");
    $carddata_sql->execute([$cardid]);
	if($carddata_sql->rowCount()!=1 && !unregistered_rfid($cardid)){//register
		$stmt = $conn->prepare("INSERT INTO rfid (rfid_fname, rfid_lname,rfid_username,rfid_carddata) VALUES ('UNREGISTERED','UNREGISTERED','$username','$cardid')");
		$stmt->execute();
		echo "success";
	}
	elseif(!unregistered_rfid($cardid)){//time in and time out
		$today = date("Y-m-d");
		$time_today = date("h:i:s");
		echo $cardid;
	}
	elseif(unregistered_rfid($cardid)){
		echo "Please contact the administrator to register RFID";
	}

}
function view_rfid()
{
	include '../db_conn.php';
	$sql = "SELECT * FROM rfid";
	$result =  $conn->query($sql);
	while($row = $result->fetch()){
 		echo "<tr>
			<td>$row[rfid_fname]</td>
			<td>$row[rfid_lname]</td>
			<td>$row[rfid_username]</td>
			<td>$row[rfid_carddata]</td>
			<td>
				<div class='row align-content-center' style='width: 13em; margin: auto; padding: 3px;'>
				<div class='col'>
					<a href='rfid_edit?id=$row[rfid_username]' class='btn btn-success btn-sm'>Edit</a>
					<a href='./rfid-actions/delete?id=$row[rfid_id]' class='btn btn-success btn-sm'>Delete</a>
					</div>
				</div>
			</td>
			</tr>
			";	
			}
}
function view_attendanceti()
{
	include '../db_conn.php';
	date_default_timezone_set("Asia/Singapore");
	$today = date("Y-m-d");
	$timein_sql = "SELECT * FROM time_in WHERE date='$today'";
	$result_timein =  $conn->query($timein_sql);
	$getname_sql = $conn -> prepare("SELECT rfid_fname, rfid_lname, rfid_username FROM rfid WHERE rfid_carddata=?");
	  while($row = $result_timein->fetch()){
		$getname_sql->execute([$row['rfid_att_cd']]);
		$row_getname=$getname_sql->fetch();
		echo "<tr>
		<td>$row[full_name]</td>
		<td>$row_getname[2]</td>
		<td>$row[time_in]</td>
		<td>$row[status]</td>
		<td><a href='./rfid-actions/time_in_delete.php?id=$row[id]' class='btn btn-success btn-md'>Delete</a></td>
		</tr>
	  ";
	  }
}
function view_attendanceto()
{
	include '../db_conn.php';
	date_default_timezone_set("Asia/Singapore");
	$today = date("Y-m-d");
	$timeout_sql = "SELECT * FROM time_out WHERE date='$today'";
	$result_timeout =  $conn->query($timeout_sql);
	$getname_sql = $conn -> prepare("SELECT rfid_fname, rfid_lname, rfid_username FROM rfid WHERE rfid_carddata=?");
	  while($row = $result_timeout->fetch()){
		$getname_sql->execute([$row['rfid_att_cd']]);
		$row_getname=$getname_sql->fetch();
		echo "<tr>
		<td>$row[full_name]</td>
		<td>$row_getname[2]</td>
		<td>$row[time_out]</td>
		<td>$row[status]</td>
		<td><a href='./rfid-actions/time_out_delete.php?id=$row[id]' class='btn btn-success btn-md'>Delete</a></td>
		</tr>
	  ";
	  }
}
?>
