# Quiz: INSERT-Operationen in PHP

Testen Sie Ihr Wissen zu Formularen, POST-Methode, INSERT-Statements und Sicherheit!

---

## Teil 1: Einfache Fragen

### Frage 1 (Einfach)
**Welches Attribut sorgt dafür, dass Formulardaten nicht in der URL sichtbar sind?**

- A) `method="get"`
  ❌ *Falsch: GET überträgt Daten sichtbar in der URL als Query-Parameter*
- B) `method="post"` ✓
  ✅ *Richtig: POST sendet Daten im HTTP-Body, nicht in der URL*
- C) `action="hidden"`
  ❌ *Falsch: Das action-Attribut definiert nur die Ziel-URL des Formulars*
- D) `type="secret"`
  ❌ *Falsch: Dieses Attribut existiert in HTML nicht*

---

### Frage 2 (Einfach)
**Wie greift man in PHP auf den Wert eines Formularfeldes mit `name="katzenname"` zu, wenn das Formular mit POST gesendet wurde?**

- A) `$_POST['katzenname']` ✓
  ✅ *Richtig: $_POST ist ein superglobales Array mit allen POST-Daten*
- B) `$_GET['katzenname']`
  ❌ *Falsch: $_GET enthält nur Daten aus der URL, nicht aus POST-Formularen*
- C) `$POST->katzenname`
  ❌ *Falsch: $_POST ist ein Array, kein Objekt - Zugriff mit eckigen Klammern*
- D) `post('katzenname')`
  ❌ *Falsch: Es gibt keine post()-Funktion in PHP*

---

### Frage 3 (Einfach)
**Was gibt die Funktion `mysqli_insert_id($conn)` zurück?**

- A) Die automatisch generierte ID des zuletzt eingefügten Datensatzes ✓
  ✅ *Richtig: Bei AUTO_INCREMENT-Spalten liefert diese Funktion die neue ID*
- B) Die Anzahl der eingefügten Zeilen
  ❌ *Falsch: Dafür verwendet man mysqli_affected_rows()*
- C) `true` oder `false`
  ❌ *Falsch: mysqli_query() gibt true/false zurück, nicht mysqli_insert_id()*
- D) Den vollständigen SQL-String
  ❌ *Falsch: Die Funktion gibt eine Zahl zurück, keinen String*

---

### Frage 4 (Einfach)
**Welches HTML-Element erstellt ein Dropdown-Auswahlmenü?**

- A) `<dropdown>`
  ❌ *Falsch: Dieses Element existiert in HTML nicht*
- B) `<select>` ✓
  ✅ *Richtig: `<select>` mit `<option>`-Elementen erstellt ein Dropdown*
- C) `<list>`
  ❌ *Falsch: Für Listen gibt es `<ul>` und `<ol>`, aber nicht `<list>`*
- D) `<input type="dropdown">`
  ❌ *Falsch: Der Typ "dropdown" existiert bei input nicht*

---

### Frage 5 (Einfach)
**Wofür verwendet man `isset($_POST['name'])` vor der Verarbeitung?**

- A) Prüft, ob das Feld leer ist
  ❌ *Falsch: isset() prüft Existenz, nicht ob leer - dafür verwendet man empty()*
- B) Prüft, ob die Variable existiert ✓
  ✅ *Richtig: isset() gibt true zurück, wenn die Variable existiert und nicht NULL ist*
- C) Löscht die Variable
  ❌ *Falsch: Zum Löschen verwendet man unset()*
- D) Setzt einen Standardwert
  ❌ *Falsch: isset() setzt keine Werte, es prüft nur*

---

## Teil 2: Schwierige Fragen

### Frage 6 (Schwierig)
**Was macht `mysqli_real_escape_string()` mit dem Namen `O'Brien`?**

- A) Löscht das Apostroph komplett
  ❌ *Falsch: Die Funktion löscht keine Zeichen, sie escaped sie nur*
- B) Macht daraus `O\'Brien` ✓
  ✅ *Richtig: Das Apostroph wird mit Backslash escaped, damit SQL es als Text erkennt*
- C) Gibt einen Fehler aus
  ❌ *Falsch: Die Funktion behandelt solche Zeichen problemlos*
- D) Ändert gar nichts
  ❌ *Falsch: Das Apostroph ist ein SQL-relevantes Zeichen und muss escaped werden*

---

### Frage 7 (Schwierig)
**Wann sollte man `intval()` anstelle von `mysqli_real_escape_string()` verwenden?**

