<?php
require_once("../admin/dbConfig.php");

$postData = json_decode(file_get_contents("php://input"));

if(isset($postData->checkCeateAcc) && $postData->checkCeateAcc == true){
    $createName = $postData->createName;
    $createEmail = $postData->createEmail;
    $createPass = $postData->createPass;

    $query = "INSERT INTO `tblusers`(`userName`, `userPass`, `mail`) VALUES ('$createName','$createPass','$createEmail')";
    $runQuery = mysqli_query($connection,$query);
    if($runQuery){
        echo 1;
    }else{
        echo 2;
    }

}

if(isset($postData->checkLogInDetails) && $postData->checkLogInDetails == true){
    $logInName = $postData->logInName;
    $logInPass = $postData->logInPass;

    $status = "failed";
    $userData = [];
    $role = '';

    $query = "SELECT `id`, `userName`, `mail`,`role` FROM `tblusers` WHERE `mail` = '$logInName' and  `userPass` = '$logInPass'";
    $runQuery = mysqli_query($connection, $query);
    $fetch = mysqli_fetch_assoc($runQuery);
    if($fetch){
        if($fetch['role'] == 'User'){
            $status = "success";
            session_name("user_session");
            session_start();
            $_SESSION['userData']=$fetch;
            $userData = $fetch;
            $role = $fetch['role'];
        }
        
    }else{
        $query = "SELECT `empId`, `empName`, `empMail`,`empRole` FROM `allemployes` WHERE `empMail` = '$logInName' and  `empPass` = '$logInPass'";
        $runQuery = mysqli_query($connection, $query);
        $fetchEmp = mysqli_fetch_assoc($runQuery);
        if($fetchEmp){
            if($fetchEmp['empRole'] == 'driver'){
                $status = "success";
                session_name("emp_session");
                session_start();
                $_SESSION['empData']=$fetchEmp;
                $userData = $fetchEmp;
                $role = $fetchEmp['empRole'];
            }
            
        }
    }
    
    echo json_encode(array("status"=>$status, "userData"=>$userData,"role"=>$role));
    

}