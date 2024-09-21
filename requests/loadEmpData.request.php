<?php
require_once("../admin/dbConfig.php");
$postData = json_decode(file_get_contents("php://input"));

if(isset($postData->getToadyDuty) && $postData->getToadyDuty == true){
    $dMail = $postData->umail;
    $query = "SELECT emp.empName, t1.bookingID, t2.userName, t1.startDate, t1.endDate, t1.pickupTime, t1.fromAdd, t1.toAdd, t1.userPhoneNo FROM `allemployes` as emp JOIN `tblbookings` as t1 on emp.empId = t1.appointTo and t1.BookedStatus = 'approved' JOIN `tblusers` as t2 on t2.mail = t1.userMail where emp.empMail = '$dMail'";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);
    $Data= [];
    if($num_rows>0){
        $fetchData =  mysqli_fetch_assoc($runQuery);
           $Data = array("bookingID"=>$fetchData['bookingID'],"toAdd"=>$fetchData['toAdd'],"startDate"=>date("d/m/Y", strtotime($fetchData['startDate'])),"endDate"=>date("d/m/Y", strtotime($fetchData['endDate'])),"pickupTime"=>date("h:i:s a", strtotime($fetchData['pickupTime'])),"userPhoneNo"=>$fetchData['userPhoneNo'],"fromAdd"=>$fetchData['fromAdd'],"clientName"=>$fetchData['userName']);
        
        $status= "success";
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "Data"=>$Data));
}
else if(isset($postData->getCompleteDuty) && $postData->getCompleteDuty == true){
    $dCondition = $postData->dCondition;
    $bookedId = $postData->bookedId;
    $dMail = $postData->dMail;

    if($dCondition == 'start'){
        $query = "UPDATE `tblbookings` SET `BookedStatus`='ontheway' WHERE `bookingID` = '$bookedId'";
        $runQuery = mysqli_query($connection,$query);
        if($runQuery){
            echo 3;
        }
    } 
    else{
        // update booking status 
        $query = "UPDATE `tblbookings` SET `BookedStatus`='complete' WHERE `bookingID` = '$bookedId'";
        $runQuery = mysqli_query($connection,$query);
        if($runQuery){
            //update driver duty status for next
            $query2 = "UPDATE `allemployes` SET `appointed`='0' WHERE `empMail` = '$dMail'";
            $runQuery2 = mysqli_query($connection,$query2);
            if($runQuery2){
                echo 1; //success
            }else{
                echo 2; //failed
            }
        }
    }
}