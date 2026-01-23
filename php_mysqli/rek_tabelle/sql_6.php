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

// Spalten-Array: Datenbankname => Anzeigetitel
$spalten = [
    'name' => 'Name',
    'spezialitaet' => 'Spezialität',
    'taeglicher_unfug' => 'Täglicher Unfug',
    'kaffee_konsum' => 'Kaffeekonsum'
];

// Links für jede Spalte erstellen
$links = [];
foreach ($spalten as $spalte => $titel) {
    if ($sortierung == $spalte) {
        $links[$spalte] = "?sortierung=$spalte&reihenfolge=$umgekehrte_reihenfolge";
    } else {
        $links[$spalte] = "?sortierung=$spalte&reihenfolge=$standard_reihenfolge";
    }
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
foreach ($spalten as $spalte => $titel) {
    echo "<th><a href='" . $links[$spalte] . "'>$titel</a></th>";
}
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
    <a href="sql_5.php" class="nav-btn zurueck">← Zurück</a>
    <div class="nav-platzhalter"></div>
    <a href="sql_7.php" class="nav-btn weiter">Weiter zur Bonus-Lösung→</a>
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
    .musterloesung {
        background: #d4edda;
        border: 2px solid #28a745;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .musterloesung-titel {
        font-weight: bold;
        color: #155724;
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .musterloesung p {
        color: #155724;
        font-size: 1.05em;
        margin: 0;
    }
</style>

<div class="anleitung">
    <h2>🔀 Sortierbare Tabellenspalten</h2>

    <div class="musterloesung">
        <div class="musterloesung-titel">✅ Musterlösung</div>
        <p>Dies ist die fertige Lösung zur Aufgabe aus sql_5.php. Vergleiche deinen Code mit dieser Lösung!</p>
    </div>

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

    <h3>SQL-Abfrage anpassen</h3>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
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
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">Standard-Reihenfolge für neue Spalten</span>
        <code>$standard_reihenfolge = 'desc';</code>
        <p>Wenn eine bisher nicht aktive Spalte angeklickt wird, soll sie mit dieser Reihenfolge starten. Wir definieren sie als Variable für einfache Anpassung.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">5</span>
        <span class="schritt-titel">Umgekehrte Reihenfolge berechnen</span>
        <code>if ($reihenfolge == 'asc') {
    $umgekehrte_reihenfolge = 'desc';
} else {
    $umgekehrte_reihenfolge = 'asc';
}</code>
        <p>Für die aktive Spalte berechnen wir die umgekehrte Reihenfolge. Diese wird im Link verwendet, damit ein erneuter Klick die Richtung wechselt.</p>
    </div>

    <h3>Spalten-Array und foreach-Schleife</h3>

    <div class="schritt">
        <span class="schritt-nummer">6</span>
        <span class="schritt-titel">Spalten-Array definieren</span>
        <code>$spalten = [
    'name' => 'Name',
    'spezialitaet' => 'Spezialität',
    'taeglicher_unfug' => 'Täglicher Unfug',
    'kaffee_konsum' => 'Kaffeekonsum'
];</code>
        <p>Das Array enthält alle Spalten als Key-Value-Paare: Der Key ist der Datenbankname, der Value ist der Anzeigetitel. So vermeiden wir Wiederholungen im Code.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">7</span>
        <span class="schritt-titel">Links mit foreach erstellen</span>
        <code>$links = [];
foreach ($spalten as $spalte => $titel) {
    if ($sortierung == $spalte) {
        $links[$spalte] = "?sortierung=$spalte&amp;reihenfolge=$umgekehrte_reihenfolge";
    } else {
        $links[$spalte] = "?sortierung=$spalte&amp;reihenfolge=$standard_reihenfolge";
    }
}</code>
        <p>Die foreach-Schleife durchläuft alle Spalten und erstellt für jede einen Link. Falls die Spalte aktiv ist, wird die umgekehrte Reihenfolge verwendet, sonst die Standard-Reihenfolge.</p>
    </div>

    <h3>Tabellenkopf mit foreach ausgeben</h3>

    <div class="schritt">
        <span class="schritt-nummer">8</span>
        <span class="schritt-titel">Überschriften mit foreach ausgeben</span>
        <code>echo "&lt;thead&gt;&lt;tr&gt;";
foreach ($spalten as $spalte => $titel) {
    echo "&lt;th&gt;&lt;a href='" . $links[$spalte] . "'&gt;$titel&lt;/a&gt;&lt;/th&gt;";
}
echo "&lt;/tr&gt;&lt;/thead&gt;";</code>
        <p>Eine weitere foreach-Schleife gibt die Tabellenüberschriften aus. Der Titel kommt aus dem $spalten-Array, der Link aus dem $links-Array.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">9</span>
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
        <span class="schritt-nummer">10</span>
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

// Spalten-Array: Datenbankname =&gt; Anzeigetitel
$spalten = [
    'name' =&gt; 'Name',
    'spezialitaet' =&gt; 'Spezialität',
    'taeglicher_unfug' =&gt; 'Täglicher Unfug',
    'kaffee_konsum' =&gt; 'Kaffeekonsum'
];

// Links für jede Spalte erstellen
$links = [];
foreach ($spalten as $spalte =&gt; $titel) {
    if ($sortierung == $spalte) {
        $links[$spalte] = "?sortierung=$spalte&amp;reihenfolge=$umgekehrte_reihenfolge";
    } else {
        $links[$spalte] = "?sortierung=$spalte&amp;reihenfolge=$standard_reihenfolge";
    }
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
foreach ($spalten as $spalte =&gt; $titel) {
    echo "&lt;th&gt;&lt;a href='" . $links[$spalte] . "'&gt;$titel&lt;/a&gt;&lt;/th&gt;";
}
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
        <p>Die aktive Spalte soll einen Pfeil zeigen, der die Sortierrichtung anzeigt: ↑ für aufsteigend, ↓ für absteigend. Siehe sql_7.php für die Lösung mit foreach!</p>
    </div>
</div>