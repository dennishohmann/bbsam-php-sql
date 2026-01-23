<?php
// Verbindung herstellen
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Parameter auslesen
if (isset($_REQUEST['sortierung'])) {
    $sortierung = $_REQUEST['sortierung'];
} else {
    $sortierung = 'id';
}

if (isset($_REQUEST['reihenfolge'])) {
    $reihenfolge = $_REQUEST['reihenfolge'];
} else {
    $reihenfolge = 'desc';
}

// Whitelist prüfen
$erlaubte_spalten = ['id', 'name', 'spezialitaet', 'taeglicher_unfug', 'kaffee_konsum'];

if (!in_array($sortierung, $erlaubte_spalten)) {
    $sortierung = 'id';
}

if ($reihenfolge != 'asc' && $reihenfolge != 'desc') {
    $reihenfolge = 'desc';
}

// Abfrage ausführen
$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);

// Toggle-Logik vorbereiten
$standard_reihenfolge = 'desc';

if ($reihenfolge == 'asc') {
    $umgekehrte_reihenfolge = 'desc';
} else {
    $umgekehrte_reihenfolge = 'asc';
}

// Links für jede Spalte erstellen
if ($sortierung == 'name') {
    $link_name = "?sortierung=name&reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_name = "?sortierung=name&reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'spezialitaet') {
    $link_spezialitaet = "?sortierung=spezialitaet&reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_spezialitaet = "?sortierung=spezialitaet&reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'taeglicher_unfug') {
    $link_unfug = "?sortierung=taeglicher_unfug&reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_unfug = "?sortierung=taeglicher_unfug&reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'kaffee_konsum') {
    $link_kaffee = "?sortierung=kaffee_konsum&reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_kaffee = "?sortierung=kaffee_konsum&reihenfolge=$standard_reihenfolge";
}

if ($reihenfolge == 'asc') {
    $pfeil = '&nbsp;↑';
} else {
    $pfeil = '&nbsp;↓';
}

if ($sortierung == 'name') {
    $titel_name = "Name" . $pfeil;
} else {
    $titel_name = "Name";
}

if ($sortierung == 'spezialitaet') {
    $titel_spezialitaet = "Spezialität" . $pfeil;
} else {
    $titel_spezialitaet = "Spezialität";
}

if ($sortierung == 'taeglicher_unfug') {
    $titel_unfug = "Täglicher Unfug" . $pfeil;
} else {
    $titel_unfug = "Täglicher Unfug";
}

if ($sortierung == 'kaffee_konsum') {
    $titel_kaffee = "Kaffeekonsum" . $pfeil;
} else {
    $titel_kaffee = "Kaffeekonsum";
}
?>

