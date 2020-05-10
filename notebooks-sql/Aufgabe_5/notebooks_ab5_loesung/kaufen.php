<html>
<head>
<title>Fortbildung - PHP und MySQL</title>
</head>
<body>
<?php
include("zugangsdaten.txt");
$verbindung=mysqli_connect($db_server,$db_user,$db_passwort,$db_name);
If(!$verbindung) {
	echo "Die Verbindung konnte nicht erstellt werden.";
	exit;
}
$abfrage="SELECT * FROM Notebooks";
$ergebnis=mysqli_query($verbindung,$abfrage);
echo "<table border=1>\n";
echo "<tr>\n";
echo "<th>Artikel-Nr</th>\n";
echo "<th>Bezeichnung</th>\n";
echo "<th>Hersteller</th>\n";
echo "<th>Preis</th>\n";
echo "<th>Bestand</th>\n";
echo "<th>Arbeitsspeicher in GB</th>\n";
echo "<th>Webcam</th>\n";
echo "<th>WLAN</th>\n";
echo "<th>Bild</th>\n";
echo "</tr>\n";
while($datensatz=mysqli_fetch_array($ergebnis)) {
	echo "<tr align='center'>\n";
	echo "<td><a href='bestellung.php?ArtikelNr=".$datensatz[0]."'>".$datensatz[0]."</a></td>\n";
	echo "<td>".$datensatz[1]."</td>\n";
	echo "<td>".$datensatz[2]."</td>\n";
	echo "<td>".$datensatz[3]." &euro;</td>\n";
	echo "<td>".$datensatz[4]."</td>\n";
	echo "<td>".$datensatz[5]."</td>\n";
	echo "<td>".$datensatz[6]."</td>\n";
	echo "<td>".$datensatz[7]."</td>\n";
	echo "<td><a href='Bilder/".$datensatz[8]."'><img src='Bilder/".$datensatz[8]."' width='100' height='50' border='0'></a></td>\n";
	echo "</tr>\n";
}
echo "</table>\n";
mysqli_close($verbindung);

?>

</body>
</html>