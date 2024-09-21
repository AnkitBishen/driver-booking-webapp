// var bookinginfo = angular.module('bookinginfo',[]);

adminApp.controller('bookingInfoController', function($scope, $http){

    $scope.refreshPage = function(){
        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    $scope.getBookingData = function(page,limit){
        $scope.currentPage = page;

        $http({
            method:'POST',
            url:"request/loadData.request.php",
            data: {'page':page,'limit':limit,'getBookingData':true}
        }).then(function(response){
            if(response.data.status == "success"){
                $scope.bookingDetails = response.data.BookedData;
                $scope.totalPage = response.data.total_page;
                $scope.totalRecords = response.data.total_record;
            }
            // console.log($scope.bookingDetails);
        }, function(response){
            $("#error-msg").html("Failed to load Categories.").slideDown();
            $("#success-msg").slideUp();
        })
    }


    // decline bookings 
    $scope.passbookingIdFun = function(itemid, userMail, userName){
        $scope.passbookingId = itemid;
        $scope.userMail = userMail;
        $scope.userName = userName;
    }

    $scope.declineBookings = function(option){
        if(option == 'no'){
            $scope.passbookingId = '';
            $scope.userMail = '';
            $scope.userName = '';
            return;
        }
        $http({
            method:'POST',
            url:"request/loadData.request.php",
            data: {'bId': $scope.passbookingId,'userMail':$scope.userMail,'userName':$scope.userName,'declineBookingData':true}
        }).then(function(response){
            if(response.data == 1){
                alert("delete");
                $scope.refreshPage();
            }else{
                alert("failed");
            }
        }, function(response){
            $("#error-msg").html("Failed to Delete.").slideDown();
            $("#success-msg").slideUp();
        })

        $scope.passbookingId = '';
        $scope.userMail = '';
        $scope.userName = '';
    }

    $scope.selectedEmp="";
    $scope.isDriverSelected=true;
    $scope.approvedClick=function(option){
       // console.log($scope.selectedEmp);
        if(option == 'no'){
            $scope.isDriverSelected = true;
            $scope.passbookingId = '';
            $scope.userMail = '';
            $scope.userName = '';
            return;
        }
        if($scope.selectedEmp == ""){
            $scope.isDriverSelected = false;
        }
        else{
            $http({
                method:'POST',
                url:"request/loadData.request.php",
                data: {'bId': $scope.passbookingId,'userMail':$scope.userMail,'userName':$scope.userName,'selectedEmp':$scope.selectedEmp,'approveBookingData':true}
            }).then(function(response){
                if(response.data == 1){
                    alert("Approved");
                }else{
                    alert("failed");
                }
               $scope.refreshPage();
            }, function(response){
                $("#error-msg").html("Failed to Delete.").slideDown();
                $("#success-msg").slideUp();
            })
            $scope.isDriverSelected = true;
            
            $scope.passbookingId = '';
            $scope.userMail = '';
            $scope.userName = '';
        }

        
    }

    $scope.selectedEmp="";
    $scope.isDriverSelected=true;
    $scope.ReApprovedClick=function(option){
       // console.log($scope.selectedEmp);
        if(option == 'no'){
            $scope.isDriverSelected = true;
            $scope.passbookingId = '';
            $scope.userMail = '';
            $scope.userName = '';
            return;
        }
        if($scope.selectedEmp == ""){
            $scope.isDriverSelected = false;
        }
        else{
            $http({
                method:'POST',
                url:"request/loadData.request.php",
                data: {'bId': $scope.passbookingId,'userMail':$scope.userMail,'userName':$scope.userName,'selectedEmp':$scope.selectedEmp,'ReApproveBookingData':true}
            }).then(function(response){
                if(response.data == 1){
                    alert("Approved");
                }else{
                    alert("failed");
                }
                $scope.refreshPage();
            }, function(response){
                $("#error-msg").html("Failed to Delete.").slideDown();
                $("#success-msg").slideUp();
            })
            $scope.isDriverSelected = true;
            
            $scope.passbookingId = '';
            $scope.userMail = '';
            $scope.userName = '';
        }

        
    }

    $scope.getEmpDriver = function(){
        $http({
            method:'POST',
            url:"request/loadData.request.php",
            data: {'getEmpDriver':true}
        }).then(function(response){
            if(response.data.status == "success"){
                $scope.driverDetails = response.data.driverData;
            }
        }, function(response){
            $("#error-msg").html("Failed to load Categories.").slideDown();
            $("#success-msg").slideUp();
        })
    }

})