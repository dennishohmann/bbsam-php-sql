<?php
// ============================================
// AUFGABE: Daten als HTML-Tabelle ausgeben
// ============================================

// Datenbankverbindung (aus Aufgabe 1)
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT * FROM katzen");

echo "<h2>🐱 Mitarbeiter des Monats 🐱</h2>";

// --------------------------------------------
// Schritt 1: Tabelle öffnen und Kopfzeile mit <th> erstellen
// --------------------------------------------

// --------------------------------------------
// Schritt 2: In der Schleife Zeilen mit <td> ausgeben
// --------------------------------------------
while ($katze = mysqli_fetch_array($result)) {
    echo "<p><b>{$katze['name']}</b><br>";
    echo "Spezialität: {$katze['spezialitaet']}<br>";
    echo "Täglicher Unfug: {$katze['taeglicher_unfug']}<br>";
    echo "Kaffeekonsum: {$katze['kaffee_konsum']} Tassen</p><hr>";
}

// --------------------------------------------
// Schritt 3: Tabelle schließen
// --------------------------------------------


mysqli_free_result($result);
mysqli_close($conn);
?>



<!--    #######################################
        Ab hier braucht ihr nicht weiter lesen :)

        Diese Anleitung ist nur für die Anzeige im Browser gedacht...
-->
<div class="navigation">
    <a href="sql_2.php" class="nav-btn zurueck">&larr; Zurück</a>
    <div class="nav-platzhalter"></div>
    <a href="sql_4.php" class="nav-btn weiter">Weiter zur Lösung &rarr;</a>
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
</style>

<div class="anleitung">
    <h2>Tabellenausgabe mit PHP &amp; MySQL</h2>

    <div class="konzept">
        <div class="konzept-titel">Das Konzept</div>
        <p>Statt jeden Datensatz einzeln mit Absätzen auszugeben, bauen wir eine HTML-Tabelle auf. Die Schleife durchläuft alle Datensätze und erzeugt für jeden eine neue Tabellenzeile. So entsteht die Tabelle Zeile für Zeile dynamisch.</p>
    </div>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe: <br><br><img src="img/mit-table.png" style="width:100%;"/></div>
        <p>Baue die einfache Textausgabe zu einer HTML-Tabelle um.</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>Tabellenkopf mit Spaltenüberschriften vor der Schleife ausgeben</li>
                <li>In der Schleife: statt &lt;p&gt;-Tags eine Tabellenzeile erzeugen</li>
                <li>Jeden Datenbankwert in eine eigene Tabellenzelle schreiben</li>
                <li>Tabelle nach der Schleife schließen</li>
                <li>BONUS: CSS für schönere Darstellung hinzufügen</li>
            </ol>
        </div>
    </div>

    <h3>Aufbau der HTML-Tabelle</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">1</span>
            <span class="schritt-titel">Tabellenstruktur verstehen</span>
        </div>
        <p class="schritt-auftrag">
            Mache dich mit den HTML-Tags für Tabellen vertraut: <code>&lt;table&gt;</code> für den Container,
            <code>&lt;tr&gt;</code> für Zeilen, <code>&lt;th&gt;</code> für Kopfzellen und
            <code>&lt;td&gt;</code> für Datenzellen.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Eine HTML-Tabelle ist so aufgebaut:</p>
                <ul>
                    <li><strong>&lt;table&gt;</strong> – Der Container für die gesamte Tabelle</li>
                    <li><strong>&lt;tr&gt;</strong> – Eine Tabellenzeile (table row)</li>
                    <li><strong>&lt;th&gt;</strong> – Eine Kopfzelle (table header) - wird fett angezeigt</li>
                    <li><strong>&lt;td&gt;</strong> – Eine Datenzelle (table data)</li>
                </ul>
                <code>&lt;table&gt;
    &lt;tr&gt;
        &lt;th&gt;Überschrift&lt;/th&gt;
        &lt;th&gt;Überschrift&lt;/th&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
        &lt;td&gt;Daten&lt;/td&gt;
        &lt;td&gt;Daten&lt;/td&gt;
    &lt;/tr&gt;
