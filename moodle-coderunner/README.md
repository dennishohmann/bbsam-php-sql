# Moodle CodeRunner Fragensammlung: mysqli in PHP

## Inhalt

Diese Fragensammlung enthält **15 CodeRunner-Fragen** zum Thema mysqli-Datenbankzugriff in PHP.

## Lernziele

Die Fragen decken folgende Konzepte ab:

1. **Verbindungsvariablen definieren** (keine Konstanten)
2. **Datenbankverbindung** mit `mysqli_connect()` herstellen
3. **SQL-Abfragen** mit `mysqli_query()` ausführen
4. **Daten auslesen** mit `mysqli_fetch_array()`
5. **while-Schleife** zum Durchlaufen aller Datensätze
6. **Verbindung schließen** mit `mysqli_close()`

## Fragenübersicht

| Nr. | Titel | Schwerpunkt |
|-----|-------|-------------|
| 01 | Variablen für Datenbankverbindung | Variablendeklaration |
| 02 | Verbindung mit mysqli_connect | Verbindungsaufbau, Fehlerprüfung |
| 03 | SQL-Abfrage mit mysqli_query | Abfrage ausführen, mysqli_num_rows |
| 04 | Einen Datensatz auslesen | mysqli_fetch_array Grundlagen |
| 05 | Alle Datensätze mit while-Schleife | while + mysqli_fetch_array |
| 06 | Verbindung schließen | mysqli_close |
| 07 | Gefilterte Abfrage mit WHERE | WHERE-Klausel, Variablen in SQL |
| 08 | Zugriff über Spaltennamen | Assoziative Array-Zugriffe |
| 09 | Kompletter Datenbankzugriff | Alle Konzepte kombiniert |
| 10 | Ergebnisse als HTML-Tabelle | HTML-Ausgabe mit PHP |
| 11 | Suche mit LIKE-Operator | LIKE, Wildcards |
| 12 | Datensätze nummerieren | Zähler in while-Schleife |
| 13 | Summe berechnen | Berechnungen in Schleifen |
| 14 | Bedingte Ausgabe | if-Bedingung in while-Schleife |
| 15 | Teilnehmerdaten formatieren | Komplexe Ausgabeformatierung |

## Voraussetzungen

### Datenbank

Die Fragen basieren auf der Datenbank `fortbildung` mit folgenden Tabellen:

**Tabelle `notebooks`:**
- ArtikelNr, Bezeichnung, Hersteller, Preis, Bestand, Arbeitsspeicher, Webcam, WLAN, Bild

**Tabelle `teilnehmer`:**
- Nummer, Name, Vorname, Adresse, PLZ, Ort

### SQL-Datei

Die benötigte Datenbankstruktur finden Sie unter:
`notebooks-sql/Aufgabe_4/fortbildung-teilnehmer_und_notebooks.sql`

## Import in Moodle

1. Melden Sie sich in Moodle als Kursleiter an
2. Gehen Sie zu **Fragensammlung** > **Import**
3. Wählen Sie das Format **Moodle XML**
4. Laden Sie die Datei `mysqli_fragensammlung.xml` hoch
5. Klicken Sie auf **Import**

## Hinweise für CodeRunner

- Die Fragen sind vom Typ `php`
- Für korrekte Testausführung muss die Datenbank im CodeRunner-Sandbox verfügbar sein
- Alternative: Testcases können mit Mock-Daten angepasst werden

## Verwendete PHP-Funktionen

```php
// Verbindung herstellen
$verbindung = mysqli_connect($server, $benutzer, $passwort, $datenbank);

// Abfrage ausführen
$ergebnis = mysqli_query($verbindung, $abfrage);

// Datensätze auslesen
while($datensatz = mysqli_fetch_array($ergebnis)) {
    echo $datensatz[0];        // Zugriff über Index
    echo $datensatz['Name'];   // Zugriff über Spaltenname
}

// Verbindung schließen
mysqli_close($verbindung);
```

## Lizenz

Diese Materialien sind für Unterrichtszwecke erstellt.
