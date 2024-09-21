// var viewApp = angular.module('viewApp',[]);

adminApp.controller('viewCont', function($scope,$http){

    $scope.isNotification = false;
    $scope.getNotifications = function(){
        $http({
            method:'POST',
            url:'request/view.request.php',
            data:{'checkNotification':true}
        }).then(function(response){
            $scope.notificationStatus =response.data.status;
            $scope.notificationData =response.data.notifiData;
            if($scope.notificationData == '' || $scope.notificationData == null){
                $scope.isNotification = false;
            }else{
                $scope.isNotification = true;
            }
            
        }).catch(function(response){
            alert('something went wrong.')
        })
    }

    setInterval(() => {
       // $scope.getNotifications();
    }, 30000);

    $scope.updateNotification =  function(){
        $http({
            method:'POST',
            url:'request/view.request.php',
            data:{'updateNotification':true}
        }).then(function(response){
            if(response.data == 1){
                $scope.isNotification = false;
            }else{
                $scope.isNotification = true;
            }
        }).catch(function(response){
            alert('something went wrong.')
        })
    }

    $scope.isRefreshBtnClicked = false;
    $scope.isNoOnDutyData = false;
    $scope.getOnDutyEmp =  function(){
        $scope.isRefreshBtnClicked = true;
        $http({
            method:'POST',
            url:'request/view.request.php',
            data:{'getOnDutyEmp':true}
        }).then(function(response){
            $scope.onDutyData = response.data.Data;
        }).catch(function(response){
            $scope.isNoOnDutyData = true;
            alert('something went wrong.')
        })
    }

})