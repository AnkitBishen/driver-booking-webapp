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
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="css/userProfile.css">
<body ng-app="slotBookingApp" ng-controller="userProfileCont">

    <!-- ********* nav bar ********* -->
    <div class="row ml-0 mr-0 bg-white pt-3 pb-3 fixed-top navbar-cont">
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            slot booking
        </div>
    </div>
    
    <div class="row ml-4 mt-5 mr-4 justify-content-center">

        <!-- ********* profile ********* -->
        <!-- <div class="row ml-0 w-100">  -->
            <div class="col-sm-8 col-md-10 col-lg-12 bg-white mt-5 profile-container">
                <ul class="profiles pl-0 d-flex justify-content-between mt-3    ">
                    <li class="w-80">
                        <div class="d-flex justify-content-left align-items-center w-100">
                            <img src="./images/loginbackgrd.png" class="rounded-circle" alt="">
                            <div class="ml-3">
                                <h3><?php echo $userName ?></h3>
                                <p><?php echo $userMail ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="w-20 text-center align-self-center"><a href="userLogout.php?r=<?php echo $role ?>"> <button class="button">log out</button></a></li>
                </ul>
            </div> 
        <!-- </div> -->

        <!-- ********* slot booking ********* -->
        <!-- <div class="row ml-0 w-100">  -->
            <div class="col-sm-8 col-md-10 col-lg-12 bg-white mt-5 profile-container p-4">
                <h2 class="mb-4 font-weight-bold">Slot Booking</h2>
                <div class="book-main-container">
                    <form ng-submit="bookslot(booking,'<?php echo $userMail ?>')">
                        <div class="row mb-2">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <p for="">Start Date</p>
                                <input type="date" name="" id="" ng-model="booking.startDate">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <p for="">End Date</p>
                                <input type="date" name="" id="" ng-model="booking.EndDate">
                            </div>  
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <p for="">Pickup Time</p>
                                <input type="time" name="" id="" ng-model="booking.pickupTime">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <p for="">Phone Number</p>
                                <input type="number" name="" id="" ng-model="booking.phoneNumber">
                            </div>  
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p for="">From</p>
                                <textarea name="" id="" ng-model="booking.fromAddress"></textarea>
                            </div> 
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p for="">To</p>
                                <textarea name="" id="" ng-model="booking.toAddress"></textarea>
                            </div> 
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="button">
                            </div> 
                        </div>
                    </form>
                </div>
                    <!-- try this color before hover on button #ffd43b -->
                <!-- ******** Booking history ******** -->
                <h2 class="mb-4 mt-5 font-weight-bold">Booking History</h2>
                <!-- search icons  -->
                <div class="input-group mb-4">
                    <input type="text" class="form-control" placeholder="Search" ng-model="searchHistory">
                    <div class="input-group-append">
                    <button class="btn btn-secondary search-btn" type="button" style="">
                    <i class="bi bi-search" style="color: #000000;"></i>
                    </button>
                    </div>
                </div>
                 <!-- search icons  -->
                <div class="book-main-container" ng-init="getBookingHistory('<?php echo $userMail ?>')">
                    <div class="booked-data border-bottom history-hover p-2" ng-repeat="Bdata in allBookedData | filter : searchHistory" ng-click="getBookingInfo(Bdata.bookingID,'<?php echo $userMail ?>')">
                        <div class="">
                            <h5>To {{Bdata.toAdd}}</h5>
                            <p class="m-0">Booking Time : {{Bdata.bookingDateTime}}</p>
                        </div>
                    </div>
                    <div ng-if="isbookingAvailable == false">
                        <p class="text-center">There is no Bookings</p>
                    </div>
                </div>

            
            </div>
            

        <!-- </div> -->


        <div class="bookedDataContainer" id="bookedDataContainer_id">
            <div class="popup_conatiner">
                <div class="text-right w-100 cross_class" ng-click="crossBtn()">X</div>
                <div class="container ">
                    <div class="row border-bottom pt-2 pb-3">
                        <div class="col-md-6">
                            <h6>From</h6>
                            <h2>{{BookedData.fromAdd}}</h2>
                            <span>{{BookedData.startDate}}</span>
                        </div>
                        <div class="col-md-6">
                            <h6>To</h6>
                            <h2>{{BookedData.toAdd}}</h2>
                            <span>{{BookedData.endDate}}</span>
                        </div>
                    </div>
                    <div class="row pt-3 other-details-cont">
                        <div class="col-md-12">
                            <p><b>E-Mail : </b> {{BookedData.userMail}}</p>
                            <p><b>Phone Number : </b> {{BookedData.userPhoneNo}}</p>
                            <p><b>Booking Time : </b> {{BookedData.bookingDateTime}}</p>
                            <p><b>pickup Time : </b> {{BookedData.pickupTime}}</p>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="col-md-12 text-center">
                        <button ng-click="downloadPDF(BookedData.bookingID, BookedData.userMail)">Print</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <br>
    <br>

</body>
<?php require("footerLinks.php"); ?>
<script type='text/javascript' src='js/userProfile.js'></script>