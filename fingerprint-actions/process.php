<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){ 
	switch ($_POST['action']) {
		case 'view_fingerprintdb':
			view_fingerprintdb();
		break;
		case 'timeintimeout_insert':
			timeintimeout_insert();
		break;
		case 'view_Openslot':
			view_Openslot();
		break;
		default:
		break;
	}
}
else{
	header("Location: ../logout.php");
}
function view_Openslot(){
	include '../db_conn.php';
	$openslot_sql = $conn -> prepare ("SELECT * FROM fingerprint WHERE NOT LENGTH(fingerprint_username) = 11");
    $openslot_sql->execute();
	if($openslot_sql->rowCount()>=1){
		while($row = $openslot_sql->fetch()){
			echo "<tr>
			   <td>$row[fingerprint_username]</td>
			   <td>$row[fingerprint_fingerid]</td>
			   <td>
				   <div class='row align-content-center' style='width: 13em; margin: auto; padding: 3px;'>
					   <div class='col'>
						   <a href='./fingerprint_edit?id=$row[fingerprint_id]' class='btn btn-success btn-sm'>Edit</a>
						   <a href='./fingerprint-actions/reset?id=$row[fingerprint_id]&fingerid=$row[fingerprint_fingerid]' class='btn btn-success btn-sm'>Reset</a>
					   </div>
				   </div>
			   </td>
			   </tr>
			   ";	
		}
	}
}


function duplicate_timein($username_carddata){
	include '../db_conn.php';
	$today = date("Y-m-d");
	$attendance_sql = $conn -> prepare("SELECT * FROM time_in WHERE rfid_att_cd='$username_carddata' AND date='$today'");
    $attendance_sql->execute();
	if($attendance_sql->rowCount()===1){
		return True;
	}
	else{
		return False;
	}
}
function duplicate_timeout($username_carddata){
	include '../db_conn.php';
	$today = date("Y-m-d");
	$attendance_sql = $conn -> prepare("SELECT * FROM time_out WHERE rfid_att_cd='$username_carddata' AND date='$today'");
    $attendance_sql->execute();
	if($attendance_sql->rowCount()===1){
		return True;
	}
	else{
		return False;
	}
}
function ontime_timein(){
	if (time()>strtotime("09:15:00")){
		return False;
	}
	else{
		return True;
	}
}

function overtime_timeout(){
	if (time()>strtotime("19:00:00")){
		return True;
	}
	else{
		return False;
	}
}
function timeintimeout_insert(){
	include '../db_conn.php';
	date_default_timezone_set("Asia/Singapore");
	$today = date("Y-m-d");
	$time_today = date("h:i:s");
	$fingerid = $_POST['fingerid'];
	$fingerid_sql = $conn -> prepare("SELECT * FROM fingerprint WHERE fingerprint_fingerid=?");
    $fingerid_sql->execute([$fingerid]);
	if($fingerid_sql->rowCount()==1){
		$fingerid_row=$fingerid_sql->fetch();
		$cardid=$fingerid_row['fingerprint_username'];//MITSI ID
		$username_sql = $conn -> prepare("SELECT rfid_fname, rfid_lname, rfid_carddata FROM rfid WHERE rfid_username=?");
    	$username_sql->execute([$cardid]);
		if($username_sql->rowCount()==1){
			$username_row=$username_sql->fetch();
			$full_name=strval($username_row['rfid_fname'])." ".strval($username_row['rfid_lname']);
			$username_carddata=$username_row['rfid_carddata'];//rfid card
			if(!duplicate_timein($username_carddata)){//TIME IN
				if(ontime_timein()){//ontime time in
					$stmt = $conn->prepare("INSERT INTO time_in (full_name,rfid_att_cd,time_in,date,status) VALUES ('$full_name','$username_carddata','$time_today','$today','On-time')");
					$stmt->execute();
					echo "ON TIME";
				}
				else{
					$stmt = $conn->prepare("INSERT INTO time_in (full_name,rfid_att_cd,time_in,date,status) VALUES ('$full_name','$username_carddata','$time_today','$today','Late')");
					$stmt->execute();
					echo "LATE";
				}
			}
			else{//TIME OUT
				if(!duplicate_timeout($username_carddata)){
					if(!overtime_timeout()){//not overtime
						$stmt = $conn->prepare("INSERT INTO time_out (full_name,rfid_att_cd,time_out,date,status) VALUES ('$full_name','$username_carddata','$time_today','$today','Not Overtime')");
						$stmt->execute();
						echo "Not Overtime";
					}
					else{
						$stmt = $conn->prepare("INSERT INTO time_out (full_name,rfid_att_cd,time_out,date,status) VALUES ('$full_name','$username_carddata','$time_today','$today','Overtime')");
						$stmt->execute();
						echo "Overtime";
					}
				}
				else{
					echo "You have already time-out.";
				}
			}
		}
	}
}


function view_fingerprintdb()
{
	include '../db_conn.php';
	$sql = "SELECT * FROM fingerprint";
	$result =  $conn->query($sql);
	while($row = $result->fetch()){
 		echo "<tr>
			<td>$row[fingerprint_username]</td>
			<td>$row[fingerprint_fingerid]</td>
			<td>
				<div class='row align-content-center' style='width: 13em; margin: auto; padding: 3px;'>
				    <div class='col'>
					    <a href='./fingerprint_edit?id=$row[fingerprint_id]' class='btn btn-success btn-sm'>Edit</a>
						<a href='./fingerprint-actions/reset?id=$row[fingerprint_id]&fingerid=$row[fingerprint_fingerid]' class='btn btn-success btn-sm'>Reset</a>
					</div>
				</div>
			</td>
			</tr>
			";	
			}
}

?>