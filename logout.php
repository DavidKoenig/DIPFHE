<?php
  // Wenn Benutzer eingeloggt ist, Sitzungsvariablen löschen und Benutzer ausloggen
  session_start();
  if (isset($_SESSION['loginID'])) {
    // Sitzungsvariablen löschen, indem $_SESSION auf ein leeres Array gesetzt wird
    $_SESSION = array();

    // Sitzungs-Cookie löschen, indem sein Verfallsdatum zurückgedreht wird
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 3600);
    }

    // Sitzung zerstören
    session_destroy();
  }

  // Cookies löschen, indem wir das Verfallsdatum auf vor eine Stunde (3600 Sekunden) setzen
  setcookie('loginID', '', time() - 3600);
  setcookie('loginName', '', time() - 3600);

  // Zur Hauptseite zurückleiten
  echo "Sie sind nun ausgeloggt und werden auf die Startseite weitergeleitet";
  header('Refresh: 3; url = index.php');	//unbedingt refresh anstatt location verwenden, sonst wird echo vor header nicht ausgegeben!, 'url =' ist ebenfalls unbedingt notwendig!
 
?>
