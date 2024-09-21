<?php
    // include("sideInfo.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link rel="stylesheet" href="adminCss/login.css">
</head>

<body class="align" ng-app="adminapp" ng-controller="adminLoginCont">
    <h2 class="text-white" style=" color: #ffffff; font-size: 35px; margin-top:0px; margin-bottom: 19px;">aadharinfo</h2>
    <div class="grid login-container">
        <form class="form login" ng-submit="login(inp_userName,inp_password,'Admin')">
            <div class="form__field">
                <label for="login__username"><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="hidden">Username</span></label>
                <input id="login__username" type="text" name="username" class="form__input" placeholder="Username" ng-model="inp_userName" required>
            </div>
            <div class="form__field">
                <label for="login__password"><i class="fa-solid fa-lock" style="color: #ffffff;"></i><span class="hidden">Password</span></label>
                <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" ng-model="inp_password" required>
            </div>
            <div class="form__field">
                <input type="submit" value="Sign In">
            </div>  
        </form>
        <!-- <p class="text--center">Not a member? <a href="#">Sign up now</a> <svg class="icon"></svg></p> -->
    </div>



    <script src="../js/angularjs/angular.min.js"></script>
    <script src="./assets/js/login.js"></script>
    <script src="../js/jquery.js"></script>
    <!-- <script src="./assets/js/login.js"></script> -->
</body>
</html>
