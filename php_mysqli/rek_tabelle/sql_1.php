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
    
    <div class="nav-platzhalter"></div>
    <a href="sql_2.php" class="nav-btn weiter">Weiter zur Lösung→</a>
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
    .schritt {
        background: white;
        margin: 15px 0;
        padding: 15px;
        border-left: 4px solid #3498db;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
    .schritt code {
        display: block;
        background: #2c3e50;
        color: #2ecc71;
        padding: 12px;
        margin: 10px 0;
        border-radius: 5px;
        font-family: monospace;
        overflow-x: auto;
    }
    .schritt p {
        color: #555;
        line-height: 1.6;
        margin: 10px 0 0 0;
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
    <h2>📚 PHP &amp; MariaDB: Schritt-für-Schritt</h2>

    <div class="aufgabe">
        <div class="aufgabe-titel">📝 Deine Aufgabe</div>
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

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">Verbindung zur Datenbank herstellen</span>
        <code>$conn = mysqli_connect("localhost", "root", "", "katzencafe");</code>
        <p>Diese Funktion baut die Verbindung zum Datenbankserver auf.</p>
        <div class="parameter">
            <strong>Host:</strong> Wo läuft der Server? Bei lokaler Entwicklung localhost<br>
            <strong>Benutzername:</strong> Der Datenbank-Benutzer<br>
            <strong>Passwort:</strong> Das Passwort des Benutzers<br>
            <strong>Datenbank:</strong> Name der zu verwendenden Datenbank
        </div>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">2</span>
        <span class="schritt-titel">Zeichensatz festlegen</span>
        <code>mysqli_set_charset($conn, "utf8mb4");</code>
        <p>Legt den Zeichensatz für die Verbindung fest. utf8mb4 unterstützt alle Unicode-Zeichen inklusive Emojis. Ohne diese Einstellung können Umlaute und Sonderzeichen falsch dargestellt werden.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Verbindung prüfen</span>
        <code>if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}</code>
        <p>Prüft, ob die Verbindung erfolgreich war. Falls nicht, gibt mysqli_connect_error() eine Fehlermeldung zurück. Die Funktion die() beendet das Skript sofort.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">SQL-Abfrage ausführen</span>
        <code>$result = mysqli_query($conn, "SELECT * FROM katzen");</code>
        <p>Sendet eine SQL-Abfrage an die Datenbank. Der erste Parameter ist die Verbindung, der zweite der SQL-Befehl. Das Ergebnis wird in $result gespeichert.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">5</span>
        <span class="schritt-titel">Ergebnisse durchlaufen</span>
        <code>while ($katze = mysqli_fetch_assoc($result)) { ... }</code>
        <p>Holt nacheinander jeden Datensatz als assoziatives Array. Die Spaltennamen dienen als Schlüssel. Gibt false zurück wenn keine Daten mehr vorhanden sind.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">6</span>
        <span class="schritt-titel">Daten ausgeben</span>
        <code>echo $katze['name'];
$kaffee = $katze['kaffee_konsum'] ?? '???';</code>
        <p>Zugriff auf Spalten über ihre Namen. Der Operator ?? ist der Null-Coalescing-Operator: Falls der Wert NULL ist, wird der Ersatzwert verwendet.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">7</span>
        <span class="schritt-titel">Ressourcen freigeben</span>
        <code>mysqli_free_result($result);</code>
        <p>Gibt den Speicher frei, der für das Abfrageergebnis reserviert wurde. Bei großen Datenmengen wichtig für die Performance.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">8</span>
        <span class="schritt-titel">Verbindung schließen</span>
        <code>mysqli_close($conn);</code>
        <p>Beendet die Verbindung zur Datenbank ordnungsgemäß. PHP schließt Verbindungen zwar automatisch am Skriptende, aber explizites Schließen ist sauberer Stil.</p>
    </div>
</div>