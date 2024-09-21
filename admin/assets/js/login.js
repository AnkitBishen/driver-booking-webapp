var adminapp = angular.module('adminapp', []);

adminapp.controller('adminLoginCont', function($scope, $http){

    $scope.login = function(user,pass,role){
        // alert(role);
        $http({
            method:'POST',
            url: "./request/login.request.php",
            data: {'username':user,'password':pass,'loginRequest':true}
        }).then(function(response){
            $scope.Data = response.data;
            console.log($scope.Data);
            window.location.href = "view.php";
        }, function(response){
            $("#error-msg").html("Invalid Email and Password").slideDown();
            $("#success-msg").slideUp();
            // $scope.refreshPage();
        })
    }
})