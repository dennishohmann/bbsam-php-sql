<?php
// Schritt 0: Datenbank erstellen / importieren der SQL Anweisungen

// Schritt 1: Verbindung herstellen

// Schritt 2: Zeichensatz festlegen

// Schritt 3: Verbindung prüfen


// Schritt 4: Abfrage ausführen

// Schritt 5 & 6: Ergebnisse durchlaufen und ausgeben

// Schritt 7: Ressourcen freigeben

// Schritt 8: Verbindung schließen

?>



<!--    #######################################
        Ab hier braucht ihr nicht weiter lesen :)

        Diese Anleitung braucht nur im Browser gelesen zu werden...
-->
<div class="navigation">
    <a href="sql_0.php" class="nav-btn zurueck">&larr; Zurück zur Einführung</a>
    <a href="sql_2.php" class="nav-btn weiter">Weiter zur Lösung &rarr;</a>
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
        border-bottom: 3px solid #e74c3c;
        padding-bottom: 10px;
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

    /* Arbeitsschritt-Styles */
    .arbeitsschritt {
        background: white;
        margin: 15px 0;
        padding: 15px;
        border-left: 4px solid #3498db;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .schritt-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .schritt-nummer {
        background: #3498db;
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
        background: #e8f4fc;
        padding: 2px 6px;
        border-radius: 3px;
        color: #2980b9;
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
        color: #3498db;
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
</style>

<div class="anleitung">
    <h2>PHP &amp; MariaDB: Schritt-für-Schritt</h2>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Verbinde PHP mit einer MariaDB-Datenbank und gib die Katzen-Daten aus.</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>Verbindung zur Datenbank "katzencafe" herstellen</li>
                <li>Zeichensatz auf UTF-8 setzen</li>
                <li>Prüfen ob die Verbindung geklappt hat</li>
                <li>SQL-Abfrage ausführen: alle Katzen auslesen</li>
                <li>Ergebnisse in einer Schleife durchlaufen und ausgeben</li>
                <li>Ressourcen freigeben und Verbindung schließen</li>
            </ol>
        </div>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">1</span>
            <span class="schritt-titel">Verbindung zur Datenbank herstellen</span>
        </div>
        <p class="schritt-auftrag">
            Erstelle eine Variable <code>$conn</code> und nutze die Funktion <code>mysqli_connect()</code>
            mit den Zugangsdaten für den lokalen Datenbankserver.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Die Funktion benötigt 4 Parameter:</p>
                <ul>
                    <li><strong>Host:</strong> "localhost"</li>
                    <li><strong>Benutzer:</strong> "root"</li>
                    <li><strong>Passwort:</strong> "" (leer)</li>
                    <li><strong>Datenbank:</strong> "katzencafe"</li>
                </ul>
                <code>$conn = mysqli_connect("localhost", "root", "", "katzencafe");</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">2</span>
            <span class="schritt-titel">Zeichensatz festlegen</span>
        </div>
        <p class="schritt-auftrag">
            Setze den Zeichensatz der Verbindung auf <code>utf8mb4</code> mit der Funktion
            <code>mysqli_set_charset()</code>. Das stellt sicher, dass Umlaute und Sonderzeichen
            korrekt angezeigt werden.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Die Funktion braucht die Verbindung und den Zeichensatz-Namen:</p>
                <code>mysqli_set_charset($conn, "utf8mb4");</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">3</span>
            <span class="schritt-titel">Verbindung prüfen</span>
        </div>
        <p class="schritt-auftrag">
            Prüfe mit einer <code>if</code>-Bedingung, ob die Verbindung fehlgeschlagen ist.
            Falls <code>$conn</code> <em>false</em> ist, beende das Skript mit <code>die()</code> und
            gib eine Fehlermeldung mit <code>mysqli_connect_error()</code> aus.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Mit <code>!</code> prüfst du auf "nicht wahr". Die Funktion <code>die()</code>
                beendet das Skript sofort und gibt den Text aus:</p>
                <code>if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">4</span>
            <span class="schritt-titel">SQL-Abfrage ausführen</span>
        </div>
        <p class="schritt-auftrag">
            Führe eine SQL-Abfrage aus, die alle Datensätze aus der Tabelle <code>katzen</code>
            holt. Nutze <code>mysqli_query()</code> und speichere das Ergebnis in einer Variable
            <code>$result</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Der erste Parameter ist die Verbindung, der zweite der SQL-Befehl:</p>
                <code>$result = mysqli_query($conn, "SELECT * FROM katzen");</code>
                <p>Der Rückgabewert von mysqli_query (ein Datenbankobjekt mit allen Datensätzen) wird in die Variable $result abgelegt.</p>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">5</span>
            <span class="schritt-titel">Ergebnisse durchlaufen</span>
        </div>
        <p class="schritt-auftrag">
            Erstelle eine <code>while</code>-Schleife, die mit <code>mysqli_fetch_array()</code>
            jeden Datensatz nacheinander holt. Speichere den aktuellen Datensatz in einer
            Variable <code>$katze</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Die Funktion mysqli_fetch_array() holt den nächsten Datensatz als Array und legt ihn für diesen Schleifendurchlauf in die Variable $katze an. Gibt Sie <em>false</em>
                zurück, weil keine weiteren Datensätze mehr da sind - dann endet die Schleife:</p>
                <code>while ($katze = mysqli_fetch_array($result)) {
    // Hier kommt die Ausgabe
}</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">6</span>
            <span class="schritt-titel">Daten ausgeben</span>
        </div>
        <p class="schritt-auftrag">
            Gib innerhalb der Schleife die Daten mit <code>echo</code> aus. Greife auf die
            Spalten mit <code>$katze['spaltenname']</code> zu.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Die Spaltennamen sind: <code>name</code>, <code>spezialitaet</code>,
                <code>taeglicher_unfug</code>, <code>kaffee_konsum</code></p>
                <code>echo "&lt;p&gt;&lt;b&gt;{$katze['name']}&lt;/b&gt;&lt;br&gt;";
echo "Spezialität: {$katze['spezialitaet']}&lt;br&gt;";
echo "Täglicher Unfug: {$katze['taeglicher_unfug']}&lt;br&gt;";
echo "Kaffeekonsum: {$katze['kaffee_konsum']} Tassen&lt;/p&gt;&lt;hr&gt;";</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">7</span>
            <span class="schritt-titel">Ressourcen freigeben</span>
        </div>
        <p class="schritt-auftrag">
            Gib den Speicher für das Abfrageergebnis mit <code>mysqli_free_result()</code> frei.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Übergib das Ergebnis-Objekt an die Funktion:</p>
                <code>mysqli_free_result($result);</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">8</span>
            <span class="schritt-titel">Verbindung schließen</span>
        </div>
        <p class="schritt-auftrag">
            Schließe die Datenbankverbindung ordnungsgemäß mit <code>mysqli_close()</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Übergib die Verbindungsvariable:</p>
                <code>mysqli_close($conn);</code>
            </div>
        </details>
    </div>
</div>
