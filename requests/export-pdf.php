<?php
require_once("../admin/dbConfig.php");

if(isset($_GET['getdownloadPDF']) && $_GET['getdownloadPDF'] == true){
    $bookingID = $_GET['bookingId'];
    $userMail = $_GET['userMail'];
    $query="SELECT `bookingID`, `bookingDateTime`, `userMail`, `startDate`, `endDate`, `pickupTime`, `userPhoneNo`, `fromAdd`, `toAdd` FROM `tblbookings` where `bookingID` = $bookingID and `userMail` = '$userMail'";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);
    $BookedData = array();
    $html="";
    if($num_rows>0){
        $fetchData =  mysqli_fetch_assoc($runQuery);
           $BookedData = array("bookingID"=>$fetchData['bookingID'],"bookingDateTime"=>date("d/m/Y h:i:s a", strtotime($fetchData['bookingDateTime'])),"toAdd"=>$fetchData['toAdd'],"userMail"=>$fetchData['userMail'],"startDate"=>date("d/m/Y", strtotime($fetchData['startDate'])),"endDate"=>date("d/m/Y", strtotime($fetchData['endDate'])),"pickupTime"=>date("h:i:s a", strtotime($fetchData['pickupTime'])),"userPhoneNo"=>$fetchData['userPhoneNo'],"fromAdd"=>$fetchData['fromAdd']);

           $html.="<div>
                        <div style='border:1px solid #000; margin:3px'>
                            <div>
                                <div style='border-bottom:1px solid #000; padding:8px 4px 8px 4px;'>
                                    <div style='width:50%'>
                                        <h6>From</h6>
                                        <h2>".$BookedData['fromAdd']."</h2>
                                        <span>".$BookedData['startDate']."</span>
                                    </div>
                                    <div style='width:50%'>
                                        <h6>to</h6>
                                        <h2 >".$BookedData['toAdd']."</h2>
                                        <span >".$BookedData['endDate']."</span>
                                    </div>
                                </div>
                            </div>
                            <div style='padding-top:12px;'>
                                <div style='border-bottom:1px solid #000; padding:8px 4px 8px 4px;'>
                                    <h6>Client Details:</h6>
                                    <p><b>E-Mail : </b> ".$BookedData['userMail']."</p>
                                    <p><b>Phone Number : </b> ".$BookedData['userPhoneNo']."</p>
                                    <p><b>Booking Time : </b> ".$BookedData['bookingDateTime']."</p>
                                    <p><b>pickup Time : </b> ".$BookedData['pickupTime']."</p>
                                </div>
                            </div>
                        </div>
                    </div>";
       // header("Location:export-pdf.php?data=$html");
        require '../admin/request/pdfD/vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $time = date("M-d-Y h:i:s A");
        $fileName = $BookedData['bookingID'].$time.".pdf";
        $mpdf->Output($fileName,'I');
        
        $status= "success";
        unset($html);
    }else{
        $status= "failed";
    }
   // echo json_encode(array("status"=>$status));
}
