<?php
	// LoginID ermitteln und Login erstellen
	include 'pdo_db_connect.php';
	
	// Login-Daten erstellen 
		// LoginName = Vorname.Nachname
		// Passwort = Rolle + Vorname + Nachname
	$loginName 		= $_SESSION["regFirstName"].".".$_SESSION["regLastName"];
	$loginPassword 	= $_SESSION["regKind"].$_SESSION["regFirstName"].$_SESSION["regLastName"]; 

	// String Login-Daten in Datenbank einfügen
	$insertLogin = $db->prepare("INSERT INTO login (loginName, password) VALUES('$loginName', SHA('$loginPassword'))");
	$insertLogin->execute();
	
	// Login-ID ermitteln
	class Login  {
		public $loginID = "";
	}
	$loginIdQuery = $db->query("SELECT * FROM login WHERE loginName = '$loginName' ORDER BY loginID DESC LIMIT 1");
	$loginIdQuery->setFetchMode(PDO::FETCH_CLASS,"Login",array());
	$loginId = $loginIdQuery->fetch();

	// Timestamp erstellen
	$timestamp = date('y-m-d H:i:s');
	
	// Person einfügen
	$insertPerson = $db->prepare("INSERT INTO person
					(firstName, famName, sex, email, matrNmbr, fieldOfStudy, focus, semester, akadTitel, specialFields, tel, login_loginID, created)
				    VALUES
				  	('$_SESSION[regFirstName]', '$_SESSION[regLastName]', '$_SESSION[regSex]', '$_SESSION[regEMail]', '$_SESSION[regMatrNmbr]',
				  	 '$_SESSION[regFieldOfStudy]', '$_SESSION[regFocus]', '$_SESSION[regSemester]', '$_SESSION[regAkadTitel]', '$_SESSION[specialFields]', 
				  	 '$_SESSION[regTel]', '$loginId->loginID', '$timestamp')");
	$insertPerson->execute();
	class Person {
		public $personID = "";
	}
	// Personen-ID ermitteln
	$personSelect = $db->query("SELECT * FROM person WHERE firstName = '$_SESSION[regFirstName]' AND famName = '$_SESSION[regLastName]' AND created = '$timestamp'");
	$personSelect->setFetchMode(PDO::FETCH_CLASS,"Person",array());
	$personId = $personSelect->fetch();
	
	// Rollen-ID ermitteln
	class Role {
		public $roleID = "";
	}
	$roleSelect = $db->query("SELECT * FROM role WHERE name = '$_SESSION[regKind]'");
	$roleSelect->setFetchMode(PDO::FETCH_CLASS,"Role", array());
	$roleId = $roleSelect->fetch();
	
	// Person mit Rolle verknüpfen
	$insertPersonRole = $db->prepare("INSERT INTO person_has_role (person_personID, role_roleID) VALUES ('$personId->personID', '$roleId->roleID')");
	$insertPersonRole->execute();
	

	// Person mit Firma verbinden
	if($_SESSION["regKind"] == "FIRM")
	{
		$companyWorkerInsert = $db->prepare ("UPDATE company 
					 SET person_personID = $personId->personID
					 WHERE name = '$_SESSION[regCompanyName]'");
		$companyWorkerInsert->execute();
	}
	include 'pdo_db_close.php';
	
	/*
	 * In der Person-Tabelle muss akadTitel und Semester zu einem VARCHAR-Feld geändert werden!
	 */
?>