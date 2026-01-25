<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
       <title>Fortbildung - PHP und MySQL</title>
</head>
<body>
<?php
/*Ankommende Daten auslesen*/
$Kunde=$_REQUEST['nummer'];
$Passwort_HTML=$_REQUEST['passwort'];

/*Verbindung aufbauen     */
include("dbconnect.txt");
$verbindung=mysqli_connect($db_server,$db_user,$db_passwort,$db_name);
If(!$verbindung) {
	echo "Die Verbindung konnte nicht erstellt werden.";
	exit;
}

/*Abfragen, ob der Kunde in der Datenbank vorhanden ist*/
$abfrage="SELECT * FROM kunden WHERE KundenNr='".$Kunde."'";
$ergebnis=mysqli_query($verbindung,$abfrage);

/*Wenn der Kunde nicht in der Datenbank vorhanden ist*/
if (mysqli_num_rows($ergebnis)<1) {
	echo "Falscher Benutzer!<br>\n";
	echo "Klicken Sie <a href='login.html'>hier</a>, um zur Anmeldung zur�ckzukehren.<br>\n";

/*Falls ein entsprechender Kunde vorhanden ist*/
} else {
	$datensatz=mysqli_fetch_array($ergebnis);

/*Stimmt das eingegebene Passwort mit dem in der Datenbank gespeicherten Passwort �berein?*/
	if ($Passwort_HTML==$datensatz['Passwort']) {
		echo "<a href='login.html'>Herzlich willkommen, Sie sind eingeloggt!</a>\n";
	} else {
		echo "Falsches Passwort!<br>\n";
		echo "Klicken Sie <a href='login.html'>hier</a>, um zur Anmeldung zur�ckzukehren.<br>\n";
	}
}

mysqli_close($verbindung);


?>
</body>
</html>