<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
	<head>
		<title> Startseite </title>	
		<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1"/>
		<meta name = "author" content = "Davelicious" />
		<link type = "text/css" href = "../css/style.less" rel = "stylesheet" media = "screen" />
		<script src="js/less-1.3.1.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php
			session_start();
			
			if(isset ($_SESSION['loginName']) OR isset ($_COOKIE['loginName']))
			{
				echo '<a href = "index.php">Startseite</a> <br/>';
				echo '<a href = "logout.php">Ausloggen (' . $_COOKIE['loginName'] . ')</a> <br/>';
				echo '<a href = "anlegen/person.php">Person anlegen</a> <br/>';
				echo '<a href = "suche/prototype_search.php">Suche</a> <br/>';
			}
			else
			{
				echo '<a href = "index.php">Startseite</a> <br/>';
				echo '<a href = "anlegen/login_anlegen.php">Login anlegen</a> <br/>';
				echo '<a href = "login.php">Einloggen</a> <br/>';
			}
		?>
	</body>
</html>