<style>
    .katzen-tabelle { width: 100%; border-collapse: collapse; margin: 20px 0; max-width: 800px; }
    .katzen-tabelle th, .katzen-tabelle td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    .katzen-tabelle th { background: #3498db; color: white; }
    .katzen-tabelle th a { color: white; text-decoration: none; }
    .katzen-tabelle th a:hover { text-decoration: underline; }
    .katzen-tabelle tr:nth-child(even) { background: #f2f2f2; }
    .katzen-tabelle tr:hover { background: #e8f4fc; }
</style>

<h2>🐱 Mitarbeiter des Monats 🐱</h2>

<?php
echo "<table class='katzen-tabelle'>";
echo "<thead><tr>";
echo "<th><a href='$link_name'>$titel_name</a></th>";
echo "<th><a href='$link_spezialitaet'>$titel_spezialitaet</a></th>";
echo "<th><a href='$link_unfug'>$titel_unfug</a></th>";
echo "<th><a href='$link_kaffee'>$titel_kaffee</a></th>";
echo "</tr></thead>";
echo "<tbody>";

while ($katze = mysqli_fetch_assoc($result)) {
    $kaffee = $katze['kaffee_konsum'] ?? '???';
    
    echo "<tr>";
    echo "<td>" . $katze['name'] . "</td>";
    echo "<td>" . $katze['spezialitaet'] . "</td>";
    echo "<td>" . $katze['taeglicher_unfug'] . "</td>";
    echo "<td>" . $kaffee . " ☕</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

mysqli_free_result($result);
mysqli_close($conn);
?>



<!--    #######################################
        Ab hier braucht ihr nicht weiter lesen :)
        
        Diese Anleitung braucht nur im Browser gelesen zu werden...
-->
<div class="navigation">
    <a href="sql_6.php" class="nav-btn zurueck">← Zurück</a>
    <div class="nav-platzhalter"></div>
    <a class="nav-btn weiter">Ende :)</a>
</div>   

<style>
    .navigation {
        display: flex;
        justify-content: space-between;
        max-width: 800px;
        margin: 20px auto;
    }
    .nav-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-family: Arial, sans-serif;
        font-weight: bold;
        transition: background 0.3s, transform 0.2s;
    }
    .nav-btn:hover {
        background: #2980b9;
        transform: translateY(-2px);
    }
    .nav-btn.zurueck {
        background: #95a5a6;
    }
    .nav-btn.zurueck:hover {
        background: #7f8c8d;
    }
    .nav-btn.weiter {
        background: #9b59b6;
    }
    .nav-btn.weiter:hover {
        background: #8e44ad;
    }
    .nav-platzhalter {
        width: 150px;
    }
    .anleitung {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 10px;
    }
    .anleitung h2 {
        color: #333;
        border-bottom: 3px solid #9b59b6;
        padding-bottom: 10px;
    }
    .anleitung h3 {
        color: #2c3e50;
        margin-top: 30px;
    }
    .schritt {
        background: white;
        margin: 15px 0;
        padding: 15px;
        border-left: 4px solid #9b59b6;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .schritt-nummer {
        background: #9b59b6;
        color: white;
        padding: 3px 10px;
        border-radius: 15px;
        font-weight: bold;
        margin-right: 10px;
    }
    .schritt-titel {
        font-weight: bold;
        color: #2c3e50;
        font-size: 1.1em;
    }
    .schritt code {
        display: block;
        background: #2c3e50;
        color: #2ecc71;
        padding: 12px;
        margin: 10px 0;
        border-radius: 5px;
        font-family: monospace;
        overflow-x: auto;
        white-space: pre;
    }
    .schritt p {
        color: #555;
        line-height: 1.6;
        margin: 10px 0 0 0;
    }
    .konzept {
        background: #fff3cd;
        border: 1px solid #ffc107;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .konzept-titel {
        font-weight: bold;
        color: #856404;
        margin-bottom: 10px;
    }
    .parameter {
        background: #ecf0f1;
        padding: 8px;
        border-radius: 5px;
        margin-top: 10px;
    }
    .parameter strong {
        color: #e74c3c;
    }
    .hinweis {
        background: #d4edda;
        border: 1px solid #28a745;
        padding: 12px;
        border-radius: 8px;
        margin-top: 10px;
    }
    .hinweis strong {
        color: #155724;
    }
    .warnung {
        background: #f8d7da;
        border: 1px solid #dc3545;
        padding: 12px;
        border-radius: 8px;
        margin-top: 10px;
    }
    .warnung strong {
        color: #721c24;
    }
    .zusatz {
        background: #e8daef;
        border: 1px solid #9b59b6;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .zusatz-titel {
        font-weight: bold;
        color: #6c3483;
        margin-bottom: 10px;
    }
</style>

<div class="anleitung">
    <h2>🔀 Sortierbare Tabellenspalten</h2>

    <div class="konzept">
        <div class="konzept-titel">💡 Das Konzept</div>
        <p>Die Spaltenüberschriften werden zu Links, die beim Klick die Seite neu laden und dabei Parameter übergeben. Diese Parameter steuern die Sortierung der SQL-Abfrage. Ein erneuter Klick auf dieselbe Spalte kehrt die Reihenfolge um.</p>
        <div class="parameter">
            <strong>Beispiel-URL:</strong> seite.php?sortierung=name&amp;reihenfolge=asc
        </div>
    </div>

    <h3>URL-Parameter auslesen</h3>

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">$_REQUEST verstehen</span>
        <code>$wert = $_REQUEST['parametername'];</code>
        <p>$_REQUEST ist ein Array, das alle übergebenen Parameter enthält, egal ob per URL (GET) oder Formular (POST). Wir nutzen es, um die Sortierparameter auszulesen.</p>
        <div class="parameter">
            <strong>URL:</strong> seite.php?sortierung=name&amp;reihenfolge=asc<br>
            <strong>$_REQUEST['sortierung']:</strong> "name"<br>
            <strong>$_REQUEST['reihenfolge']:</strong> "asc"
        </div>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">2</span>
        <span class="schritt-titel">Parameter mit Standardwerten auslesen</span>
        <code>if (isset($_REQUEST['sortierung'])) {
    $sortierung = $_REQUEST['sortierung'];
} else {
    $sortierung = 'id';
}

if (isset($_REQUEST['reihenfolge'])) {
    $reihenfolge = $_REQUEST['reihenfolge'];
} else {
    $reihenfolge = 'desc';
}</code>
        <p>Die Funktion isset() prüft, ob ein Parameter überhaupt existiert. Falls nicht, setzen wir Standardwerte: Sortierung nach ID, absteigend (DESC).</p>
    </div>

    <h3>Sicherheit: Erlaubte Werte prüfen</h3>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Whitelist für Spaltennamen</span>
        <code>$erlaubte_spalten = ['id', 'name', 'spezialitaet', 'taeglicher_unfug', 'kaffee_konsum'];

if (!in_array($sortierung, $erlaubte_spalten)) {
    $sortierung = 'id';
}</code>
        <p>Niemals Benutzereingaben direkt in SQL einfügen! Die Whitelist enthält alle erlaubten Spaltennamen. Falls jemand einen ungültigen Wert übergibt, wird auf den Standardwert zurückgesetzt.</p>
        <div class="warnung">
            <strong>Sicherheit:</strong> Ohne diese Prüfung könnte ein Angreifer schädlichen SQL-Code einschleusen (SQL-Injection).
        </div>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">Whitelist für Reihenfolge</span>
        <code>if ($reihenfolge != 'asc' &amp;&amp; $reihenfolge != 'desc') {
    $reihenfolge = 'desc';
}</code>
        <p>Die Reihenfolge kann nur zwei gültige Werte haben: 'asc' oder 'desc'. Alles andere wird auf den Standardwert 'desc' gesetzt.</p>
    </div>

    <h3>SQL-Abfrage anpassen</h3>

    <div class="schritt">
        <span class="schritt-nummer">5</span>
        <span class="schritt-titel">Dynamische ORDER BY Klausel</span>
        <code>$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);</code>
        <p>Die Variablen werden in den SQL-String eingesetzt. Da wir sie vorher validiert haben, ist dies sicher. Die Abfrage sortiert nun nach der gewählten Spalte in der gewählten Richtung.</p>
        <div class="hinweis">
            <strong>Beispiel:</strong> Bei sortierung=name und reihenfolge=asc wird daraus:<br>
            SELECT * FROM katzen ORDER BY name asc
        </div>
    </div>

    <h3>Toggle-Logik: Reihenfolge berechnen</h3>

    <div class="schritt">
        <span class="schritt-nummer">6</span>
        <span class="schritt-titel">Standard-Reihenfolge für neue Spalten</span>
        <code>$standard_reihenfolge = 'desc';</code>
        <p>Wenn eine bisher nicht aktive Spalte angeklickt wird, soll sie mit dieser Reihenfolge starten. Wir definieren sie als Variable für einfache Anpassung.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">7</span>
        <span class="schritt-titel">Umgekehrte Reihenfolge berechnen</span>
        <code>if ($reihenfolge == 'asc') {
    $umgekehrte_reihenfolge = 'desc';
} else {
    $umgekehrte_reihenfolge = 'asc';
}</code>
        <p>Für die aktive Spalte berechnen wir die umgekehrte Reihenfolge. Diese wird im Link verwendet, damit ein erneuter Klick die Richtung wechselt.</p>
    </div>

    <h3>Links für jede Spalte erstellen</h3>

    <div class="schritt">
        <span class="schritt-nummer">8</span>
        <span class="schritt-titel">Link für Spalte "name"</span>
        <code>if ($sortierung == 'name') {
    $link_name = "?sortierung=name&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_name = "?sortierung=name&amp;reihenfolge=$standard_reihenfolge";
}</code>
        <p>Falls "name" die aktive Spalte ist, verwenden wir die umgekehrte Reihenfolge. Falls nicht, verwenden wir die Standard-Reihenfolge für neue Spalten.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">9</span>
        <span class="schritt-titel">Links für alle weiteren Spalten</span>
        <code>if ($sortierung == 'spezialitaet') {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'taeglicher_unfug') {
    $link_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'kaffee_konsum') {
    $link_kaffee = "?sortierung=kaffee_konsum&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_kaffee = "?sortierung=kaffee_konsum&amp;reihenfolge=$standard_reihenfolge";
}</code>
        <p>Das gleiche Prinzip wird für jede Spalte wiederholt. Jede Spalte erhält ihre eigene Link-Variable.</p>
    </div>

    <h3>Tabellenkopf mit Links ausgeben</h3>

    <div class="schritt">
        <span class="schritt-nummer">10</span>
        <span class="schritt-titel">Überschriften als anklickbare Links</span>
        <code>echo "&lt;thead&gt;&lt;tr&gt;";
