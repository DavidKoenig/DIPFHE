<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
	<head>
		<title> Studenten anlegen </title>	
		<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1"/>
		<meta name = "author" content = "Davelicious" />
		<link type = "text/css" href = "../css/reset.css" rel = "stylesheet" media = "screen" />
		<link type = "text/css" href = "../css/main.less" rel = "stylesheet/less" media = "screen" />
		<script src="../js/less-1.3.1.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php
		
			session_start();
			
			$display = array("matrNmbr" 	=> "none",
							 "fieldOfStudy" => "none",
							 "focus"		=> "none",
							 "semester"		=> "none");
			
			$studValues = array("matrNmbr" 	   => "",
								"fieldOfStudy" => "",
								"focus"		   => "");
			
			$fieldSel = array("ai"	=> "");
			
			$focusSel = array("medInf" 	=> "",
							  "ingInf"	=> "",
							  "wiInf"	=> "");
							  
			$semSel = array("nothing" => "",
							"ba1" 	  => "",
							"ba2"	  => "",
							"ba3"	  => "",
							"ba4"	  => "",
							"ba5"	  => "",
							"ba6"	  => "",
							"ma1"	  => "",
							"ma2"	  => "",
							"ma3"     => "",
							"ma4"	  => "");
			if($_SESSION["secRegVis"] == TRUE && !isset($_REQUEST["submit"])) 
			{
				$studValues = array("matrNmbr" 	   => $_SESSION["regMatrNmbr"],
									"fieldOfStudy" => $_SESSION["regFieldOfStudy"],
									"focus"		   => $_SESSION["regFocus"]);
									
				// Ausfüllen des Studiegangs-Auswahl-Feldes
				if 		($_SESSION["regFieldOfStudy"] == "Angewandte Informatik") $fieldSel["ai"] = "selected = 'selected'";
				
				// Ausfüllen des Vertiefungsrichtungs-Auswahl-Feldes
				if 		($_SESSION["regFocus"] == "Medieninformatik") $focusSel["medInf"] = "selected = 'selected'";
				else if ($_SESSION["regFocus"] == "Ingenieurinformatik") $focusSel["ingInf"] = "selected = 'selected'";
				else if ($_SESSION["regFocus"] == "Wirtschaftsinformatik") $focusSel["wiInf"] = "selected = 'selected'";
				
				// Ausfüllen des Semester-Auswahl-Feldes					
				if 		($_SESSION["regSemester"] == "BA1") $semSel["ba1"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "BA2") $semSel["ba2"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "BA3") $semSel["ba3"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "BA4") $semSel["ba4"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "BA5") $semSel["ba5"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "BA6") $semSel["ba6"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "MA1") $semSel["ma1"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "MA2") $semSel["ma2"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "MA3") $semSel["ma3"] = "selected = 'selected'";
				else if ($_SESSION["regSemester"] == "MA4") $semSel["ma4"] = "selected = 'selected'";
				
			}
			$_SESSION["secRegVis"] = TRUE;
			
			// Zurück-Button
			if(isset($_REQUEST["back"])) 
				header("Location: person.php");
			
			// Erstellen-Button
			if(isset($_REQUEST["submit"]))
			{
				if(empty($_REQUEST["matrNmbr"])) 		$display["matrNmbr"] 	= "block";
				if($_REQUEST["fieldOfStudy"] == "") 	$display["fieldOfStudy"] = "block";
				if($_REQUEST["focus"] == "")			$display["focus"] = "block";
				if($_REQUEST["semester"] == "")			$display["semester"] = "block";
				
				if(!empty($_REQUEST["matrNmbr"]) &&
				   !empty($_REQUEST["fieldOfStudy"]) &&
				   !empty($_REQUEST["focus"]) &&
				   $_REQUEST["semester"] != "")
				{			
					$_SESSION["regMatrNmbr"] = $_REQUEST["matrNmbr"];
					$_SESSION["regFieldOfStudy"] = $_REQUEST["fieldOfStudy"];
					$_SESSION["regFocus"] = $_REQUEST["focus"];
					$_SESSION["regSemester"] = $_REQUEST["semester"];				
					
					header("Location: zusammenfassung.php");
				}
				else
				{
					$studValues = array("matrNmbr" 	   => $_REQUEST["matrNmbr"],
										"fieldOfStudy" => $_REQUEST["fieldOfStudy"],
										"focus"		   => $_REQUEST["focus"]);		
					
					// Ausfüllen des Studiegangs-Auswahl-Feldes
					if 		($_REQUEST["fieldOfStudy"] == "Angewandte Informatik") $fieldSel["ai"] = "selected = 'selected'";
					
					// Ausfüllen des Vertiefungsrichtungs-Auswahl-Feldes
					if 		($_REQUEST["focus"] == "Medieninformatik") $focusSel["medInf"] = "selected = 'selected'";
					else if ($_REQUEST["focus"] == "Ingenieurinformatik") $focusSel["ingInf"] = "selected = 'selected'";
					else if ($_REQUEST["focus"] == "Wirtschaftsinformatik") $focusSel["wiInf"] = "selected = 'selected'";
								
					// Ausfüllen des Semester-Auswahl-Feldes
					if 		($_REQUEST["semester"] == "BA1") $semSel["ba1"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "BA2") $semSel["ba2"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "BA3") $semSel["ba3"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "BA4") $semSel["ba4"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "BA5") $semSel["ba5"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "BA6") $semSel["ba6"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "MA1") $semSel["ma1"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "MA2") $semSel["ma2"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "MA3") $semSel["ma3"] = "selected = 'selected'";
					else if ($_REQUEST["semester"] == "MA4") $semSel["ma4"] = "selected = 'selected'";
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
				<a href="#" title="Neue(n) Studierende(n) anlegen">Studierende(n)</a>
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
				<h1> Neue(n) Studierende(n) anlegen </h1>
				<form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "post">
					<fieldset>
						<legend>Studentenspezifische Angaben</legend>
						<p class="required <?php echo $display["matrNmbr"]; ?>">
							Sie m&uuml;ssen eine Matrikel-Nummer angeben!
						</p>
						<p>
							<label for = "matrNmbr">Matrikelnummer:</label>
							<input type = "text" name = "matrNmbr" id = "matrNmbr" placeholder = "Matrikelnummer" value="<?php echo $studValues["matrNmbr"]; ?>" />
						</p>
						<p class="required <?php echo $display["fieldOfStudy"]; ?>">
							Sie m&uuml;ssen einen Studiengang angeben!
						</p>
						<p>
							<label for = "fieldOfStudy">Studiengang:</label>
							<select name="fieldOfStudy" id ="fieldOfStudy">
								<option value="" <?php echo $fieldSel["nothing"]; ?>>keine Angabe</option>
								<option value="Angewandte Informatik" <?php echo $fieldSel["ai"]; ?>>Angewandte Informatik</option>
							</select>
						</p>
						<p class="required <?php echo $display["focus"]; ?>">
							Sie m&uuml;ssen eine Vertiefungsrichtung angeben!
						</p>
						<p>
							<label for = "focus">Vertiefungsrichtung:</label>
							<select name="focus" id ="focus">
								<option value="" <?php echo $focusSel["nothing"]; ?>>keine Angabe</option>
								<option value="Medieninformatik" <?php echo $focusSel["medInf"]; ?>>Medieninformatik</option>
								<option value="Ingenieurinformatik" <?php echo $focusSel["ingInf"]; ?>>Ingenieurinformatik</option>
								<option value="Wirtschaftsinformatik" <?php echo $focusSel["wiInf"]; ?>>Wirtschaftsinformatik</option>
							</select>
						</p>
						<p class="required <?php echo $display["semester"]; ?>">
							Sie m&uuml;ssen ein Semester angeben!
						</p>
						<p>
							<label for = "semester">Semester:</label>
							<select name = "semester" id = "semester">
								<option value = ""  <?php echo $semSel["nothing"]; ?>>keine Angabe</option>
								<option value = "BA1" <?php echo $semSel["ba1"]; ?>>1.BA</option>
								<option value = "BA2" <?php echo $semSel["ba2"]; ?>>2.BA</option>
								<option value = "BA3" <?php echo $semSel["ba3"]; ?>>3.BA</option>
								<option value = "BA4" <?php echo $semSel["ba4"]; ?>>4.BA</option>
								<option value = "BA5" <?php echo $semSel["ba5"]; ?>>5.BA</option>
								<option value = "BA6" <?php echo $semSel["ba6"]; ?>>6.BA</option>
								<option value = "MA1" <?php echo $semSel["ma1"]; ?>>1.MA</option>
								<option value = "MA2" <?php echo $semSel["ma2"]; ?>>2.MA</option>
								<option value = "MA3" <?php echo $semSel["ma3"]; ?>>3.MA</option>
								<option value = "MA4" <?php echo $semSel["ma4"]; ?>>4.MA</option>
							</select>
						</p> 
					</fieldset>
					<?php
						$_SESSION["regMatrNmbr"] = $_REQUEST["matrNmbr"];
						$_SESSION["regFieldOfStudy"] = $_REQUEST["fieldOfStudy"];
						$_SESSION["regFocus"] = $_REQUEST["focus"];
						$_SESSION["regSemester"] = $_REQUEST["semester"];
					?>
					<input type="submit" name="back" value="Zur&uuml;ck" class="left" />
					<input type="submit" name="submit" value="Erstellen" class="right" />
				</form>
			</div> <!-- .grid_9 -->
		</div> <!-- .container -->
	</body>
</html>