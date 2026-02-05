# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a German-language PHP tutorial teaching database operations with MariaDB/MySQL using the mysqli extension. The tutorial uses a "Katzencafe" (cat cafe) theme with a `katzen` table containing cat employee data.

## Architecture

The project consists of multiple progressive tutorial series. Files are labeled as either AUFGABE (task) or MUSTERLÖSUNG (solution).

### `rek_tabelle/` - Table Output & Sorting

- **sql_1.php** - Template with step-by-step instructions (comments only)
- **sql_2.php** - MUSTERLÖSUNG: Basic mysqli connection and simple output
- **sql_3.php** - AUFGABE: Build HTML table output
- **sql_4.php** - MUSTERLÖSUNG: Complete HTML table implementation
- **sql_5.php** - AUFGABE: Make columns sortable
- **sql_5a.php** - MUSTERLÖSUNG: Simple sorting (column selection, always DESC)
- **sql_5b.php** - MUSTERLÖSUNG: Toggle sorting (ASC/DESC switch)
- **sql_6.php** - MUSTERLÖSUNG: DRY optimization with foreach loops
- **sql_7.php** - MUSTERLÖSUNG: Sortable table with arrow indicators
- **sql_8.php** - Interactive code explanation with hover tooltips (two-column layout)

### `delete_record/` - Deleting Records via Links

- **delete_0.html** - Introduction page with SQL restore code for deleted data
- **delete_1.php** - AUFGABE: Add delete functionality (code skeleton with hints)
- **delete_2.php** - MUSTERLÖSUNG: Complete delete implementation with GET parameters
- **delete_3.php** - ZUSATZAUFGABE: Add JavaScript confirmation dialog (for JS beginners)
- **delete_4.php** - MUSTERLÖSUNG: Complete implementation with onclick confirm()

Key concepts taught: `$_GET` parameters, `isset()`, `intval()` for SQL injection prevention, DELETE statements, JavaScript `onclick` attribute, `confirm()` function for user confirmation.

### `insert_record/` - Inserting New Records via Forms

- **insert_0.html** - Introduction page with GET vs POST comparison, SQL setup for new columns
- **insert_1.php** - AUFGABE (einfach): Formular mit POST-Methode, Dropdown-Optionen, INSERT ausführen
- **insert_2.php** - MUSTERLÖSUNG (einfach): Funktionierende Version ohne Sicherheitsmaßnahmen
- **insert_3.php** - AUFGABE (Sicherheit): Eingaben absichern mit `mysqli_real_escape_string()`, `intval()`, Whitelist
- **insert_4.php** - MUSTERLÖSUNG (sicher): Vollständige Absicherung aller Eingaben
- **insert_5.php** - BONUS: Prepared Statements (fortgeschrittene Sicherheitsmethode)

Key concepts taught:
- **insert_1/2**: `$_POST` parameters, `isset()`, HTML5 form elements (`<input type="date">`, `<input type="number">`), `<select>` dropdowns, `mysqli_insert_id()`
- **insert_3/4**: `mysqli_real_escape_string()` for text fields, `intval()`/`floatval()` for numbers, whitelist validation with `in_array()` for ENUM fields, SQL injection prevention
- **insert_5**: Prepared statements with `mysqli_prepare()` and `bind_param()`

Each PHP file contains both executable code and embedded HTML instructions for browser viewing.

## Database Configuration

- **Host:** localhost
- **User:** root
- **Password:** (empty)
- **Database:** katzencafe
- **Table:** katzen
- **Charset:** utf8mb4

Table columns (base): `id`, `name`, `spezialitaet`, `taeglicher_unfug`, `kaffee_konsum`

Extended columns (for insert_record tutorial): `eingestellt_am` (DATE), `gehalt` (DECIMAL(8,2)), `abteilung` (ENUM: 'Küche', 'Service', 'Unterhaltung', 'Sicherheit', 'Management')

## Code Patterns

### Connection Pattern
```php
$conn = mysqli_connect("localhost", "root", "", "katzencafe");
mysqli_set_charset($conn, "utf8mb4");
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}
```

### SQL Injection Prevention
User input for sorting uses whitelist validation:
```php
$erlaubte_spalten = ['id', 'name', 'spezialitaet', 'taeglicher_unfug', 'kaffee_konsum'];
if (!in_array($sortierung, $erlaubte_spalten)) {
    $sortierung = 'id';
}
```

For integer IDs (e.g., delete operations), use `intval()`:
```php
$id = intval($_GET['delete']);
mysqli_query($conn, "DELETE FROM katzen WHERE id = $id");
```

For text fields in INSERT/UPDATE (e.g., form input), use `mysqli_real_escape_string()`:
```php
$name = mysqli_real_escape_string($conn, $_POST['name']);
mysqli_query($conn, "INSERT INTO katzen (name) VALUES ('$name')");
```

For ENUM fields, use whitelist validation:
```php
$erlaubte_abteilungen = ['Küche', 'Service', 'Unterhaltung', 'Sicherheit', 'Management'];
if (!in_array($abteilung, $erlaubte_abteilungen)) {
    $abteilung = 'Service';
}
```

### Resource Cleanup
```php
mysqli_free_result($result);
mysqli_close($conn);
```

## Running the Tutorial

Access files via a web server (Apache/Nginx) at the configured document root. Files are designed to be viewed in a browser with navigation between steps.
