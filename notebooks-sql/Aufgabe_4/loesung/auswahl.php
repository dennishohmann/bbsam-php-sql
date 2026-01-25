<html>
<head>
<title>Fortbildung - PHP und MySQL</title>
<meta charset="utf-8">
</head>
<body>
<?php
if(isset($_REQUEST['auswahl'])) {
	$auswahl=$_REQUEST['auswahl'];
	$gesuch=$_REQUEST['gesuch'];
} else {
	$auswahl=1;
	$gesuch="";
}

$gesuch="%".$gesuch."%";

include("zugangsdaten.txt");
$verbindung=mysqli_connect($db_server,$db_user,$db_passwort,$db_name);
If(!$verbindung) {
	echo "Die Verbindung konnte nicht erstellt werden.";
	exit;
}

if ($auswahl==1) {
	$abfrage="SELECT * FROM teilnehmer WHERE Nummer LIKE '".$gesuch."'";
} elseif ($auswahl==2) {
	$abfrage="SELECT * FROM teilnehmer WHERE Name LIKE '".$gesuch."'";
} elseif ($auswahl==3) {
	$abfrage="SELECT * FROM teilnehmer WHERE Vorname LIKE '".$gesuch."'";
}
echo $abfrage."<br>";

$ergebnis=mysqli_query($verbindung,$abfrage);
while($datensatz=mysqli_fetch_array($ergebnis)) {
	echo $datensatz[0]."<br>\n";
	echo $datensatz[1]."<br>\n";
	echo $datensatz[2]."<br>\n";
}

mysqli_close($verbindung);

?>

</body>
</html>