echo "&lt;th&gt;&lt;a href='$link_name'&gt;Name&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_spezialitaet'&gt;Spezialität&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_unfug'&gt;Täglicher Unfug&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_kaffee'&gt;Kaffeekonsum&lt;/a&gt;&lt;/th&gt;";
echo "&lt;/tr&gt;&lt;/thead&gt;";</code>
        <p>Die vorbereiteten Link-Variablen werden in die href-Attribute eingesetzt. Ein Klick lädt die Seite mit den entsprechenden Parametern neu.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">11</span>
        <span class="schritt-titel">CSS für die Links</span>
        <code>.katzen-tabelle th a {
    color: white;
    text-decoration: none;
}
.katzen-tabelle th a:hover {
    text-decoration: underline;
}</code>
        <p>Die Links in den Überschriften sollen weiß sein und beim Hover unterstrichen werden, damit sie sich in das bestehende Design einfügen.</p>
    </div>

    <h3>Vollständiger Code</h3>

    <div class="schritt">
        <span class="schritt-nummer">12</span>
        <span class="schritt-titel">Alles zusammengesetzt</span>
        <code>&lt;?php
// Verbindung herstellen
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Parameter auslesen
if (isset($_REQUEST['sortierung'])) {
    $sortierung = $_REQUEST['sortierung'];
} else {
    $sortierung = 'id';
}

