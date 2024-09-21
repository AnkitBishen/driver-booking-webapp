empApp.controller('empViewCont', function($scope, $http){

    $scope.refreshPage = function(){
        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    $scope.isDutyAvailable=false;
    $scope.getTodayDuty = function(uMail){
        
        $http({
            url:"./requests/loadEmpData.request.php",
            method:"POST",
            data:{"getToadyDuty":true, "umail":uMail}
        }).then(function(response){
            if(response.data.status == "success"){
                $scope.dutyData = response.data.Data;
                $scope.isDutyAvailable=true;
            }
        }).catch(function(response){
            alert("wrong");
            $scope.isDutyAvailable=false;
        })
    }

    $scope.showCompleteBtn = false;
    $scope.completeClick= function(dCondition,dMail, bookedId){
        $http({
            url:"./requests/loadEmpData.request.php",
            method:"POST",
            data:{"getCompleteDuty":true, "dCondition":dCondition, "dMail":dMail, "bookedId":bookedId}
        }).then(function(response){
            if(response.data == 1){
                $scope.refreshPage();
                $scope.isDutyAvailable=false;
            }
            else if(response.data == 3){
                $scope.showCompleteBtn = true;
            }
        }).catch(function(response){
            alert("wrong");
            $scope.isDutyAvailable=false;
        })
    }
})