- A) Bei Textfeldern wie Namen
  ❌ *Falsch: Für Text verwendet man mysqli_real_escape_string()*
- B) Bei numerischen Werten wie IDs oder Gehältern ✓
  ✅ *Richtig: intval() wandelt in eine Ganzzahl um - ungültige Eingaben werden zu 0*
- C) Bei Datumsfeldern
  ❌ *Falsch: Datum ist ein String im Format 'YYYY-MM-DD', braucht escape_string*
- D) Niemals, escape_string reicht immer
  ❌ *Falsch: Bei Zahlen ohne Anführungszeichen im SQL hilft escape_string nicht*

---

### Frage 8 (Schwierig)
**Warum braucht man für ENUM-Felder (z.B. Abteilung) eine Whitelist-Prüfung mit `in_array()`?**

- A) Weil die Abfrage sonst langsamer wird
  ❌ *Falsch: Performance ist hier nicht der Grund*
- B) Um ungültige Werte zu verhindern und Manipulation zu blockieren ✓
  ✅ *Richtig: Nur vorher festgelegte Werte werden akzeptiert - Angreifer können keine beliebigen Werte einschleusen*
- C) Weil MySQL sonst abstürzt
  ❌ *Falsch: MySQL würde nur einen Fehler oder leeren Wert speichern*
- D) Weil es in PHP Pflicht ist
  ❌ *Falsch: PHP verlangt es nicht, aber es ist Best Practice für Sicherheit*

---

### Frage 9 (Schwierig)
**Was bedeutet der String `"ssi"` bei `mysqli_stmt_bind_param($stmt, "ssi", $name, $spezialitaet, $id)`?**

- A) String, String, Integer - die Datentypen der drei Variablen ✓
  ✅ *Richtig: s=String, i=Integer, d=Double, b=Blob - ein Buchstabe pro Variable*
- B) Secure-SQL-Insert als Sicherheitsmodus
  ❌ *Falsch: Der String definiert die Datentypen, keine Sicherheitsmodi*
- C) Simple-Statement-Identifier
  ❌ *Falsch: Es ist eine Typ-Definition, kein Identifier*
- D) Ein Syntaxfehler
  ❌ *Falsch: "ssi" ist korrekte Syntax für zwei Strings und einen Integer*

---

### Frage 10 (Schwierig)
**Welches Problem hat dieser Code?**
```php
$name = $_POST['name'];
$sql = "INSERT INTO katzen (name) VALUES ($name)";
```

- A) Es fehlt ein Semikolon am Ende
  ❌ *Falsch: Das Semikolon ist korrekt gesetzt*
- B) Der Wert $name braucht Anführungszeichen im SQL-String ✓
  ✅ *Richtig: Textwerte in SQL müssen in Anführungszeichen stehen: VALUES ('$name')*
- C) Es fehlt ein Komma
  ❌ *Falsch: Bei nur einer Spalte braucht man kein Komma*
- D) Der Code ist vollständig korrekt
  ❌ *Falsch: Ohne Anführungszeichen interpretiert MySQL $name als Spaltenname*

---

## Teil 3: Knifflige Fragen

### Frage 11 (Knifflig)
**Welche Benutzereingabe stellt einen SQL-Injection-Angriff dar?**

- A) `Herr Müller`
  ❌ *Falsch: Ein normaler Name ohne gefährliche Zeichen*
- B) `O'Brien`
  ❌ *Falsch: Problematisch, aber kein Angriff - nur ein Name mit Apostroph*
- C) `'; DROP TABLE katzen;--` ✓
  ✅ *Richtig: Diese Eingabe versucht, das SQL zu beenden und einen DROP-Befehl einzuschleusen*
- D) `<script>alert('hi')</script>`
  ❌ *Falsch: Das ist ein XSS-Angriff auf HTML, kein SQL-Injection*

---

### Frage 12 (Knifflig)
**Bei Prepared Statements: Was passiert mit den `?`-Platzhaltern?**

- A) Sie werden direkt durch die Werte ersetzt
  ❌ *Falsch: Die Werte werden separat übergeben, nicht eingesetzt*
- B) Sie werden durch bind_param mit Variablen verknüpft, aber SQL und Daten bleiben getrennt ✓
  ✅ *Richtig: Das SQL wird zuerst kompiliert, dann werden die Daten sicher eingefügt - deshalb ist es sicher*
