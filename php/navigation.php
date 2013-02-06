<?php 
	if($_SESSION["login"] != true) 
	{ 
?>
	<header class="site-borders top-bar">
		<div class="container_12">
		<div class="grid_10">
			<h1>Digitales Praktikantenamt FH Erfurt</h1>
		</div>
		
		<nav class="grid_2">
			<p class="right">Sprache</p>
		</nav>
		<div class="clear"></div>
		</div>
	</header>
<?php 
	} 
	if($_SESSION["login"] == true)
	{
?>
	<header class="site-border top-bar">
		<div class="container_12">
			<div class="grid_10">
				<nav class="navigation">
					<ul>
						<li <?php if($active == "Personen") echo "class='active'"; ?>><a href="#">Personen</a></li>
						<li <?php if($active == "Praktika") echo "class='active'"; ?>><a href="#">Praktika</a></li>
						<li <?php if($active == "Suche") echo "class='active'"; ?>><a href="#">Suche</a></li>
					</ul>
				</nav>
			</div>
			<div class="grid_2">
				<p class="right">Sprahce</p>
			</div>
			<div class="clear"></div>
		</div>
	</header>
<?php 	
	}
?>