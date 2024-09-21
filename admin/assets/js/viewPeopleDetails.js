adminApp.controller('viewPeopleDetailsCont', function($scope,$http){

    // get client details *********
    $scope.getClientData = function(page, limit){
        $scope.currentPage = page;

        $http({
            method:'POST',
            url:"request/viewPeopleDetails.request.php",
            data: {'page':page,'limit':limit,'getClientData':true}
        }).then(function(response){
            if(response.data.status == "success"){
                $scope.clientDetails = response.data.clientData;
                $scope.totalPage = response.data.total_page;
                $scope.totalRecords = response.data.total_record;
            }
            // console.log($scope.bookingDetails);
        }, function(response){
            $("#error-msg").html("Failed to load Categories.").slideDown();
            $("#success-msg").slideUp();
        })
    }

     // get Driver details *********
     $scope.getDriverData = function(page, limit){
        $scope.DcurrentPage = page;

        $http({
            method:'POST',
            url:"request/viewPeopleDetails.request.php",
            data: {'page':page,'limit':limit,'checkDriverData':true}
        }).then(function(response){
            if(response.data.status == "success"){
                $scope.driverDatas = response.data.driverData;
                $scope.driverTotalPage = response.data.total_page;
                $scope.driverTotalRecords = response.data.total_record;
            }
            // console.log($scope.bookingDetails);
        }, function(response){
            $("#error-msg").html("Failed to load Categories.").slideDown();
            $("#success-msg").slideUp();
        })
    }
     // get Driver details *********
     $scope.getEmpOtherData = function(page, limit){
        $scope.EOcurrentPage = page;

        $http({
            method:'POST',
            url:"request/viewPeopleDetails.request.php",
            data: {'page':page,'limit':limit,'checkEmpOtherData':true}
        }).then(function(response){
            if(response.data.status == "success"){
                $scope.empOtherDatas = response.data.empOtherData;
                $scope.empOtheTotalPage = response.data.total_page;
                $scope.empOtheTotalRecords = response.data.total_record;
            }
            // console.log($scope.bookingDetails);
        }, function(response){
            $("#error-msg").html("Failed to load Categories.").slideDown();
            $("#success-msg").slideUp();
        })
    }
})