<?php
// ============================================
// MUSTERLÖSUNG: Neue Katzen einstellen (einfache Version)
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

// INSERT-Logik: Prüfen ob das Formular abgeschickt wurde
if (isset($_POST['name']) && !empty($_POST['name'])) {

    // Daten aus dem Formular holen (NOCH OHNE Absicherung!)
    $name = $_POST['name'];
    $spezialitaet = $_POST['spezialitaet'];
    $taeglicher_unfug = $_POST['taeglicher_unfug'];
    $kaffee_konsum = $_POST['kaffee_konsum'];
    $gehalt = $_POST['gehalt'];
    $eingestellt_am = $_POST['eingestellt_am'];
    $abteilung = $_POST['abteilung'];

    // INSERT-Statement erstellen
    $sql = "INSERT INTO katzen
        (name, spezialitaet, taeglicher_unfug, kaffee_konsum, eingestellt_am, gehalt, abteilung)
        VALUES
        ('$name', '$spezialitaet', '$taeglicher_unfug', $kaffee_konsum, '$eingestellt_am', $gehalt, '$abteilung')";

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
    <title>Neue Katze einstellen - Musterlösung</title>
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
    .neue-katze {
        background: #d4edda !important;
        animation: highlight 2s ease-out;
    }
    @keyframes highlight {
        0% { background: #90EE90; }
        100% { background: #d4edda; }
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

<div class="formular-container">
    <h3>Bewerbungsformular</h3>

    <form action="insert_2.php" method="post">

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
            <input type="number" id="gehalt" name="gehalt" step="0.01" min="0" value="1800.00" placeholder="z.B. 1800.00">
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
    // Neue Katze hervorheben
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
    <a href="insert_1.php" class="nav-btn zurueck">&larr; Zurück</a>
    <a href="insert_3.php" class="nav-btn weiter">Weiter: Sicherheit &rarr;</a>
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
        background: #e67e22;
    }
    .nav-btn.weiter:hover {
        background: #d35400;
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
    .anleitung h3 {
        color: #2c3e50;
        margin-top: 30px;
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
    .warnung-box {
        background: #fff3cd;
        border: 2px solid #ffc107;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .warnung-box-titel {
        font-weight: bold;
        color: #856404;
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .warnung-box p {
        color: #856404;
        font-size: 1.05em;
        margin: 0;
    }
    .schritt {
        background: white;
        margin: 15px 0;
        padding: 15px;
        border-left: 4px solid #27ae60;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
        background: #e3f2fd;
        border: 1px solid #2196f3;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .konzept-titel {
        font-weight: bold;
        color: #1565c0;
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
</style>

<div class="anleitung">
    <h2>Neue Katzen einstellen - Musterlösung</h2>

    <div class="musterloesung">
        <div class="musterloesung-titel">Musterlösung</div>
        <p>Dies ist die fertige Lösung zur Aufgabe aus insert_1.php. Vergleiche deinen Code mit dieser Lösung!</p>
    </div>

    <div class="warnung-box">
        <div class="warnung-box-titel">Achtung: Diese Version ist noch UNSICHER!</div>
        <p>
            Der Code funktioniert, aber er ist anfällig für <strong>SQL-Injection-Angriffe</strong>.<br>
            Ein böswilliger Benutzer könnte durch spezielle Eingaben die Datenbank manipulieren oder löschen!<br><br>
            <strong>Im nächsten Schritt lernst du, wie du die Eingaben absicherst.</strong>
        </p>
    </div>

    <div class="konzept">
        <div class="konzept-titel">So funktioniert das Einfügen</div>
        <p>Der Ablauf beim Absenden des Formulars:</p>
        <ol style="margin: 10px 0; padding-left: 20px; line-height: 1.8;">
            <li>Das Formular sendet die Daten per POST an die gleiche Seite</li>
            <li>PHP prüft mit <code style="background:#eceff1; padding:2px 6px; border-radius:3px;">isset($_POST['name'])</code> ob Daten gesendet wurden</li>
            <li>Die Daten werden in Variablen gespeichert</li>
            <li>Das INSERT-Statement fügt den neuen Datensatz ein</li>
            <li>Die Tabelle wird neu geladen - mit der neuen Katze!</li>
        </ol>
    </div>

    <h3>Der Code im Detail</h3>

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">Formular mit POST-Methode</span>
        <code>&lt;form action="insert_2.php" method="post"&gt;
    ...
&lt;/form&gt;</code>
        <p>
            <strong>action:</strong> Die URL, an die das Formular gesendet wird (hier: dieselbe Seite)<br>
            <strong>method="post":</strong> Daten werden unsichtbar übertragen, nicht in der URL
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">2</span>
        <span class="schritt-titel">Dropdown mit Optionen</span>
        <code>&lt;select id="abteilung" name="abteilung" required&gt;
    &lt;option value=""&gt;-- Bitte wählen --&lt;/option&gt;
    &lt;option value="Küche"&gt;Küche&lt;/option&gt;
    &lt;option value="Service" selected&gt;Service&lt;/option&gt;
    &lt;option value="Unterhaltung"&gt;Unterhaltung&lt;/option&gt;
    &lt;option value="Sicherheit"&gt;Sicherheit&lt;/option&gt;
    &lt;option value="Management"&gt;Management&lt;/option&gt;
&lt;/select&gt;</code>
        <p>
            <strong>value:</strong> Der Wert, der an PHP gesendet wird<br>
            <strong>selected:</strong> Vorausgewählte Option<br>
            <strong>required:</strong> Pflichtfeld
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Daten aus POST holen</span>
        <code>if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
    $spezialitaet = $_POST['spezialitaet'];
    $taeglicher_unfug = $_POST['taeglicher_unfug'];
    $kaffee_konsum = $_POST['kaffee_konsum'];
    $gehalt = $_POST['gehalt'];
    $eingestellt_am = $_POST['eingestellt_am'];
    $abteilung = $_POST['abteilung'];
}</code>
        <p>
            <strong>isset():</strong> Prüft ob die Variable existiert<br>
            <strong>!empty():</strong> Prüft ob der Wert nicht leer ist
        </p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">INSERT-Statement ausführen</span>
        <code>$sql = "INSERT INTO katzen
    (name, spezialitaet, taeglicher_unfug, kaffee_konsum, eingestellt_am, gehalt, abteilung)
    VALUES
    ('$name', '$spezialitaet', '$taeglicher_unfug', $kaffee_konsum, '$eingestellt_am', $gehalt, '$abteilung')";

if (mysqli_query($conn, $sql)) {
    $neue_id = mysqli_insert_id($conn);
    // Erfolgsmeldung...
} else {
    $fehler = mysqli_error($conn);
}</code>
        <p>
            <strong>mysqli_insert_id():</strong> Gibt die automatisch generierte ID des neuen Eintrags zurück<br>
            <strong>mysqli_error():</strong> Zeigt die Fehlermeldung bei Problemen
        </p>
    </div>

    <div class="hinweis" style="margin-top: 25px;">
        <strong>Nächster Schritt:</strong> In insert_3.php lernst du, wie du die Benutzereingaben absicherst,
        um SQL-Injection-Angriffe zu verhindern!
    </div>
</div>

</body>
</html>
