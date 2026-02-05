<?php
// ============================================
// AUFGABE: Eingaben absichern (Sicherheit)
// ============================================

// Datenbankverbindung
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Erlaubte Abteilungen (für Whitelist-Validierung)
$erlaubte_abteilungen = ['Küche', 'Service', 'Unterhaltung', 'Sicherheit', 'Management'];

// Variablen für Meldungen
$erfolg = false;
$fehler = false;
$neue_id = 0;

// INSERT-Logik
if (isset($_POST['name']) && !empty($_POST['name'])) {

    // --------------------------------------------
    // Aufgabe 1: Textfelder absichern
    // Tipp: mysqli_real_escape_string($conn, $_POST['feldname'])
    // --------------------------------------------
    $name = $_POST['name'];  // <- hier absichern!
    $spezialitaet = $_POST['spezialitaet'];  // <- hier absichern!
    $taeglicher_unfug = $_POST['taeglicher_unfug'];  // <- hier absichern!

    // --------------------------------------------
    // Aufgabe 2: Zahlen absichern
    // Tipp: intval() für Ganzzahlen, floatval() für Dezimalzahlen
    // --------------------------------------------
    $kaffee_konsum = $_POST['kaffee_konsum'];  // <- hier absichern!
    $gehalt = $_POST['gehalt'];  // <- hier absichern!

    // Datum absichern
    $eingestellt_am = !empty($_POST['eingestellt_am'])
        ? "'" . mysqli_real_escape_string($conn, $_POST['eingestellt_am']) . "'"
        : "NULL";

    // --------------------------------------------
    // Aufgabe 3: Abteilung mit Whitelist validieren
    // Tipp: in_array($abteilung, $erlaubte_abteilungen)
    // --------------------------------------------
    $abteilung = $_POST['abteilung'];  // <- hier validieren!


    // INSERT-Statement erstellen
    $sql = "INSERT INTO katzen
        (name, spezialitaet, taeglicher_unfug, kaffee_konsum, eingestellt_am, gehalt, abteilung)
        VALUES
        ('$name', '$spezialitaet', '$taeglicher_unfug', $kaffee_konsum, $eingestellt_am, $gehalt, '$abteilung')";

    // Query ausführen
    if (mysqli_query($conn, $sql)) {
        $erfolg = true;
        $neue_id = mysqli_insert_id($conn);
    } else {
        $fehler = mysqli_error($conn);
    }
}

