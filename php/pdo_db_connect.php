<?php
	//set connection info into variables
	$server = "localhost";
	$user = "root2";
	$password = "";
	$database = "internships";
	
	// creating Data Source Name
	$dsn = "mysql:host=$server;dbname=$database";
	
	// creating PDO-Object with database information
	try
	{
		$db = new PDO($dsn,$user,$password);
	}
	catch (PDOException $p)
	{
		echo "Es konnte keine Verbindung hergestellt werden<br />";
		echo $p->getMessage();
	}
?>