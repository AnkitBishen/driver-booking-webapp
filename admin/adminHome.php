<div class="xs-pd-20-10 pd-ltr-20" ng-controller="viewCont">
	<div class="row clearfix progress-box">
		<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
			<div class="card-box pd-30 height-100-p">
				<div class="progress-box text-center">
					<h2>4</h2>
					<h5 class="text-blue padding-top-10 h5">Total Categories</h5>
					<!-- <span class="d-block" >80% Average <i class="fa fa-line-chart text-blue"></i> -->
					</span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
			<div class="card-box pd-30 height-100-p">
				<div class="progress-box text-center">
				<h2>24</h2>
					<h5 class="text-light-green padding-top-10 h5"> Total Posts</h5>
					<!-- <span class="d-block" >75% Average <i class="fa text-light-green fa-line-chart"></i> -->
					</span>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="row">
		<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
			<div class="card-box pd-30 pt-10 height-100-p">
				<h2 class="mb-30 h4">Browser Visit</h2>
				<div class="browser-visits">
					<ul>
						<li class="d-flex flex-wrap align-items-center">
							<div class="icon">
								<img src="vendors/images/chrome.png" alt="" />
							</div>
							<div class="browser-name">Google Chrome</div>
							<div class="visit">
								<span class="badge badge-pill badge-primary">50%</span>
							</div>
						</li>
						<li class="d-flex flex-wrap align-items-center">
							<div class="icon">
								<img src="vendors/images/firefox.png" alt="" />
							</div>
							<div class="browser-name">Mozilla Firefox</div>
							<div class="visit">
								<span class="badge badge-pill badge-secondary">40%</span>
							</div>
						</li>
						<li class="d-flex flex-wrap align-items-center">
							<div class="icon">
								<img src="vendors/images/safari.png" alt="" />
							</div>
							<div class="browser-name">Safari</div>
							<div class="visit">
								<span class="badge badge-pill badge-success">40%</span>
							</div>
						</li>
						<li class="d-flex flex-wrap align-items-center">
							<div class="icon">
								<img src="vendors/images/edge.png" alt="" />
							</div>
							<div class="browser-name">Microsoft Edge</div>
							<div class="visit">
								<span class="badge badge-pill badge-warning">20%</span>
							</div>
						</li>
						<li class="d-flex flex-wrap align-items-center">
							<div class="icon">
								<img src="vendors/images/opera.png" alt="" />
							</div>
							<div class="browser-name">Opera Mini</div>
							<div class="visit">
								<span class="badge badge-pill badge-info">20%</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-6 col-sm-12 mb-30">
			<div class="card-box pd-30 pt-10 height-100-p">
				<h2 class="mb-30 h4">World Map</h2>
				<div
					id="browservisit"
					style="width: 100% !important; height: 380px"
				></div>
			</div>
		</div>
	</div> -->

	<div class="row h-50">
		<div class="col-lg-7 col-md-12 col-sm-12 mb-30">
			<div class="card-box pd-30 h-100">
				<span class="mb-20 h4 d-flex justify-content-between"><span>On Duty</span>
				<span><i class="fa-solid fa-arrows-rotate" style="color: #142127;" ng-click="getOnDutyEmp()"></i></span>
				</span>
				<div class="book-main-container h-75 overflow-scroll" >
                    <div class="booked-data border-bottom text-hover p-2" ng-repeat="data in onDutyData">
						<p><b>{{data.empName}}</b> has been scheduled with {{data.clientName}} from {{data.fromAdd}} to {{data.toAdd}}</p>
                    </div>
                    <div ng-if="isRefreshBtnClicked == false">
                        <p class="text-center text-danger">Please click Refresh button for view data</p>
                    </div>
					<div ng-if="isNoOnDutyData == true">
                        <p class="text-center">There is no Driver on duty</p>
                    </div>
                </div>
			</div>
		</div>
		<div class="col-lg-5 col-md-12 col-sm-12 mb-30">
			<div class="card-box pd-30 height-100-p">
				<h4 class="mb-30 h4">Records</h4>
				<div id="chart" class="chart"></div>
			</div>
		</div>
	</div>
</div>