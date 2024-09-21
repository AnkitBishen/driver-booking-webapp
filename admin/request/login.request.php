<?php
include("../dbConfig.php");

$checkData = json_decode(file_get_contents("php://input"));

if(!empty($checkData->loginRequest) &&$checkData->loginRequest==true){
    $user = $checkData->username;
    $password = $checkData->password;

    $query = "SELECT `userName`,`role` FROM `tblusers` WHERE `mail`='$user' and userPass='$password'";
    $run = mysqli_query($connection,$query);
    $fetch = mysqli_fetch_assoc($run);
    if($fetch>0){
        if($fetch['role'] == 'Admin'){
            session_name("admin_session");
            session_start();
            $_SESSION['AdminUsername']=$user;
            echo 1;
            exit();
        }
        
        // header("location:../php/profile.php");
    }else{
        echo 2;
        exit();
    }
}