&lt;/table&gt;</code>
            </div>
        </details>
    </div>

    <h3>Umbau der Ausgabe</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">2</span>
            <span class="schritt-titel">Tabellenkopf vor der Schleife ausgeben</span>
        </div>
        <p class="schritt-auftrag">
            Gib <strong>vor</strong> der while-Schleife den Tabellenkopf aus: Öffne die Tabelle mit
            <code>&lt;table&gt;</code>, erstelle eine Zeile mit <code>&lt;tr&gt;</code> und füge für
            jede Spalte eine Überschrift mit <code>&lt;th&gt;</code> hinzu.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Die Spaltenüberschriften entsprechen den Datenbankfeldern:</p>
                <code>echo "&lt;table&gt;";
echo "&lt;tr&gt;";
echo "&lt;th&gt;Name&lt;/th&gt;";
echo "&lt;th&gt;Spezialität&lt;/th&gt;";
echo "&lt;th&gt;Täglicher Unfug&lt;/th&gt;";
echo "&lt;th&gt;Kaffeekonsum&lt;/th&gt;";
echo "&lt;/tr&gt;";</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">3</span>
            <span class="schritt-titel">Schleife für die Datenzeilen anpassen</span>
        </div>
        <p class="schritt-auftrag">
            Ändere die Ausgabe in der while-Schleife: Statt <code>&lt;p&gt;</code>-Tags verwendest du
            jetzt <code>&lt;tr&gt;</code> für eine Zeile und <code>&lt;td&gt;</code> für jede Zelle.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Jeder Datensatz wird zu einer Tabellenzeile:</p>
                <code>while ($katze = mysqli_fetch_array($result)) {
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">4</span>
            <span class="schritt-titel">Alle Spalten in die Zeile einfügen</span>
        </div>
        <p class="schritt-auftrag">
            Erweitere die Schleife, sodass alle Datenbankfelder (<code>name</code>, <code>spezialitaet</code>,
            <code>taeglicher_unfug</code>, <code>kaffee_konsum</code>) als eigene <code>&lt;td&gt;</code>-Zellen
            ausgegeben werden.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Jede Spalte bekommt eine eigene Zelle. Die Reihenfolge muss mit dem Tabellenkopf übereinstimmen:</p>
                <code>while ($katze = mysqli_fetch_array($result)) {
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['spezialitaet'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['taeglicher_unfug'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['kaffee_konsum'] . "&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">5</span>
            <span class="schritt-titel">Tabelle nach der Schleife schließen</span>
        </div>
        <p class="schritt-auftrag">
            Gib <strong>nach</strong> der while-Schleife das schließende <code>&lt;/table&gt;</code>-Tag aus.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Einfach die Tabelle beenden:</p>
                <code>echo "&lt;/table&gt;";</code>
            </div>
        </details>
    </div>

    <h3>BONUS: Styling der Tabelle</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">6</span>
            <span class="schritt-titel">CSS-Klasse und Styles hinzufügen</span>
        </div>
        <p class="schritt-auftrag">
            Gib der Tabelle eine CSS-Klasse (z.B. <code>class='katzen-tabelle'</code>) und erstelle
            passende CSS-Regeln für Rahmen, Abstände und abwechselnde Zeilenfarben.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Ändere die Tabellen-Ausgabe und füge CSS hinzu:</p>
                <code>echo "&lt;table class='katzen-tabelle'&gt;";</code>
                <p style="margin-top: 15px;">Das CSS für eine ansprechende Tabelle:</p>
                <code>&lt;style&gt;
    .katzen-tabelle {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    .katzen-tabelle th,
    .katzen-tabelle td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    .katzen-tabelle th {
        background: #3498db;
        color: white;
    }
    .katzen-tabelle tr:nth-child(even) {
        background: #f2f2f2;
    }
    .katzen-tabelle tr:hover {
        background: #e8f4fc;
    }
&lt;/style&gt;</code>
            </div>
        </details>
    </div>
</div>
