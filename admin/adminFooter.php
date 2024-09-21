
<!-- bootstrap js  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		<script src="./assets/scripts/core.js"></script>
		<script src="./assets/scripts/script.min.js"></script>
		<script src="./assets/scripts/process.js"></script>
		<script src="../js/angularjs/angular.min.js"></script>
		<script src="./assets/js/ngApp.js"></script>
		<script src="./assets/js/view.js"></script>
		<?php
			if(isset($_GET['p'])){
				$page = $_GET['p'];
			}else{
				$page = 'adminHome';
			}

			if($page == 'bookingInfo'){
				?><script src="./assets/js/bookingInfo.js"></script><?php
			}
			else if($page == 'adminHome'){
				//require_once('adminHome.php');
			}
			else if($page == 'clients' || $page == 'Employes'){
				?><script src="./assets/js/viewPeopleDetails.js"></script><?php
			}
		?>
	</body>
</html>