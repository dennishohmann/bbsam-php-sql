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

while ($katze = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $katze['name'] . "</td>";
    echo "<td>" . $katze['spezialitaet'] . "</td>";
    echo "<td>" . $katze['taeglicher_unfug'] . "</td>";
    echo "<td>" . $katze['kaffee_konsum'] . "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_free_result($result);
mysqli_close($conn);
?>

<div class="navigation">
    <a href="sql_4.php" class="nav-btn zurueck">&larr; Zurück</a>
    <div class="nav-platzhalter"></div>
    <a href="sql_5a.php" class="nav-btn weiter">Weiter zur Optimierung &rarr;</a>
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
    .konzept .parameter {
        background: #fff8e1;
        padding: 8px;
        border-radius: 5px;
        margin-top: 10px;
    }
    .konzept .parameter strong {
        color: #e65100;
    }

    /* Arbeitsschritt-Styles */
    .arbeitsschritt {
        background: white;
        margin: 15px 0;
        padding: 15px;
        border-left: 4px solid #9b59b6;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .schritt-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
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
    .schritt-auftrag {
        color: #333;
        font-size: 1.05em;
        margin: 10px 0;
        line-height: 1.6;
    }
    .schritt-auftrag code {
        background: #f3e8fc;
        padding: 2px 6px;
        border-radius: 3px;
        color: #8e44ad;
        font-family: monospace;
    }

    /* Hilfe/Details-Styles */
    .hilfe {
        margin-top: 10px;
        border: 1px dashed #bdc3c7;
        border-radius: 5px;
    }
    .hilfe summary {
        padding: 8px 12px;
        cursor: pointer;
        color: #7f8c8d;
        font-size: 0.9em;
    }
    .hilfe summary:hover {
        color: #9b59b6;
    }
    .hilfe[open] summary {
        border-bottom: 1px dashed #bdc3c7;
    }
    .hilfe-inhalt {
        padding: 12px;
        background: #fafafa;
    }
    .hilfe-inhalt p {
        color: #555;
        margin: 0 0 10px 0;
        line-height: 1.5;
    }
    .hilfe-inhalt ul {
        margin: 5px 0 10px 0;
        padding-left: 20px;
    }
    .hilfe-inhalt li {
        margin: 3px 0;
        color: #555;
    }
    .hilfe-inhalt li strong {
        color: #e74c3c;
    }
    .hilfe-inhalt code {
        display: block;
        background: #2c3e50;
        color: #2ecc71;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
        font-family: monospace;
        white-space: pre;
        overflow-x: auto;
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
    <h2>Aufgabe: Sortierbare Tabellenspalten</h2>

    <div class="konzept">
        <div class="konzept-titel">Das Konzept</div>
        <p>Die Spaltenüberschriften werden zu Links, die beim Klick die Seite neu laden und dabei Parameter übergeben. Diese Parameter steuern die Sortierung der SQL-Abfrage. Ein erneuter Klick auf dieselbe Spalte kehrt die Reihenfolge um.</p>
        <div class="parameter">
            <strong>Beispiel-URL:</strong> seite.php?sortierung=name&amp;reihenfolge=asc
        </div>
    </div>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Mache die Tabellenspalten klickbar, um die Sortierung zu ändern.</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>URL-Parameter für Sortierung und Reihenfolge auslesen</li>
                <li>SQL-Abfrage mit ORDER BY dynamisch anpassen</li>
                <li>Toggle-Logik: umgekehrte Reihenfolge für erneuten Klick berechnen</li>
                <li>Für jede Spalte einen Link erstellen</li>
                <li>Tabellenüberschriften als klickbare Links ausgeben</li>
            </ol>
        </div>
    </div>

    <h3>URL-Parameter auslesen</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">1</span>
            <span class="schritt-titel">$_REQUEST verstehen</span>
        </div>
        <p class="schritt-auftrag">
            Mache dich mit dem <code>$_REQUEST</code>-Array vertraut. Es enthält alle Parameter,
            die über die URL übergeben werden. Wenn du <code>seite.php?name=Wert</code> aufrufst,
            steht der Wert in <code>$_REQUEST['name']</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p><code>$_REQUEST</code> ist ein Array mit allen übergebenen Parametern:</p>
                <ul>
                    <li><strong>URL:</strong> seite.php?sortierung=name&amp;reihenfolge=asc</li>
                    <li><strong>$_REQUEST['sortierung']:</strong> "name"</li>
                    <li><strong>$_REQUEST['reihenfolge']:</strong> "asc"</li>
                </ul>
                <code>$wert = $_REQUEST['parametername'];</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">2</span>
            <span class="schritt-titel">Parameter mit Standardwerten auslesen</span>
        </div>
        <p class="schritt-auftrag">
            Lies die Parameter <code>sortierung</code> und <code>reihenfolge</code> aus. Nutze
            <code>isset()</code> um zu prüfen, ob der Parameter existiert. Falls nicht, setze
            Standardwerte: Sortierung nach <code>'id'</code>, Reihenfolge <code>'desc'</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Mit <code>isset()</code> prüfst du, ob ein Parameter existiert:</p>
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
            </div>
        </details>
    </div>

    <h3>SQL-Abfrage anpassen</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">3</span>
            <span class="schritt-titel">Dynamische ORDER BY Klausel</span>
        </div>
        <p class="schritt-auftrag">
            Baue die SQL-Abfrage so um, dass die Variablen <code>$sortierung</code> und
            <code>$reihenfolge</code> in der ORDER BY-Klausel verwendet werden. Speichere
            den SQL-String in einer Variable <code>$sql</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Die Variablen werden in den SQL-String eingesetzt:</p>
                <code>$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);</code>
                <div class="hinweis">
                    <strong>Beispiel:</strong> Bei sortierung=name und reihenfolge=asc wird daraus:<br>
                    SELECT * FROM katzen ORDER BY name asc
                </div>
            </div>
        </details>
    </div>

    <h3>Toggle-Logik implementieren</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">4</span>
            <span class="schritt-titel">Reihenfolge umkehren bei erneutem Klick</span>
        </div>
        <p class="schritt-auftrag">
            Erstelle eine Variable <code>$standard_reihenfolge</code> mit dem Wert <code>'desc'</code>.
            Berechne dann die <code>$umgekehrte_reihenfolge</code>: Wenn aktuell <code>'asc'</code>
            sortiert wird, soll es <code>'desc'</code> sein und umgekehrt.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Mit einer if-Bedingung die Reihenfolge umkehren:</p>
                <code>$standard_reihenfolge = 'desc';

if ($reihenfolge == 'asc') {
    $umgekehrte_reihenfolge = 'desc';
} else {
    $umgekehrte_reihenfolge = 'asc';
}</code>
            </div>
        </details>
    </div>

    <h3>Links für jede Spalte erstellen</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">5</span>
            <span class="schritt-titel">Links einzeln erstellen</span>
        </div>
        <p class="schritt-auftrag">
            Erstelle für jede Spalte (name, spezialitaet, taeglicher_unfug, kaffee_konsum) eine
            Link-Variable. Prüfe mit <code>if</code>, ob diese Spalte gerade aktiv ist. Falls ja,
            verwende die <code>$umgekehrte_reihenfolge</code>, sonst die <code>$standard_reihenfolge</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Für jede Spalte einen eigenen Link mit Bedingung:</p>
                <code>// Link für "Name"
if ($sortierung == 'name') {
    $link_name = "?sortierung=name&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_name = "?sortierung=name&amp;reihenfolge=$standard_reihenfolge";
}

// Link für "Spezialitaet"
if ($sortierung == 'spezialitaet') {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$standard_reihenfolge";
}

// Link für "Taeglicher Unfug"
if ($sortierung == 'taeglicher_unfug') {
    $link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$standard_reihenfolge";
}

// Link für "Kaffeekonsum"
if ($sortierung == 'kaffee_konsum') {
    $link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=$standard_reihenfolge";
}</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">6</span>
            <span class="schritt-titel">Tabellenkopf mit Links ausgeben</span>
        </div>
        <p class="schritt-auftrag">
            Ändere die Ausgabe des Tabellenkopfes: Jede Überschrift wird zu einem Link mit
            <code>&lt;a href='...'&gt;</code>. Nutze die vorher erstellten Link-Variablen.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Die Überschriften werden zu klickbaren Links:</p>
                <code>echo "&lt;thead&gt;&lt;tr&gt;";
echo "&lt;th&gt;&lt;a href='$link_name'&gt;Name&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_spezialitaet'&gt;Spezialitaet&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_taeglicher_unfug'&gt;Taeglicher Unfug&lt;/a&gt;&lt;/th&gt;";
echo "&lt;th&gt;&lt;a href='$link_kaffee_konsum'&gt;Kaffeekonsum&lt;/a&gt;&lt;/th&gt;";
echo "&lt;/tr&gt;&lt;/thead&gt;";</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">7</span>
            <span class="schritt-titel">CSS für die Links hinzufügen</span>
        </div>
        <p class="schritt-auftrag">
            Füge CSS-Regeln hinzu, damit die Links in den Überschriften weiß sind und sich
            beim Hover unterstreichen. Nutze den Selektor <code>.katzen-tabelle th a</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>CSS für weiße Links, die sich ins Design einfügen:</p>
                <code>.katzen-tabelle th a {
    color: white;
    text-decoration: none;
}
.katzen-tabelle th a:hover {
    text-decoration: underline;
}</code>
            </div>
        </details>
    </div>

    <h3>Vollständiger Code</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">8</span>
            <span class="schritt-titel">Alles zusammengesetzt</span>
        </div>
        <p class="schritt-auftrag">
            Vergleiche deinen Code mit der vollständigen Lösung. Alle Teile sollten zusammenpassen:
            Parameter auslesen, SQL dynamisch bauen, Toggle-Logik, Links erstellen und ausgeben.
        </p>
        <details class="hilfe">
            <summary>Lösung anzeigen</summary>
            <div class="hilfe-inhalt">
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

// Links für jede Spalte einzeln erstellen
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

while ($katze = mysqli_fetch_array($result)) {
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['spezialitaet'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['taeglicher_unfug'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['kaffee_konsum'] . "&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}

echo "&lt;/tbody&gt;";
echo "&lt;/table&gt;";

mysqli_free_result($result);
mysqli_close($conn);
?&gt;</code>
            </div>
        </details>
    </div>

    <h3>Nächster Schritt: Code-Optimierung</h3>

    <div class="zusatz">
        <div class="zusatz-titel">Code-Wiederholung vermeiden</div>
        <p>Fällt dir auf, dass sich der Code für die Links sehr oft wiederholt? In sql_5a.php lernst du, wie du diesen Code mit Arrays und foreach-Schleifen eleganter schreiben kannst!</p>
    </div>
</div>
