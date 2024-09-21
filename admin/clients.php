<?php
   // include("sideInfo.html");
   // session_start();
    if(!isset($_SESSION['AdminUsername'])){
        header("location:login.php");
    }
    
?>
<link rel="stylesheet" href="./adminCss/bookingInfo.css">

<div class="xs-pd-20-10 pd-ltr-20"  ng-controller="viewPeopleDetailsCont" ng-cloak ng-init="getClientData(1,4)">

    <div class="row clearfix progress-box" >
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <h3 class="text-left pl-1 pb-2">Clients</h3>
            <div class="card-box pd-10">
                <div class="overflow-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Client ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mail</th>
                                <!-- <th scope="col">Date</th>
                                <th scope="col">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="clientDetail in clientDetails">
                                <td>{{clientDetail.clientID}}</td>
                                <td>{{clientDetail.userName}}</td>
                                <td>{{clientDetail.mail}}</td>
                                <!-- <td>{{bookingDetail.startDate}} - {{bookingDetail.endDate}}</td> -->
                                <!-- <td class="pl-0 pr-0 d-flex justify-content-evenly">
                                    <button class="btn btn-success action_btn p-1 rounded mr-2" title="Approve" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" ng-if="bookingDetail.BookedStatus == 'pending' || bookingDetail.BookedStatus == 'rejected'" ng-click="passbookingIdFun(bookingDetail.bookingID,bookingDetail.userMail,bookingDetail.userName)">
                                        <img src="../images/icons/check-lg.svg" alt="">
                                    </button>
                                    <button class="btn btn-warning action_btn p-1 rounded mr-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                        <img src="../images/icons/msg-icon.svg" alt="" title="Message">
                                    </button>
                                    <button class="btn btn-danger action_btn p-1 rounded mr-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" ng-click="passbookingIdFun(bookingDetail.bookingID,bookingDetail.userMail,bookingDetail.userName)">
                                        <img src="../images/icons/delete-icon.svg" alt="" title="Decline">
                                    </button>
                                </td> -->
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
                        <li class="page-item p-2" ng-click="getClientData(currentPage-1,4)" ng-show="currentPage>1"><button class="btn btn-primary" style="font-size:14px; padding: 5px 12px;"> Previous</button></li>
                        <li class="page-item p-2" style="font-size:20px">{{currentPage}}/{{totalPage}}</li>
                        <li class="page-item p-2" ng-click="getClientData(currentPage+1,4)" ng-show="currentPage<totalPage"><button class="btn btn-primary" style="font-size:14px; padding: 5px 12px;"> Next</button></li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

    <!-- Modal 1 (approved) -->
    <!-- <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ng-click="approvedClick('no')">No</button>
                <button type="button" class="btn btn-primary" ng-click="approvedClick('yes')">Yes</button>
            </div>
            </div>
        </div>
    </div> -->

    <!-- Modal 2 (mesg) -->
    <!-- <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               message
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
            </div>
        </div>
    </div> -->

    <!-- Modal 3 (decline) -->
    <!-- <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    </div> -->

</div>

