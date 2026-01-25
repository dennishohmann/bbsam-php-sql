<html>
<head>
<title>Fortbildung - PHP und MySQL</title>
</head>
<body>
<?php
$ArtikelNr=$_REQUEST['ArtikelNr'];
include("zugangsdaten.txt");
$verbindung=mysqli_connect($db_server,$db_user,$db_passwort,$db_name);
If(!$verbindung) {
	echo "Die Verbindung konnte nicht erstellt werden.";
	exit;
}

$abfrage="SELECT * FROM Notebooks WHERE ArtikelNr=".$ArtikelNr;
$ergebnis=mysqli_query($verbindung,$abfrage);

$datensatz=mysqli_fetch_array($ergebnis);

echo "<center>\n";
echo "<h2>Vielen Dank für die Bestellung des Geräts ".$datensatz[1]."</h2><br>\n";
echo "<p>\n";
echo "<a href='kaufen.php'>Zurück zur Auswahl</a>";
echo "</p>\n";
echo "</center>\n";
$bestand=$datensatz[4];
$bestand=$bestand-1;
$abfrage="UPDATE Notebooks SET Bestand = ".$bestand." WHERE ArtikelNr=".$ArtikelNr;
$ergebnis=mysqli_query($verbindung,$abfrage);

mysqli_close($verbindung);

?>

</body>
</html>