
<!-- bootstrap js  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		<script src="admin/assets/scripts/core.js"></script>
		<script src="admin/assets/scripts/script.min.js"></script>
		<script src="admin/assets/scripts/process.js"></script>
		<script src="js/angularjs/angular.min.js"></script>
		<script src="admin/assets/js/ngApp.js"></script>
		<script src="js/empProfile.js"></script>
		<?php
			if(isset($_GET['p'])){
				$page = $_GET['p'];
			}else{
				$page = 'adminHome';
			}

	
		?>
	</body>
</html>