// Daten für die Tabelle abfragen
$result = mysqli_query($conn, "SELECT * FROM katzen ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eingaben absichern - Aufgabe</title>
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
        color: #e67e22;
        margin-top: 0;
        border-bottom: 2px solid #e67e22;
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
        border-color: #e67e22;
        outline: none;
        box-shadow: 0 0 5px rgba(230, 126, 34, 0.3);
    }
    .submit-btn {
        background: #e67e22;
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
        background: #d35400;
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
        background: #e67e22;
        color: white;
    }
    .katzen-tabelle tr:nth-child(even) {
        background: #f2f2f2;
    }
    .katzen-tabelle tr:hover {
        background: #fef3e8;
    }
    .neue-katze {
        background: #fdebd0 !important;
        animation: highlight 2s ease-out;
    }
    @keyframes highlight {
        0% { background: #f5b041; }
        100% { background: #fdebd0; }
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

<h2>Eingaben absichern (Sicherheit)</h2>

<?php
// Meldungen anzeigen
if ($erfolg) {
    echo "<div class='erfolg-meldung'>Katze erfolgreich eingestellt! (ID: $neue_id)</div>";
}
if ($fehler) {
    echo "<div class='fehler-meldung'>Fehler: $fehler</div>";
}
?>

<div class="formular-container">
    <h3>Bewerbungsformular (mit Absicherung)</h3>

    <form action="insert_3.php" method="post">

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
            <input type="date" id="eingestellt_am" name="eingestellt_am" value="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="form-gruppe">
            <label for="gehalt">Monatsgehalt (€):</label>
            <input type="number" id="gehalt" name="gehalt" step="0.01" min="0" value="1800.00">
        </div>

        <div class="form-gruppe">
            <label for="abteilung">Abteilung:</label>
            <select id="abteilung" name="abteilung" required>
                <option value="">-- Bitte wählen --</option>
                <option value="Küche">Küche</option>
                <option value="Service" selected>Service</option>
                <option value="Unterhaltung">Unterhaltung</option>
                <option value="Sicherheit">Sicherheit</option>
                <option value="Management">Management</option>
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
    $klasse = ($katze['id'] == $neue_id) ? "neue-katze" : "";

    echo "<tr class='$klasse'>";
    echo "<td>" . $katze['id'] . "</td>";
    echo "<td>" . htmlspecialchars($katze['name']) . "</td>";
    echo "<td>" . htmlspecialchars($katze['spezialitaet']) . "</td>";
    echo "<td>" . htmlspecialchars($katze['taeglicher_unfug']) . "</td>";
    echo "<td>" . ($katze['kaffee_konsum'] ?? '-') . " Tassen</td>";
    echo "<td>" . ($katze['eingestellt_am'] ?? '-') . "</td>";
    echo "<td>" . number_format($katze['gehalt'] ?? 0, 2, ',', '.') . " €</td>";
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
    <a href="insert_2.php" class="nav-btn zurueck">&larr; Zurück</a>
    <a href="insert_4.php" class="nav-btn weiter">Weiter zur Lösung &rarr;</a>
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
        border-bottom: 3px solid #e67e22;
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
        background: #f8d7da;
        border: 2px solid #dc3545;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .konzept-titel {
        font-weight: bold;
        color: #721c24;
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
        border-left: 4px solid #e67e22;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .schritt-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .schritt-nummer {
        background: #e67e22;
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
        background: #fef3e8;
        padding: 2px 6px;
        border-radius: 3px;
        color: #d35400;
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
        color: #e67e22;
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
        color: #f5b041;
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
    .info-tabelle {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }
    .info-tabelle th, .info-tabelle td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    .info-tabelle th {
        background: #fff3cd;
        color: #856404;
    }
    .info-tabelle code {
        background: #eceff1;
        padding: 2px 6px;
        border-radius: 3px;
        font-family: monospace;
    }
</style>

<div class="anleitung">
    <h2>Eingaben absichern - SQL-Injection verhindern</h2>

    <div class="konzept">
        <div class="konzept-titel">Was ist SQL-Injection?</div>
        <p>
            Bei einer SQL-Injection schleust ein Angreifer schädlichen SQL-Code über Formulareingaben ein.
        </p>
        <p style="margin-top: 10px;">
            <strong>Beispiel:</strong> Wenn jemand als Name eingibt:<br>
            <code style="display:block; margin:10px 0; padding:10px; background:#2c3e50; color:#e74c3c;">'); DROP TABLE katzen; --</code>
            wird daraus im SQL:
            <code style="display:block; margin:10px 0; padding:10px; background:#2c3e50; color:#e74c3c;">INSERT INTO katzen (name) VALUES (''); DROP TABLE katzen; --')</code>
            Das würde die gesamte Tabelle löschen!
        </p>
    </div>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Sichere die Benutzereingaben im PHP-Code ab:</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>Textfelder mit <code>mysqli_real_escape_string()</code> absichern</li>
                <li>Zahlen mit <code>intval()</code> und <code>floatval()</code> absichern</li>
                <li>Abteilung mit Whitelist (<code>in_array()</code>) validieren</li>
            </ol>
        </div>
    </div>

    <div class="konzept" style="background: #fff3cd; border-color: #ffc107;">
        <div class="konzept-titel" style="color: #856404;">Welche Absicherung für welchen Datentyp?</div>
        <table class="info-tabelle">
            <tr>
                <th>Datentyp</th>
                <th>Absicherung</th>
                <th>Beispiel</th>
            </tr>
            <tr>
                <td>Text (VARCHAR)</td>
                <td><code>mysqli_real_escape_string()</code></td>
                <td>Name, Spezialität, Unfug</td>
            </tr>
            <tr>
                <td>Ganzzahl (INT)</td>
                <td><code>intval()</code></td>
                <td>Kaffeekonsum, ID</td>
            </tr>
            <tr>
                <td>Dezimalzahl (DECIMAL)</td>
                <td><code>floatval()</code></td>
                <td>Gehalt</td>
            </tr>
            <tr>
                <td>Auswahl (ENUM)</td>
                <td><code>in_array()</code> Whitelist</td>
                <td>Abteilung</td>
            </tr>
        </table>
    </div>

    <h3>Die Arbeitsschritte</h3>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">1</span>
            <span class="schritt-titel">Textfelder absichern</span>
        </div>
        <p class="schritt-auftrag">
            Wickle jeden Textwert in <code>mysqli_real_escape_string($conn, ...)</code> ein.<br>
            Diese Funktion "entschärft" gefährliche Zeichen wie Anführungszeichen.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>So sicherst du Textfelder:</p>
                <code>$name = mysqli_real_escape_string($conn, $_POST['name']);
$spezialitaet = mysqli_real_escape_string($conn, $_POST['spezialitaet']);
$taeglicher_unfug = mysqli_real_escape_string($conn, $_POST['taeglicher_unfug']);</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">2</span>
            <span class="schritt-titel">Zahlen absichern</span>
        </div>
        <p class="schritt-auftrag">
            Wandle Zahlen mit <code>intval()</code> (Ganzzahlen) oder <code>floatval()</code> (Dezimalzahlen) um.<br>
            Nicht-numerische Eingaben werden automatisch zu 0.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>So sicherst du Zahlenfelder:</p>
                <code>$kaffee_konsum = intval($_POST['kaffee_konsum']);
$gehalt = floatval($_POST['gehalt']);</code>
            </div>
        </details>
    </div>

    <div class="arbeitsschritt">
        <div class="schritt-header">
            <span class="schritt-nummer">3</span>
            <span class="schritt-titel">Whitelist-Validierung</span>
        </div>
        <p class="schritt-auftrag">
            Prüfe mit <code>in_array()</code>, ob die Abteilung in der Liste erlaubter Werte ist.<br>
            Falls nicht, setze einen sicheren Standardwert.
        </p>
        <details class="hilfe">
            <summary>Hilfe anzeigen</summary>
            <div class="hilfe-inhalt">
                <p>So validierst du mit einer Whitelist:</p>
                <code>$abteilung = $_POST['abteilung'];
if (!in_array($abteilung, $erlaubte_abteilungen)) {
    $abteilung = 'Service'; // Fallback-Wert
}</code>
            </div>
        </details>
    </div>

    <div class="hinweis" style="margin-top: 25px;">
        <strong>Tipp zum Testen:</strong> Versuche, Sonderzeichen wie <code>'</code> oder <code>"</code>
        in die Textfelder einzugeben. Mit korrekter Absicherung sollte es trotzdem funktionieren!
    </div>
</div>

</body>
</html>
