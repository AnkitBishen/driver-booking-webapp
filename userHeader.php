<?php
  session_name("user_session");
  session_start();
  if(!isset($_SESSION['userData'])){
      header("Location: ./loginAndCreateAcc.php");
  }
  // print_r($_SESSION);
  $userId = $_SESSION['userData']["id"];
  $userName = $_SESSION['userData']["userName"];
  $userMail = $_SESSION['userData']["mail"];
  $role = $_SESSION['userData']["role"];
?>

<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Company</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
		<!-- bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="admin/assets/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="admin/assets/styles/style.css" />

	</head>
    
	<body>