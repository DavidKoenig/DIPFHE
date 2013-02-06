<?php
	//set connection info into variables
	$server = "localhost";
	$user = "root2";
	$password = "";
	$database = "internships";
	
	//connect to the database server
	$connect = mysql_connect($server, $user, $password);
		if(!$connect)
		{
			echo "Verbindung zum DB-Server fehlgeschlagen!" . "<br>";
			exit();
		}
		
	//establish connection to the database
	$database = mysql_select_db($database, $connect);
		if(!$database)
		{
			echo "Verbindung zur Datenbank fehlgeschlagen! " . "<br>";
			exit();
		}
?>