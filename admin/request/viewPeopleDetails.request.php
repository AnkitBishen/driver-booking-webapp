<?php
include("../dbConfig.php");

$checkData = json_decode(file_get_contents("php://input"));

if(isset($checkData->getClientData) && $checkData->getClientData==true){
    $page = $checkData->page;
    $limit = $checkData->limit;
    $offset = ($page-1)*$limit;

    // geting total pages and records 
    $query1="SELECT id FROM `tblusers` where `role`!='Admin'";
    $runQuery1 = mysqli_query($connection, $query1);
    $num_rows1 = mysqli_num_rows($runQuery1);
    if($num_rows1>0){
        $total_record = $num_rows1;
        $total_page = ceil($total_record / $limit);
    }else {
        $total_record=0;
        $total_page=0;
    }

    $query="SELECT `id`, `userName`, `mail` FROM `tblusers`  where `role`!='Admin' ORDER by `id` DESC LIMIT {$offset}, {$limit}";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);

    $clientData = array();
    if($num_rows>0){
        while($fetchData =  mysqli_fetch_assoc($runQuery)){
           $clientData[] = array("userName"=>$fetchData['userName'],"clientID"=>$fetchData['id'],"mail"=>$fetchData['mail']);
        }

        $status= "success";
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "clientData"=>$clientData,"total_page"=>$total_page,"total_record"=>$total_record));
}
else if(isset($checkData->checkDriverData) && $checkData->checkDriverData==true){
    $page = $checkData->page;
    $limit = $checkData->limit;
    $offset = ($page-1)*$limit;

    $query = "SELECT empId FROM `allemployes` WHERE `empRole` = 'driver'";
    $runQuery = mysqli_query($connection, $query);
    $num_rows1 = mysqli_num_rows($runQuery);
    if($num_rows1>0){
        $total_record = $num_rows1;
        $total_page = ceil($total_record / $limit);
    }else {
        $total_record=0;
        $total_page=0;
    }

    $query="SELECT empId, empName, empMail, empPhoneNumber FROM `allemployes` WHERE `empRole` = 'driver' ORDER by `empId` DESC LIMIT {$offset}, {$limit}";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);

    $driverData = array();
    if($num_rows>0){
        while($fetchData =  mysqli_fetch_assoc($runQuery)){
           $driverData[] = array("empName"=>$fetchData['empName'],"empId"=>$fetchData['empId'],"empMail"=>$fetchData['empMail'],"empPhoneNumber"=>$fetchData['empPhoneNumber']);
        }

        $status= "success";
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "driverData"=>$driverData,"total_page"=>$total_page,"total_record"=>$total_record));

}
else if(isset($checkData->checkEmpOtherData) && $checkData->checkEmpOtherData==true){
    $page = $checkData->page;
    $limit = $checkData->limit;
    $offset = ($page-1)*$limit;

    $query = "SELECT empId FROM `allemployes` WHERE `empRole` = 'other'";
    $runQuery = mysqli_query($connection, $query);
    $num_rows1 = mysqli_num_rows($runQuery);
    if($num_rows1>0){
        $total_record = $num_rows1;
        $total_page = ceil($total_record / $limit);
    }else {
        $total_record=0;
        $total_page=0;
    }

    $query="SELECT empId, empName, empMail, empPhoneNumber FROM `allemployes` WHERE `empRole` = 'other' ORDER by `empId` DESC LIMIT {$offset}, {$limit}";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);

    $empOtherData = array();
    if($num_rows>0){
        while($fetchData =  mysqli_fetch_assoc($runQuery)){
           $empOtherData[] = array("empName"=>$fetchData['empName'],"empId"=>$fetchData['empId'],"empMail"=>$fetchData['empMail'],"empPhoneNumber"=>$fetchData['empPhoneNumber']);
        }

        $status= "success";
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "empOtherData"=>$empOtherData,"total_page"=>$total_page,"total_record"=>$total_record));

}