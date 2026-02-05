<?php
// ============================================
// BONUS: Prepared Statements (sicherste Methode)
// ============================================

// Datenbankverbindung
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Erlaubte Abteilungen (Whitelist - immer noch nötig!)
$erlaubte_abteilungen = ['Küche', 'Service', 'Unterhaltung', 'Sicherheit', 'Management'];

// Variablen für Meldungen
$erfolg = false;
$fehler = false;
$neue_id = 0;

// INSERT mit Prepared Statement
if (isset($_POST['name']) && !empty($_POST['name'])) {

    // Daten aus dem Formular holen (OHNE manuelles Escaping!)
    $name = $_POST['name'];
    $spezialitaet = $_POST['spezialitaet'];
    $taeglicher_unfug = $_POST['taeglicher_unfug'];
    $kaffee_konsum = intval($_POST['kaffee_konsum']);
    $gehalt = floatval($_POST['gehalt']);
    $eingestellt_am = !empty($_POST['eingestellt_am']) ? $_POST['eingestellt_am'] : null;

    // Abteilung mit Whitelist validieren (immer noch nötig!)
    $abteilung = $_POST['abteilung'];
    if (!in_array($abteilung, $erlaubte_abteilungen)) {
        $abteilung = 'Service';
    }

    // Prepared Statement erstellen
    $sql = "INSERT INTO katzen
        (name, spezialitaet, taeglicher_unfug, kaffee_konsum, eingestellt_am, gehalt, abteilung)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Parameter binden: s=string, i=integer, d=double
        mysqli_stmt_bind_param($stmt, "sssisds",
            $name,
            $spezialitaet,
            $taeglicher_unfug,
            $kaffee_konsum,
            $eingestellt_am,
            $gehalt,
            $abteilung
        );

        // Statement ausführen
        if (mysqli_stmt_execute($stmt)) {
            $erfolg = true;
            $neue_id = mysqli_insert_id($conn);
        } else {
            $fehler = mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
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
    <title>Prepared Statements - Bonus</title>
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
        color: #9b59b6;
        margin-top: 0;
        border-bottom: 2px solid #9b59b6;
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
        border-color: #9b59b6;
        outline: none;
        box-shadow: 0 0 5px rgba(155, 89, 182, 0.3);
    }
    .submit-btn {
        background: #9b59b6;
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
        background: #8e44ad;
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
        background: #9b59b6;
        color: white;
    }
    .katzen-tabelle tr:nth-child(even) {
        background: #f2f2f2;
    }
    .katzen-tabelle tr:hover {
        background: #f3e8fc;
    }
    .neue-katze {
        background: #e8daef !important;
        animation: highlight 2s ease-out;
    }
    @keyframes highlight {
        0% { background: #d7bde2; }
        100% { background: #e8daef; }
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

<h2>Neue Katze einstellen (Prepared Statements)</h2>

<?php
if ($erfolg) {
    echo "<div class='erfolg-meldung'>Katze erfolgreich eingestellt! (ID: $neue_id)</div>";
}
if ($fehler) {
    echo "<div class='fehler-meldung'>Fehler: $fehler</div>";
}
?>

<div class="formular-container">
    <h3>Bewerbungsformular (Prepared Statements)</h3>

    <form action="insert_5.php" method="post">

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
    <a href="insert_4.php" class="nav-btn zurueck">&larr; Zurück</a>
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
        border-bottom: 3px solid #9b59b6;
        padding-bottom: 10px;
    }
    .anleitung h3 {
        color: #2c3e50;
        margin-top: 30px;
    }
    .bonus-box {
        background: #f3e8fc;
        border: 2px solid #9b59b6;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .bonus-titel {
        font-weight: bold;
        color: #8e44ad;
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .bonus-box p {
        color: #5b2c6f;
        font-size: 1.05em;
        margin: 0;
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
        color: #bb8fce;
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
    .konzept code {
        background: #eceff1;
        padding: 2px 6px;
        border-radius: 3px;
        font-family: monospace;
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
    .vergleich-tabelle {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }
    .vergleich-tabelle th, .vergleich-tabelle td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    .vergleich-tabelle th {
        background: #f3e8fc;
        color: #8e44ad;
    }
</style>

<div class="anleitung">
    <h2>Bonus: Prepared Statements</h2>

    <div class="bonus-box">
        <div class="bonus-titel">Für Fortgeschrittene</div>
        <p>Prepared Statements sind die sicherste Methode, um Datenbank-Queries auszuführen.
        Sie trennen SQL-Code und Daten vollständig voneinander.</p>
    </div>

    <div class="konzept">
        <div class="konzept-titel">Warum Prepared Statements?</div>
        <table class="vergleich-tabelle">
            <tr>
                <th></th>
                <th>mysqli_real_escape_string()</th>
                <th>Prepared Statements</th>
            </tr>
            <tr>
                <td><strong>Sicherheit</strong></td>
                <td>Gut (bei korrekter Anwendung)</td>
                <td>Maximal (SQL-Injection unmöglich)</td>
            </tr>
            <tr>
                <td><strong>Lesbarkeit</strong></td>
                <td>Unübersichtlich bei vielen Variablen</td>
                <td>Klare Trennung von SQL und Daten</td>
            </tr>
            <tr>
                <td><strong>Performance</strong></td>
                <td>Normal</td>
                <td>Besser bei wiederholten Queries</td>
            </tr>
            <tr>
                <td><strong>Komplexität</strong></td>
                <td>Einfach</td>
                <td>Etwas mehr Code nötig</td>
            </tr>
        </table>
    </div>

    <h3>Der Code im Detail</h3>

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">SQL-Statement mit Platzhaltern</span>
        <code>$sql = "INSERT INTO katzen
    (name, spezialitaet, taeglicher_unfug, kaffee_konsum, eingestellt_am, gehalt, abteilung)
    VALUES (?, ?, ?, ?, ?, ?, ?)";</code>
        <p>
            Die <code>?</code> sind Platzhalter für die Werte. Sie werden später sicher eingesetzt.<br>
            Hier gibt es keine Anführungszeichen um die Platzhalter - das übernimmt MySQL automatisch!
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">2</span>
        <span class="schritt-titel">Statement vorbereiten</span>
        <code>$stmt = mysqli_prepare($conn, $sql);</code>
        <p>
            MySQL "kompiliert" das Statement und merkt sich, wo die Daten eingefügt werden sollen.
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Parameter binden</span>
        <code>mysqli_stmt_bind_param($stmt, "sssisds",
    $name,              // s = string
    $spezialitaet,      // s = string
    $taeglicher_unfug,  // s = string
    $kaffee_konsum,     // i = integer
    $eingestellt_am,    // s = string (Datum)
    $gehalt,            // d = double (Dezimalzahl)
    $abteilung          // s = string
);</code>
        <p>
            <strong>Der Typ-String "sssisds":</strong><br>
            <code>s</code> = String (Text)<br>
            <code>i</code> = Integer (Ganzzahl)<br>
            <code>d</code> = Double (Dezimalzahl)<br>
            <code>b</code> = Blob (Binärdaten)<br><br>
            Die Reihenfolge muss mit den <code>?</code> im SQL übereinstimmen!
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">Statement ausführen</span>
        <code>if (mysqli_stmt_execute($stmt)) {
    $neue_id = mysqli_insert_id($conn);
    // Erfolg!
} else {
    $fehler = mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);</code>
        <p>
            <strong>mysqli_stmt_execute():</strong> Führt das vorbereitete Statement aus<br>
            <strong>mysqli_stmt_close():</strong> Gibt die Ressourcen wieder frei
        </p>
    </div>

    <div class="konzept">
        <div class="konzept-titel">Warum ist das sicherer?</div>
        <p>
            Bei Prepared Statements werden <strong>SQL-Befehl</strong> und <strong>Daten</strong>
            getrennt an den Datenbankserver geschickt. Der Server weiß dadurch genau, was Code ist
            und was Daten sind.
        </p>
        <p style="margin-top: 10px;">
            Selbst wenn jemand <code>'; DROP TABLE katzen; --</code> eingibt, wird das nur als
            normaler Text gespeichert, nicht als SQL-Befehl ausgeführt!
        </p>
    </div>

    <div class="hinweis" style="margin-top: 25px;">
        <strong>Empfehlung:</strong> In professionellen Projekten solltest du immer Prepared Statements
        verwenden. Sie sind der Industriestandard für sichere Datenbankzugriffe.<br><br>
        <strong>Nächster Schritt:</strong> Lerne PDO (PHP Data Objects) kennen - eine modernere
        Alternative zu mysqli mit noch eleganterem Code!
    </div>
</div>

</body>
</html>
