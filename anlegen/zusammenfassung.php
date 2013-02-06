<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
	<head>
		<title> Erstellte Person ansehen </title>	
		<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1"/>
		<meta name = "author" content = "Davelicious" />
		<link type = "text/css" href = "../css/reset.css" rel = "stylesheet" media = "screen" />
		<link type = "text/css" href = "../css/main.less" rel = "stylesheet/less" media = "screen" />
		<script src="../js/less-1.3.1.min.js" type="text/javascript"></script>
	</head>
	
	<body>
		<?php
			session_start();			
			include '../php/insert_person.php';
		?>
		<div class="container">
			<div class="grid_3 navigation">
				Menu
			</div> <!-- .grid_3 -->
			<div class="grid_6 navigation breadcrumbs">
				<a href="#" title="Personen verwalten">Personen</a> > 
				<a href="#" title="Neue Person anlegen">Anlegen</a> >
				<a href="#" title="Neue(n) Studierende(n) anlegen">Erstellte Person ansehen</a>
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
				<h1> Erstellte Person ansehen </h1>
				<table>
					<tbody>
						<tr>
							<th scope="row">Art der Person</th>
							<td><?php echo $_SESSION["regKind"]; ?></td>
						</tr>
						<tr>
							<th scope="row">Akademischer Titel</th>
							<td><?php echo $_SESSION["regAkadTitel"]; ?></td>
						</tr>
						<tr>
							<th scope="row">Name</th>
							<td><?php echo $_SESSION["regFirstName"]." ".$_SESSION["regLastName"]; ?></td>
						</tr>
						<tr>
							<th scope="row">Geschlecht</th>
							<td><?php echo $_SESSION["regSex"]; ?></td>
						</tr>
						<tr>
							<th scope="row">E-Mail-Adresse</th>
							<td><?php echo $_SESSION["regEMail"]; ?></td>
						</tr>
						<tr>
							<th scope="row">Telefonnummer</th>
							<td><?php echo $_SESSION["regTel"]; ?></td>
						</tr>
						<?php
							if($_SESSION["regKind"] == "STUD")
							{
								
								echo "					
										<tr>
											<th scope='row'>Matrikelnummer</th>
											<td>$_SESSION[regMatrNmbr]</td>
										</tr>
										<tr>
											<th scope='row'>Studiengang</th>
											<td>$_SESSION[regFieldOfStudy]</td>
										</tr>
										<tr>
											<th scope='row'>Vertiefungsrichtung</th>
											<td>$_SESSION[regFocus]</td>
										</tr>
										<tr>
											<th scope='row'>Semester</th>
											<td>$_SESSION[regSemester]</td>
										</tr>
									";
							}
							if($_SESSION["regKind"] == "PRAK")
							{
								echo "
										<tr>
											<th scope='row'>Fakult&auml;t</th>
											<td>$_SESSION[regFocus]</td>
										</tr>
									 ";
							}
							if($_SESSION["regKind"] == "FIRM")
							{
								
							}
						?>
					</tbody>
				</table>
				<a href="person.php" title="Neue Person anlegen"><button class="right">Neue Person anlegen</button></a>
			</div> <!-- .grid_9 -->
		</div> <!-- .container -->
		<?php
			include '../php/flush_reg_variables.php';
		?>
	</body>
</html>