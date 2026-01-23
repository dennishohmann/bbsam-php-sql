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

<h2>🐱 Mitarbeiter des Monats 🐱</h2>

<?php
echo "<table class='katzen-tabelle'>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Spezialität</th>";
echo "<th>Täglicher Unfug</th>";
echo "<th>Kaffeekonsum</th>";
echo "</tr>";

while ($katze = mysqli_fetch_assoc($result)) {
    $kaffee = $katze['kaffee_konsum'] ?? '???';
    
    echo "<tr>";
    echo "<td>" . $katze['name'] . "</td>";
    echo "<td>" . $katze['spezialitaet'] . "</td>";
    echo "<td>" . $katze['taeglicher_unfug'] . "</td>";
    echo "<td>" . $kaffee . " ☕</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_free_result($result);
mysqli_close($conn);
?>

<div class="navigation">
    <a href="sql_4.php" class="nav-btn zurueck">← Zurück</a>
    <div class="nav-platzhalter"></div>
    <a href="sql_6.php" class="nav-btn weiter">Weiter zur Lösung→</a>
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
</style>

<div class="anleitung">
    <h2>🔀 Aufgabe: Sortierbare Tabellenspalten</h2>

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

    <h3>Toggle-Logik implementieren</h3>

    <div class="schritt">
        <span class="schritt-nummer">6</span>
        <span class="schritt-titel">Reihenfolge umkehren bei erneutem Klick</span>
        <code>if ($reihenfolge == 'asc') {
    $neue_reihenfolge = 'desc';
} else {
    $neue_reihenfolge = 'asc';
}</code>
        <p>Für die Links berechnen wir die umgekehrte Reihenfolge. Wenn aktuell aufsteigend sortiert wird, soll der nächste Klick absteigend sortieren und umgekehrt.</p>
    </div>

    <h3>Spaltenüberschriften als Links</h3>

    <div class="schritt">
        <span class="schritt-nummer">7</span>
        <span class="schritt-titel">Link-Funktion erstellen</span>
        <code>function sortier_link($spalte, $titel, $aktuelle_sortierung, $aktuelle_reihenfolge) {
    if ($spalte == $aktuelle_sortierung) {
        if ($aktuelle_reihenfolge == 'asc') {
            $neue_reihenfolge = 'desc';
        } else {
            $neue_reihenfolge = 'asc';
        }
    } else {
        $neue_reihenfolge = 'desc';
    }
    
    return "&lt;a href='?sortierung=$spalte&amp;reihenfolge=$neue_reihenfolge'&gt;$titel&lt;/a&gt;";
}</code>
        <p>Die Funktion erzeugt einen Link für eine Spalte. Parameter:</p>
        <div class="parameter">
            <strong>$spalte:</strong> Der Datenbankname der Spalte<br>
            <strong>$titel:</strong> Der angezeigte Text<br>
            <strong>$aktuelle_sortierung:</strong> Die aktuell aktive Spalte<br>
            <strong>$aktuelle_reihenfolge:</strong> Die aktuelle Richtung
        </div>
        <p>Wenn die Spalte bereits aktiv ist, wird die Reihenfolge umgekehrt. Bei einer anderen Spalte beginnen wir mit DESC.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">8</span>
        <span class="schritt-titel">Tabellenkopf mit Links</span>
        <code>echo "&lt;thead&gt;&lt;tr&gt;";
echo "&lt;th&gt;" . sortier_link('name', 'Name', $sortierung, $reihenfolge) . "&lt;/th&gt;";
echo "&lt;th&gt;" . sortier_link('spezialitaet', 'Spezialität', $sortierung, $reihenfolge) . "&lt;/th&gt;";
echo "&lt;th&gt;" . sortier_link('taeglicher_unfug', 'Täglicher Unfug', $sortierung, $reihenfolge) . "&lt;/th&gt;";
echo "&lt;th&gt;" . sortier_link('kaffee_konsum', 'Kaffeekonsum', $sortierung, $reihenfolge) . "&lt;/th&gt;";
echo "&lt;/tr&gt;&lt;/thead&gt;";</code>
        <p>Jede Überschrift ruft die Funktion auf und übergibt den Spaltennamen und den Anzeigetitel. Die Funktion gibt den fertigen Link zurück.</p>
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

// Whitelist prüfen
$erlaubte_spalten = ['id', 'name', 'spezialitaet', 'taeglicher_unfug', 'kaffee_konsum'];

if (!in_array($sortierung, $erlaubte_spalten)) {
    $sortierung = 'id';
}

if ($reihenfolge != 'asc' &amp;&amp; $reihenfolge != 'desc') {
    $reihenfolge = 'desc';
}

// Funktion für Sortier-Links
function sortier_link($spalte, $titel, $aktuelle_sortierung, $aktuelle_reihenfolge) {
    if ($spalte == $aktuelle_sortierung) {
        if ($aktuelle_reihenfolge == 'asc') {
            $neue_reihenfolge = 'desc';
        } else {
            $neue_reihenfolge = 'asc';
        }
    } else {
        $neue_reihenfolge = 'desc';
    }
    
    return "&lt;a href='?sortierung=$spalte&amp;reihenfolge=$neue_reihenfolge'&gt;$titel&lt;/a&gt;";
}

// Abfrage ausführen
$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);
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
echo "&lt;th&gt;" . sortier_link('name', 'Name', $sortierung, $reihenfolge) . "&lt;/th&gt;";
echo "&lt;th&gt;" . sortier_link('spezialitaet', 'Spezialität', $sortierung, $reihenfolge) . "&lt;/th&gt;";
echo "&lt;th&gt;" . sortier_link('taeglicher_unfug', 'Täglicher Unfug', $sortierung, $reihenfolge) . "&lt;/th&gt;";
echo "&lt;th&gt;" . sortier_link('kaffee_konsum', 'Kaffeekonsum', $sortierung, $reihenfolge) . "&lt;/th&gt;";
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
        <span class="schritt-nummer">11</span>
        <span class="schritt-titel">Funktion erweitern</span>
        <code>function sortier_link($spalte, $titel, $aktuelle_sortierung, $aktuelle_reihenfolge) {
    if ($spalte == $aktuelle_sortierung) {
        if ($aktuelle_reihenfolge == 'asc') {
            $neue_reihenfolge = 'desc';
            $pfeil = ' ↑';
        } else {
            $neue_reihenfolge = 'asc';
            $pfeil = ' ↓';
        }
    } else {
        $neue_reihenfolge = 'desc';
        $pfeil = '';
    }
    
    return "&lt;a href='?sortierung=$spalte&amp;reihenfolge=$neue_reihenfolge'&gt;$titel$pfeil&lt;/a&gt;";
}</code>
        <p>Die Funktion prüft nun zusätzlich, ob die Spalte aktiv ist. Falls ja, wird der passende Pfeil an den Titel angehängt. Inaktive Spalten zeigen keinen Pfeil.</p>
        <div class="hinweis">
            <strong>Ergebnis:</strong> "Name ↑" zeigt an, dass nach Name aufsteigend sortiert wird. Ein Klick wechselt zu "Name ↓".
        </div>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">12</span>
        <span class="schritt-titel">Optionales CSS für den Pfeil</span>
        <code>.katzen-tabelle th a .pfeil {
    font-size: 0.8em;
    margin-left: 5px;
}</code>
        <p>Falls du die Pfeile als eigenes Element stylen möchtest, kannst du sie in ein span-Tag packen und dieses CSS verwenden. Die einfache Variante mit direktem Unicode-Zeichen funktioniert aber genauso gut.</p>
    </div>
</div>