<?php
include("../dbConfig.php");

$checkData = json_decode(file_get_contents("php://input"));

if(isset($checkData->checkNotification) && $checkData->checkNotification==true){
    
    // Ankit has made a booking for the date of 12/03/2023
    $query = "SELECT t2.userName, t1.bookingID, t1.startDate FROM `tblbookings` as t1 JOIN `tblusers` as t2 ON t1.userMail = t2.mail WHERE notificationStatus = 1 order by bookingDateTime DESC";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);
    $data = array();
    if($num_rows>0){
        while($fetchData =  mysqli_fetch_assoc($runQuery)){
           $data[] = array("userName"=>$fetchData['userName'],"bookingID"=>$fetchData['bookingID'],"startDate"=>date("d/m/Y", strtotime($fetchData['startDate'])));
        }

        $status= "success";
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "notifiData"=>$data));
    
}
else if(isset($checkData->updateNotification) && $checkData->updateNotification==true){

    $query = "UPDATE `tblbookings` SET `notificationStatus`='0'";
    $runQuery = mysqli_query($connection, $query);
    if($runQuery){
        echo 1;
    }
    else{
        echo 2;
    }
}
else if(isset($checkData->getOnDutyEmp) && $checkData->getOnDutyEmp==true){

    $query = "SELECT emp.empName, t1.bookingID, t2.userName, t1.fromAdd, t1.toAdd FROM `allemployes` as emp JOIN `tblbookings` as t1 on emp.empId = t1.appointTo and t1.BookedStatus = 'ontheway' JOIN `tblusers` as t2 on t2.mail = t1.userMail";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);
    $Data= [];
    if($num_rows>0){
        while($fetchData =  mysqli_fetch_assoc($runQuery)){
            $Data[] = array("empName"=>$fetchData['empName'],"toAdd"=>$fetchData['toAdd'],"fromAdd"=>$fetchData['fromAdd'],"clientName"=>$fetchData['userName']);
        }
           
        
        $status= "success";
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "Data"=>$Data));
}