- C) Sie bleiben unverändert in der Datenbank
  ❌ *Falsch: Die Fragezeichen sind Platzhalter, keine gespeicherten Werte*
- D) Sie erlauben das Einschleusen von SQL-Befehlen
  ❌ *Falsch: Genau das Gegenteil - Prepared Statements verhindern SQL-Injection*

---

### Frage 13 (Knifflig)
**Welcher Code enthält eine Sicherheitslücke?**

```php
A) $id = intval($_GET['id']);
B) $name = $_POST['name'];
C) $name = mysqli_real_escape_string($conn, $_POST['name']);
D) $stmt = mysqli_prepare($conn, "INSERT INTO katzen (name) VALUES (?)");
   mysqli_stmt_bind_param($stmt, "s", $_POST['name']);
```

- A) `$id = intval($_GET['id']);`
  ❌ *Falsch: intval() macht die Eingabe sicher - ungültige Werte werden zu 0*
- B) `$name = $_POST['name'];` ✓
  ✅ *Richtig: Die Benutzereingabe wird ohne jede Absicherung verwendet - SQL-Injection möglich*
- C) `mysqli_real_escape_string()`
  ❌ *Falsch: Die Funktion escaped gefährliche Zeichen korrekt*
- D) Prepared Statement mit bind_param
  ❌ *Falsch: Prepared Statements sind die sicherste Methode*

---

### Frage 14 (Knifflig)
**Was ist der Hauptvorteil von Prepared Statements gegenüber mysqli_real_escape_string()?**

- A) Sie sind deutlich schneller
  ❌ *Falsch: Bei einzelnen Abfragen sind sie ähnlich schnell, bei vielen gleichen sogar langsamer beim Kompilieren*
- B) SQL-Struktur und Benutzerdaten werden komplett getrennt verarbeitet ✓
  ✅ *Richtig: Das SQL wird zuerst kompiliert - danach können Daten die Struktur nicht mehr verändern*
- C) Man braucht weniger Codezeilen
  ❌ *Falsch: Prepared Statements brauchen sogar mehr Code (prepare, bind, execute)*
- D) Sie sind einfacher zu verstehen
  ❌ *Falsch: escape_string ist für Anfänger oft intuitiver*

---

### Frage 15 (Knifflig)
**Welche Methode bietet den besten Schutz für ein INSERT-Formular mit Text, Zahlen und ENUM-Feldern?**

- A) Nur POST statt GET verwenden
  ❌ *Falsch: POST versteckt nur die Daten, schützt aber nicht vor Manipulation*
- B) POST kombiniert mit intval() für alle Felder
  ❌ *Falsch: intval() zerstört Textwerte - "Whiskers" würde zu 0*
- C) POST kombiniert mit mysqli_real_escape_string() für alle Felder
  ❌ *Falsch: Funktioniert für Text, aber Zahlen ohne Anführungszeichen und ENUMs brauchen andere Behandlung*
- D) Prepared Statements mit korrekten Typ-Bindungen ✓
  ✅ *Richtig: Prepared Statements behandeln alle Datentypen automatisch sicher*

---

## Auswertung

| Punkte | Bewertung |
|--------|-----------|
| 13-15  | Ausgezeichnet! Sie haben die INSERT-Konzepte sehr gut verstanden. |
| 10-12  | Gut! Wiederholen Sie die Sicherheitsthemen noch einmal. |
| 7-9    | Befriedigend. Schauen Sie sich insert_3.php bis insert_5.php nochmal an. |
| 4-6    | Üben Sie die Grundlagen mit insert_1.php und insert_2.php. |
| 0-3    | Arbeiten Sie das Tutorial von Anfang an durch. |

---

## Schnellübersicht der Antworten

| Frage | Antwort | Thema |
|-------|---------|-------|
| 1 | B | POST-Methode |
| 2 | A | $_POST-Zugriff |
| 3 | A | mysqli_insert_id() |
| 4 | B | HTML select-Element |
| 5 | B | isset()-Funktion |
| 6 | B | Escaping von Apostrophen |
| 7 | B | intval() für Zahlen |
| 8 | B | Whitelist für ENUM |
| 9 | A | bind_param Typ-String |
| 10 | B | SQL-Syntax für Strings |
| 11 | C | SQL-Injection erkennen |
| 12 | B | Prepared Statement Funktionsweise |
| 13 | B | Unsicheren Code erkennen |
| 14 | B | Vorteil Prepared Statements |
| 15 | D | Best Practice Sicherheit |
