<html>
<head>
<title>Fortbildung - PHP und MySQL</title>
<meta charset="utf-8">
</head>
<body>
<?php
$nummer=$_REQUEST['nummer'];
$bez=$_REQUEST['bezeichnung'];
$hersteller=$_REQUEST['hersteller'];
$preis=$_REQUEST['preis'];
$bestand=$_REQUEST['bestand'];
$ram=$_REQUEST['ram'];
$bild=$_REQUEST['bild'];
$wlan="Nein";
$webcam="Nein";

if(isset($_REQUEST['zubehoer'])) {
	$zubehoer=$_REQUEST['zubehoer'];
	foreach ($zubehoer AS $index => $wert) {
         	if($index=="WLAN") {
	                 $wlan="Ja";
	         } elseif ($index=="Webcam") {
	                 $webcam="Ja";
	         }
         }
}

include("zugangsdaten.txt");
$verbindung=mysqli_connect($db_server,$db_user,$db_passwort,$db_name);
If(!$verbindung) {
	echo "Die Verbindung konnte nicht erstellt werden.";
	exit;
}

$abfrage="INSERT INTO notebooks VALUES (".$nummer.",'".$bez."','".$hersteller."','".$preis."',".$bestand.",'".$ram."','".$webcam."','".$wlan."','".$bild."')";
echo $abfrage."<br>\n";
$ergebnis=mysqli_query($verbindung,$abfrage);

mysqli_close($verbindung);

?>

</body>
</html>