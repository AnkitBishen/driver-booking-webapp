<?php 
	require_once("adminHeader.php");
	//session_start();
	$user = $_SESSION['AdminUsername'];
	// print_r($_SESSION);
	//echo $user;
	//var_dump($_SESSION);
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
<div ng-app="adminApp">
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
		<div class="header"  ng-controller="viewCont">
			<div class="header-left">
				<div class="menu-icon bi bi-list">
				<i class="side-bar-open fa-solid fa-bars"></i>
				</div>

				<div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
			</div>
			<div class="header-right align-items-center">

				<!-- notidication -->
				<div class="user-notification" ng-init="getNotifications()">
					<div class="dropdown">
						<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown" >
							<img src="../images/icons/bell-fill.svg" alt="notification" title="Notification" style="width:20px;">
							<span class="badge notification-active" ng-if="isNotification == true"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<li ng-if="isNotification == true" ng-repeat="nd in notificationData" class="border-bottom">
										<a class="pl-2">
											<!-- <img src="vendors/images/img.jpg" alt="" /> -->
											<!-- <h3>{{nd.userName}}</h3> -->
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
				</div>
				<!-- notification end-->
				
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
							<!-- <span class="user-icon">
								<img src="assets/images/adminProfile.png" alt="">
							</span> -->
							<span class="user-name">Hi, <?php echo $user ?> </span>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> Log Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	<!-- side navbar  -->
		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="../index.php">
					<h3 class="text-white">Slot booking
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
							<a href="?p=adminHome" class="dropdown-toggle">
								<span class="micon"><i class="fa-solid fa-house " style="color: #ffffff; font-size:16px;"></i></span>
								<span class="mtext">Home</span>
							</a>
						</li>
						<!-- <li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon"><i class="fa-solid fa-newspaper" style="color: #ffffff; font-size:16px;"></i></span>
								<span class="mtext">Posts</span>
							</a>
							<ul class="submenu">
								<li><a href="?p=homeBlog">All Posts</a> </li>
								<li><a href="?p=addPost">Add Post</a></li>
							</ul>
						</li> -->
						<li class="dropdown">
							<a href="?p=bookingInfo" class="dropdown-toggle">
								<span class="micon"><i class="fa-solid fa-table-list" style="color: #ffffff; font-size:16px;"></i></span><span class="mtext">Bookings</span>
							</a>
							<!-- <ul class="submenu">
								<li><a href="">All Categories</a></li>
								<li><a href="datatable.html">Add Categories</a></li>
							</ul> -->
						</li>
						<li>
							<a href="?p=clients" class="dropdown-toggle no-arrow">
								<span class="micon"><i class="fa-solid fa-users" style="color: #ffffff; font-size:16px;"></i></span
								><span class="mtext">Clients</span>
							</a>
						</li>
						<li>
							<a href="?p=Employes" class="dropdown-toggle no-arrow">
								<span class="micon"><i class="fa-solid fa-id-card" style="color: #ffffff;  font-size:16px"></i></span
								><span class="mtext">Employes</span>
							</a>
						</li>
						<!--<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-archive"></span
								><span class="mtext"> UI Elements </span>
							</a>
							<ul class="submenu">
								<li><a href="ui-buttons.html">Buttons</a></li>
								<li><a href="ui-cards.html">Cards</a></li>
								<li><a href="ui-cards-hover.html">Cards Hover</a></li>
								<li><a href="ui-modals.html">Modals</a></li>
								<li><a href="ui-tabs.html">Tabs</a></li>
								<li>
									<a href="ui-tooltip-popover.html">Tooltip &amp; Popover</a>
								</li>
								<li><a href="ui-sweet-alert.html">Sweet Alert</a></li>
								<li><a href="ui-notification.html">Notification</a></li>
								<li><a href="ui-timeline.html">Timeline</a></li>
								<li><a href="ui-progressbar.html">Progressbar</a></li>
								<li><a href="ui-typography.html">Typography</a></li>
								<li><a href="ui-list-group.html">List group</a></li>
								<li><a href="ui-range-slider.html">Range slider</a></li>
								<li><a href="ui-carousel.html">Carousel</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-command"></span
								><span class="mtext">Icons</span>
							</a>
							<ul class="submenu">
								<li><a href="bootstrap-icon.html">Bootstrap Icons</a></li>
								<li><a href="font-awesome.html">FontAwesome Icons</a></li>
								<li><a href="foundation.html">Foundation Icons</a></li>
								<li><a href="ionicons.html">Ionicons Icons</a></li>
								<li><a href="themify.html">Themify Icons</a></li>
								<li><a href="custom-icon.html">Custom Icons</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-pie-chart"></span
								><span class="mtext">Charts</span>
							</a>
							<ul class="submenu">
								<li><a href="highchart.html">Highchart</a></li>
								<li><a href="knob-chart.html">jQuery Knob</a></li>
								<li><a href="jvectormap.html">jvectormap</a></li>
								<li><a href="apexcharts.html">Apexcharts</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Additional Pages</span>
							</a>
							<ul class="submenu">
								<li><a href="video-player.html">Video Player</a></li>
								<li><a href="login.html">Login</a></li>
								<li><a href="forgot-password.html">Forgot Password</a></li>
								<li><a href="reset-password.html">Reset Password</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-bug"></span
								><span class="mtext">Error Pages</span>
							</a>
							<ul class="submenu">
								<li><a href="400.html">400</a></li>
								<li><a href="403.html">403</a></li>
								<li><a href="404.html">404</a></li>
								<li><a href="500.html">500</a></li>
								<li><a href="503.html">503</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-back"></span
								><span class="mtext">Extra Pages</span>
							</a>
							<ul class="submenu">
								<li><a href="blank.html">Blank</a></li>
								<li><a href="contact-directory.html">Contact Directory</a></li>
								<li><a href="blog.html">Blog</a></li>
								<li><a href="blog-detail.html">Blog Detail</a></li>
								<li><a href="product.html">Product</a></li>
								<li><a href="product-detail.html">Product Detail</a></li>
								<li><a href="faq.html">FAQ</a></li>
								<li><a href="profile.html">Profile</a></li>
								<li><a href="gallery.html">Gallery</a></li>
								<li><a href="pricing-table.html">Pricing Tables</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-hdd-stack"></span
								><span class="mtext">Multi Level Menu</span>
							</a>
							<ul class="submenu">
								<li><a href="javascript:;">Level 1</a></li>
								<li><a href="javascript:;">Level 1</a></li>
								<li><a href="javascript:;">Level 1</a></li>
								<li class="dropdown">
									<a href="javascript:;" class="dropdown-toggle">
										<span class="micon fa fa-plug"></span
										><span class="mtext">Level 2</span>
									</a>
									<ul class="submenu child">
										<li><a href="javascript:;">Level 2</a></li>
										<li><a href="javascript:;">Level 2</a></li>
									</ul>
								</li>
								<li><a href="javascript:;">Level 1</a></li>
								<li><a href="javascript:;">Level 1</a></li>
								<li><a href="javascript:;">Level 1</a></li>
							</ul>
						</li>
						<li>
							<a href="sitemap.html" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-diagram-3"></span
								><span class="mtext">Sitemap</span>
							</a>
						</li>
						<li>
							<a href="chat.html" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-chat-right-dots"></span
								><span class="mtext">Chat</span>
							</a>
						</li>
						<li>
							<a href="invoice.html" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">Invoice</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Extra</div>
						</li>
						<li>
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-pdf"></span
								><span class="mtext">Documentation</span>
							</a>
							<ul class="submenu">
								<li><a href="introduction.html">Introduction</a></li>
								<li><a href="getting-started.html">Getting Started</a></li>
								<li><a href="color-settings.html">Color Settings</a></li>
								<li>
									<a href="third-party-plugins.html">Third Party Plugins</a>
								</li>
							</ul>
						</li>
						<li>
							<a
								href="https://dropways.github.io/deskapp-free-single-page-website-template/"
								target="_blank"
								class="dropdown-toggle no-arrow"
							>
								<span class="micon bi bi-layout-text-window-reverse"></span>
								<span class="mtext"
									>Landing Page
									<img src="vendors/images/coming-soon.png" alt="" width="25"
								/></span>
							</a>
						</li> -->
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
					$page = 'adminHome';
				}

				if($page == 'bookingInfo'){
					require_once('bookingInfo.php');
				}
				else if($page == 'adminHome'){
					require_once('adminHome.php');
				}
				else if($page == 'clients'){
					require_once('clients.php');
				}
				else if($page == 'Employes'){
					require_once('Employes.php');
				}
			?>

		</div>
</div>

<?php 
	require_once("adminFooter.php");
?>
