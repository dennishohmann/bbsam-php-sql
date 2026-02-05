<?php
// ============================================
// AUFGABE: Neue Katzen einstellen (INSERT)
// ============================================

// Datenbankverbindung
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Variablen für Meldungen
$erfolg = false;
$fehler = false;
$neue_id = 0;

// --------------------------------------------
// Schritt 1: Prüfen ob das Formular abgeschickt wurde
// Tipp: Nutze isset() und $_POST['name']
// --------------------------------------------


// --------------------------------------------
// Schritt 2: Daten aus dem Formular holen
// Tipp: $_POST['feldname'] gibt den Wert zurück
// --------------------------------------------


// --------------------------------------------
// Schritt 3: INSERT-Statement ausführen
// Tipp: INSERT INTO katzen (spalte1, spalte2, ...) VALUES ('wert1', 'wert2', ...)
// --------------------------------------------


// Daten für die Tabelle abfragen
$result = mysqli_query($conn, "SELECT * FROM katzen ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neue Katze einstellen</title>
</head>
<body>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background: #f5f5f5;
    }
    h2 {
        color: #2c3e50;
        text-align: center;
    }

    /* Formular-Styles */
    .formular-container {
        max-width: 600px;
        margin: 20px auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .formular-container h3 {
        color: #27ae60;
        margin-top: 0;
        border-bottom: 2px solid #27ae60;
        padding-bottom: 10px;
    }
    .form-gruppe {
        margin-bottom: 15px;
    }
    .form-gruppe label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }
    .form-gruppe input,
    .form-gruppe select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1em;
        box-sizing: border-box;
    }
    .form-gruppe input:focus,
    .form-gruppe select:focus {
        border-color: #27ae60;
        outline: none;
        box-shadow: 0 0 5px rgba(39, 174, 96, 0.3);
    }
    .submit-btn {
        background: #27ae60;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-size: 1.1em;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
    }
    .submit-btn:hover {
        background: #219a52;
    }

    /* Tabellen-Styles */
    .katzen-tabelle {
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        border-collapse: collapse;
    }
    .katzen-tabelle th, .katzen-tabelle td {
        border: 1px solid #ddd;
        padding: 10px;
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

    /* Meldungen */
    .erfolg-meldung {
        background: #d4edda;
        border: 1px solid #28a745;
        color: #155724;
        padding: 12px 20px;
        border-radius: 5px;
        margin: 20px auto;
        max-width: 600px;
    }
    .fehler-meldung {
        background: #f8d7da;
        border: 1px solid #dc3545;
        color: #721c24;
        padding: 12px 20px;
        border-radius: 5px;
        margin: 20px auto;
        max-width: 600px;
    }
</style>

<h2>Neue Katze einstellen</h2>

<?php
// Meldungen anzeigen
if ($erfolg) {
    echo "<div class='erfolg-meldung'>Katze erfolgreich eingestellt! (ID: $neue_id)</div>";
}
if ($fehler) {
    echo "<div class='fehler-meldung'>Fehler: $fehler</div>";
}
?>

<!-- =============================================
     FORMULAR - Hier musst du die method ergänzen!
     ============================================= -->
<div class="formular-container">
    <h3>Bewerbungsformular</h3>

    <!-- Aufgabe A: Ergänze method="post" im form-Tag -->
    <form action="insert_1.php">

        <div class="form-gruppe">
            <label for="name">Name der Katze:</label>
            <input type="text" id="name" name="name" required placeholder="z.B. Frau Miezbert">
        </div>

        <div class="form-gruppe">
            <label for="spezialitaet">Spezialität:</label>
            <input type="text" id="spezialitaet" name="spezialitaet" required placeholder="z.B. Kaffee verschütten">
        </div>

        <div class="form-gruppe">
            <label for="taeglicher_unfug">Täglicher Unfug:</label>
            <input type="text" id="taeglicher_unfug" name="taeglicher_unfug" required placeholder="z.B. Blumentöpfe umwerfen">
        </div>

        <div class="form-gruppe">
            <label for="kaffee_konsum">Kaffeekonsum (Tassen pro Tag):</label>
            <input type="number" id="kaffee_konsum" name="kaffee_konsum" min="0" max="99" value="0">
        </div>

        <div class="form-gruppe">
            <label for="eingestellt_am">Einstellungsdatum:</label>
            <input type="date" id="eingestellt_am" name="eingestellt_am">
        </div>

        <div class="form-gruppe">
            <label for="gehalt">Monatsgehalt (€):</label>
            <input type="number" id="gehalt" name="gehalt" step="0.01" min="0" placeholder="z.B. 1800.00">
        </div>

        <div class="form-gruppe">
            <label for="abteilung">Abteilung:</label>
            <!-- Aufgabe B: Erstelle hier die Optionen für das Dropdown -->
            <select id="abteilung" name="abteilung">
                <option value="">-- Bitte wählen --</option>
                <!-- Füge hier die 5 Abteilungen als <option> ein:
                     Küche, Service, Unterhaltung, Sicherheit, Management -->
            </select>
        </div>

        <button type="submit" class="submit-btn">Katze einstellen</button>
    </form>
</div>

<h2 style="margin-top: 40px;">Aktuelle Mitarbeiter</h2>

<?php
echo "<table class='katzen-tabelle'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Spezialität</th>";
echo "<th>Unfug</th>";
echo "<th>Kaffee</th>";
echo "<th>Eingestellt</th>";
echo "<th>Gehalt</th>";
echo "<th>Abteilung</th>";
echo "</tr>";

while ($katze = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $katze['id'] . "</td>";
    echo "<td>" . htmlspecialchars($katze['name']) . "</td>";
    echo "<td>" . htmlspecialchars($katze['spezialitaet']) . "</td>";
    echo "<td>" . htmlspecialchars($katze['taeglicher_unfug']) . "</td>";
    echo "<td>" . ($katze['kaffee_konsum'] ?? '-') . "&nbsp;Tassen</td>";
    echo "<td>" . ($katze['eingestellt_am'] ?? '-') . "</td>";
    echo "<td>" . number_format($katze['gehalt'] ?? 0, 2, ',', '.') . "&nbsp;€</td>";
    echo "<td>" . htmlspecialchars($katze['abteilung'] ?? '-') . "</td>";
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
    <a href="insert_0.html" class="nav-btn zurueck">&larr; Zurück</a>
    <a href="insert_2.php" class="nav-btn weiter">Weiter zur Lösung &rarr;</a>
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

    /* Anleitung Styles */
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
        border-bottom: 3px solid #27ae60;
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
    .arbeitsschritt {
        background: white;
        margin: 15px 0;
        padding: 15px;
        border-left: 4px solid #27ae60;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .schritt-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .schritt-nummer {
        background: #27ae60;
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
        background: #e8f5e9;
        padding: 2px 6px;
        border-radius: 3px;
        color: #2e7d32;
        font-family: monospace;
    }
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
        color: #27ae60;
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
    <h2>Neue Katzen einstellen mit PHP &amp; MySQL</h2>

    <div class="konzept">
        <div class="konzept-titel">POST-Methode</div>
        <p>
            Im Gegensatz zu GET (wo die Daten in der URL stehen) werden bei POST die Daten
            <em>unsichtbar</em> im Hintergrund übertragen. Das ist sicherer für Formulare!
        </p>
        <p style="text-align: center; font-family: monospace; font-size: 1.1em; margin: 15px 0;">
            <code>&lt;form method="post"&gt;</code> statt <code>&lt;form method="get"&gt;</code>
        </p>
        <p>
            In PHP greifst du auf die Werte mit <code>$_POST['feldname']</code> zu.
        </p>
    </div>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Vervollständige das Formular und die PHP-Logik:</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>Formular-Methode auf <code>post</code> setzen</li>
                <li>Dropdown-Optionen für die Abteilungen hinzufügen</li>
                <li>INSERT-Statement ausführen und Erfolgsmeldung anzeigen</li>
            </ol>
        </div>
    </div>

    <h3>Die Arbeitsschritte</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">1</span>
            <span class="schritt-titel">Formular auf POST umstellen</span>
        </div>
        <p class="schritt-auftrag">
            Ändere im <code>&lt;form&gt;</code>-Tag das <code>method</code>-Attribut auf <code>"post"</code>.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Das form-Tag sollte so aussehen:</p>
                <code>&lt;form action="insert_1.php" method="post"&gt;</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">2</span>
            <span class="schritt-titel">Dropdown-Optionen hinzufügen</span>
        </div>
        <p class="schritt-auftrag">
            Füge im <code>&lt;select&gt;</code> für die Abteilung die 5 Optionen hinzu:
            Küche, Service, Unterhaltung, Sicherheit, Management
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>Jede Option hat einen value und einen angezeigten Text:</p>
                <code>&lt;option value="Küche"&gt;Küche&lt;/option&gt;
&lt;option value="Service"&gt;Service&lt;/option&gt;
&lt;option value="Unterhaltung"&gt;Unterhaltung&lt;/option&gt;
&lt;option value="Sicherheit"&gt;Sicherheit&lt;/option&gt;
&lt;option value="Management"&gt;Management&lt;/option&gt;</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">3</span>
            <span class="schritt-titel">INSERT ausführen</span>
        </div>
        <p class="schritt-auftrag">
            Prüfe mit <code>isset()</code> ob das Formular abgeschickt wurde.
            Hole die Daten mit <code>$_POST['feldname']</code> und erstelle ein INSERT-Statement.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>So holst du die Daten und führst das INSERT aus:</p>
                <code>if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
    $spezialitaet = $_POST['spezialitaet'];
    $taeglicher_unfug = $_POST['taeglicher_unfug'];
    $kaffee_konsum = $_POST['kaffee_konsum'];
    $gehalt = $_POST['gehalt'];
    $eingestellt_am = $_POST['eingestellt_am'];
    $abteilung = $_POST['abteilung'];

    $sql = "INSERT INTO katzen
        (name, spezialitaet, taeglicher_unfug, kaffee_konsum, eingestellt_am, gehalt, abteilung)
        VALUES
        ('$name', '$spezialitaet', '$taeglicher_unfug', $kaffee_konsum, '$eingestellt_am', $gehalt, '$abteilung')";

    if (mysqli_query($conn, $sql)) {
        $erfolg = true;
        $neue_id = mysqli_insert_id($conn);
    } else {
        $fehler = mysqli_error($conn);
    }
}</code>
            </div>
        </details>
    </div>

    <div class="hinweis" style="margin-top: 25px;">
        <strong>Tipp zum Testen:</strong> Fülle alle Felder aus und klicke auf "Katze einstellen".
        Die neue Katze sollte in der Tabelle erscheinen!
    </div>
</div>

</body>
</html>
