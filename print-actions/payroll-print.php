<?php 
require('../fpdf186/fpdf.php');
include "../db_conn.php";
session_start();
if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
    if(!empty($_POST['employee-option']) && !empty($_POST['fromDate']) && !empty($_POST['toDate']) && !empty($_POST['basic-salaryrate'])){
        $id = $_POST['employee-option'];
        $basicpay = $_POST['basic-salaryrate'];
        $from_Date = $_POST['fromDate'];
        $to_Date = $_POST['toDate'];

        if(!empty($_POST['chkbox_sss'])){
            $sss = $_POST['chkbox_sss'];
        }
        if(!empty($_POST['chkbox_phlhealth'])){
            $phlhealth = $_POST['chkbox_phlhealth'];
        }
        if(!empty($_POST['chkbox_pagibig'])){
            $pagibig = $_POST['chkbox_pagibig'];
        }

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

        $pdf->SetFont('Arial','B',18);
        $pdf->Cell(190,5,'PAYROLL',0,1,'C');
        
        $getrfidcd_sql = $conn->prepare("SELECT * FROM rfid WHERE rfid_carddata=? AND NOT rfid_fname='UNREGISTERED' AND NOT rfid_Lname='UNREGISTERED'");
        $getrfidcd_sql->execute([$id]);
        if($getrfidcd_sql->rowCount()==0){header("Location: ../payroll_page.php?error=Can't find the employee");}
        $row_getrfidcd = $getrfidcd_sql->fetch();
        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(60,5,'Name: '.$row_getrfidcd['rfid_fname']." ".$row_getrfidcd['rfid_lname'],0,0,'R');
        $pdf->Cell(123,5,'MITSI-ID: '.$row_getrfidcd['rfid_username'],0,1,'R');



        $countdays_sql = $conn->prepare("SELECT * FROM time_out WHERE rfid_att_cd='$id' AND date >= '$from_Date' AND date <= '$to_Date'");
        $countdays_sql->execute();
        $pdf->Ln(10);
        $pdf->Cell(93,10,"Number of days ",1,0,'C');
        $pdf->Cell(93,10,"Pay",1,1,'C');
        if($countdays_sql->rowCount()>=1){
            $numdays_work=$countdays_sql->rowCount();
            $total_Pay = $basicpay*$numdays_work;
            while($dayswork_row = $countdays_sql->fetch()){
                $pdf->Cell(93,10,$dayswork_row['date'],1,0,'C');
                $pdf->Cell(93,10,"P".$basicpay,1,1,'C');
            }
        }
        else{
            $pdf->Ln(25);
            $pdf->SetFont('Arial','B',50);
            $pdf->Cell(190,120,"EMPTY ATTENDANCE",0,0,'C');
        }



    }
    else{
        header("Location: ../payroll_page.php?error=Error Empty Fields");
    }
                
$pdf->Output();
}
else{
    header("Location: ../logout.php");
}
function compute(){

}
?>