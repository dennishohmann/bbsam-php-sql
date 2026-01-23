<?php
// Schritt 1: Verbindung herstellen
$conn = mysqli_connect("localhost", "root", "", "katzencafe");

// Schritt 2: Zeichensatz festlegen
mysqli_set_charset($conn, "utf8mb4");

// Schritt 3: Verbindung prüfen
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Schritt 4: Abfrage ausführen
$result = mysqli_query($conn, "SELECT * FROM katzen ORDER BY kaffee_konsum DESC");

// Schritt 5 & 6: Ergebnisse durchlaufen und ausgeben
echo "<h2>🐱 Mitarbeiter des Monats 🐱</h2>";

while ($katze = mysqli_fetch_assoc($result)) {
    $kaffee = $katze['kaffee_konsum'] ?? '???';
    echo "<p><b>{$katze['name']}</b><br>";
    echo "Spezialität: {$katze['spezialitaet']}<br>";
    echo "Täglicher Unfug: {$katze['taeglicher_unfug']}<br>";
    echo "Kaffeekonsum: {$kaffee} Tassen ☕</p><hr>";
}

// Schritt 7: Ressourcen freigeben
mysqli_free_result($result);

// Schritt 8: Verbindung schließen
mysqli_close($conn);
?>
<div class="navigation">
    <a href="sql_2.php" class="nav-btn zurueck">← Zurück</a>
    <div class="nav-platzhalter"></div>
    <a href="sql_4.php" class="nav-btn weiter">Weiter zur Lösung→</a>
</div>   
<!--    #######################################
        Ab hier braucht ihr nicht weiter lesen :)
        
        Diese Anleitung braucht nur im Browser gelesen zu werden...
