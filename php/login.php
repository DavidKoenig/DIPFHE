<?php
	$loginDispl = array("errorLogin" 	=> "errorMsg-none");
	//session starten
	
	session_start();
	
	if(isset ($_REQUEST['loginSbmt']))
	{
		$username = $_REQUEST['username'];
		$pw = $_REQUEST['password'];
		$userExists = false;
		$pwCorrect = false;
		
		include 'php/db_connect.php';
		
		//Pr�fen, ob user existiert
		$sql = "SELECT * FROM login WHERE loginName = '$username'";       //'" . $_REQUEST['user'] . "'";
		$result = mysql_query($sql);
		
		if (!$result)
		{
			echo "Username-Abfrage nicht ausf�hrbar" . mysql_error();
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				$loginDispl["errorLogin"] = "errorMsg";
			}
			else
			{
				$sql = "SELECT loginID, loginName FROM login WHERE loginName = '$username' AND " . "password = SHA('$pw')";
				$result = mysql_query($sql);
				
				if (!$result)
				{
					echo "Username-Abfrage nicht ausf�hrbar" . mysql_error();
				}
				else
				{
					if(mysql_num_rows($result) == 0)
					{
						$loginDispl["errorLogin"] = "errorMsg";
					}
					else
					{
						$loginDispl["errorLogin"] = "errorMsg-none";
						
						//session + cookies setzen, da Login erfolgreich 
						$row = mysql_fetch_array($result);
						
						$_SESSION['loginID'] = $row['loginID'];
						$_SESSION['loginName'] = $row['loginName'];
						setcookie('loginID', $row['loginID'], time() + (60 * 60 * 3));    //(Sekunden * Minuten * Stunden) verf�llt in 3 Stunden 
						setcookie('loginName', $row['loginName'], time() + (60 * 60 * 3));  ///(Sekunden * Minuten * Stunden) verf�llt in 3 Stunden
						
						//Datenbank schlie�en, da in diesem Fall eine Weiterleitung auf die Startseite erfolgt und der nachfolgende Code durch exit() nicht ausgef�hrt wird
						include 'db_close.php';
						
						session_start();
						$_SESSION["login"] = true;
						header('Refresh: 1; url = anlegen/person.php');	//unbedingt refresh anstatt location verwenden, sonst wird echo vor header nicht ausgegeben!, 'url =' ist ebenfalls unbedingt notwendig!					
					}
				}
			}
		}
	}
	include 'php/db_close.php';
?>
<div class="login">
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
		<legend>Login</legend>
		<p class="<?php echo $loginDispl["errorLogin"]; ?>">
			Login fehlgeschlagen!
		</p>
		<p>
			<label for="username">Name</label>
			<input type="text" name="username" id="username" placeholder="Name oder Matrikelnr." class="right" />
		</p>
		<p>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="Passwort" />
			<input type="submit" name="loginSbmt" value="Login" class="right" /> 
		</p>
	</fieldset>
	</form>
</div>