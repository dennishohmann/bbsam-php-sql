<?php
// ============================================
// ZUSATZAUFGABE: JavaScript-Bestätigungsdialog
// ============================================
// Erweitere den Lösch-Link um eine Sicherheitsabfrage!
// Der Benutzer soll vor dem Löschen gefragt werden: "Wirklich löschen?"

// Datenbankverbindung
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Lösch-Logik (bereits fertig aus delete_2.php)
$geloescht = false;
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM katzen WHERE id = $id");
    $geloescht = true;
}

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
    .erfolg-meldung {
        background: #d4edda;
        border: 1px solid #28a745;
        color: #155724;
        padding: 12px 20px;
        border-radius: 5px;
        margin: 20px 0;
        font-family: Arial, sans-serif;
    }
</style>

<h2>Mitarbeiter des Monats</h2>

<?php
if ($geloescht) {
    echo "<div class='erfolg-meldung'>Datensatz wurde gelöscht!</div>";
}
?>

<?php
echo "<table class='katzen-tabelle'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Spezialität</th>";
echo "<th>Täglicher Unfug</th>";
echo "<th>Kaffeekonsum</th>";
echo "<th>Aktion</th>";
echo "</tr>";

while ($katze = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $katze['id'] . "</td>";
    echo "<td>" . $katze['name'] . "</td>";
    echo "<td>" . $katze['spezialitaet'] . "</td>";
    echo "<td>" . $katze['taeglicher_unfug'] . "</td>";
    echo "<td>" . $katze['kaffee_konsum'] . " Tassen</td>";

    // ===========================================
    // HIER DEINE AUFGABE: Erweitere den Link!
    // ===========================================
    // Füge das onclick-Attribut hinzu, um eine Bestätigung anzuzeigen
    // VORHER: <a href='...' class='loeschen-btn'>
    // NACHHER: <a href='...' onclick="???" class='loeschen-btn'>

    echo "<td><a href='delete_3.php?delete=" . $katze['id'] . "' class='loeschen-btn'>Löschen</a></td>";

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
    <a href="delete_2.php" class="nav-btn zurueck">&larr; Zurück</a>
    <a href="delete_4.php" class="nav-btn weiter">Weiter &rarr;</a>
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
        font-size: 1.1em;
    }
    .konzept p, .konzept ul {
        color: #856404;
        line-height: 1.6;
        margin: 10px 0;
    }
    .konzept ul {
        padding-left: 20px;
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
    .aufgabe-box {
        background: #e8f4fc;
        border: 2px solid #3498db;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .aufgabe-titel {
        font-weight: bold;
        color: #2980b9;
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .aufgabe-box p {
        color: #2c3e50;
        margin: 10px 0;
    }
    details {
        background: #f0f0f0;
        border-radius: 8px;
        padding: 10px 15px;
        margin: 10px 0;
    }
    summary {
        cursor: pointer;
        font-weight: bold;
        color: #9b59b6;
        padding: 5px 0;
    }
    summary:hover {
        color: #8e44ad;
    }
    details[open] summary {
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    .vergleich-tabelle {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }
    .vergleich-tabelle th, .vergleich-tabelle td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    .vergleich-tabelle th {
        background: #9b59b6;
        color: white;
    }
    .vergleich-tabelle tr:nth-child(even) {
        background: #f9f9f9;
    }
</style>

<div class="anleitung">
    <h2>Zusatzaufgabe: JavaScript-Bestätigungsdialog</h2>

    <div class="aufgabe-box">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Aktuell löscht ein Klick auf "Löschen" den Datensatz sofort - ohne Rückfrage!</p>
        <p>Das ist gefährlich. Erweitere den Lösch-Link so, dass vorher ein Dialogfenster erscheint:</p>
        <p style="text-align: center; font-style: italic; font-size: 1.1em;">"Diesen Mitarbeiter wirklich entlassen?"</p>
        <p>Nur wenn der Benutzer auf "OK" klickt, soll gelöscht werden. Bei "Abbrechen" passiert nichts.</p>
    </div>

    <h3>Neues Konzept: JavaScript</h3>

    <div class="konzept">
        <div class="konzept-titel">Was ist JavaScript?</div>
        <p>Bisher hast du nur mit PHP gearbeitet. PHP läuft auf dem <strong>Server</strong> - der Benutzer sieht nur das Ergebnis (HTML).</p>
        <p><strong>JavaScript</strong> ist eine andere Programmiersprache, die direkt im <strong>Browser</strong> läuft!</p>

        <table class="vergleich-tabelle">
            <tr>
                <th>PHP</th>
                <th>JavaScript</th>
            </tr>
            <tr>
                <td>Läuft auf dem Server</td>
                <td>Läuft im Browser des Benutzers</td>
            </tr>
            <tr>
                <td>Generiert HTML</td>
                <td>Kann HTML verändern und auf Klicks reagieren</td>
            </tr>
            <tr>
                <td>Braucht Server-Request (Seite neu laden)</td>
                <td>Reagiert sofort ohne Neuladen</td>
            </tr>
            <tr>
                <td>Code in &lt;?php ?&gt; Tags</td>
                <td>Code in HTML-Attributen oder &lt;script&gt; Tags</td>
            </tr>
        </table>

        <p><strong>Für unsere Aufgabe:</strong> Das Dialogfenster soll erscheinen <em>bevor</em> der Link ausgeführt wird. Das geht nur mit JavaScript im Browser!</p>
    </div>

    <div class="konzept">
        <div class="konzept-titel">Das onclick-Attribut</div>
        <p>HTML-Elemente können auf Benutzeraktionen reagieren. Dafür gibt es spezielle Attribute:</p>
        <ul>
            <li><strong>onclick</strong> - wird ausgeführt bei einem Klick</li>
            <li>onmouseover - wird ausgeführt wenn die Maus drüber fährt</li>
            <li>onkeypress - wird ausgeführt bei Tastendruck</li>
        </ul>
        <p>Wir brauchen <strong>onclick</strong>, weil wir auf den Klick des Lösch-Links reagieren wollen.</p>
        <p><strong>Syntax:</strong></p>
        <code style="display:block; background:#2c3e50; color:#2ecc71; padding:12px; border-radius:5px; font-family:monospace; margin:10px 0;">&lt;a href="ziel.php" onclick="JavaScript-Code-hier"&gt;Link&lt;/a&gt;</code>
        <p>Der JavaScript-Code im onclick wird ausgeführt, <strong>bevor</strong> der Link aufgerufen wird!</p>
    </div>

    <div class="konzept">
        <div class="konzept-titel">Die confirm()-Funktion</div>
        <p><code style="background:#eceff1; padding:2px 6px; border-radius:3px;">confirm()</code> ist eine eingebaute JavaScript-Funktion, die ein Popup-Fenster anzeigt:</p>
        <ul>
            <li>Zeigt eine Nachricht mit zwei Buttons: <strong>OK</strong> und <strong>Abbrechen</strong></li>
            <li>Gibt <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">true</code> zurück, wenn "OK" geklickt wird</li>
            <li>Gibt <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">false</code> zurück, wenn "Abbrechen" geklickt wird</li>
        </ul>
        <p><strong>Beispiel:</strong></p>
        <code style="display:block; background:#2c3e50; color:#2ecc71; padding:12px; border-radius:5px; font-family:monospace; margin:10px 0;">confirm('Bist du sicher?')</code>
        <p>Das alleine zeigt das Fenster - aber wie stoppen wir den Link bei "Abbrechen"?</p>
    </div>

    <div class="konzept">
        <div class="konzept-titel">return und Links abbrechen</div>
        <p>Bei onclick kann man mit <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">return</code> steuern, ob der Link ausgeführt wird:</p>
        <ul>
            <li><code style="background:#eceff1; padding:2px 6px; border-radius:3px;">return true</code> → Link wird normal ausgeführt</li>
            <li><code style="background:#eceff1; padding:2px 6px; border-radius:3px;">return false</code> → Link wird NICHT ausgeführt (abgebrochen)</li>
        </ul>
        <p><strong>Die Kombination:</strong></p>
        <code style="display:block; background:#2c3e50; color:#2ecc71; padding:12px; border-radius:5px; font-family:monospace; margin:10px 0;">onclick="return confirm('Bist du sicher?')"</code>
        <p>Das funktioniert so:</p>
        <ol style="padding-left: 20px; line-height: 1.8;">
            <li><code style="background:#eceff1; padding:2px 6px; border-radius:3px;">confirm('...')</code> zeigt das Dialogfenster</li>
            <li>Benutzer klickt OK → <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">confirm()</code> gibt <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">true</code> zurück</li>
            <li><code style="background:#eceff1; padding:2px 6px; border-radius:3px;">return true</code> → Link wird ausgeführt (Löschen!)</li>
        </ol>
        <p>Oder:</p>
        <ol style="padding-left: 20px; line-height: 1.8;">
            <li><code style="background:#eceff1; padding:2px 6px; border-radius:3px;">confirm('...')</code> zeigt das Dialogfenster</li>
            <li>Benutzer klickt Abbrechen → <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">confirm()</code> gibt <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">false</code> zurück</li>
            <li><code style="background:#eceff1; padding:2px 6px; border-radius:3px;">return false</code> → Link wird NICHT ausgeführt (nichts passiert)</li>
        </ol>
    </div>

    <h3>Deine Arbeitsschritte</h3>

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">Finde die Zeile mit dem Lösch-Link</span>
        <p>Suche im PHP-Code nach der Zeile, die den "Löschen"-Link erzeugt. Sie sieht ungefähr so aus:</p>
        <code>echo "&lt;td&gt;&lt;a href='delete_3.php?delete=" . $katze['id'] . "' class='loeschen-btn'&gt;Löschen&lt;/a&gt;&lt;/td&gt;";</code>

        <details>
            <summary>Hilfe: Wo genau ist die Zeile?</summary>
            <p>Schau in die while-Schleife. Dort werden alle Tabellenzellen erzeugt. Die letzte Zelle vor <code>&lt;/tr&gt;</code> enthält den Lösch-Link.</p>
        </details>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">2</span>
        <span class="schritt-titel">Füge das onclick-Attribut hinzu</span>
        <p>Erweitere den &lt;a&gt;-Tag um das onclick-Attribut mit <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">return confirm('...')</code></p>
        <p><strong>Vorher:</strong></p>
        <code>&lt;a href='...' class='loeschen-btn'&gt;</code>
        <p><strong>Nachher:</strong></p>
        <code>&lt;a href='...' onclick="return confirm('Deine Frage hier')" class='loeschen-btn'&gt;</code>

        <details>
            <summary>Hilfe: Anführungszeichen-Problem</summary>
            <p>Achtung! In PHP verwendest du bereits doppelte Anführungszeichen für den String:</p>
            <code>echo "&lt;td&gt;...&lt;/td&gt;";</code>
            <p>Wenn du im onclick auch doppelte Anführungszeichen brauchst, musst du sie "escapen" mit Backslash:</p>
            <code>onclick=\"return confirm('...')\"</code>
            <p>Alternativ: Im confirm() einfach einfache Anführungszeichen verwenden - dann kein Problem!</p>
        </details>

        <details>
            <summary>Hilfe: Der vollständige echo-Befehl</summary>
            <code>echo "&lt;td&gt;&lt;a href='delete_3.php?delete=" . $katze['id'] . "' onclick=\"return confirm('Diesen Mitarbeiter wirklich entlassen?')\" class='loeschen-btn'&gt;Löschen&lt;/a&gt;&lt;/td&gt;";</code>
        </details>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Teste deine Lösung</span>
        <p>Speichere die Datei und lade sie im Browser neu.</p>
        <ul style="padding-left: 20px; line-height: 1.8;">
            <li>Klicke auf einen "Löschen"-Button</li>
            <li>Es sollte ein Dialogfenster erscheinen</li>
            <li>Klicke "Abbrechen" - der Datensatz sollte bleiben</li>
            <li>Klicke "OK" - der Datensatz sollte gelöscht werden</li>
        </ul>
    </div>

    <div class="hinweis" style="margin-top: 25px;">
        <strong>Geschafft?</strong> Vergleiche deine Lösung mit der Musterlösung in <a href="delete_4.php">delete_4.php</a>!
    </div>

    <div class="warnung" style="margin-top: 15px;">
        <strong>Wichtig:</strong> JavaScript-Bestätigungen sind nur eine Komfort-Funktion! Ein böswilliger Benutzer kann sie umgehen (z.B. JavaScript deaktivieren). Die echte Sicherheit muss immer auf dem Server (PHP) implementiert sein - wie unser <code>intval()</code> gegen SQL-Injection.
    </div>
</div>
