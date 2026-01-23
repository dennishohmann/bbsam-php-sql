<?php
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM katzen ORDER BY kaffee_konsum DESC");
?>

<style>
    .katzen-tabelle { width: 100%; border-collapse: collapse; margin: 20px 0; }
    .katzen-tabelle th, .katzen-tabelle td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    .katzen-tabelle th { background: #3498db; color: white; }
    .katzen-tabelle tr:nth-child(even) { background: #f2f2f2; }
    .katzen-tabelle tr:hover { background: #e8f4fc; }
</style>

<h2>Mitarbeiter des Monats</h2>

<?php
echo "<table class='katzen-tabelle'>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Spezialitaet</th>";
echo "<th>Taeglicher Unfug</th>";
echo "<th>Kaffeekonsum</th>";
echo "</tr>";

while ($katze = mysqli_fetch_assoc($result)) {
    $kaffee = $katze['kaffee_konsum'] ?? '???';

    echo "<tr>";
    echo "<td>" . $katze['name'] . "</td>";
    echo "<td>" . $katze['spezialitaet'] . "</td>";
    echo "<td>" . $katze['taeglicher_unfug'] . "</td>";
    echo "<td>" . $kaffee . "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_free_result($result);
mysqli_close($conn);
?>

<div class="navigation">
    <a href="sql_4.php" class="nav-btn zurueck">Zurueck</a>
    <div class="nav-platzhalter"></div>
    <a href="sql_5a.php" class="nav-btn weiter">Weiter zur Optimierung</a>
</div>

<!--    #######################################
        Ab hier braucht ihr nicht weiter lesen :)

        Diese Anleitung braucht nur im Browser gelesen zu werden...
-->


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
    .aufgabe {
        background: #e3f2fd;
        border: 2px solid #2196f3;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .aufgabe-titel {
        font-weight: bold;
        color: #1565c0;
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .aufgabe p {
        color: #333;
        font-size: 1.1em;
        margin-bottom: 10px;
    }
    .schritte-liste {
        background: white;
        padding: 10px 10px 10px 25px;
        border-radius: 5px;
    }
    .schritte-liste ol {
        margin: 10px 0 0 0;
        padding-left: 20px;
    }
    .schritte-liste li {
        margin: 5px 0;
        color: #555;
    }
</style>

<div class="anleitung">
    <h2>Aufgabe: Sortierbare Tabellenspalten</h2>

    <div class="konzept">
        <div class="konzept-titel">Das Konzept</div>
        <p>Die Spaltenueberschriften werden zu Links, die beim Klick die Seite neu laden und dabei Parameter uebergeben. Diese Parameter steuern die Sortierung der SQL-Abfrage. Ein erneuter Klick auf dieselbe Spalte kehrt die Reihenfolge um.</p>
        <div class="parameter">
            <strong>Beispiel-URL:</strong> seite.php?sortierung=name&amp;reihenfolge=asc
        </div>
    </div>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Mache die Tabellenspalten klickbar, um die Sortierung zu aendern.</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>URL-Parameter fuer Sortierung und Reihenfolge auslesen</li>
                <li>SQL-Abfrage mit ORDER BY dynamisch anpassen</li>
                <li>Toggle-Logik: umgekehrte Reihenfolge fuer erneuten Klick berechnen</li>
                <li>Fuer jede Spalte einen Link erstellen</li>
                <li>Tabellenueberschriften als klickbare Links ausgeben</li>
            </ol>
        </div>
    </div>

    <h3>URL-Parameter auslesen</h3>

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">$_REQUEST verstehen</span>
        <code>$wert = $_REQUEST['parametername'];</code>
        <p>$_REQUEST ist ein Array, das alle uebergebenen Parameter enthaelt, egal ob per URL (GET) oder Formular (POST). Wir nutzen es, um die Sortierparameter auszulesen.</p>
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
        <p>Die Funktion isset() prueft, ob ein Parameter ueberhaupt existiert. Falls nicht, setzen wir Standardwerte: Sortierung nach ID, absteigend (DESC).</p>
    </div>

    <h3>SQL-Abfrage anpassen</h3>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Dynamische ORDER BY Klausel</span>
        <code>$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);</code>
        <p>Die Variablen werden in den SQL-String eingesetzt. Da wir sie vorher validiert haben, ist dies sicher. Die Abfrage sortiert nun nach der gewaehlten Spalte in der gewaehlten Richtung.</p>
        <div class="hinweis">
            <strong>Beispiel:</strong> Bei sortierung=name und reihenfolge=asc wird daraus:<br>
            SELECT * FROM katzen ORDER BY name asc
        </div>
    </div>

    <h3>Toggle-Logik implementieren</h3>

    <div class="schritt">
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">Reihenfolge umkehren bei erneutem Klick</span>
        <code>$standard_reihenfolge = 'desc';

if ($reihenfolge == 'asc') {
    $umgekehrte_reihenfolge = 'desc';
} else {
    $umgekehrte_reihenfolge = 'asc';
}</code>
        <p>Fuer die Links berechnen wir die umgekehrte Reihenfolge. Wenn aktuell aufsteigend sortiert wird, soll der naechste Klick absteigend sortieren und umgekehrt.</p>
    </div>

    <h3>Links fuer jede Spalte erstellen</h3>

    <div class="schritt">
        <span class="schritt-nummer">5</span>
        <span class="schritt-titel">Links einzeln erstellen</span>
        <code>// Link fuer "Name"
if ($sortierung == 'name') {
    $link_name = "?sortierung=name&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_name = "?sortierung=name&amp;reihenfolge=$standard_reihenfolge";
}

// Link fuer "Spezialitaet"
if ($sortierung == 'spezialitaet') {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$standard_reihenfolge";
}

// Link fuer "Taeglicher Unfug"
if ($sortierung == 'taeglicher_unfug') {
    $link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$standard_reihenfolge";
}

// Link fuer "Kaffeekonsum"
if ($sortierung == 'kaffee_konsum') {
    $link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=$standard_reihenfolge";
}</code>
        <p>Fuer jede Spalte erstellen wir einen eigenen Link. Wenn die Spalte gerade aktiv ist, verwenden wir die umgekehrte Reihenfolge, sonst die Standard-Reihenfolge.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">6</span>
        <span class="schritt-titel">Tabellenkopf mit Links ausgeben</span>
        <code>echo "&lt;thead&gt;&lt;tr&gt;";
echo "&lt;th&gt;&lt;a href='$link_name'&gt;Name&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_spezialitaet'&gt;Spezialitaet&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_taeglicher_unfug'&gt;Taeglicher Unfug&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_kaffee_konsum'&gt;Kaffeekonsum&lt;/a&gt;&lt;/th&gt;";
echo "&lt;/tr&gt;&lt;/thead&gt;";</code>
        <p>Jede Ueberschrift wird als Link mit dem entsprechenden Ziel ausgegeben.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">7</span>
        <span class="schritt-titel">CSS fuer die Links</span>
        <code>.katzen-tabelle th a {
    color: white;
    text-decoration: none;
}
.katzen-tabelle th a:hover {
    text-decoration: underline;
}</code>
        <p>Die Links in den Ueberschriften sollen weiss sein und beim Hover unterstrichen werden, damit sie sich in das bestehende Design einfuegen.</p>
    </div>

    <h3>Vollstaendiger Code</h3>

    <div class="schritt">
        <span class="schritt-nummer">8</span>
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

// Abfrage ausfuehren
$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);

// Toggle-Logik vorbereiten
$standard_reihenfolge = 'desc';

if ($reihenfolge == 'asc') {
    $umgekehrte_reihenfolge = 'desc';
} else {
    $umgekehrte_reihenfolge = 'asc';
}

// Links fuer jede Spalte einzeln erstellen
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
    $link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'kaffee_konsum') {
    $link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=$standard_reihenfolge";
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

&lt;h2&gt;Mitarbeiter des Monats&lt;/h2&gt;

&lt;?php
echo "&lt;table class='katzen-tabelle'&gt;";
echo "&lt;thead&gt;&lt;tr&gt;";
echo "&lt;th&gt;&lt;a href='$link_name'&gt;Name&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_spezialitaet'&gt;Spezialitaet&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_taeglicher_unfug'&gt;Taeglicher Unfug&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_kaffee_konsum'&gt;Kaffeekonsum&lt;/a&gt;&lt;/th&gt;";
echo "&lt;/tr&gt;&lt;/thead&gt;";
echo "&lt;tbody&gt;";

while ($katze = mysqli_fetch_assoc($result)) {
    $kaffee = $katze['kaffee_konsum'] ?? '???';

    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['spezialitaet'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['taeglicher_unfug'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $kaffee . "&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}

echo "&lt;/tbody&gt;";
echo "&lt;/table&gt;";

mysqli_free_result($result);
mysqli_close($conn);
?&gt;</code>
    </div>

    <h3>Naechster Schritt: Code-Optimierung</h3>

    <div class="zusatz">
        <div class="zusatz-titel">Code-Wiederholung vermeiden</div>
        <p>Faellt dir auf, dass sich der Code fuer die Links sehr oft wiederholt? In sql_5a.php lernst du, wie du diesen Code mit Arrays und foreach-Schleifen eleganter schreiben kannst!</p>
    </div>
</div>
