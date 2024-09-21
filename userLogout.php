<?php

    if($_GET['r'] == 'User'){
        session_name("user_session");
        session_start();
        if(!isset($_SESSION['userData'])){
            header("Location: ./loginAndCreateAcc.php");
        }else{
            session_unset();
        // session_destroy();
            header("Location: ./loginAndCreateAcc.php");
        }
    }
    else if($_GET['r'] == 'driver'){
        session_name("emp_session");
        session_start();
        if(!isset($_SESSION['empData'])){
            header("Location: ./loginAndCreateAcc.php");
        }else{
            session_unset();
            header("Location: ./loginAndCreateAcc.php");
        }
    }
    