-->

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
    .vergleich {
        display: flex;
        gap: 20px;
        margin: 15px 0;
    }
    .vergleich-box {
        flex: 1;
        background: white;
        padding: 10px;
        border-radius: 5px;
    }
    .vergleich-box.vorher {
        border: 2px solid #e74c3c;
    }
    .vergleich-box.nachher {
        border: 2px solid #27ae60;
    }
    .vergleich-label {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .vergleich-box code {
        display: block;
        background: #2c3e50;
        color: #2ecc71;
        padding: 8px;
        border-radius: 3px;
        font-family: monospace;
        font-size: 0.85em;
        white-space: pre;
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
    <h2>📊 Tabellenausgabe mit PHP &amp; MySQL</h2>

    <div class="konzept">
        <div class="konzept-titel">💡 Das Konzept</div>
        <p>Statt jeden Datensatz einzeln mit Absätzen auszugeben, bauen wir eine HTML-Tabelle auf. Die Schleife durchläuft alle Datensätze und erzeugt für jeden eine neue Tabellenzeile. So entsteht die Tabelle Zeile für Zeile dynamisch.</p>
    </div>

    <h3>Aufbau der HTML-Tabelle</h3>

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">Tabellenstruktur verstehen</span>
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
        <p>Eine HTML-Tabelle besteht aus mehreren Elementen:</p>
        <div class="parameter">
            <strong>&lt;table&gt;</strong> – Der Container für die gesamte Tabelle<br>            <strong>&lt;tr&gt;</strong> – Eine Tabellenzeile (table row)<br>
            <strong>&lt;th&gt;</strong> – Eine Kopfzelle (table header) / wird in fetter Schriftart angezeigt<br>
            <strong>&lt;td&gt;</strong> – Eine Datenzelle (table data)
        </div>
    </div>

    <h3>Umbau der Ausgabe</h3>

    <div class="schritt">
        <span class="schritt-nummer">2</span>
        <span class="schritt-titel">Tabellenkopf vor der Schleife ausgeben</span>
        <code>echo "&lt;table&gt;";
echo "&lt;tr&gt;";
echo "&lt;th&gt;Name&lt;/th&gt;";
echo "&lt;th&gt;Spezialität&lt;/th&gt;";
echo "&lt;th&gt;Täglicher Unfug&lt;/th&gt;";
echo "&lt;th&gt;Kaffeekonsum&lt;/th&gt;";
echo "&lt;/tr&gt;";</code>
        <p>Der Tabellenkopf wird einmalig vor der Schleife ausgegeben. Er enthält die Spaltenüberschriften, die den Feldern in der Datenbank entsprechen. Das öffnende &lt;tbody&gt;-Tag bereitet den Bereich für die Datenzeilen vor.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Schleife für die Datenzeilen anpassen</span>
        
        <div class="vergleich">
            <div class="vergleich-box vorher">
                <div class="vergleich-label">❌ Vorher:</div>
                <code>while ($katze = mysqli_fetch_assoc($result)) {
    echo "&lt;p&gt;";
    echo $katze['name'];
    echo "&lt;/p&gt;";
}</code>
            </div>
            <div class="vergleich-box nachher">
                <div class="vergleich-label">✅ Nachher:</div>
                <code>while ($katze = mysqli_fetch_assoc($result)) {
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}</code>
            </div>
        </div>
        
        <p>Statt Absätze (&lt;p&gt;) erzeugen wir jetzt Tabellenzeilen (&lt;tr&gt;). Jeder Wert wird in eine eigene Zelle (&lt;td&gt;) geschrieben. Die Schleife wiederholt dies für jeden Datensatz.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">Alle Spalten in die Zeile einfügen</span>
        <code>while ($katze = mysqli_fetch_assoc($result)) {
    $kaffee = $katze['kaffee_konsum'] ?? '???';
    
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['spezialitaet'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['taeglicher_unfug'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $kaffee . " ☕&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}</code>
        <p>Jede Spalte aus der Datenbank bekommt eine eigene &lt;td&gt;-Zelle. Die Reihenfolge muss mit den Überschriften im Tabellenkopf übereinstimmen. Der Null-Coalescing-Operator behandelt NULL-Werte.</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">5</span>
        <span class="schritt-titel">Tabelle nach der Schleife schließen</span>
        <code>
echo "&lt;/table&gt;";</code>
        <p>Nach der Schleife werden die geöffneten Tags geschlossen. Erst &lt;/tbody&gt; für den Datenbereich, dann &lt;/table&gt; für die gesamte Tabelle. Dies geschieht einmalig nach allen Datensätzen.</p>
    </div>

    <h3>BONUS: Styling der Tabelle</h3>

    <div class="schritt">
        <span class="schritt-nummer">6</span>
        <span class="schritt-titel">CSS für die Tabelle hinzufügen</span>
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
        <p>Das CSS macht die Tabelle ansprechender:</p>
        <div class="parameter">
            <strong>border-collapse:</strong> Verschmilzt doppelte Rahmenlinien zu einer<br>
            <strong>nth-child(even):</strong> Färbt jede zweite Zeile für bessere Lesbarkeit<br>
            <strong>tr:hover:</strong> Hebt die Zeile unter dem Mauszeiger hervor
        </div>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">7</span>
        <span class="schritt-titel">CSS-Klasse der Tabelle zuweisen</span>
        <code>echo "&lt;table class='katzen-tabelle'&gt;";</code>
        <p>Die Klasse verbindet die Tabelle mit dem CSS. Ohne diese Zuweisung greifen die Styles nicht.</p>
    </div>

    <h3>Vollständiger Code</h3>

    <div class="schritt">
        <span class="schritt-nummer">8</span>
        <span class="schritt-titel">Alles zusammengesetzt</span>
        <code>&lt;?php
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM katzen ORDER BY kaffee_konsum DESC");
?&gt;

&lt;style&gt;
    .katzen-tabelle { width: 100%; border-collapse: collapse; margin: 20px 0; }
    .katzen-tabelle th, .katzen-tabelle td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    .katzen-tabelle th { background: #3498db; color: white; }
    .katzen-tabelle tr:nth-child(even) { background: #f2f2f2; }
    .katzen-tabelle tr:hover { background: #e8f4fc; }
&lt;/style&gt;

&lt;h2&gt;🐱 Mitarbeiter des Monats 🐱&lt;/h2&gt;

&lt;?php
echo "&lt;table class='katzen-tabelle'&gt;";
echo "&lt;tr&gt;";
echo "&lt;th&gt;Name&lt;/th&gt;";
echo "&lt;th&gt;Spezialität&lt;/th&gt;";
echo "&lt;th&gt;Täglicher Unfug&lt;/th&gt;";
echo "&lt;th&gt;Kaffeekonsum&lt;/th&gt;";
echo "&lt;/tr&gt;";

while ($katze = mysqli_fetch_assoc($result)) {
    $kaffee = $katze['kaffee_konsum'] ?? '???';
    
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $katze['name'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['spezialitaet'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $katze['taeglicher_unfug'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . $kaffee . " ☕&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}

echo "&lt;/table&gt;";

mysqli_free_result($result);
mysqli_close($conn);
?&gt;</code>
        
        <div class="hinweis">
            <strong>Tipp:</strong> Der PHP-Code kann mit reinem HTML gemischt werden. Dafür mit ?&gt; php schließen - "normales" html verwenden und später wieder mit &lt;?php in php wechseln.
        </div>
    </div>
</div>