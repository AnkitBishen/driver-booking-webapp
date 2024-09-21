<?php
   require_once("empHeader.php");
?>

<style>
	.notification-list ul li a {
		min-height:60px;
		/* border-bottom:1px solid #000; */
	}
	.markallRead{
		font-size:12px;
		color: #2a2aff;
		cursor: pointer;
	}
</style>
<div ng-app="empApp" ng-cloak>
		<!-- <div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="vendors/images/deskapp-logo.svg" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div> -->

	<!-- top header  -->
		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list">
				<i class="side-bar-open fa-solid fa-bars"></i>
				</div>

				<div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
			</div>
			<div class="header-right align-items-center">

				<!-- notidication -->
				<!-- <div class="user-notification" ng-init="">
					<div class="dropdown">
						<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown" >
							<img src="images/icons/bell-fill.svg" alt="notification" title="Notification" style="width:20px;">
							<span class="badge notification-active" ng-if="isNotification == true"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<li ng-if="isNotification == true" ng-repeat="nd in notificationData" class="border-bottom">
										<a class="pl-2">
											<p><b>{{nd.userName}}</b>
												has made a booking for the date of <b>{{nd.startDate}}</b>.
											</p>
										</a>
									</li>
									<li ng-if="isNotification == false">
										<p class="text-center mt-1">No new notifications at the moment.</p>
									</li>
								</ul>
							</div>
							<p class="text-right pt-2 m-0 markallRead" ng-click="updateNotification()">Mark all as Read</p>
						</div>
					</div>
				</div> -->
				<!-- notification end-->
				
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
							<!-- <span class="user-icon">
								<img src="assets/images/adminProfile.png" alt="">
							</span> -->
							<span class="user-name">Hi, <?php echo $userName ?> </span>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" href="userLogout.php?r=<?php echo $role ?>"><i class="dw dw-logout"></i> Log Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	<!-- side navbar  -->
		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="index.php">
					<h3 class="text-white">Company
					<i class="fa-solid fa-arrow-up-right-from-square" style="color: #ffffff;"></i>
					</h3>
					
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="?p=empIndex" class="dropdown-toggle">
								<span class="micon"><i class="fa-solid fa-house " style="color: #ffffff; font-size:16px;"></i></span>
								<span class="mtext">Home</span>
							</a>
						</li>
						<!--<li class="dropdown">
							<a href="?p=bookingInfo" class="dropdown-toggle">
								<span class="micon"><i class="fa-solid fa-table-list" style="color: #ffffff; font-size:16px;"></i></span><span class="mtext">Bookings</span>
							</a>
							 <ul class="submenu">
								<li><a href="">All Categories</a></li>
								<li><a href="datatable.html">Add Categories</a></li>
							</ul> 
						</li>-->
						
					</ul>
				</div>
			</div>
		</div>

	<!-- main body  -->
		<div class="main-container">
			<?php
				if(isset($_GET['p'])){
					$page = $_GET['p'];
				}else{
					$page = 'empIndex';
				}

				if($page == 'empIndex'){
					require_once('empIndex.php');
				}
				// else if($page == 'adminHome'){
				// 	require_once('adminHome.php');
				// }
				// else if($page == 'clients'){
				// 	require_once('clients.php');
				// }
				// else if($page == 'Employes'){
				// 	require_once('Employes.php');
				// }
			?>

		</div>
</div>

<?php 
	require_once("empFooter.php");
?>
