<?php
// ============================================
// AUFGABE: Datensätze über einen Link löschen
// ============================================

// Datenbankverbindung
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// --------------------------------------------
// Schritt 1: Prüfen ob ein Lösch-Parameter übergeben wurde
// Tipp: Nutze isset() und $_GET['delete']
// --------------------------------------------


// --------------------------------------------
// Schritt 2: Wenn ja, Datensatz löschen
// Tipp: Nutze intval() für Sicherheit und mysqli_query() mit DELETE
// --------------------------------------------


// Daten abfragen
$result = mysqli_query($conn, "SELECT * FROM katzen");
?>

<style>
    .katzen-tabelle { width: 100%; border-collapse: collapse; margin: 20px 0; }
    .katzen-tabelle th, .katzen-tabelle td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    .katzen-tabelle th { background: #3498db; color: white; }
    .katzen-tabelle tr:nth-child(even) { background: #f2f2f2; }
    .katzen-tabelle tr:hover { background: #e8f4fc; }
    .loeschen-btn {
        background: #e74c3c;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.9em;
    }
    .loeschen-btn:hover {
        background: #c0392b;
    }
</style>

<h2>Mitarbeiter des Monats</h2>

<?php
echo "<table class='katzen-tabelle'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Spezialität</th>";
echo "<th>Täglicher Unfug</th>";
echo "<th>Kaffeekonsum</th>";
// --------------------------------------------
// Schritt 3: Neue Spalte "Aktion" im Tabellenkopf hinzufügen
// --------------------------------------------

echo "</tr>";

while ($katze = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $katze['id'] . "</td>";
    echo "<td>" . $katze['name'] . "</td>";
    echo "<td>" . $katze['spezialitaet'] . "</td>";
    echo "<td>" . $katze['taeglicher_unfug'] . "</td>";
    echo "<td>" . $katze['kaffee_konsum'] . " Tassen</td>";
    // --------------------------------------------
    // Schritt 4: Lösch-Link mit ID als GET-Parameter hinzufügen
    // Beispiel: <a href='delete_1.php?delete=3'>Löschen</a>
    // --------------------------------------------

    echo "</tr>";
}

echo "</table>";

mysqli_free_result($result);
mysqli_close($conn);
?>



<!--    #######################################
        Ab hier braucht ihr nicht weiter lesen :)

        Diese Anleitung ist nur für die Anzeige im Browser gedacht...
-->
<div class="navigation">
    <a href="delete_0.html" class="nav-btn zurueck">&larr; Zurück</a>
    <div class="nav-platzhalter"></div>
    <a href="delete_2.php" class="nav-btn weiter">Weiter zur Lösung &rarr;</a>
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
    .konzept code {
        background: #eceff1;
        padding: 2px 6px;
        border-radius: 3px;
        font-family: monospace;
        color: #c62828;
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
</style>

<div class="anleitung">
    <h2>Datensätze löschen mit PHP &amp; MySQL</h2>

    <div class="konzept">
        <div class="konzept-titel">GET-Parameter</div>
        <p>
            Mit GET-Parametern können Daten über die URL übergeben werden. Der Parameter wird an die URL angehängt:
        </p>
        <p style="text-align: center; font-family: monospace; font-size: 1.1em; margin: 15px 0;">
            <code>delete_1.php?delete=3</code>
        </p>
        <p>
            In PHP greifst du auf den Wert mit <code>$_GET['delete']</code> zu. Das Ergebnis wäre hier: <code>3</code>
        </p>
    </div>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Erweitere die Tabelle um eine Lösch-Funktion:</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>Prüfen ob ein <code>delete</code>-Parameter in der URL übergeben wurde</li>
                <li>Wenn ja: Den Datensatz mit dieser ID aus der Datenbank löschen</li>
                <li>Eine neue Tabellenspalte "Aktion" im Kopf hinzufügen</li>
                <li>In jeder Zeile einen Lösch-Link mit der jeweiligen ID einfügen</li>
            </ol>
        </div>
    </div>

    <h3>Die Arbeitsschritte</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">1</span>
            <span class="schritt-titel">Prüfen ob gelöscht werden soll</span>
        </div>
        <p class="schritt-auftrag">
            Am Anfang der PHP-Datei (vor der Datenabfrage) prüfst du mit <code>isset()</code>,
            ob der GET-Parameter <code>delete</code> vorhanden ist.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p><code>isset()</code> prüft, ob eine Variable existiert:</p>
                <code>if (isset($_GET['delete'])) {
    // Hier kommt der Lösch-Code
}</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">2</span>
            <span class="schritt-titel">Datensatz sicher löschen</span>
        </div>
        <p class="schritt-auftrag">
            Innerhalb der if-Abfrage: Hole die ID mit <code>intval()</code> (wandelt in eine sichere Zahl um)
            und führe dann das <code>DELETE</code>-Statement aus.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p><code>intval()</code> wandelt den Wert in eine Ganzzahl um - so können keine SQL-Injections passieren:</p>
                <code>$id = intval($_GET['delete']);
mysqli_query($conn, "DELETE FROM katzen WHERE id = $id");</code>
            </div>
        </details>
        <div class="warnung">
            <strong>Wichtig:</strong> Nutze <strong>immer</strong> <code>intval()</code> bei IDs aus GET-Parametern!
            Sonst könnte jemand schädlichen SQL-Code einschleusen.
        </div>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">3</span>
            <span class="schritt-titel">Tabellenkopf erweitern</span>
        </div>
        <p class="schritt-auftrag">
            Füge im Tabellenkopf eine neue Spalte <code>&lt;th&gt;Aktion&lt;/th&gt;</code> hinzu.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Nach der letzten Spalte im Kopfbereich:</p>
                <code>echo "&lt;th&gt;Aktion&lt;/th&gt;";</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">4</span>
            <span class="schritt-titel">Lösch-Link in jeder Zeile</span>
        </div>
        <p class="schritt-auftrag">
            In der while-Schleife: Füge eine neue Tabellenzelle mit einem Link hinzu.
            Der Link zeigt auf die aktuelle Seite mit <code>?delete=</code> und der ID der Katze.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Der Link übergibt die ID als GET-Parameter. Die CSS-Klasse macht ihn rot:</p>
                <code>echo "&lt;td&gt;&lt;a href='delete_1.php?delete=" . $katze['id'] . "' class='loeschen-btn'&gt;Löschen&lt;/a&gt;&lt;/td&gt;";</code>
            </div>
        </details>
    </div>

    <div class="hinweis" style="margin-top: 25px;">
        <strong>Tipp zum Testen:</strong> Wenn du einen Datensatz löschst, ist er wirklich weg!
        Nutze den SQL-Code auf der Startseite, um die Katzen wiederherzustellen.
    </div>
</div>
