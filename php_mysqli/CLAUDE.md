# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a German-language PHP tutorial teaching database operations with MariaDB/MySQL using the mysqli extension. The tutorial uses a "Katzencafe" (cat cafe) theme with a `katzen` table containing cat employee data.

## Architecture

The project is a progressive tutorial series in `rek_tabelle/`:

- **sql_1.php** - Template with step-by-step instructions (comments only)
- **sql_2.php** - Basic mysqli connection and simple output
- **sql_3.php** - Instructions for HTML table output
- **sql_4.php** - Complete HTML table implementation
- **sql_5.php** - Instructions for sortable columns
- **sql_6.php** - Sortable columns without visual indicators
- **sql_7.php** - Complete sortable table with arrow indicators

Each PHP file contains both executable code and embedded HTML instructions for browser viewing.

## Database Configuration

- **Host:** localhost
- **User:** root
- **Password:** (empty)
- **Database:** katzencafe
- **Table:** katzen
- **Charset:** utf8mb4

Table columns: `id`, `name`, `spezialitaet`, `taeglicher_unfug`, `kaffee_konsum`

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

### Resource Cleanup
```php
mysqli_free_result($result);
mysqli_close($conn);
```

## Running the Tutorial

Access files via a web server (Apache/Nginx) at the configured document root. Files are designed to be viewed in a browser with navigation between steps.
