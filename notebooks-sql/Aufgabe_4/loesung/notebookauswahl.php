<html>
<head>
<title>Fortbildung - PHP und MySQL</title>
</head>
<body>
<?php
$anzahl=1;
$zusatz="";
if(isset($_REQUEST['zubehoer'])) {
	$zubehoer=$_REQUEST['zubehoer'];
	foreach ($zubehoer As $index =>$wert) {
         	if($anzahl==1) {
                 	$zusatz=" WHERE $index = 'Ja'";
                 } else {
                 	$zusatz=$zusatz." AND $index = 'Ja'";
                 }
                 $anzahl++;
         }
}
$hersteller=$_REQUEST['hersteller'];
if($hersteller<>"") {
	$hersteller=$hersteller."%";
         if($zusatz<>"") {
         	$zusatz =$zusatz." AND Hersteller LIKE '".$hersteller."'";
         } else {
         	$zusatz= " WHERE Hersteller LIKE '".$hersteller."'";
         }
}
$preis=$_REQUEST['preis'];
if($preis<>"") {
         if($zusatz<>"") {
         	$zusatz =$zusatz." AND Preis <= ".$preis;
         } else {
         	$zusatz= " WHERE Preis <= ".$preis;
         }

}

include("zugangsdaten.txt");
$verbindung=mysqli_connect($db_server,$db_user,$db_passwort,$db_name);
If(!$verbindung) {
	echo "Die Verbindung konnte nicht erstellt werden.";
	exit;
}
$abfrage="SELECT * FROM Notebooks".$zusatz;
echo "<br><b>".$abfrage."<b></b><br>";
$ergebnis=mysqli_query($verbindung,$abfrage);
if(mysqli_num_rows($ergebnis)>=1) {
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
 		echo "<td>".$datensatz[0]."</td>\n";
 		echo "<td>".$datensatz[1]."</td>\n";
 		echo "<td>".$datensatz[2]."</td>\n";
 		echo "<td>".$datensatz[3]." &euro;</td>\n";
 		echo "<td>".$datensatz[4]."</td>\n";
 		echo "<td>".$datensatz[5]."</td>\n";
 		echo "<td>".$datensatz[6]."</td>\n";
 		echo "<td>".$datensatz[7]."</td>\n";
 		echo "<td><img src='Bilder/".$datensatz[8]."' width='100' height='50'></td>\n";
 		echo "</tr>\n";
	}
	echo "</table>\n";
} else {
	echo "Kein Notebook gefunden";
}
mysqli_close($verbindung);

?>

</body>
</html>