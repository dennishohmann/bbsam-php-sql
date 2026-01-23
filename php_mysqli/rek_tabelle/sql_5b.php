<?php
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM katzen ORDER BY kaffee_konsum DESC");
?>

<style>
    .katzen-tabelle { width: 100%; border-collapse: collapse; margin: 20px 0; }
    .katzen-tabelle th, .katzen-tabelle td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    .katzen-tabelle th { background: #3498db; color: white; }
    .katzen-tabelle tr:nth-child(even) { background: #f2f2f2; }
    .katzen-tabelle tr:hover { background: #e8f4fc; }
</style>

<h2>Mitarbeiter des Monats</h2>

<?php
echo "<table class='katzen-tabelle'>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Spezialitaet</th>";
echo "<th>Taeglicher Unfug</th>";
echo "<th>Kaffeekonsum</th>";
echo "</tr>";

while ($katze = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $katze['name'] . "</td>";
    echo "<td>" . $katze['spezialitaet'] . "</td>";
    echo "<td>" . $katze['taeglicher_unfug'] . "</td>";
    echo "<td>" . $katze['kaffee_konsum'] . "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_free_result($result);
mysqli_close($conn);
?>

<div class="navigation">
    <a href="sql_5a.php" class="nav-btn zurueck">&larr; Zurueck</a>
    <div class="nav-platzhalter"></div>
    <a href="sql_6.php" class="nav-btn weiter">Weiter zur Musterloesung &rarr;</a>
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
    .parameter {
        background: #ecf0f1;
        padding: 8px;
        border-radius: 5px;
        margin-top: 10px;
    }
    .parameter strong {
        color: #e74c3c;
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
    .zusatz {
        background: #e8daef;
        border: 1px solid #9b59b6;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .zusatz-titel {
        font-weight: bold;
        color: #6c3483;
        margin-bottom: 10px;
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
    .vorteile {
        background: #d4edda;
        border: 2px solid #28a745;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .vorteile-titel {
        font-weight: bold;
        color: #155724;
        font-size: 1.1em;
        margin-bottom: 10px;
    }
    .vorteile ul {
        margin: 0;
        padding-left: 20px;
    }
    .vorteile li {
        color: #155724;
        margin: 5px 0;
    }
</style>

<div class="anleitung">
    <h2>Aufgabe: Code-Optimierung mit foreach</h2>

    <div class="konzept">
        <div class="konzept-titel">DRY - Don't Repeat Yourself</div>
        <p>Ein wichtiges Prinzip in der Programmierung: Wiederhole dich nicht! Wenn Code sich mehrfach wiederholt, sollte er zusammengefasst werden. Das macht den Code kuerzer, uebersichtlicher und einfacher zu warten.</p>
    </div>

    <div class="aufgabe">
        <div class="aufgabe-titel">Deine Aufgabe</div>
        <p>Optimiere den Code aus sql_5.php mit Arrays und foreach-Schleifen.</p>
        <div class="schritte-liste">
            <strong>Das sollst du tun:</strong>
            <ol>
                <li>Das Problem im bisherigen Code erkennen</li>
                <li>Ein assoziatives Array fuer die Spalten erstellen</li>
                <li>Die Links mit einer foreach-Schleife erstellen</li>
                <li>Den Tabellenkopf mit foreach ausgeben</li>
            </ol>
        </div>
    </div>

    <h3>Das Problem erkennen</h3>

    <div class="schritt">
        <span class="schritt-nummer">1</span>
        <span class="schritt-titel">Wiederholender Code aus sql_5.php</span>
        <code>// Link fuer "Name"
if ($sortierung == 'name') {
    $link_name = "?sortierung=name&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_name = "?sortierung=name&amp;reihenfolge=$standard_reihenfolge";
}

// Link fuer "Spezialitaet"
if ($sortierung == 'spezialitaet') {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$umgekehrte_reihenfolge";
} else {
    $link_spezialitaet = "?sortierung=spezialitaet&amp;reihenfolge=$standard_reihenfolge";
}

// ... und so weiter fuer jede Spalte!</code>
        <p>Dieser Code wiederholt sich 4 Mal mit nur minimalen Unterschieden: dem Spaltennamen und der Variablen. Das ist ein klarer Fall fuer eine Schleife!</p>
        <div class="warnung">
            <strong>Probleme mit diesem Ansatz:</strong><br>
            - Bei 10 Spalten braeuchten wir 10 fast identische Codeblocks<br>
            - Fehler muessen an mehreren Stellen korrigiert werden<br>
            - Eine neue Spalte erfordert viel Copy-Paste
        </div>
    </div>

    <h3>Assoziative Arrays verstehen</h3>

    <div class="schritt">
        <span class="schritt-nummer">2</span>
        <span class="schritt-titel">Was ist ein assoziatives Array?</span>
        <code>// Normales Array (numerische Indizes)
$farben = ['rot', 'gruen', 'blau'];
// $farben[0] = 'rot'
// $farben[1] = 'gruen'

// Assoziatives Array (benannte Keys)
$person = [
    'name' =&gt; 'Max',
    'alter' =&gt; 25,
    'stadt' =&gt; 'Berlin'
];
// $person['name'] = 'Max'
// $person['alter'] = 25</code>
        <p>Bei assoziativen Arrays haben die Eintraege benannte Schluessel (Keys) statt Zahlen. Der Pfeil =&gt; verbindet den Key mit seinem Wert (Value).</p>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">3</span>
        <span class="schritt-titel">Spalten-Array definieren</span>
        <code>$spalten = [
    'name' =&gt; 'Name',
    'spezialitaet' =&gt; 'Spezialitaet',
    'taeglicher_unfug' =&gt; 'Taeglicher Unfug',
    'kaffee_konsum' =&gt; 'Kaffeekonsum'
];</code>
        <p>Der Key (links) ist der Datenbankname, der Value (rechts) ist der Anzeigetitel. So haben wir alle Informationen an einer Stelle!</p>
        <div class="parameter">
            <strong>Beispiel:</strong> $spalten['name'] ergibt 'Name'<br>
            <strong>Beispiel:</strong> $spalten['kaffee_konsum'] ergibt 'Kaffeekonsum'
        </div>
    </div>

    <h3>foreach mit assoziativen Arrays</h3>

    <div class="schritt">
        <span class="schritt-nummer">4</span>
        <span class="schritt-titel">foreach-Syntax verstehen</span>
        <code>foreach ($spalten as $spalte =&gt; $titel) {
    echo "Spalte: $spalte, Titel: $titel";
}

// Ausgabe:
// Spalte: name, Titel: Name
// Spalte: spezialitaet, Titel: Spezialitaet
// Spalte: taeglicher_unfug, Titel: Taeglicher Unfug
// Spalte: kaffee_konsum, Titel: Kaffeekonsum</code>
        <p>Die foreach-Schleife durchlaeuft jedes Key-Value-Paar. Bei jedem Durchlauf steht der Key in $spalte und der Value in $titel.</p>
        <div class="hinweis">
            <strong>Merke:</strong> foreach ($array as $key =&gt; $value) gibt dir beides: den Schluessel und den Wert!
        </div>
    </div>

    <h3>Links dynamisch erstellen</h3>

    <div class="schritt">
        <span class="schritt-nummer">5</span>
        <span class="schritt-titel">Links mit foreach erstellen</span>
        <code>$links = [];
foreach ($spalten as $spalte =&gt; $titel) {
    if ($sortierung == $spalte) {
        $links[$spalte] = "?sortierung=$spalte&amp;reihenfolge=$umgekehrte_reihenfolge";
    } else {
        $links[$spalte] = "?sortierung=$spalte&amp;reihenfolge=$standard_reihenfolge";
    }
}</code>
        <p>Statt 4 separate if-Bloecke haben wir jetzt eine Schleife. Sie erstellt automatisch fuer jede Spalte den passenden Link und speichert ihn im $links-Array.</p>
        <div class="parameter">
            <strong>Ergebnis:</strong><br>
            $links['name'] = "?sortierung=name&amp;reihenfolge=..."<br>
            $links['spezialitaet'] = "?sortierung=spezialitaet&amp;reihenfolge=..."<br>
            ... und so weiter
        </div>
    </div>

    <h3>Tabellenkopf mit foreach ausgeben</h3>

    <div class="schritt">
        <span class="schritt-nummer">6</span>
        <span class="schritt-titel">Ueberschriften dynamisch ausgeben</span>
        <code>echo "&lt;thead&gt;&lt;tr&gt;";
foreach ($spalten as $spalte =&gt; $titel) {
    echo "&lt;th&gt;&lt;a href='" . $links[$spalte] . "'&gt;$titel&lt;/a&gt;&lt;/th&gt;";
}
echo "&lt;/tr&gt;&lt;/thead&gt;";</code>
        <p>Eine weitere foreach-Schleife gibt die Tabellenueberschriften aus. Der Titel kommt aus dem $spalten-Array, der Link aus dem $links-Array.</p>
    </div>

    <h3>Vorteile dieser Loesung</h3>

    <div class="vorteile">
        <div class="vorteile-titel">Warum ist dieser Code besser?</div>
        <ul>
            <li><strong>Weniger Wiederholung:</strong> Die Logik steht nur einmal im Code</li>
            <li><strong>Einfach erweiterbar:</strong> Eine neue Spalte = eine Zeile im Array</li>
            <li><strong>Weniger fehleranfaellig:</strong> Aenderungen nur an einer Stelle noetig</li>
            <li><strong>Besser lesbar:</strong> Die Spalten-Definition ist uebersichtlich</li>
        </ul>
    </div>

    <div class="schritt">
        <span class="schritt-nummer">7</span>
        <span class="schritt-titel">Vergleich: Vorher vs. Nachher</span>
        <code>// VORHER: 4 separate if-Bloecke (ca. 24 Zeilen)
if ($sortierung == 'name') { ... } else { ... }
if ($sortierung == 'spezialitaet') { ... } else { ... }
if ($sortierung == 'taeglicher_unfug') { ... } else { ... }
if ($sortierung == 'kaffee_konsum') { ... } else { ... }

// NACHHER: 1 Schleife (ca. 7 Zeilen)
foreach ($spalten as $spalte =&gt; $titel) {
    if ($sortierung == $spalte) {
        $links[$spalte] = "?sortierung=$spalte&amp;reihenfolge=$umgekehrte_reihenfolge";
    } else {
        $links[$spalte] = "?sortierung=$spalte&amp;reihenfolge=$standard_reihenfolge";
    }
}</code>
        <p>Der optimierte Code ist nicht nur kuerzer, sondern skaliert auch besser: Egal ob 4 oder 40 Spalten - die Schleife bleibt gleich!</p>
    </div>

    <h3>Naechster Schritt</h3>

    <div class="zusatz">
        <div class="zusatz-titel">Musterloesung ansehen</div>
        <p>Schau dir in sql_6.php die vollstaendige Loesung mit foreach an und vergleiche sie mit deinem Code!</p>
    </div>
</div>
