<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
	<head>
		<title> Mitarbeiter von Firma anlegen </title>	
		<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1"/>
		<meta name = "author" content = "Davelicious" />
		<link type = "text/css" href = "../css/reset.css" rel = "stylesheet" media = "screen" />
		<link type = "text/css" href = "../css/main.less" rel = "stylesheet/less" media = "screen" />
		<script src="../js/less-1.3.1.min.js" type="text/javascript"></script>
	</head>
	
	<body>
		<?php
		
			session_start();
			
			// Überprüfen ob Suchen-Button betätigt
			$search = FALSE;
			
			$display = array("firmSearch"	=> "none");
			
			$firmValues = array("search" 	   => "");

			$_SESSION["secRegVis"] = TRUE;
			
			// Zurück-Button
			if(isset($_REQUEST["back"])) 
				header("Location: person.php");
			
			// Suchen-Button
			if(isset($_REQUEST["search"]))
			{
				if(empty($_REQUEST["firmSearch"])) 
				{
					$display["firmSearch"] = "block";
					$search = FALSE;
				}
				else 
				{
					$firmValues["search"] = $_REQUEST["firmSearch"];
					$search = TRUE;
				}
			}
			
			// Erstellen-Button
			if(isset($_REQUEST["submit"]))
			{
				if 		(!$search) $display["firmSearch"] = "block";
				if      (!isset($_REQUEST["companyName"])) 
				{
					$display["firmSearch"] = "block";
					$firmValues["search"] = $_REQUEST["firmSearch"];
					$search = TRUE;
				}
				else 
				{
					$display["firmSearch"] = "none";
					$_SESSION["regCompanyName"] = $_REQUEST["companyName"];
					header("Location: zusammenfassung.php");			
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
				<h1> Mitarbeiter(in) einer Firma anlegen </h1>
				<form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "post">
					<fieldset>
						<legend>Firma</legend>
						<p class="required <?php echo $display["firmSearch"]; ?>">
							Sie m&uuml;ssen eine Firma angeben!
						</p>
						<p>
							<label for = "firmSearch">Firma suchen</label>
							<input type = "text" name = "firmSearch" id = "firmSearch" placeholder = "Firma suchen" value="<?php echo $firmValues["search"]; ?>" />
							<input type="submit" name="search" value="Suchen">
						</p>				
					<?php
						if($search)
						{
							$find = $firmValues["search"];
							include ('../php/db_connect.php');
	
							// We preform a bit of filtering
							$find = strtoupper($find);
							$find = strip_tags($find);
							$find = trim ($find);
							$data = mysql_query("SELECT * FROM company WHERE name LIKE'%$find%'");
							echo "
							  	<table>
								  	<thead>
								  		<tr>
								  			<th>Auswahl</th>
								  			<th>Name</th>
								  		</tr>
								  	</thead>
								  	<tbody>
							";
									while($result = mysql_fetch_array($data))
									{
										echo "<tr>";
											echo "<td><input type='radio' name='companyName' id='".$result["name"]."' value='".$result["name"]."'/></td>";
											echo "<td>
													<label for='".$result["name"]."'>".$result["name"]."</label>
													<div class='companyInfo'>
														<table>
															<thead>
																<th scope='col'>Adresse</th>
																<th scope='col'>Telefon</th>
																<th scope='col'>Manager</th>
																<th scope='col'>Form</th>
															</thead>
															<tbody>
																<td>".$result["streetNmbr"].",<br /> ".$result["city"]."</td>
																<td>".$result["tel"]."</td>
																<td>".$result["manager"]."</td>
																<td>".$result["legalForm"]."</td>
															</tbody>
														</table>
													</div>
												  </td>";
										echo "</tr>";
									}
							echo "
									</tbody>
								</table>
								
							";
							include ('../php/db_close.php');
						}
					?>
						<p>
							<label for="createCompany">Firma erstellen</label>
							<input type="submit" name="createCompany" id="createCompany" value="Neue Firma erstellen" />
						</p>
					</fieldset>
					<input type="submit" name="back" value="Zur&uuml;ck" class="left" />
					<input type="submit" name="submit" value="Erstellen" class="right" />
				</form>
			</div> <!-- .grid_9 -->
		</div> <!-- .container -->
	</body>
</html>