<?php
	//close the connection to the database
	
	//first you have to include the connection file
	include 'db_connect.php';
	
	//close
	mysql_close($connect);
?>