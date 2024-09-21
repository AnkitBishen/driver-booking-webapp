slotBookingApp.controller('loginAndCreateAccCont', function($scope, $http){

    $scope.isLoginContaier = true;
    $scope.showLoginOrCreateBox = function(condition){
        if( $scope.isLoginContaier == condition){
            $scope.isLoginContaier = condition
        }else{
            $scope.isLoginContaier = condition
        }
    }

    // create Account ===========
    // $scope.createName='';
    $scope.createAcc= function(createName,createEmail,createPass){
        
        if(createName == '' || createName == undefined || createName == null){
            alert('Name not filled')
        }else if(createEmail == '' || createEmail == undefined || createEmail == null){
            alert('email not filled')
        }else if(createPass == '' || createPass == undefined || createPass == null){
            alert('pass not filled')
        }else{
            $http({
                method:"POST",
                url:"./requests/checkLogin.request.php",
                data:{"createName":createName,"createEmail":createEmail,"createPass":createPass,"checkCeateAcc":true},
            }).then(function(response){
                if(response.data == 1){
                    $scope.isLoginContaier = true;
                }else{
                    $scope.isLoginContaier = false;
                }
            });
        }
    }

    // login account ============
    $scope.login = function(logInName,logInPass){

        if(logInName == '' || logInName == undefined || logInName == null){
            alert('Name not filled')
        }else if(logInPass == '' || logInPass == undefined || logInPass == null){
            alert('Pass not filled')
        }else
        {
            $http({
                method:"POST",
                url:"./requests/checkLogin.request.php",
                data:{"logInName":logInName,"logInPass":logInPass,"checkLogInDetails":true},
            }).then(function(response){
                if(response.data.status == "success"){
                    if(response.data.role == "User"){
                        window.location.href = "./userProfile.php";
                    }
                    else if(response.data.role == "driver"){
                        window.location.href = "./empProfile.php";
                    }
                }else{
                    alert("failed");
                }
            });
        }
    }

})