<?php 
require('../fpdf186/fpdf.php');#C:\Users\MITSI\Desktop\fpdf186\fpdf.php
include "../db_conn.php";
session_start();
if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,'Date and Time Record',0,0,'C');

$pdf->Ln(20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(47.5,10,'Name',1,0,'C');
$pdf->Cell(47.5,10,'Time In',1,0,'C');
$pdf->Cell(47.5,10,'Time Out',1,0,'C');
$pdf->Cell(47.5,10,'Date',1,1,'C');

                    $id = $_GET['id'];
                    $name_sql = $conn->prepare("SELECT * FROM rfid WHERE rfid_id=?");
                    $name_sql->execute([$id]);
                    $row_name=$name_sql->fetch();

                    $timein_sql = $conn->prepare("SELECT * FROM time_in WHERE rfid_att_cd=?");
                    $timein_sql->execute([$row_name['rfid_username']]);
                    //$row_timein=$timein_sql->fetch();
                    // if(!$result){
                    //   echo "<h1>No RFID data</h1>";
                    // }
                    // else {
                    //   while($row = $result->fetch()){
                    //     echo "<tr>
                    //     <td>$row[rfid_fname]</td>
                    //     <td>$row[rfid_lname]</td>
                    //     <td>$row[rfid_username]</td>
                    //     <td>$row[rfid_carddata]</td>
                    //     <td>
                    //       <div class='row align-content-center' style='width: 13em; margin: auto; padding: 3px;'>
                    //         <div class='col'>
                    //           <a href='rfid_edit.php?id=$row[rfid_username]' class='btn btn-success btn-sm'>Edit</a>
                    //           <a href='./rfid-actions/delete.php?id=$row[rfid_id]' class='btn btn-success btn-sm'>Delete</a>
                    //           <a href='./rfid-actions/print.php?id=$row[rfid_id]' class='btn btn-success btn-sm'>Print</a>
                    //           </div>
                    //       </div>
                    //     </td>
                    //     </tr>
                    //   ";

                    //   }
                    // }
                    while($row_timein=$timein_sql->fetch()){
                        $pdf->Cell(47.5,10,$row_name['rfid_fname']." ".$row_name['rfid_lname'],1,0,'C');
                        $pdf->Cell(47.5,10,$row_timein['time_in'],1,0,'C');

                        $timeout_sql = $conn->prepare("SELECT time_out FROM time_out WHERE date=?");
                        $timeout_sql->execute([$row_timein['date']]);

                        $date=$row_timein['date'];
                        $timeout_sql2="SELECT time_out FROM time_out WHERE date=$date";
                        $result=$conn->query($timeout_sql2);
                        if(!$result){
                            $pdf->Cell(47.5,10,'empty',1,0,'C');
                            $pdf->Cell(47.5,10,'empty',1,1,'C');
                        }
                        else{
                            $row_timeout=$timeout_sql->fetch();
                            // $pdf->Cell(47.5,10,$row_timeout['time_out'],1,0,'C');
                            // $pdf->Cell(47.5,10,$row_timein['date'],1,0,'C');
                            // $row_timeout=$timeout_sql->fetch();
                            $pdf->Cell(47.5,10,'LOLO',1,0,'C');
                            $pdf->Cell(47.5,10,$row_timein['date'],1,1,'C');
                        }
                        
                    }
                
$pdf->Output();
}
else{
    header("Location: ../logout.php");
}