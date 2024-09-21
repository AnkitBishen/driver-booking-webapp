
<!-- <link rel="stylesheet" href="./adminCss/bookingInfo.css"> -->
<div class="xs-pd-20-10 pd-ltr-20"  ng-controller="userProfileCont" ng-cloak>

    <div class="row clearfix progress-box" >
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <h3 class="text-left pb-2 pl-1">Slot Bookings</h3>
            <div class="card-box pd-10">
                <div class="overflow-auto">
                    <form ng-submit="bookslot(booking,'<?php echo $userMail ?>')">
                        <div class="container m-0">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    
</div>

