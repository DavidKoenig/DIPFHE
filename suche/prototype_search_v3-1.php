<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Suchfeld Prototyp</title>
</head>

<body>
<h2>Suche</h2> 
<form name="search" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Suche nach: <input type="text" name="find" value ="<?php echo $_POST['find']; ?>"/> in 
    <Select NAME="field">
        <Option VALUE="activities">Job</option>
        <Option VALUE="city">Stadt</option>
    </Select>
        <Select NAME="state">
        <Option VALUE="showAll">Alle Stellen</option>
        <Option VALUE="Frei">Freie Stellen</option>
        <Option VALUE="Besetzt">Besetzte Stellen</option>
    </Select>
    </Select>
        <Select NAME="country">
        <Option VALUE="showAll">Alle Länder</option>
        <Option VALUE="Deutschland">Deutschland</option>
        <Option VALUE="England">England</option>
        <Option VALUE="Spanien">Spanien</option>
    </Select>
    <br />
   	<input type="checkbox" name="application" value="appChecked">Bewerbungsfrist beachten <br />
    Sortieren nach:
    <select NAME="sortBy">
		<Option VALUE="activities">Job</option>
        <Option VALUE="city">Stadt</option>
        <Option VALUE="country">Land</option>
		<Option VALUE="applicationEnd">Bewerbungsfrist</option>
		<Option VALUE="salary">Bezahlung</option>
        <Option VALUE="state">Status</option>
	</Select>
    <br />
    <input type="radio" name="sort_direction" value="asc" checked="checked"> Aufsteigend<br />
	<input type="radio" name="sort_direction" value="desc">Absteigend<br />
    <input type="hidden" name="searching" value="yes" />
    <input type="submit" name="submit" value="Los!" />
</form>

<?php

// ### SCHWARZE MAGIE! NICHT ANFASSEN! ###
// Aufsteigende Sortierung
function subval_sort($a,$subkey)
{
	foreach($a as $k=>$v)
	{
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val)
	{
		$c[] = $a[$key];
	}
	return $c;
}
// Absteigende Sortierung
function subval_sort_desc($a,$subkey)
{
	foreach($a as $k=>$v)
	{
		$b[$k] = strtolower($v[$subkey]);
	}
	arsort($b);
	foreach($b as $key=>$val)
	{
		$c[] = $a[$key];
	}
	return $c;
}
// #######################################

// This is only displayed if they have submitted the form
if ($_POST['searching'] == "yes")
{
	echo "<h2>Ergebnisse</h2>";
	// If they did not enter a search term we give them an error
	$find = $_POST['find'];
	
	// Gibt an, wonach das Ergebnis sortiert werden soll
	$sortBy = $_POST['sortBy'];
	$sort_direction = $_POST['sort_direction'];

	// Otherwise we connect to our Database
	$server = "localhost";
	$user="root";
	$passwort = "";
	$datenbank="internships";
	
	mysql_connect($server, $user, $passwort) or die(mysql_error());
	mysql_select_db($datenbank) or die(mysql_error());

	// We preform a bit of filtering
	$find = strtoupper($find);
	$find = strip_tags($find);
	$find = trim ($find);

	//Now we search for our search term, in the field the user specified
	$field = $_POST['field'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	
	if ($state != 'showAll')
	{
		if($country !='showAll')
		{
			$data = mysql_query("SELECT * FROM offer WHERE upper($field) LIKE'%$find%' AND state ='$state' AND country ='$country'");
		}
		else
		{
			$data = mysql_query("SELECT * FROM offer WHERE upper($field) LIKE'%$find%' AND state ='$state'");
		}
	}
	else if ($state == 'showAll')
	{
		if($country !='showAll')
		{
			$data = mysql_query("SELECT * FROM offer WHERE upper($field) LIKE'%$find%' AND country ='$country'");
		}
		else
		{
			$data = mysql_query("SELECT * FROM offer WHERE upper($field) LIKE'%$find%'");
		}
	}
	
	$appCheck = $_POST['application'];
	
	$count = 1;
	$i = 0;

	while($result = mysql_fetch_array($data))
	{
		
		$exp_date = $result['applicationEnd'];
		$todays_date = date("Y-m-d");
		$today = strtotime($todays_date);
		$expiration_date = strtotime($exp_date);
		
		if ($expiration_date < $today && $expiration_date != "" && $appCheck == "appChecked")
		{
			// Bewerbungsfrist ist Abgelaufen, dieser Datenbankeintrag wird übersprungen!
		}
		else if ($i != 0)
		{
			$array_temp_result = array($i => array(
			'activities'=>$result['activities'],
			'city'=>$result['city'],
			'country' => $result['country'],
			'applicationEnd' => $result['applicationEnd'],
			'state' => $result['state'],
			'salary' => $result['salary']
			));
			$array_result = array_merge($array_temp_result, $array_result);
			
			$count = $count + 1;
			$i = $i + 1;
		}
		else
		{
			$array_result = array(0 => array(
			'activities'=>$result['activities'],
			'city'=>$result['city'],
			'country' => $result['country'],
			'applicationEnd' => $result['applicationEnd'],
			'state' => $result['state'],
			'salary' => $result['salary']
			));
			
			$count = $count + 1;
			$i = $i + 1;
		}
	}
	 
	//This counts the number or results - and if there wasn't any it gives them a little message explaining that
	$anymatches=mysql_num_rows($data);
	if ($anymatches == 0 || $count == 1) 
	{
		echo "Es konnte kein passender Eintrag zu den angegebenen Kriterien gefunden werden.<br><br>";
	}
	else
	{			
		echo 	"<table border='1'>
				<tr>
				<td>#</td>
				<td>Job</td>
				<td>Stadt</td>
				<td>Land</td>
				<td>Bewerbungsfrist</td>
				<td>Bezahlung</td>
				<td>Status</td>
				</tr>";
		
		if ($sort_direction == "asc")
		{	
			$array_result = subval_sort($array_result, $sortBy);
		}
		else
		{
			$array_result = subval_sort_desc($array_result, $sortBy);
		}
		
		$k = 0;
		while ($k < $i)
		{
			$index = $k +1;
			echo "<tr>";
			echo "<td style='text-align:right'>".$index." </td>";
			echo "<td> ".$array_result[$k] ['activities']." </td>";
			echo "<td> ".$array_result[$k] ['city']." </td>";
			echo "<td> ".$array_result[$k] ['country']." </td>";
			echo "<td> ".$array_result[$k] ['applicationEnd']." </td>";
			if ($array_result[$k] ['salary'] > 0.00)
			{
				echo "<td> ".$array_result[$k] ['salary']." Euro"." </td>";
			}
			else
			{
				echo "<td> "."Keine Bezahlung"." </td>";	
			}
			echo "<td> ".$array_result[$k] ['state']." </td>";
			echo "</tr>";
			$k = $k +1;
		}
		echo "</table>";
	}
	//And we remind them what they searched for
	echo "<br />"."<b>Gesucht nach:</b> ".$find;
	echo "<br />"."<b>Sortiert nach:</b> ".$sortBy;
}

?> 
</body>
</html>