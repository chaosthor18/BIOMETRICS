<?php 
require('../fpdf186/fpdf.php');
include "../db_conn.php";
session_start();
if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
    $id = $_POST['id'];
    $from_Date = $_POST['fromDate'];
    $to_Date = $_POST['toDate'];
    if(!empty($_POST['id']) && !empty($_POST['fromDate']) && !empty($_POST['toDate'])){
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','',16);
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',16);
        $pdf->Image('../icons/mitsi-icon.png', 50, 10, -500);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(158,5,'Massive Integrated Tech Solutions Inc.',0,1,'R');
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(167,5,'Suite 1508 Landsdale Tower Mother, 1103 Mo. Ignacia Ave, Quezon City, 6000',0,1,'R');
        $pdf->Cell(160,5,'Contact us: info@massiveits.com, sales@massiveits.com, (02) 448-6511',0,1,'R');
        $pdf->Ln(25);

        $getrfidcd_sql = $conn->prepare("SELECT * FROM rfid WHERE rfid_username=? AND NOT rfid_fname='UNREGISTERED' AND NOT rfid_Lname='UNREGISTERED'");
        $getrfidcd_sql->execute([$id]);//get rfid card data
        if($getrfidcd_sql->rowCount()==1){//if it is not unregistered
            if($from_Date>=$to_Date){
                header("Location: ../print_page.php?error=From Date must not be bigger than To Date.");
            }
            $row_getrfidcd = $getrfidcd_sql->fetch();
            $rfid = $row_getrfidcd['rfid_carddata'];
            $pdf->SetFont('Arial','B',13);
            $pdf->Cell(60,5,'Name: '.$row_getrfidcd['rfid_fname']." ".$row_getrfidcd['rfid_lname'],0,0,'R');
            $pdf->Cell(123,5,'MITSI-ID: '.$id,0,1,'R');

            $pdf->Ln(10);
            $pdf->SetFont('Arial','B',18);
            $pdf->Cell(190,10,'Date and Time Record',0,0,'C');

            $pdf->Ln(20);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(47.5,10,'Name',1,0,'C');
            $pdf->Cell(47.5,10,'Time In',1,0,'C');
            $pdf->Cell(47.5,10,'Time Out',1,0,'C');
            $pdf->Cell(47.5,10,'Date',1,1,'C');
        
            $total_Hours = 0; //total Hours
            $timein_sql = $conn->prepare("SELECT * FROM time_in WHERE rfid_att_cd='$rfid' AND date >= '$from_Date' AND date <= '$to_Date'");
            $timein_sql->execute();
            if($timein_sql->rowCount()>=1){
                while($row_timein = $timein_sql->fetch()){
                    $pdf->SetTitle($from_Date." ".$to_Date." ".$row_timein['full_name']);
                    $pdf->Cell(47.5,10,$row_timein['full_name'],1,0,'C');
                    $pdf->Cell(47.5,10,$row_timein['time_in']."(".$row_timein['status'].")",1,0,'C');
                    $date = $row_timein['date'];
                    $timeout_sql = $conn->prepare("SELECT * FROM time_out WHERE rfid_att_cd='$rfid' AND date='$date'");
                    $timeout_sql->execute();
                    if($timeout_sql->rowCount()==1){
                        $row_timeout=$timeout_sql->fetch();
                        $perline_Hours=(strtotime($row_timeout['time_out']))-(strtotime($row_timein['time_in']));
                        $timetohours=($perline_Hours/3600);
                        if($timetohours>=6){
                            $total_Hours-=1;
                        }
                        $total_Hours+=$timetohours;
                        $pdf->Cell(47.5,10,$row_timeout['time_out']."(".$row_timeout['status'].")",1,0,'C');
                    }
                    else{
                        $pdf->Cell(47.5,10,"EMPTY",1,0,'C');
                    }
                    $pdf->Cell(47.5,10,$row_timein['date'],1,1,'C');
                }
                $pdf->Cell(190,10,"TOTAL HOURS: ".floor($total_Hours),1,1,'C');
            }
            else{
                $pdf->SetFont('Arial','B',50);
                $pdf->Cell(190,120,"EMPTY ATTENDANCE",0,0,'C');
            }
        }
        else{
            header("Location: ../print_page.php?error=ID is not found");
        }
    }
    else{
        header("Location: ../print_page.php?error=Error Empty Fields");
    }
                
$pdf->Output();
}
else{
    header("Location: ../logout.php");
}
?>