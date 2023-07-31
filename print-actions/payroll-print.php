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
        $overtime_rate = 0;
        // if(!empty($_POST['chkbox_sss'])){
        //     $sss = $_POST['chkbox_sss'];
        // }
        // if(!empty($_POST['chkbox_phlhealth'])){
        //     $phlhealth = $_POST['chkbox_phlhealth'];
        // }
        // if(!empty($_POST['chkbox_pagibig'])){
        //     $pagibig = $_POST['chkbox_pagibig'];
        // }
        if(!empty($_POST['overtime-percent'])){
            $overtime_rate = 1.00+(($_POST['overtime-percent'])/100);
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
        $pdf->SetTitle($from_Date." ".$to_Date." ".$row_getrfidcd['rfid_fname']." ".$row_getrfidcd['rfid_lname']);
        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(60,5,'Name: '.$row_getrfidcd['rfid_fname']." ".$row_getrfidcd['rfid_lname'],0,0,'R');
        $pdf->Cell(123,5,'MITSI-ID: '.$row_getrfidcd['rfid_username'],0,1,'R');

        $countdays_sql = $conn->prepare("SELECT * FROM time_out WHERE rfid_att_cd='$id' AND date >= '$from_Date' AND date <= '$to_Date'");
        $countdays_sql->execute();
        $pdf->Ln(10);
        $pdf->Cell(93,10,"Date",1,0,'C');
        $pdf->Cell(93,10,"Pay",1,1,'C');
        if($countdays_sql->rowCount()>=1){ //CANT TIMEOUT WITHOUT TIMEIN
            $total_Pay = 0;//WITHOUT DEDEUCTIONS
            $total_overtimePay=0;//TOTAL OVERTIME PAY
            $total_lateDeduc=0;//TOTAL LATE DEDUCTION
            $total_paymonth=$basicpay*30;//MONTHLY SALARY WITHOUT DUDUC AND OVERTIME
            while($dayswork_row = $countdays_sql->fetch()){
                $gross_payd = $basicpay;
                if(floor(overtime($dayswork_row['time_out'],$dayswork_row['date'],$id))>=1 && !empty($_POST['overtime-percent'])){//OVERTIME
                    $hours_ot=floor(overtime($dayswork_row['time_out'],$dayswork_row['date'],$id));
                    $hourly_overtime = (($basicpay/8)*$overtime_rate)*$hours_ot;//perhour overtime rate
                    $total_overtimePay+=$hourly_overtime;
                    $gross_payd+=$hourly_overtime;
                }
                if(late($dayswork_row['date'],$id)!=0){//LATE DEDUCTION
                    $hourly_late=(($basicpay/8)/60)*late($dayswork_row['date'],$id);
                    $total_lateDeduc+=$hourly_late;
                }
                $total_Pay+=$gross_payd;
                $pdf->Cell(93,10,$dayswork_row['date'],1,0,'C');
                $pdf->Cell(93,10,round($gross_payd,2) ,1,1,'C');
            }
            $sss_deduc=0;//SSS DEDUC
            if(!empty($_POST['chkbox_sss'])){
                $sss_deduc=($total_paymonth*0.045);
            }
            $pagibig=0;//pagibig DEDUC
            if(!empty($_POST['chkbox_pagibig'])){
                if($total_paymonth<1500){
                    $pagibig = $total_paymonth*0.01;
                }
                elseif($total_paymonth>=1500 && $total_paymonth<=4999){
                    $pagibig = $total_paymonth*0.02;
                }
                elseif($total_paymonth>=5000){
                    $pagibig = 100;
                }
            }
            $phlhealth=0;
            if(!empty($_POST['chkbox_phlhealth'])){
                $phlhealth = ($total_paymonth*0.045)/2;
            }
            $netpay=$total_Pay-($phlhealth+$sss_deduc+$pagibig+$total_lateDeduc);
            $pdf->Cell(93,10,"Total Overtime Pay:",1,0,'C');
            $pdf->Cell(93,10,round($total_overtimePay,2),1,1,'C');
            $pdf->Cell(93,10,"Gross Pay: ",1,0,'C');
            $pdf->Cell(93,10,round($total_Pay,2),1,1,'C');

            $pdf->Cell(190,10,"MONTHLY SALARY DEDUCTIONS",0,1,'C');
            $pdf->Cell(93,10,"Late Deductions: ",1,0,'C');
            $pdf->Cell(93,10,round($total_lateDeduc,2),1,1,'C');
            $pdf->Cell(93,10,"SSS:",1,0,'C');
            $pdf->Cell(93,10,round($sss_deduc,2),1,1,'C');
            $pdf->Cell(93,10,"PAG-IBIG:",1,0,'C');
            $pdf->Cell(93,10,round($pagibig,2),1,1,'C');
            $pdf->Cell(93,10,"PHIL-HEALTH:",1,0,'C');
            $pdf->Cell(93,10,round($phlhealth,2),1,1,'C');
            $pdf->Cell(93,10,"Net Pay: ",1,0,'C');
            $pdf->Cell(93,10,round($netpay,2),1,1,'C');

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

function late($date,$id){
    include "../db_conn.php";
    $timein_sql =  $conn->prepare("SELECT * FROM time_in WHERE rfid_att_cd='$id' AND date='$date'");
    $timein_sql->execute();
    $row_timein =  $timein_sql->fetch();
    if(strtotime($row_timein['time_in'])>strtotime("09:15:00")){
        $lateMin = (strtotime($row_timein['time_in'])-strtotime("09:15:00")) / 60 % 60; //per 30 minutes deduction
        return $lateMin;
    }
    else{
        return 0;
    }
}

function overtime($timeout,$date,$id){
    include "../db_conn.php";
    $timein_sql =  $conn->prepare("SELECT * FROM time_in WHERE rfid_att_cd='$id' AND date='$date'");
    $timein_sql->execute();
    $row_timein =  $timein_sql->fetch();
    $overtime_hours=(strtotime($timeout)-strtotime($row_timein['time_in']))/3600;
    return $overtime_hours-9;
}

?>