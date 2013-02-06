<?php 
	$title = "Startseite";
	$rootPoint = 0;
	include('php/head.php'); 
?>
	<body>
		<?php include('php/navigation.php'); ?>
		<div class="container_12 content">
			<div class="grid_7">
				<?php include('php/start_suche.php'); ?>
			</div>
			<div class="grid_5 start-login">
				<?php include('php/login.php'); ?>
			</div>		

			<div class="clear"></div>
			<div class="grid_12">
				<?php include('php/stellenangebote.php'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php include('php/footer.php'); ?>
	</body>
</html>