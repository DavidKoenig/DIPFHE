<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
	<head>
		<title> Mitarbeiter(in) Praktikantenamt anlegen </title>	
		<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1"/>
		<meta name = "author" content = "Davelicious" />
		<link type = "text/css" href = "../css/reset.css" rel = "stylesheet" media = "screen" />
		<link type = "text/css" href = "../css/main.less" rel = "stylesheet/less" media = "screen" />
		<script src="../js/less-1.3.1.min.js" type="text/javascript"></script>
	</head>
	
	<body>
		<?php
		
			session_start();
			
			$display = array("focus"		=> "none",);
			
			$focusSel = array("gEtAI"	=> "");
			
			if($_SESSION["secRegVis"] == TRUE && !isset($_REQUEST["submit"])) 
			{
				if 		($_SESSION["regFocus"] == "GEtAI") $focusSel["gEtAI"] = "selected = 'selected'";				
			}
			$_SESSION["secRegVis"] = TRUE;
			
			// Zurück-Button
			if(isset($_REQUEST["back"])) 
				header("Location: person.php");
			
			// Erstellen-Button
			if(isset($_REQUEST["submit"]))
			{
				if(empty($_REQUEST["focus"])) $display["focus"] = "block";
				
				if($_REQUEST["focus"] != "")
				{			
					$_SESSION["regFocus"] = $_REQUEST["focus"];					
					header("Location: zusammenfassung.php");
				}
				else
				{
					if($_SESSION["regFocus"] == "GEtAI") $focusSel["gEtAI"] = "selected = 'selected'";
				}
			}
		?>
		<div class="container">
			<div class="grid_3 navigation">
				Menu
			</div> <!-- .grid_3 -->
			<div class="grid_6 navigation breadcrumbs">
				<a href="#" title="Personen verwalten">Personen</a> > 
				<a href="#" title="Neue Person anlegen">Anlegen</a> >
				<a href="#" title="Neue(n) Studierende(n) anlegen">Mitarbeiter(in) Praktikantenamt</a>
			</div> <!-- grid_7 -->
			<div class="grid_3 navigation">
				<div class="search">
					<form>
						<input type="search" name="search" id="search" placeholder="Suchen" />
					</form>
				</div>
			</div> <!-- grid_2 -->
			<div class="grid_3 navigation sidebar">
				<nav>
					<ul>
						<li>
							<a href="#" title="Personen verwalten">Personen</a>
							<ul class="child active">
								<li>
									<a href="#" title="Neue Person anlegen">Anlegen</a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
			</div> <!-- .grid_3 -->
			<div class="grid_9 content">
				<h1> Mitarbeiter(in) Praktikantenamt anlegen </h1>
				<form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "post">
					<fieldset>
						<legend>Mitarbeiter spezifische Daten</legend>
						<p class="required <?php echo $display["focus"]; ?>">
							Sie m&uuml;ssen eine Fakult&auml;t angeben!
						</p>
						<p>
							<label for = "focus">Fakult&auml;t:</label>
							<select name="focus" id ="focus">
								<option value="" <?php echo $focusSel["nothing"]; ?>>keine Angabe</option>
								<option value="GEtAI" <?php echo $focusSel["gEtAI"]; ?>>Geb&auml;ude und Energietechnik und Angewandte Informatik</option>
							</select>
						</p>
					</fieldset>
					<?php
						$_SESSION["regFocus"] = $_REQUEST["focus"];
					?>
					<input type="submit" name="back" value="Zur&uuml;ck" class="left" />
					<input type="submit" name="submit" value="Erstellen" class="right" />
				</form>
			</div> <!-- .grid_9 -->
		</div> <!-- .container -->
	</body>
</html>