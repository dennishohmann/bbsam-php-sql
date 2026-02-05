<?php
// ============================================
// MUSTERLÖSUNG: Datensätze über einen Link löschen
// ============================================

// Datenbankverbindung
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Lösch-Logik: Prüfen ob ein delete-Parameter übergeben wurde
$geloescht = false;
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);  // Sicherheit: nur Integer erlauben
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
// Erfolgsmeldung anzeigen
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
    echo "<td><a href='delete_2.php?delete=" . $katze['id'] . "' class='loeschen-btn'>Löschen</a></td>";
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
    <a href="delete_1.php" class="nav-btn zurueck">&larr; Zurück</a>
    <a href="delete_3.php" class="nav-btn weiter">Weiter &rarr;</a>
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
</style>

<div class="anleitung">
    <h2>Datensätze löschen - Musterlösung</h2>

    <div class="musterloesung">
        <div class="musterloesung-titel">Musterlösung</div>
        <p>Dies ist die fertige Lösung zur Aufgabe aus delete_1.php. Vergleiche deinen Code mit dieser Lösung!</p>
    </div>

    <div class="konzept">
        <div class="konzept-titel">So funktioniert das Löschen</div>
        <p>Der Ablauf beim Klicken auf "Löschen":</p>
        <ol style="margin: 10px 0; padding-left: 20px; line-height: 1.8;">
            <li>Der Link ruft dieselbe Seite auf, aber mit Parameter: <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">delete_2.php?delete=3</code></li>
            <li>PHP liest den Parameter mit <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">$_GET['delete']</code></li>
            <li>Der Wert wird mit <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">intval()</code> in eine sichere Zahl umgewandelt</li>
            <li>Das DELETE-Statement entfernt den Datensatz aus der Datenbank</li>
            <li>Die Tabelle wird neu geladen - ohne den gelöschten Eintrag</li>
        </ol>
    </div>

    <h3>Der Code im Detail</h3>

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">Lösch-Logik am Seitenanfang</span>
        <code>$geloescht = false;
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM katzen WHERE id = $id");
    $geloescht = true;
}</code>
        <p>
            <strong>Zeile 1:</strong> Variable für die Erfolgsmeldung<br>
            <strong>Zeile 2:</strong> <code>isset()</code> prüft, ob der Parameter existiert<br>
            <strong>Zeile 3:</strong> <code>intval()</code> wandelt den Wert in eine Ganzzahl um (Sicherheit!)<br>
            <strong>Zeile 4:</strong> Das DELETE-Statement entfernt die Zeile mit der passenden ID<br>
            <strong>Zeile 5:</strong> Merken, dass gelöscht wurde (für die Meldung)
        </p>
        <div class="warnung">
            <strong>Warum intval()?</strong> Ohne diese Absicherung könnte jemand schädlichen Code in die URL schreiben.
            Beispiel: <code>?delete=3; DROP TABLE katzen;</code> würde die ganze Tabelle löschen!
            Mit <code>intval()</code> wird daraus einfach die Zahl <code>3</code>.
        </div>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">2</span>
        <span class="schritt-titel">Erfolgsmeldung anzeigen</span>
        <code>if ($geloescht) {
    echo "&lt;div class='erfolg-meldung'&gt;Datensatz wurde gelöscht!&lt;/div&gt;";
}</code>
        <p>
            Optional: Eine Bestätigung für den Benutzer, dass das Löschen erfolgreich war.
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Neue Spalte im Tabellenkopf</span>
        <code>echo "&lt;th&gt;Aktion&lt;/th&gt;";</code>
        <p>
            Eine zusätzliche Spalte für den Lösch-Button.
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">Lösch-Link in jeder Zeile</span>
        <code>echo "&lt;td&gt;&lt;a href='delete_2.php?delete=" . $katze['id'] . "' class='loeschen-btn'&gt;Löschen&lt;/a&gt;&lt;/td&gt;";</code>
        <p>
            Der Link besteht aus:<br>
            <strong>delete_2.php</strong> - Die aktuelle Seite<br>
            <strong>?delete=</strong> - Der GET-Parameter<br>
            <strong>$katze['id']</strong> - Die ID des jeweiligen Datensatzes<br><br>
            Für Katze mit ID 3 entsteht: <code>delete_2.php?delete=3</code>
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">5</span>
        <span class="schritt-titel">CSS für den Lösch-Button</span>
        <code>.loeschen-btn {
    background: #e74c3c;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9em;
}
.loeschen-btn:hover {
    background: #c0392b;
}</code>
        <p>
            Der rote Button macht den Lösch-Link deutlich sichtbar und signalisiert "Vorsicht".
        </p>
    </div>

    <h3>Vollständiger Code</h3>

    <div class="schritt">
        <span class="schritt-nummer">6</span>
        <span class="schritt-titel">Alles zusammengesetzt</span>
        <code>&lt;?php
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Lösch-Logik
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM katzen WHERE id = $id");
}

$result = mysqli_query($conn, "SELECT * FROM katzen");
?&gt;

&lt;h2&gt;Mitarbeiter des Monats&lt;/h2&gt;

&lt;?php
echo "&lt;table class='katzen-tabelle'&gt;";
echo "&lt;tr&gt;";
echo "&lt;th&gt;ID&lt;/th&gt;";
echo "&lt;th&gt;Name&lt;/th&gt;";
echo "&lt;th&gt;Spezialität&lt;/th&gt;";
echo "&lt;th&gt;Täglicher Unfug&lt;/th&gt;";
echo "&lt;th&gt;Kaffeekonsum&lt;/th&gt;";
echo "&lt;th&gt;Aktion&lt;/th&gt;";
echo "&lt;/tr&gt;";

while ($katze = mysqli_fetch_array($result)) {
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['id'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['spezialitaet'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['taeglicher_unfug'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['kaffee_konsum'] . " Tassen&lt;/td&gt;";
    echo "&lt;td&gt;&lt;a href='delete_2.php?delete=" . $katze['id'] . "' class='loeschen-btn'&gt;Löschen&lt;/a&gt;&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}

echo "&lt;/table&gt;";

mysqli_free_result($result);
mysqli_close($conn);
?&gt;</code>
    </div>

    <div class="hinweis" style="margin-top: 25px;">
        <strong>Weiterführende Ideen:</strong><br>
        - JavaScript-Bestätigungsdialog vor dem Löschen<br>
        - "Soft Delete" mit einer Spalte "geloescht" statt echtem Entfernen<br>
        - Nur Admins dürfen löschen (Berechtigungssystem)
    </div>
</div>