if (isset($_REQUEST['reihenfolge'])) {
    $reihenfolge = $_REQUEST['reihenfolge'];
} else {
    $reihenfolge = 'desc';
}

// Whitelist prüfen
$erlaubte_spalten = ['id', 'name', 'spezialitaet', 'taeglicher_unfug', 'kaffee_konsum'];

if (!in_array($sortierung, $erlaubte_spalten)) {
    $sortierung = 'id';
}

if ($reihenfolge != 'asc' &amp;&amp; $reihenfolge != 'desc') {
    $reihenfolge = 'desc';
}

// Abfrage ausführen
$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);

// Toggle-Logik vorbereiten
$standard_reihenfolge = 'desc';

if ($reihenfolge == 'asc') {
    $umgekehrte_reihenfolge = 'desc';
} else {
    $umgekehrte_reihenfolge = 'asc';
}

// Links für jede Spalte erstellen
if ($sortierung == 'name') {
    $link_name = "?sortierung=name&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_name = "?sortierung=name&amp;reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'spezialitaet') {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'taeglicher_unfug') {
    $link_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'kaffee_konsum') {
    $link_kaffee = "?sortierung=kaffee_konsum&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_kaffee = "?sortierung=kaffee_konsum&amp;reihenfolge=$standard_reihenfolge";
}
?&gt;

