<?php
// ============================================
// MUSTERLÖSUNG: JavaScript-Bestätigungsdialog
// ============================================

// Datenbankverbindung
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Lösch-Logik (unverändert aus delete_2.php)
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

    // MIT JavaScript-Bestätigungsdialog
    echo "<td><a href='delete_4.php?delete=" . $katze['id'] . "' onclick=\"return confirm('Diesen Mitarbeiter wirklich entlassen?')\" class='loeschen-btn'>Löschen</a></td>";

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
    <a href="delete_3.php" class="nav-btn zurueck">&larr; Zurück</a>
    <div class="nav-platzhalter"></div>
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
        font-size: 1.1em;
    }
    .konzept p, .konzept ul, .konzept ol {
        color: #856404;
        line-height: 1.6;
        margin: 10px 0;
    }
    .konzept ul, .konzept ol {
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
    .code-vergleich {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin: 15px 0;
    }
    .code-box {
        background: #2c3e50;
        color: #ecf0f1;
        padding: 15px;
        border-radius: 8px;
        font-family: monospace;
        font-size: 0.9em;
    }
    .code-box-titel {
        background: #34495e;
        color: #fff;
        padding: 8px 12px;
        margin: -15px -15px 15px -15px;
        border-radius: 8px 8px 0 0;
        font-weight: bold;
    }
    .code-box .highlight {
        background: #f39c12;
        color: #2c3e50;
        padding: 2px 4px;
        border-radius: 3px;
    }
    .ablauf-box {
        background: #e8f4fc;
        border: 2px solid #3498db;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .ablauf-titel {
        font-weight: bold;
        color: #2980b9;
        font-size: 1.1em;
        margin-bottom: 10px;
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
    @media (max-width: 700px) {
        .code-vergleich {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="anleitung">
    <h2>Musterlösung: JavaScript-Bestätigungsdialog</h2>

    <div class="musterloesung">
        <div class="musterloesung-titel">Musterlösung</div>
        <p>Dies ist die fertige Lösung zur Zusatzaufgabe aus delete_3.php. Vergleiche deinen Code!</p>
    </div>

    <h3>Der entscheidende Code</h3>

    <div class="schritt">
        <span class="schritt-nummer">!</span>
        <span class="schritt-titel">Der erweiterte Lösch-Link</span>
        <code>echo "&lt;td&gt;&lt;a href='delete_4.php?delete=" . $katze['id'] . "' onclick=\"return confirm('Diesen Mitarbeiter wirklich entlassen?')\" class='loeschen-btn'&gt;Löschen&lt;/a&gt;&lt;/td&gt;";</code>
        <p>
            Die einzige Änderung zum vorherigen Code ist das Attribut:<br>
            <code style="display:inline; background:#f39c12; color:#2c3e50; padding:4px 8px; border-radius:4px; margin:5px 0;">onclick="return confirm('Diesen Mitarbeiter wirklich entlassen?')"</code>
        </p>
    </div>

    <h3>Vorher vs. Nachher</h3>

    <div class="code-vergleich">
        <div class="code-box">
            <div class="code-box-titel">Vorher (delete_2.php)</div>
            &lt;a href='delete_2.php?delete=3'
   class='loeschen-btn'&gt;
   Löschen
&lt;/a&gt;
        </div>
        <div class="code-box">
            <div class="code-box-titel">Nachher (delete_4.php)</div>
            &lt;a href='delete_4.php?delete=3'
   <span class="highlight">onclick="return confirm('...')"</span>
   class='loeschen-btn'&gt;
   Löschen
&lt;/a&gt;
        </div>
    </div>

    <h3>Wie funktioniert das genau?</h3>

    <div class="ablauf-box">
        <div class="ablauf-titel">Ablauf bei Klick auf "Löschen"</div>
        <ol style="padding-left: 20px; line-height: 2;">
            <li><strong>Klick</strong> - Der Benutzer klickt auf den roten "Löschen"-Button</li>
            <li><strong>onclick wird ausgelöst</strong> - Noch BEVOR der Link aufgerufen wird</li>
            <li><strong>confirm() läuft</strong> - Ein Dialogfenster erscheint mit "OK" und "Abbrechen"</li>
            <li><strong>Benutzer entscheidet</strong>
                <ul>
                    <li>OK → <code style="background:#d4edda; padding:2px 6px; border-radius:3px;">confirm()</code> gibt <code style="background:#d4edda; padding:2px 6px; border-radius:3px;">true</code> zurück</li>
                    <li>Abbrechen → <code style="background:#f8d7da; padding:2px 6px; border-radius:3px;">confirm()</code> gibt <code style="background:#f8d7da; padding:2px 6px; border-radius:3px;">false</code> zurück</li>
                </ul>
            </li>
            <li><strong>return entscheidet</strong>
                <ul>
                    <li><code style="background:#d4edda; padding:2px 6px; border-radius:3px;">return true</code> → Link wird ausgeführt → PHP löscht den Datensatz</li>
                    <li><code style="background:#f8d7da; padding:2px 6px; border-radius:3px;">return false</code> → Link wird NICHT ausgeführt → Nichts passiert</li>
                </ul>
            </li>
        </ol>
    </div>

    <h3>Die Anführungszeichen erklärt</h3>

    <div class="konzept">
        <div class="konzept-titel">Warum \"...\" statt "..."?</div>
        <p>Schau dir den echo-Befehl genau an:</p>
        <code style="display:block; background:#2c3e50; color:#2ecc71; padding:12px; border-radius:5px; font-family:monospace; margin:10px 0;">echo "<span style="color:#e74c3c;">&lt;td&gt;&lt;a href='...' onclick=</span><span style="color:#f39c12;">\"</span><span style="color:#3498db;">return confirm('...')</span><span style="color:#f39c12;">\"</span><span style="color:#e74c3c;"> class='...'&gt;...&lt;/a&gt;&lt;/td&gt;</span>";</code>
        <p>Das Problem: Der äußere PHP-String verwendet bereits doppelte Anführungszeichen (<span style="color:#e74c3c;">rot</span>). Wenn wir im HTML auch doppelte Anführungszeichen brauchen, müssen wir sie mit einem Backslash "escapen": <span style="color:#f39c12;">\"</span></p>
        <p>Der Backslash sagt PHP: "Das ist kein String-Ende, sondern ein echtes Anführungszeichen im Text!"</p>

        <table class="vergleich-tabelle">
            <tr>
                <th>Zeichen</th>
                <th>Bedeutung</th>
            </tr>
            <tr>
                <td><code>"</code></td>
                <td>Beginnt oder beendet einen PHP-String</td>
            </tr>
            <tr>
                <td><code>\"</code></td>
                <td>Ein echtes Anführungszeichen IM String</td>
            </tr>
            <tr>
                <td><code>'</code></td>
                <td>Einfaches Anführungszeichen - kein Problem in "..."-Strings</td>
            </tr>
        </table>
    </div>

    <h3>JavaScript vs. PHP - Der Unterschied</h3>

    <div class="konzept">
        <div class="konzept-titel">Wann läuft was?</div>

        <table class="vergleich-tabelle">
            <tr>
                <th style="width:50%">PHP (Server)</th>
                <th style="width:50%">JavaScript (Browser)</th>
            </tr>
            <tr>
                <td>
                    <strong>Zeitpunkt:</strong> Wenn die Seite geladen wird<br>
                    <strong>Wo:</strong> Auf dem Webserver<br>
                    <strong>Unser Code:</strong><br>
                    <code style="font-size:0.85em;">if (isset($_GET['delete'])) {<br>&nbsp;&nbsp;$id = intval($_GET['delete']);<br>&nbsp;&nbsp;mysqli_query(...);<br>}</code>
                </td>
                <td>
                    <strong>Zeitpunkt:</strong> Wenn der Benutzer klickt<br>
                    <strong>Wo:</strong> Im Browser des Benutzers<br>
                    <strong>Unser Code:</strong><br>
                    <code style="font-size:0.85em;">onclick="return confirm('...')"</code>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Aufgabe hier:</strong><br>
                    Datensatz aus der Datenbank löschen
                </td>
                <td>
                    <strong>Aufgabe hier:</strong><br>
                    Benutzer um Bestätigung bitten, bevor die PHP-Seite aufgerufen wird
                </td>
            </tr>
        </table>

        <p style="margin-top:15px;"><strong>Die Reihenfolge bei einem Klick:</strong></p>
        <ol>
            <li><span style="background:#3498db; color:white; padding:2px 8px; border-radius:4px;">JavaScript</span> confirm() im Browser</li>
            <li>Nur bei "OK": <span style="background:#9b59b6; color:white; padding:2px 8px; border-radius:4px;">HTTP-Request</span> an Server</li>
            <li><span style="background:#e74c3c; color:white; padding:2px 8px; border-radius:4px;">PHP</span> DELETE-Query ausführen</li>
            <li><span style="background:#9b59b6; color:white; padding:2px 8px; border-radius:4px;">HTTP-Response</span> zurück an Browser</li>
            <li>Browser zeigt neue Seite (ohne gelöschten Eintrag)</li>
        </ol>
    </div>

    <h3>Vollständiger Code</h3>

    <div class="schritt">
        <span class="schritt-nummer">*</span>
        <span class="schritt-titel">Die komplette Lösung</span>
        <code>&lt;?php
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Lösch-Logik (unverändert!)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM katzen WHERE id = $id");
}

$result = mysqli_query($conn, "SELECT * FROM katzen");
?&gt;

&lt;h2&gt;Mitarbeiter des Monats&lt;/h2&gt;

&lt;?php
echo "&lt;table class='katzen-tabelle'&gt;";
// ... Tabellenkopf ...

while ($katze = mysqli_fetch_array($result)) {
    echo "&lt;tr&gt;";
    // ... andere Spalten ...

    // Der Lösch-Link MIT Bestätigungsdialog:
    echo "&lt;td&gt;&lt;a href='delete_4.php?delete=" . $katze['id'] . "'
               onclick=\"return confirm('Diesen Mitarbeiter wirklich entlassen?')\"
               class='loeschen-btn'&gt;Löschen&lt;/a&gt;&lt;/td&gt;";

    echo "&lt;/tr&gt;";
}

echo "&lt;/table&gt;";

mysqli_free_result($result);
mysqli_close($conn);
?&gt;</code>
    </div>

    <div class="warnung" style="margin-top: 25px;">
        <strong>Sicherheitshinweis:</strong> Der JavaScript-Dialog ist nur eine Komfort-Funktion für den Benutzer. Er schützt nicht vor böswilligen Angriffen! Ein Angreifer kann:
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li>JavaScript im Browser deaktivieren</li>
            <li>Die URL direkt aufrufen: <code>delete_4.php?delete=3</code></li>
            <li>Einen eigenen HTTP-Request senden</li>
        </ul>
        Echte Sicherheit (wie <code>intval()</code> gegen SQL-Injection) muss immer auf dem Server in PHP implementiert sein!
    </div>

    <div class="hinweis" style="margin-top: 15px;">
        <strong>Weiterführende Ideen:</strong><br>
        - Den Namen der Katze im Dialog anzeigen: <code>confirm('Wirklich ' + katzenName + ' entlassen?')</code><br>
        - Modernere Dialoge mit CSS/JavaScript-Libraries (z.B. SweetAlert)<br>
        - Löschen per POST statt GET (sicherer gegen versehentliches Aufrufen)
    </div>
</div>
