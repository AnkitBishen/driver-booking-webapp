slotBookingApp.controller('userProfileCont', function($scope, $http){

    $scope.refreshPage = function(){
        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    $scope.bookslot= function(booking, userMail){
         console.log(booking);
        $http({
            method:'POST',
            url:"./requests/getBooking.request.php",
            data:{"bookingData":booking,"userMail":userMail, "bookingSlot":true}
        }).then(function(response){
            if(response.data == 'success'){
                $scope.isbookingAvailable = true;
                alert('your slot is booked successfully');
                $scope.refreshPage();
            }
            else if(response.data == 'no record'){
                $scope.isbookingAvailable = false;
            }
            else{
                $scope.isbookingAvailable = true;
                alert('somthing is wrong please try after sometime');
            }
        })
    }

    $scope.getBookingHistory= function(userMail){
        // console.log(userMail);
        $http({
            method:'POST',
            url:"./requests/getBooking.request.php",
            data:{"checkBookingHistory":true, "userMail":userMail}
        }).then(function(response){
            if(response.data.status == 'success'){
                $scope.allBookedData =response.data.allBookedData;
                // console.log($scope.allBookedData);
            }else{
                alert('somthing is wrong please try after sometime');
            }
        })
    }

    $scope.getBookingInfo= function(bookingId,userMail){
        // console.log(userMail);
        $http({
            method:'POST',
            url:"./requests/getBooking.request.php",
            data:{"getBookingInfo":true,"bookingId":bookingId,"userMail":userMail}
        }).then(function(response){
            if(response.data.status == 'success'){
                $scope.BookedData =response.data.BookedData;
                console.log($scope.BookedData);
                var bookedDataContainer_id = document.getElementById("bookedDataContainer_id");
                bookedDataContainer_id.style.display="flex";
            }else{
                alert('somthing is wrong please try after sometime');
            }
        })
    }

    $scope.crossBtn = function(){
        var bookedDataContainer_id = document.getElementById("bookedDataContainer_id");
        bookedDataContainer_id.style.display="none";
    }

    $scope.downloadPDF = function(bId, uMail){
        window.open("./requests/export-pdf.php?getdownloadPDF=true&bookingId="+bId+"&userMail="+uMail);
    }
})