&lt;style&gt;
    .katzen-tabelle { width: 100%; border-collapse: collapse; margin: 20px 0; max-width: 800px; }
    .katzen-tabelle th, .katzen-tabelle td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    .katzen-tabelle th { background: #3498db; color: white; }
    .katzen-tabelle th a { color: white; text-decoration: none; }
    .katzen-tabelle th a:hover { text-decoration: underline; }
    .katzen-tabelle tr:nth-child(even) { background: #f2f2f2; }
    .katzen-tabelle tr:hover { background: #e8f4fc; }
&lt;/style&gt;

&lt;h2&gt;🐱 Mitarbeiter des Monats 🐱&lt;/h2&gt;

&lt;?php
echo "&lt;table class='katzen-tabelle'&gt;";
echo "&lt;thead&gt;&lt;tr&gt;";
echo "&lt;th&gt;&lt;a href='$link_name'&gt;Name&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_spezialitaet'&gt;Spezialität&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_unfug'&gt;Täglicher Unfug&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_kaffee'&gt;Kaffeekonsum&lt;/a&gt;&lt;/th&gt;";
echo "&lt;/tr&gt;&lt;/thead&gt;";
echo "&lt;tbody&gt;";

while ($katze = mysqli_fetch_assoc($result)) {
    $kaffee = $katze['kaffee_konsum'] ?? '???';
    
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['spezialitaet'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['taeglicher_unfug'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $kaffee . " ☕&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}

echo "&lt;/tbody&gt;";
echo "&lt;/table&gt;";

mysqli_free_result($result);
mysqli_close($conn);
?&gt;</code>
    </div>

    <h3>Zusatzaufgabe: Visueller Indikator</h3>

    <div class="zusatz">
        <div class="zusatz-titel">⭐ Pfeile für die aktive Sortierung</div>
        <p>Die aktive Spalte soll einen Pfeil zeigen, der die Sortierrichtung anzeigt: ↑ für aufsteigend, ↓ für absteigend.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">13</span>
        <span class="schritt-titel">Pfeil-Variable erstellen</span>
        <code>if ($reihenfolge == 'asc') {
    $pfeil = ' ↑';
} else {
    $pfeil = ' ↓';
}</code>
        <p>Der Pfeil zeigt die aktuelle Sortierrichtung an. Er wird nur bei der aktiven Spalte angezeigt.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">14</span>
        <span class="schritt-titel">Titel-Variablen mit Pfeil erstellen</span>
        <code>if ($sortierung == 'name') {
    $titel_name = "Name" . $pfeil;
} else {
    $titel_name = "Name";
}

if ($sortierung == 'spezialitaet') {
    $titel_spezialitaet = "Spezialität" . $pfeil;
} else {
    $titel_spezialitaet = "Spezialität";
}

if ($sortierung == 'taeglicher_unfug') {
    $titel_unfug = "Täglicher Unfug" . $pfeil;
} else {
    $titel_unfug = "Täglicher Unfug";
}

if ($sortierung == 'kaffee_konsum') {
    $titel_kaffee = "Kaffeekonsum" . $pfeil;
} else {
    $titel_kaffee = "Kaffeekonsum";
}</code>
        <p>Jede Spalte bekommt eine Titel-Variable. Nur die aktive Spalte erhält den Pfeil angehängt.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">15</span>
        <span class="schritt-titel">Tabellenkopf mit Titel-Variablen</span>
        <code>echo "&lt;thead&gt;&lt;tr&gt;";
echo "&lt;th&gt;&lt;a href='$link_name'&gt;$titel_name&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_spezialitaet'&gt;$titel_spezialitaet&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_unfug'&gt;$titel_unfug&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_kaffee'&gt;$titel_kaffee&lt;/a&gt;&lt;/th&gt;";
echo "&lt;/tr&gt;&lt;/thead&gt;";</code>
        <p>Statt fester Texte werden nun die Titel-Variablen verwendet. Die aktive Spalte zeigt automatisch den Pfeil an.</p>
        <div class="hinweis">
            <strong>Ergebnis:</strong> "Name ↑" zeigt an, dass nach Name aufsteigend sortiert wird. Ein Klick wechselt zu "Name ↓".
        </div>
    </div>
</div>