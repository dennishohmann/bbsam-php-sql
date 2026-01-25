<?php
// ============================================
// MUSTERLÖSUNG: Einfache Sortierung (immer absteigend)
// ============================================

// Datenbankverbindung
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Schritt 1: Parameter auslesen
$sortierung = 'id';
if (isset($_REQUEST['sortierung'])) {
    $sortierung = $_REQUEST['sortierung'];
}

// Schritt 2: SQL-Abfrage mit dynamischer Sortierung
$sql = "SELECT * FROM katzen ORDER BY $sortierung DESC";
$result = mysqli_query($conn, $sql);

?>

<style>
    .katzen-tabelle { width: 100%; border-collapse: collapse; margin: 20px 0; }
    .katzen-tabelle th, .katzen-tabelle td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    .katzen-tabelle th { background: #3498db; color: white; }
    .katzen-tabelle th a { color: white; text-decoration: none; }
    .katzen-tabelle th a:hover { text-decoration: underline; }
    .katzen-tabelle tr:nth-child(even) { background: #f2f2f2; }
    .katzen-tabelle tr:hover { background: #e8f4fc; }
</style>

<h2>🐱 Mitarbeiter des Monats 🐱</h2>

<?php
// Schritt 3: Tabelle mit klickbaren Überschriften
echo "<table class='katzen-tabelle'>";
echo "<thead><tr>";
echo "<th><a href='?sortierung=name'>Name</a></th>";
echo "<th><a href='?sortierung=spezialitaet'>Spezialitaet</a></th>";
echo "<th><a href='?sortierung=taeglicher_unfug'>Taeglicher Unfug</a></th>";
echo "<th><a href='?sortierung=kaffee_konsum'>Kaffeekonsum</a></th>";
echo "</tr></thead>";
echo "<tbody>";

while ($katze = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $katze['name'] . "</td>";
    echo "<td>" . $katze['spezialitaet'] . "</td>";
    echo "<td>" . $katze['taeglicher_unfug'] . "</td>";
    echo "<td>" . $katze['kaffee_konsum'] . "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

mysqli_free_result($result);
mysqli_close($conn);
?>


<!--    #######################################
        Ab hier braucht ihr nicht weiter lesen :)

        Diese Anleitung ist nur für die Anzeige im Browser gedacht...
-->

<div class="navigation">
    <a href="sql_5.php" class="nav-btn zurueck">&larr; Zurück</a>
    <div class="nav-platzhalter"></div>
    <a href="sql_5b.php" class="nav-btn weiter">Weiter zur Optimierung &rarr;</a>
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
    <h2>Erweiterung: Sortierrichtung umschalten</h2>

    <div class="konzept">
        <div class="konzept-titel">Das Konzept</div>
        <p>Ein erneuter Klick auf dieselbe Spalte soll die Sortierrichtung umkehren (Toggle). Dafür brauchen wir einen zweiten URL-Parameter: <code>reihenfolge</code>.</p>
        <div class="parameter">
            <strong>Beispiel-URL:</strong> seite.php?sortierung=name&amp;reihenfolge=asc
        </div>
    </div>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Erweitere den Code aus sql_5.php um die Toggle-Funktion.</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>Zweiten Parameter <code>reihenfolge</code> auslesen</li>
                <li>SQL-Abfrage um <code>$reihenfolge</code> erweitern</li>
                <li>Toggle-Logik implementieren</li>
                <li>Links je nach aktiver Spalte anpassen</li>
            </ol>
        </div>
    </div>

    <h3>Zweiten Parameter auslesen</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">1</span>
            <span class="schritt-titel">Parameter reihenfolge hinzufügen</span>
        </div>
        <p class="schritt-auftrag">
            Lies zusätzlich den Parameter <code>reihenfolge</code> aus. Standardwert ist <code>'desc'</code>.
            Das Muster ist identisch zum Parameter <code>sortierung</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Beide Parameter nacheinander auslesen:</p>
                <code>$sortierung = 'id';
if (isset($_REQUEST['sortierung'])) {
    $sortierung = $_REQUEST['sortierung'];
}

$reihenfolge = 'desc';
if (isset($_REQUEST['reihenfolge'])) {
    $reihenfolge = $_REQUEST['reihenfolge'];
}</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">2</span>
            <span class="schritt-titel">SQL-Abfrage anpassen</span>
        </div>
        <p class="schritt-auftrag">
            Ersetze das feste <code>DESC</code> in der SQL-Abfrage durch die Variable <code>$reihenfolge</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Die Variable steuert jetzt die Sortierrichtung:</p>
                <code>$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);</code>
            </div>
        </details>
    </div>

    <h3>Toggle-Logik implementieren</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">3</span>
            <span class="schritt-titel">Umgekehrte Reihenfolge berechnen</span>
        </div>
        <p class="schritt-auftrag">
            Definiere eine Variable <code>$standard_reihenfolge</code> (für neue Spalten) und
            berechne <code>$umgekehrte_reihenfolge</code> (für die aktive Spalte).
            Wenn aktuell <code>'asc'</code>, dann umgekehrt <code>'desc'</code> und umgekehrt.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Mit if-else die Richtung umkehren:</p>
                <code>$standard_reihenfolge = 'desc';

if ($reihenfolge == 'asc') {
    $umgekehrte_reihenfolge = 'desc';
} else {
    $umgekehrte_reihenfolge = 'asc';
}</code>
                <div class="hinweis">
                    <strong>Warum zwei Variablen?</strong><br>
                    - <code>$standard_reihenfolge</code>: Für Spalten, die NICHT aktiv sind<br>
                    - <code>$umgekehrte_reihenfolge</code>: Für die aktive Spalte (Toggle)
                </div>
            </div>
        </details>
    </div>

    <h3>Links in Variablen auslagern</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">4</span>
            <span class="schritt-titel">Link-Variablen definieren</span>
        </div>
        <p class="schritt-auftrag">
            Wenn mehrere Links oder komplexe URLs entstehen, ist es übersichtlicher, die
            Link-Strings vorher in einem Block zu definieren. So stehen alle URLs an einer
            Stelle und sind leichter zu warten und zu ändern.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Alle Link-Variablen gesammelt definieren:</p>
                <code>$link_name = "?sortierung=name&amp;reihenfolge=...";
$link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=...";
$link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=...";
$link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=...";</code>
                <div class="hinweis">
                    <strong>Vorteil:</strong> Alle URLs sind an einer Stelle gebündelt.
                    Wenn sich das URL-Schema ändert, musst du nur diesen Block anpassen.
                </div>
            </div>
        </details>
    </div>

    <h3>Links je nach aktiver Spalte</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">5</span>
            <span class="schritt-titel">Links mit Bedingung erstellen</span>
        </div>
        <p class="schritt-auftrag">
            Für jede Spalte: Prüfe mit <code>if</code>, ob diese Spalte gerade aktiv ist.
            Falls ja, verwende <code>$umgekehrte_reihenfolge</code>.
            Falls nein, verwende <code>$standard_reihenfolge</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Für jede Spalte einen eigenen if-Block:</p>
                <code>// Link für "Name"
if ($sortierung == 'name') {
    $link_name = "?sortierung=name&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_name = "?sortierung=name&amp;reihenfolge=$standard_reihenfolge";
}

// Link für "Spezialität"
if ($sortierung == 'spezialitaet') {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$standard_reihenfolge";
}

// ... und so weiter für die anderen Spalten</code>
            </div>
        </details>
    </div>

    <h3>Vollständiger Code</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">6</span>
            <span class="schritt-titel">Alles zusammengesetzt</span>
        </div>
        <p class="schritt-auftrag">
            Vergleiche deinen Code mit der vollständigen Lösung. Teste das Toggle-Verhalten:
            Klick auf "Name" sortiert absteigend, erneuter Klick sortiert aufsteigend.
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
$sortierung = 'id';
if (isset($_REQUEST['sortierung'])) {
    $sortierung = $_REQUEST['sortierung'];
}

$reihenfolge = 'desc';
if (isset($_REQUEST['reihenfolge'])) {
    $reihenfolge = $_REQUEST['reihenfolge'];
}

// SQL-Abfrage mit Sortierung und Reihenfolge
$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";
$result = mysqli_query($conn, $sql);

// Toggle-Logik: Reihenfolge umkehren
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
    $link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_taeglicher_unfug = "?sortierung=taeglicher_unfug&amp;reihenfolge=$standard_reihenfolge";
}

if ($sortierung == 'kaffee_konsum') {
    $link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_kaffee_konsum = "?sortierung=kaffee_konsum&amp;reihenfolge=$standard_reihenfolge";
}
?&gt;</code>
            </div>
        </details>
    </div>

    <h3>Nächster Schritt: Code-Optimierung</h3>

    <div class="zusatz">
        <div class="zusatz-titel">Code-Wiederholung vermeiden</div>
        <p>Fällt dir auf, dass sich der Code für die Links sehr oft wiederholt? In sql_5b.php lernst du,
        wie du diesen Code mit Arrays und foreach-Schleifen eleganter schreiben kannst!</p>
    </div>
</div>
