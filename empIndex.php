<style>
	.booked-data ul{
		font-size:13px;
	}
</style>
<div class="xs-pd-20-10 pd-ltr-20" ng-controller="empViewCont">
	<!-- <div class="row clearfix progress-box">
		<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
			<div class="card-box pd-30 height-100-p">
				<div class="progress-box text-center">
					<h2>4</h2>
					<h5 class="text-blue padding-top-10 h5">Total Categories</h5>
					</span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
			<div class="card-box pd-30 height-100-p">
				<div class="progress-box text-center">
				<h2>24</h2>
					<h5 class="text-light-green padding-top-10 h5"> Total Posts</h5>
					</span>
				</div>
			</div>
		</div>
	</div> -->


	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
            <h3 class="text-left pb-2 pl-1">Today's Duty</h3>
			<div class="card-box pd-30">
                <div class="row book-main-container" ng-init="getTodayDuty('<?php echo $userMail ?>')">
                    <div class="col-lg-10 col-md-12 col-sm-12 booked-data p-2" ng-if="isDutyAvailable == true">
                            <p>Your duty has been scheduled with <b>{{dutyData.clientName}}</b>. Here is the other details :-</p>
                            <ul>
								<li>From <b>{{dutyData.fromAdd}}</b> to <b>{{dutyData.toAdd}}</b></li>
								<li><b>{{dutyData.startDate}}</b> - <b>{{dutyData.endDate}}</b></li>
								<li>Pickup Time <b>{{dutyData.pickupTime}}</b></li>
								<li>Phone Number <b>{{dutyData.userPhoneNo}}</b></li>
							</ul>
                    </div>
                    <div class="col-lg-2 col-md-12 col-sm-12 align-self-center" ng-if="isDutyAvailable == true">
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop" ng-if="showCompleteBtn == false">Start</button>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" ng-if="showCompleteBtn == true">Complete</button>
                    </div>
                    <div ng-if="isDutyAvailable == false">
                        <p class="text-center">There is no duty assigned to you</p>
                    </div>
                </div>
			</div>
		</div>
        
	</div>
	<!-- duty start model 1 -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Comfirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" ng-click="completeClick('start','<?php echo $userMail ?>',dutyData.bookingID)">Yes</button>
            </div>
            </div>
        </div>
    </div>
	<!--duty complete model 2 -->
	<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Comfirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" ng-click="completeClick('complete','<?php echo $userMail ?>',dutyData.bookingID)">Yes</button>
            </div>
            </div>
        </div>
    </div>
</div>