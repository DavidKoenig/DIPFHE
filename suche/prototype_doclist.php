<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Auflistung und Sortierung</title>
</head>

<body>
<form name="sort" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Sortieren nach:
    <Select NAME="sortBy">
        <Option VALUE="type">Job</option>
        <Option VALUE="file">Dateiname</option>
    </Select>
    <input type="hidden" name="sorting" value="yes" />
    <input type="submit" name="submit" value="Sort" />
</form>
 <br /><br />
<?php

	include ('../php/db_connect.php');
		
	if ($_POST['sorting'] == "yes")
	{	
		$sortBy = $_POST['sortBy'];
		if($sortBy == "type")
		{
			$data = mysql_query("SELECT * FROM document ORDER BY type ASC");
		}
		else
		{
			$data = mysql_query("SELECT * FROM document ORDER BY file ASC");
		}
	}
	else
	{
		// Default, unsorted list, displayed when the page is first loaded. Unsorted for testing purposes, can easily be changed later on.
		$data = mysql_query("SELECT * FROM document");	
	}
	
	while($result = mysql_fetch_array($data))
	{
		echo "Job: ".$result['type'];
		echo "<br>";
		$link = $result['file'];
		echo "Link: "."<a href=$link>".$link."</a>";
		echo "<br>";
		echo "<hr>";
	}
	
	include ('../php/db_close.php');

?>

</body>
</html>