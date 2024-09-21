
<div class="xs-pd-20-10 pd-ltr-20"  ng-controller="userProfileCont" ng-cloak>

    <div class="row clearfix progress-box" >
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <h3 class="text-left pb-2 pl-1">Bookings History</h3>
            <div class="card-box pd-10">
                <div class="overflow-auto">
                    <!-- search icons end  -->
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Search" ng-model="searchHistory">
                        <div class="input-group-append">
                        <button class="btn btn-secondary search-btn" type="button" style="">
                            <i class="bi bi-search" style="color: #000000;"></i>
                        </button>
                        </div>
                    </div>
                    <!-- search icons end  -->
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
            </div>
        </div>
    </div>
    <br>
    <br>

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