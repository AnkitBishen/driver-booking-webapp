<?php
require_once("../admin/dbConfig.php");

$postData = json_decode(file_get_contents("php://input"));

if(isset($postData->bookingSlot) && $postData->bookingSlot == true){
    $bookingData = $postData->bookingData;
    $userMail = $postData->userMail;
    $bookingData = (array)$bookingData;

    $startDate = $bookingData['startDate'];
    $EndDate = $bookingData['EndDate'];
    $pickupTime = $bookingData['pickupTime'];
    $phoneNumber = $bookingData['phoneNumber'];
    $fromAddress = $bookingData['fromAddress'];
    $toAddress = $bookingData['toAddress'];

    $booking_id = mt_rand(1000, 9999).time().mt_rand(100000, 999999);

    // date_default_timezone_set('Indian/Mahe');
    // $bookingTime = date("h:i:sa");
    // echo $booking_id;exit();

    $query = "INSERT INTO `tblbookings`(`bookingID`, `userMail`, `startDate`, `endDate`, `pickupTime`, `userPhoneNo`, `fromAdd`, `toAdd`, `appointTo`) VALUES ('$booking_id','$userMail','$startDate','$EndDate','$pickupTime','$phoneNumber','$fromAddress','$toAddress','')";
    $runQuery = mysqli_query($connection, $query);
    if($runQuery){
        echo "success";
    }else{
        echo "failed";
    }
}
if(isset($postData->checkBookingHistory) && $postData->checkBookingHistory == true){
    $userMail = $postData->userMail;
    $query="SELECT `bookingID`, `bookingDateTime`, `toAdd` FROM `tblbookings` where `userMail`= '$userMail' order by bookingDateTime DESC";
    $runQuery = mysqli_query($connection, $query);
    if($runQuery){
        $num_rows = mysqli_num_rows($runQuery);
        $allBookedData = array();
        if($num_rows>0){
            while( $fetchData =  mysqli_fetch_assoc($runQuery)){
               $allBookedData[] = array("bookingID"=>$fetchData['bookingID'],"bookingDateTime"=>date("d/m/Y h:i:s a", strtotime($fetchData['bookingDateTime'])),"toAdd"=>$fetchData['toAdd']);
            }
            $status= "success";
        }else{
            $status= "no record";
        }
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "allBookedData"=>$allBookedData));
}

if(isset($postData->getBookingInfo) && $postData->getBookingInfo == true){
    $bookingID = $postData->bookingId;
    $userMail = $postData->userMail;
    $query="SELECT `bookingID`, `bookingDateTime`, `userMail`, `startDate`, `endDate`, `pickupTime`, `userPhoneNo`, `fromAdd`, `toAdd` FROM `tblbookings` where `bookingID` = $bookingID and `userMail` = '$userMail'";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);
    $BookedData = array();
    if($num_rows>0){
        $fetchData =  mysqli_fetch_assoc($runQuery);
           $BookedData = array("bookingID"=>$fetchData['bookingID'],"bookingDateTime"=>date("d/m/Y h:i:s a", strtotime($fetchData['bookingDateTime'])),"toAdd"=>$fetchData['toAdd'],"userMail"=>$fetchData['userMail'],"startDate"=>date("d/m/Y", strtotime($fetchData['startDate'])),"endDate"=>date("d/m/Y", strtotime($fetchData['endDate'])),"pickupTime"=>date("h:i:s a", strtotime($fetchData['pickupTime'])),"userPhoneNo"=>$fetchData['userPhoneNo'],"fromAdd"=>$fetchData['fromAdd']);
        
        $status= "success";
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "BookedData"=>$BookedData));
}
