<?php
  //  include("sideInfo.html");
   // session_start();
    if(!isset($_SESSION['AdminUsername'])){
        header("location:login.php");
    }
?>
<link rel="stylesheet" href="./adminCss/bookingInfo.css">

<div class="xs-pd-20-10 pd-ltr-20"  ng-controller="bookingInfoController" ng-cloak ng-init="getBookingData(1,5)">

    <div class="row clearfix progress-box" >
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <h3 class="text-left pb-2 pl-1">Bookings</h3>
            <div class="card-box pd-10">
                <div class="overflow-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Booking ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Appoint to</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="bookingDetail in bookingDetails">
                                <td>{{bookingDetail.bookingID}}</td>
                                <td>{{bookingDetail.userName}}</td>
                                <td>{{bookingDetail.fromAdd}} to {{bookingDetail.toAdd}}</td>
                                <td>{{bookingDetail.startDate}} - {{bookingDetail.endDate}}</td>
                                <td>{{bookingDetail.BookedStatus}}</td>
                                <td>{{bookingDetail.empName}}</td>
                                <td class="pl-0 pr-0 d-flex justify-content-evenly" ng-hide="bookingDetail.BookedStatus == 'complete'">
                                    <button class="btn btn-success action_btn p-1 rounded mr-2" title="Approve" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" ng-if="bookingDetail.BookedStatus == 'pending' || bookingDetail.BookedStatus == 'rejected'" ng-click="passbookingIdFun(bookingDetail.bookingID,bookingDetail.userMail,bookingDetail.userName); getEmpDriver()" >
                                        <img src="../images/icons/check-lg.svg" alt="">
                                    </button>
                                    <button class="btn btn-warning action_btn p-1 rounded mr-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" ng-if="bookingDetail.BookedStatus != 'pending'" ng-hide="bookingDetail.BookedStatus == 'rejected' " ng-click="passbookingIdFun(bookingDetail.bookingID,bookingDetail.userMail,bookingDetail.userName); getEmpDriver()">
                                        <img src="../images/icons/edit.svg" alt="" title="Edit">
                                    </button>
                                    <button class="btn btn-danger action_btn p-1 rounded mr-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" ng-click="passbookingIdFun(bookingDetail.bookingID,bookingDetail.userMail,bookingDetail.userName)">
                                        <img src="../images/icons/delete-icon.svg" alt="" title="Decline">
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- pagination -->
                <nav class="m-4 d-flex justify-content-between" aria-label="Page navigation example">
                    <div class="align-self-center">
                        <p><b>Total Bookings</b> : {{totalRecords}}</p>
                    </div>
                    <ul class="pagination justify-content-center">
                        <li class="page-item p-2" ng-click="getBookingData(currentPage-1,5)" ng-show="currentPage>1"><button class="btn btn-primary" style="font-size:14px; padding: 5px 12px;"> Previous</button></li>
                        <li class="page-item p-2" style="font-size:20px">{{currentPage}}/{{totalPage}}</li>
                        <li class="page-item p-2" ng-click="getBookingData(currentPage+1,5)" ng-show="currentPage<totalPage"><button class="btn btn-primary" style="font-size:14px; padding: 5px 12px;"> Next</button></li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
    <br>
    <br>
    

    <!-- Modal 1 (approved) -->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Appoint To</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <!-- <label class="input-group-text" for="inputGroupSelect01">Drivers</label> -->
                    <select class="form-select" id="inputGroupSelect01" ng-model="selectedEmp">
                        <option selected>Choose...</option>
                        <option ng-value="driverDetail.empId" ng-repeat="driverDetail in driverDetails">{{driverDetail.empName}}</option>
                    </select>
                </div>
                <p class="text-danger" style="font-size:13px;" ng-show="isDriverSelected == false">Please select driver to Appoint</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ng-click="approvedClick('no')">No</button>
                <button type="button" class="btn btn-primary" ng-click="approvedClick('yes')">Yes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 (Edit) -->
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                        <!-- <label class="input-group-text" for="inputGroupSelect01">Drivers</label> -->
                        <select class="form-select" id="inputGroupSelect01" ng-model="selectedEmp">
                            <option selected>Choose...</option>
                            <option ng-value="driverDetail.empId" ng-repeat="driverDetail in driverDetails">{{driverDetail.empName}}</option>
                        </select>
                    </div>
                    <p class="text-danger" style="font-size:13px;" ng-show="isDriverSelected == false">Please select driver to Appoint</p>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ng-click="ReApprovedClick('no')">No</button>
                <button type="button" class="btn btn-primary" ng-click="ReApprovedClick('yes')">Yes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 (decline) -->
    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you Sure ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ng-click="declineBookings('no')">No</button>
                <button type="button" class="btn btn-primary" ng-click="declineBookings('yes')">Yes</button>
            </div>
            </div>
        </div>
    </div>

</div>

