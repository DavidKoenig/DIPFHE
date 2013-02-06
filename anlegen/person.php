<?php 
	$title = "Personen anlegen";
	$rootPoint = 1;
	include('../php/head.php'); 
?>
	
	<body>
		<?php 
			session_start();
			$active = "Personen";
			include('../php/navigation.php'); 
		?>
		<?php
		
		
		$display = array("firstName" 	=> "none",
						 "lastName"		=> "none");
		$sexSel = array("male" => "",
						"female" => "");
		$kindSel = array("stud" => "",
						 "lehr" => "",
						 "prak" => "",
						 "firm" => "");
		$values = array("akadTitel" => "",
						"firstName" => "",
						"lastName"	=> "",
						"eMail"		=> "",
						"tel"		=> "");
		
		// Bool-Flag zur Kontrolle ob die Seite per Zurück-Button erreicht wurde.
		if($_SESSION["secRegVis"] == true)
		{
			$values = array("akadTitel" => $_SESSION["regAkadTitel"],
							"firstName" => $_SESSION["regFirstName"],
							"lastName" 	=> $_SESSION["regLastName"],
							"eMail"		=> $_SESSION["regEMail"],
							"tel"		=> $_SESSION["regTel"]);
							
			// Bestimmen des Geschlechter-Auswahl-Feldes
			if		($_SESSION["regSex"] == "male") $sexSel["male"] = "selected='selected'";
			else if ($_SESSION["regSex"] == "female") $sexSel["female"] = "selected='selected'";
			
			// Bestimmen des Personen-Typ-Auswahl-Feldes
			if     ($_SESSION["regKind"] == "STUD") $kindSel["stud"] = "selected='selected'";
			else if($_SESSION["regKind"] == "LEHR") $kindSel["lehr"] = "selected='selected'";
			else if($_SESSION["regKind"] == "PRAK") $kindSel["prak"] = "selected='selected'";
			else if($_SESSION["regKind"] == "FIRM") $kindSel["firm"] = "selected='selected'";
			
			// Kontrolle ob alle notwendigen Felder ausgefüllt wurden
		}
		if(isset($_REQUEST["next"]))
		{
				if(empty($_REQUEST["firstName"])) 
					$display["firstName"] = "errorMsg";
				if(empty($_REQUEST["lastName"]))
					$display["lastName"] = "errorMsg";
				if(!empty($_REQUEST["firstName"]) && !empty($_REQUEST["lastName"]))
				{
					// Weiterleitung auf die einzelnen Formularseiten bei jeweiliger Angabe
					if 		($_REQUEST["kind"] == "STUD") header('Location: student.php');
					else if ($_REQUEST["kind"] == "LEHR") header('Location: zusammenfassung.php');
					else if ($_REQUEST["kind"] == "PRAK") header('Location: praktikantenamt.php');
					else if ($_REQUEST["kind"] == "FIRM") header('Location: mitarbeiter_firma.php');
				}
				else 
				{
					$values = array("akadTitel" => $_REQUEST["akadTitel"],
									"firstName" => $_REQUEST["firstName"],
									"lastName" 	=> $_REQUEST["lastName"],
									"eMail"		=> $_REQUEST["eMail"],
									"tel"		=> $_REQUEST["tel"]);
						
					// Bestimmen des Geschlechter-Auswahl-Feldes
					if		($_REQUEST["sex"] == "male") $sexSel["male"] = "selected='selected'";
					else if ($_REQUEST["sex"] == "female") $sexSel["female"] = "selected='selected'";
					
					// Bestimmen des Personen-Typ-Auswahl-Feldes
					if     ($_REQUEST["kind"] == "STUD") $kindSel["stud"] = "selected='selected'";
					else if($_REQUEST["kind"] == "LEHR") $kindSel["lehr"] = "selected='selected'";
					else if($_REQUEST["kind"] == "PRAK") $kindSel["prak"] = "selected='selected'";
					else if($_REQUEST["kind"] == "FIRM") $kindSel["firm"] = "selected='selected'";	
				}
			}
	
		?>
		<div class="container_12 content">
			<div class="grid_3 sidebar">
				<ul>
					<li><a href="personen.php" title="Alle Personen">Alle Personen</a></li>
					<li><a href="hinzufuegen.php" title="Personen hinzuf&uuml;gen">Hinzuf&uuml;gen</a></li>
				</ul>
			</div> <!-- .grid_3 .sidebar -->
			<div class="grid_9 content form">
				<h2> Neue Person anlegen </h1>
				<form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "post">
					<fieldset>
						<legend>Allgemeine Angaben</legend>
						<p>
							<label for = "akadTitel">Akademischer Titel</label>
							<input type = "text" name = "akadTitel" id = "akadTitel" placeholder = "akademischer Titel" value="<?php echo $values["akadTitel"]; ?>" />
						</p>
						<p class="required <?php echo $display["firstName"]; ?>">
							Sie m&uuml;ssen einen Vornamen angeben!
						</p>
						<p>
							<label for = "firstName">Vorname(<span class="required">*</span>):</label>
							<input type = "text" name = "firstName" id = "firstName" placeholder = "Vorname" value="<?php echo $values["firstName"]; ?>" />
						</p>
						<p class="required <?php echo $display["lastName"]; ?>">
							Sie m&uuml;ssen einen Nachnamen angeben!
						</p>
						<p>
						    <label for = "lastName">Nachname(<span class="required">*</span>):</label>
							<input type = "text" name = "lastName" id = "lastName" placeholder = "Nachname" value="<?php echo $values["lastName"]; ?>" />
						</p>
						<p>
							<label for = "sex">Geschlecht(<span class="required">*</span>):</label>
							<select name = "sex" id = "sex">
								<option value = "male" <?php echo $sexSel["male"]; ?>>m&auml;nnlich</option>
								<option value = "female" <?php echo $sexSel["female"]; ?>>weiblich</option>
							</select> 
						</p>
						<p>
							<label for="eMail">eMail:</label>
							<input type = "eMail" name = "eMail" id = "eMail" placeholder = "eMail" value="<?php echo $values["eMail"]; ?>" />
						</p>
						<p>
							<label for = "tel">Telefon:</label>
							<input type = "text" name = "tel" id = "tel" placeholder = "Telefon" value="<?php echo $values["tel"]; ?>" />
						</p>
					</fieldset>
					<fieldset>
						<legend>Art der Person</legend>
						<p>
							<label for = "kind">Art:</label>
							<select name = "kind" id = "kind" required>							
								<option value = "STUD" <?php echo $kindSel["stud"]; ?>>Student</option>
								<option value = "LEHR" <?php echo $kindSel["lehr"]; ?>>Lehrbeauftragter</option>
								<option value = "PRAK" <?php echo $kindSel["prak"]; ?>>Prakitkantenamt</option>
								<option value = "FIRM" <?php echo $kindSel["firm"]; ?>>Firmenbetreuer</option>
							</select>
						</p> 
					</fieldset>
					<?php
							$_SESSION["regAkadTitel"] = $_REQUEST["akadTitel"];
							$_SESSION["regFirstName"] = $_REQUEST["firstName"];
							$_SESSION["regLastName"] = $_REQUEST["lastName"];
							$_SESSION["regSex"] = $_REQUEST["sex"];
							$_SESSION["regEMail"] = $_REQUEST["eMail"];
							$_SESSION["regTel"] = $_REQUEST["tel"];
							$_SESSION["regKind"] = $_REQUEST["kind"];
					?>
					<input type="submit" name="next" value="Weiter" class="right" />
				</form>
			</div> <!-- .grid_9 -->
			<div class="clear"></div>
		</div> <!-- .container -->
		<?php include('../php/footer.php'); ?>
	</body>
</html>