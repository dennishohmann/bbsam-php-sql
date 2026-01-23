<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interaktive Code-Erklärung - PHP mysqli Tutorial</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .intro {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
        }

        /* Navigation */
        .navigation {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #95a5a6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
        }

        .nav-btn:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        /* Hauptcontainer: Zwei-Spalten-Layout */
        .interactive-container {
            display: flex;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Code-Panel links */
        .code-panel {
            flex: 0 0 60%;
            background: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            overflow-x: auto;
        }

        /* Erklärungs-Panel rechts */
        .explanation-panel {
            flex: 0 0 35%;
            position: sticky;
            top: 20px;
            height: fit-content;
            max-height: calc(100vh - 40px);
            overflow-y: auto;
        }

        .explanation {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .explanation h3 {
            color: #3498db;
            margin-top: 0;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .explanation p {
            color: #444;
            margin: 15px 0;
        }

        .explanation .highlight {
            background: #fff3cd;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #ffc107;
            margin: 15px 0;
        }

        .explanation .code-example {
            background: #2c3e50;
            color: #2ecc71;
            padding: 10px;
            border-radius: 5px;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 0.9em;
            overflow-x: auto;
            white-space: pre;
        }

        .explanation .info {
            background: #d4edda;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #28a745;
            margin: 15px 0;
        }

        .explanation .warning {
            background: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #dc3545;
            margin: 15px 0;
        }

        /* Code-Blöcke */
        .code-block {
            padding: 8px 15px;
            margin: 2px 0;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .code-block:hover,
        .code-block.active {
            background: #2d2d2d;
            border-left-color: #3498db;
        }

        .code-block.active {
            background: #3a3a3a;
            border-left-color: #e74c3c;
        }

        /* Zeilennummern */
        .line-numbers {
            display: inline-block;
            color: #6a737d;
            text-align: right;
            padding-right: 15px;
            user-select: none;
            min-width: 35px;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 13px;
        }

        /* Code-Inhalt */
        .code-content {
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 13px;
            white-space: pre;
        }

        /* Syntax-Highlighting */
        .keyword { color: #c586c0; }
        .function { color: #dcdcaa; }
        .variable { color: #9cdcfe; }
        .string { color: #ce9178; }
        .comment { color: #6a9955; font-style: italic; }
        .number { color: #b5cea8; }
        .operator { color: #d4d4d4; }
        .bracket { color: #ffd700; }
        .tag { color: #808080; }
        .html-tag { color: #569cd6; }
        .html-attr { color: #9cdcfe; }
        .css-prop { color: #9cdcfe; }
        .css-value { color: #ce9178; }

        /* Abschnitts-Trenner */
        .section-divider {
            border-top: 1px dashed #444;
            margin: 15px 0;
            padding-top: 10px;
        }

        /* Standard-Erklärung */
        .default-explanation {
            color: #888;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .interactive-container {
                flex-direction: column;
            }

            .code-panel,
            .explanation-panel {
                flex: none;
                width: 100%;
            }

            .explanation-panel {
                position: static;
                max-height: none;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

<h1>Interaktive Code-Erklärung</h1>
<p class="intro">Fahre mit der Maus über die Code-Zeilen, um detaillierte Erklärungen zu sehen.</p>

<div class="navigation">
    <a href="sql_7.php" class="nav-btn">Zurück zu sql_7.php</a>
</div>

<div class="interactive-container">
    <!-- Code-Panel links -->
    <div class="code-panel">

        <!-- Abschnitt 1: PHP-Tag und Kommentar -->
        <div class="code-block" data-section="php-tag">
            <span class="line-numbers">1</span>
            <span class="code-content"><span class="tag">&lt;?php</span></span>
        </div>
        <div class="code-block" data-section="php-tag">
            <span class="line-numbers">2</span>
            <span class="code-content"><span class="comment">// ============================================</span></span>
        </div>
        <div class="code-block" data-section="php-tag">
            <span class="line-numbers">3</span>
            <span class="code-content"><span class="comment">// MUSTERLÖSUNG: Sortierrichtung mit Pfeilen anzeigen</span></span>
        </div>
        <div class="code-block" data-section="php-tag">
            <span class="line-numbers">4</span>
            <span class="code-content"><span class="comment">// ============================================</span></span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 2: Datenbankverbindung -->
        <div class="code-block" data-section="verbindung">
            <span class="line-numbers">6</span>
            <span class="code-content"><span class="comment">// Datenbankverbindung</span></span>
        </div>
        <div class="code-block" data-section="verbindung">
            <span class="line-numbers">7</span>
            <span class="code-content"><span class="variable">$conn</span> <span class="operator">=</span> <span class="function">mysqli_connect</span><span class="bracket">(</span><span class="string">"localhost"</span>, <span class="string">"root"</span>, <span class="string">""</span>, <span class="string">"katzencafe"</span><span class="bracket">)</span>;</span>
        </div>
        <div class="code-block" data-section="verbindung">
            <span class="line-numbers">8</span>
            <span class="code-content"><span class="function">mysqli_set_charset</span><span class="bracket">(</span><span class="variable">$conn</span>, <span class="string">"utf8mb4"</span><span class="bracket">)</span>;</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 3: Fehlerbehandlung -->
        <div class="code-block" data-section="fehler">
            <span class="line-numbers">10</span>
            <span class="code-content"><span class="keyword">if</span> <span class="bracket">(</span>!<span class="variable">$conn</span><span class="bracket">)</span> {</span>
        </div>
        <div class="code-block" data-section="fehler">
            <span class="line-numbers">11</span>
            <span class="code-content">    <span class="keyword">die</span><span class="bracket">(</span><span class="string">"Verbindung fehlgeschlagen: "</span> . <span class="function">mysqli_connect_error</span><span class="bracket">()</span><span class="bracket">)</span>;</span>
        </div>
        <div class="code-block" data-section="fehler">
            <span class="line-numbers">12</span>
            <span class="code-content">}</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 4: Parameter sortierung -->
        <div class="code-block" data-section="param-sortierung">
            <span class="line-numbers">14</span>
            <span class="code-content"><span class="comment">// Schritt 1: Parameter auslesen</span></span>
        </div>
        <div class="code-block" data-section="param-sortierung">
            <span class="line-numbers">15</span>
            <span class="code-content"><span class="variable">$sortierung</span> <span class="operator">=</span> <span class="string">'id'</span>;</span>
        </div>
        <div class="code-block" data-section="param-sortierung">
            <span class="line-numbers">16</span>
            <span class="code-content"><span class="keyword">if</span> <span class="bracket">(</span><span class="function">isset</span><span class="bracket">(</span><span class="variable">$_REQUEST</span>[<span class="string">'sortierung'</span>]<span class="bracket">)</span><span class="bracket">)</span> {</span>
        </div>
        <div class="code-block" data-section="param-sortierung">
            <span class="line-numbers">17</span>
            <span class="code-content">    <span class="variable">$sortierung</span> <span class="operator">=</span> <span class="variable">$_REQUEST</span>[<span class="string">'sortierung'</span>];</span>
        </div>
        <div class="code-block" data-section="param-sortierung">
            <span class="line-numbers">18</span>
            <span class="code-content">}</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 5: Parameter reihenfolge -->
        <div class="code-block" data-section="param-reihenfolge">
            <span class="line-numbers">20</span>
            <span class="code-content"><span class="variable">$reihenfolge</span> <span class="operator">=</span> <span class="string">'desc'</span>;</span>
        </div>
        <div class="code-block" data-section="param-reihenfolge">
            <span class="line-numbers">21</span>
            <span class="code-content"><span class="keyword">if</span> <span class="bracket">(</span><span class="function">isset</span><span class="bracket">(</span><span class="variable">$_REQUEST</span>[<span class="string">'reihenfolge'</span>]<span class="bracket">)</span><span class="bracket">)</span> {</span>
        </div>
        <div class="code-block" data-section="param-reihenfolge">
            <span class="line-numbers">22</span>
            <span class="code-content">    <span class="variable">$reihenfolge</span> <span class="operator">=</span> <span class="variable">$_REQUEST</span>[<span class="string">'reihenfolge'</span>];</span>
        </div>
        <div class="code-block" data-section="param-reihenfolge">
            <span class="line-numbers">23</span>
            <span class="code-content">}</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 6: SQL-Abfrage -->
        <div class="code-block" data-section="sql-query">
            <span class="line-numbers">25</span>
            <span class="code-content"><span class="comment">// Schritt 2: SQL-Abfrage</span></span>
        </div>
        <div class="code-block" data-section="sql-query">
            <span class="line-numbers">26</span>
            <span class="code-content"><span class="variable">$sql</span> <span class="operator">=</span> <span class="string">"SELECT * FROM katzen ORDER BY <span class="variable">$sortierung</span> <span class="variable">$reihenfolge</span>"</span>;</span>
        </div>
        <div class="code-block" data-section="sql-query">
            <span class="line-numbers">27</span>
            <span class="code-content"><span class="variable">$result</span> <span class="operator">=</span> <span class="function">mysqli_query</span><span class="bracket">(</span><span class="variable">$conn</span>, <span class="variable">$sql</span><span class="bracket">)</span>;</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 7: Toggle-Logik -->
        <div class="code-block" data-section="toggle">
            <span class="line-numbers">29</span>
            <span class="code-content"><span class="comment">// Schritt 3: Toggle-Logik</span></span>
        </div>
        <div class="code-block" data-section="toggle">
            <span class="line-numbers">30</span>
            <span class="code-content"><span class="variable">$standard_reihenfolge</span> <span class="operator">=</span> <span class="string">'desc'</span>;</span>
        </div>
        <div class="code-block" data-section="toggle">
            <span class="line-numbers">32</span>
            <span class="code-content"><span class="keyword">if</span> <span class="bracket">(</span><span class="variable">$reihenfolge</span> <span class="operator">==</span> <span class="string">'asc'</span><span class="bracket">)</span> {</span>
        </div>
        <div class="code-block" data-section="toggle">
            <span class="line-numbers">33</span>
            <span class="code-content">    <span class="variable">$umgekehrte_reihenfolge</span> <span class="operator">=</span> <span class="string">'desc'</span>;</span>
        </div>
        <div class="code-block" data-section="toggle">
            <span class="line-numbers">34</span>
            <span class="code-content">} <span class="keyword">else</span> {</span>
        </div>
        <div class="code-block" data-section="toggle">
            <span class="line-numbers">35</span>
            <span class="code-content">    <span class="variable">$umgekehrte_reihenfolge</span> <span class="operator">=</span> <span class="string">'asc'</span>;</span>
        </div>
        <div class="code-block" data-section="toggle">
            <span class="line-numbers">36</span>
            <span class="code-content">}</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 8: Spalten-Array -->
        <div class="code-block" data-section="spalten-array">
            <span class="line-numbers">38</span>
            <span class="code-content"><span class="comment">// Schritt 4: Spalten-Array definieren</span></span>
        </div>
        <div class="code-block" data-section="spalten-array">
            <span class="line-numbers">39</span>
            <span class="code-content"><span class="variable">$spalten</span> <span class="operator">=</span> [</span>
        </div>
        <div class="code-block" data-section="spalten-array">
            <span class="line-numbers">40</span>
            <span class="code-content">    <span class="string">'name'</span> <span class="operator">=></span> <span class="string">'Name'</span>,</span>
        </div>
        <div class="code-block" data-section="spalten-array">
            <span class="line-numbers">41</span>
            <span class="code-content">    <span class="string">'spezialitaet'</span> <span class="operator">=></span> <span class="string">'Spezialität'</span>,</span>
        </div>
        <div class="code-block" data-section="spalten-array">
            <span class="line-numbers">42</span>
            <span class="code-content">    <span class="string">'taeglicher_unfug'</span> <span class="operator">=></span> <span class="string">'Täglicher Unfug'</span>,</span>
        </div>
        <div class="code-block" data-section="spalten-array">
            <span class="line-numbers">43</span>
            <span class="code-content">    <span class="string">'kaffee_konsum'</span> <span class="operator">=></span> <span class="string">'Kaffeekonsum'</span></span>
        </div>
        <div class="code-block" data-section="spalten-array">
            <span class="line-numbers">44</span>
            <span class="code-content">];</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 9: Ternary-Operator -->
        <div class="code-block" data-section="ternary">
            <span class="line-numbers">46</span>
            <span class="code-content"><span class="comment">// Schritt 5: Pfeil für aktive Spalte</span></span>
        </div>
        <div class="code-block" data-section="ternary">
            <span class="line-numbers">47</span>
            <span class="code-content"><span class="variable">$pfeil</span> <span class="operator">=</span> <span class="bracket">(</span><span class="variable">$reihenfolge</span> <span class="operator">==</span> <span class="string">'asc'</span><span class="bracket">)</span> <span class="operator">?</span> <span class="string">'&amp;nbsp;&#8593;'</span> <span class="operator">:</span> <span class="string">'&amp;nbsp;&#8595;'</span>;</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 10: foreach-Schleife -->
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">49</span>
            <span class="code-content"><span class="comment">// Schritt 6: Links und Titel mit foreach erstellen</span></span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">50</span>
            <span class="code-content"><span class="variable">$links</span> <span class="operator">=</span> [];</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">51</span>
            <span class="code-content"><span class="variable">$titel</span> <span class="operator">=</span> [];</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">52</span>
            <span class="code-content"><span class="keyword">foreach</span> <span class="bracket">(</span><span class="variable">$spalten</span> <span class="keyword">as</span> <span class="variable">$spalte</span> <span class="operator">=></span> <span class="variable">$anzeigename</span><span class="bracket">)</span> {</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">53</span>
            <span class="code-content">    <span class="keyword">if</span> <span class="bracket">(</span><span class="variable">$sortierung</span> <span class="operator">==</span> <span class="variable">$spalte</span><span class="bracket">)</span> {</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">54</span>
            <span class="code-content">        <span class="variable">$links</span>[<span class="variable">$spalte</span>] <span class="operator">=</span> <span class="string">"?sortierung=<span class="variable">$spalte</span>&amp;reihenfolge=<span class="variable">$umgekehrte_reihenfolge</span>"</span>;</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">55</span>
            <span class="code-content">        <span class="variable">$titel</span>[<span class="variable">$spalte</span>] <span class="operator">=</span> <span class="variable">$anzeigename</span> . <span class="variable">$pfeil</span>;</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">56</span>
            <span class="code-content">    } <span class="keyword">else</span> {</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">57</span>
            <span class="code-content">        <span class="variable">$links</span>[<span class="variable">$spalte</span>] <span class="operator">=</span> <span class="string">"?sortierung=<span class="variable">$spalte</span>&amp;reihenfolge=<span class="variable">$standard_reihenfolge</span>"</span>;</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">58</span>
            <span class="code-content">        <span class="variable">$titel</span>[<span class="variable">$spalte</span>] <span class="operator">=</span> <span class="variable">$anzeigename</span>;</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">59</span>
            <span class="code-content">    }</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">60</span>
            <span class="code-content">}</span>
        </div>
        <div class="code-block" data-section="foreach">
            <span class="line-numbers">61</span>
            <span class="code-content"><span class="tag">?></span></span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 11: CSS -->
        <div class="code-block" data-section="css">
            <span class="line-numbers">64</span>
            <span class="code-content"><span class="html-tag">&lt;style&gt;</span></span>
        </div>
        <div class="code-block" data-section="css">
            <span class="line-numbers">65</span>
            <span class="code-content">    <span class="css-prop">.katzen-tabelle</span> { <span class="css-prop">width</span>: <span class="css-value">100%</span>; <span class="css-prop">border-collapse</span>: <span class="css-value">collapse</span>; ... }</span>
        </div>
        <div class="code-block" data-section="css">
            <span class="line-numbers">66</span>
            <span class="code-content">    <span class="css-prop">.katzen-tabelle th, .katzen-tabelle td</span> { <span class="css-prop">border</span>: <span class="css-value">1px solid #ddd</span>; ... }</span>
        </div>
        <div class="code-block" data-section="css">
            <span class="line-numbers">67</span>
            <span class="code-content">    <span class="css-prop">.katzen-tabelle th</span> { <span class="css-prop">background</span>: <span class="css-value">#3498db</span>; <span class="css-prop">color</span>: <span class="css-value">white</span>; }</span>
        </div>
        <div class="code-block" data-section="css">
            <span class="line-numbers">68</span>
            <span class="code-content">    <span class="css-prop">.katzen-tabelle th a</span> { <span class="css-prop">color</span>: <span class="css-value">white</span>; <span class="css-prop">text-decoration</span>: <span class="css-value">none</span>; }</span>
        </div>
        <div class="code-block" data-section="css">
            <span class="line-numbers">69</span>
            <span class="code-content">    <span class="css-prop">.katzen-tabelle th a:hover</span> { <span class="css-prop">text-decoration</span>: <span class="css-value">underline</span>; }</span>
        </div>
        <div class="code-block" data-section="css">
            <span class="line-numbers">70</span>
            <span class="code-content">    <span class="css-prop">.katzen-tabelle tr:nth-child(even)</span> { <span class="css-prop">background</span>: <span class="css-value">#f2f2f2</span>; }</span>
        </div>
        <div class="code-block" data-section="css">
            <span class="line-numbers">71</span>
            <span class="code-content">    <span class="css-prop">.katzen-tabelle tr:hover</span> { <span class="css-prop">background</span>: <span class="css-value">#e8f4fc</span>; }</span>
        </div>
        <div class="code-block" data-section="css">
            <span class="line-numbers">72</span>
            <span class="code-content"><span class="html-tag">&lt;/style&gt;</span></span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 12: HTML-Ausgabe -->
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">74</span>
            <span class="code-content"><span class="html-tag">&lt;h2&gt;</span>Mitarbeiter des Monats<span class="html-tag">&lt;/h2&gt;</span></span>
        </div>
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">76</span>
            <span class="code-content"><span class="tag">&lt;?php</span></span>
        </div>
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">77</span>
            <span class="code-content"><span class="comment">// Schritt 7: Tabelle mit Überschriften ausgeben</span></span>
        </div>
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">78</span>
            <span class="code-content"><span class="keyword">echo</span> <span class="string">"&lt;table class='katzen-tabelle'&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">79</span>
            <span class="code-content"><span class="keyword">echo</span> <span class="string">"&lt;thead&gt;&lt;tr&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">80</span>
            <span class="code-content"><span class="keyword">foreach</span> <span class="bracket">(</span><span class="variable">$spalten</span> <span class="keyword">as</span> <span class="variable">$spalte</span> <span class="operator">=></span> <span class="variable">$anzeigename</span><span class="bracket">)</span> {</span>
        </div>
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">81</span>
            <span class="code-content">    <span class="keyword">echo</span> <span class="string">"&lt;th&gt;&lt;a href='"</span> . <span class="variable">$links</span>[<span class="variable">$spalte</span>] . <span class="string">"'&gt;"</span> . <span class="variable">$titel</span>[<span class="variable">$spalte</span>] . <span class="string">"&lt;/a&gt;&lt;/th&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">82</span>
            <span class="code-content">}</span>
        </div>
        <div class="code-block" data-section="html-output">
            <span class="line-numbers">83</span>
            <span class="code-content"><span class="keyword">echo</span> <span class="string">"&lt;/tr&gt;&lt;/thead&gt;"</span>;</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 13: while-Schleife -->
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">84</span>
            <span class="code-content"><span class="keyword">echo</span> <span class="string">"&lt;tbody&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">86</span>
            <span class="code-content"><span class="keyword">while</span> <span class="bracket">(</span><span class="variable">$katze</span> <span class="operator">=</span> <span class="function">mysqli_fetch_array</span><span class="bracket">(</span><span class="variable">$result</span><span class="bracket">)</span><span class="bracket">)</span> {</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">87</span>
            <span class="code-content">    <span class="keyword">echo</span> <span class="string">"&lt;tr&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">88</span>
            <span class="code-content">    <span class="keyword">echo</span> <span class="string">"&lt;td&gt;"</span> . <span class="variable">$katze</span>[<span class="string">'name'</span>] . <span class="string">"&lt;/td&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">89</span>
            <span class="code-content">    <span class="keyword">echo</span> <span class="string">"&lt;td&gt;"</span> . <span class="variable">$katze</span>[<span class="string">'spezialitaet'</span>] . <span class="string">"&lt;/td&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">90</span>
            <span class="code-content">    <span class="keyword">echo</span> <span class="string">"&lt;td&gt;"</span> . <span class="variable">$katze</span>[<span class="string">'taeglicher_unfug'</span>] . <span class="string">"&lt;/td&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">91</span>
            <span class="code-content">    <span class="keyword">echo</span> <span class="string">"&lt;td&gt;"</span> . <span class="variable">$katze</span>[<span class="string">'kaffee_konsum'</span>] . <span class="string">" &#9749;&lt;/td&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">92</span>
            <span class="code-content">    <span class="keyword">echo</span> <span class="string">"&lt;/tr&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">93</span>
            <span class="code-content">}</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">95</span>
            <span class="code-content"><span class="keyword">echo</span> <span class="string">"&lt;/tbody&gt;"</span>;</span>
        </div>
        <div class="code-block" data-section="while-loop">
            <span class="line-numbers">96</span>
            <span class="code-content"><span class="keyword">echo</span> <span class="string">"&lt;/table&gt;"</span>;</span>
        </div>

        <div class="section-divider"></div>

        <!-- Abschnitt 14: Aufräumen -->
        <div class="code-block" data-section="cleanup">
            <span class="line-numbers">98</span>
            <span class="code-content"><span class="function">mysqli_free_result</span><span class="bracket">(</span><span class="variable">$result</span><span class="bracket">)</span>;</span>
        </div>
        <div class="code-block" data-section="cleanup">
            <span class="line-numbers">99</span>
            <span class="code-content"><span class="function">mysqli_close</span><span class="bracket">(</span><span class="variable">$conn</span><span class="bracket">)</span>;</span>
        </div>
        <div class="code-block" data-section="cleanup">
            <span class="line-numbers">100</span>
            <span class="code-content"><span class="tag">?></span></span>
        </div>

    </div>

    <!-- Erklärungs-Panel rechts -->
    <div class="explanation-panel">
        <div class="explanation" id="explanation-content">
            <h3>Willkommen!</h3>
            <p class="default-explanation">Fahre mit der Maus über einen Code-Abschnitt, um hier eine detaillierte Erklärung zu sehen.</p>
            <p>Dieser Code erstellt eine sortierbare HTML-Tabelle mit Daten aus einer MySQL-Datenbank. Klicke auf eine Spaltenüberschrift, um die Sortierung zu ändern.</p>
        </div>
    </div>
</div>

<script>
// Erklärungen für jeden Code-Abschnitt
const explanations = {
    'php-tag': {
        title: 'PHP-Tag und Datei-Kommentar',
        content: `
            <p><strong>&lt;?php</strong> öffnet den PHP-Modus. Ab hier wird der Code als PHP interpretiert und auf dem Server ausgeführt.</p>
            <p>Die Kommentarzeilen mit <strong>//</strong> sind einzeilige Kommentare. Sie werden vom PHP-Interpreter ignoriert und dienen nur der Dokumentation.</p>
            <div class="highlight">
                <strong>Tipp:</strong> Gute Kommentare erklären das "Warum", nicht das "Was". Der Code selbst zeigt, was passiert - Kommentare sollten erklären, warum wir es so machen.
            </div>
        `
    },
    'verbindung': {
        title: 'Datenbankverbindung herstellen',
        content: `
            <p><strong>mysqli_connect()</strong> stellt eine Verbindung zur MySQL/MariaDB-Datenbank her. Die Funktion erwartet 4 Parameter:</p>
            <div class="code-example">mysqli_connect(host, user, passwort, datenbank)</div>
            <p><strong>Parameter:</strong></p>
            <ul>
                <li><strong>"localhost"</strong> - Der Server (hier: lokaler Rechner)</li>
                <li><strong>"root"</strong> - Der Datenbankbenutzer</li>
                <li><strong>""</strong> - Das Passwort (hier: leer)</li>
                <li><strong>"katzencafe"</strong> - Name der Datenbank</li>
            </ul>
            <p><strong>mysqli_set_charset()</strong> setzt die Zeichenkodierung auf UTF-8, damit Umlaute korrekt angezeigt werden.</p>
            <div class="warning">
                <strong>Achtung:</strong> In echten Projekten niemals leere Passwörter oder "root" als Benutzer verwenden!
            </div>
        `
    },
    'fehler': {
        title: 'Fehlerbehandlung',
        content: `
            <p>Wenn die Verbindung fehlschlägt, gibt <strong>mysqli_connect()</strong> den Wert <strong>false</strong> zurück.</p>
            <p><strong>!$conn</strong> prüft, ob $conn false ist (das Ausrufezeichen negiert den Wert).</p>
            <p><strong>die()</strong> beendet das Skript sofort und gibt die Fehlermeldung aus.</p>
            <p><strong>mysqli_connect_error()</strong> liefert die genaue Fehlerbeschreibung.</p>
            <div class="code-example">if (!$conn) {
    die("Fehler: " . mysqli_connect_error());
}</div>
            <div class="info">
                <strong>Info:</strong> Der Punkt (.) verkettet Strings. Die Fehlermeldung wird an den Text angehängt.
            </div>
        `
    },
    'param-sortierung': {
        title: 'URL-Parameter: sortierung',
        content: `
            <p><strong>$_REQUEST</strong> ist ein PHP-Array, das alle GET- und POST-Parameter enthält.</p>
            <p>Bei einer URL wie <strong>seite.php?sortierung=name</strong> enthält <strong>$_REQUEST['sortierung']</strong> den Wert "name".</p>
            <div class="code-example">$sortierung = 'id';  // Standardwert
if (isset($_REQUEST['sortierung'])) {
    $sortierung = $_REQUEST['sortierung'];
}</div>
            <p><strong>isset()</strong> prüft, ob der Parameter existiert. Das ist wichtig, weil beim ersten Seitenaufruf noch keine Parameter übergeben wurden.</p>
            <div class="highlight">
                <strong>Ablauf:</strong>
                <ol>
                    <li>Setze Standardwert 'id'</li>
                    <li>Prüfe, ob Parameter in URL existiert</li>
                    <li>Falls ja: überschreibe mit URL-Wert</li>
                </ol>
            </div>
        `
    },
    'param-reihenfolge': {
        title: 'URL-Parameter: reihenfolge',
        content: `
            <p>Dieser Block funktioniert identisch zum vorherigen - nur für den zweiten Parameter.</p>
            <p><strong>$reihenfolge</strong> bestimmt die Sortierrichtung:</p>
            <ul>
                <li><strong>'asc'</strong> = aufsteigend (A-Z, 1-9)</li>
                <li><strong>'desc'</strong> = absteigend (Z-A, 9-1)</li>
            </ul>
            <div class="code-example">// URL: seite.php?sortierung=name&reihenfolge=asc
$_REQUEST['reihenfolge'] // enthält "asc"</div>
            <div class="info">
                <strong>Beispiel-URLs:</strong><br>
                ?sortierung=name&reihenfolge=asc<br>
                ?sortierung=kaffee_konsum&reihenfolge=desc
            </div>
        `
    },
    'sql-query': {
        title: 'SQL-Abfrage mit ORDER BY',
        content: `
            <p>Die SQL-Abfrage wird dynamisch zusammengebaut. Die Variablen werden direkt in den String eingesetzt.</p>
            <div class="code-example">$sql = "SELECT * FROM katzen ORDER BY $sortierung $reihenfolge";</div>
            <p><strong>Ergebnis bei sortierung=name und reihenfolge=asc:</strong></p>
            <div class="code-example">SELECT * FROM katzen ORDER BY name asc</div>
            <p><strong>mysqli_query()</strong> führt die Abfrage aus und speichert das Ergebnis in <strong>$result</strong>.</p>
            <div class="warning">
                <strong>Sicherheitshinweis:</strong> In echten Projekten sollte man Benutzereingaben validieren, um SQL-Injection zu verhindern! Hier vertrauen wir darauf, dass nur bekannte Werte übergeben werden.
            </div>
        `
    },
    'toggle': {
        title: 'Toggle-Logik für Sortierrichtung',
        content: `
            <p>Die Toggle-Logik ermöglicht das Umschalten der Sortierrichtung beim erneuten Klick auf dieselbe Spalte.</p>
            <p><strong>$standard_reihenfolge</strong>: Die Richtung für neu angeklickte Spalten (hier: absteigend).</p>
            <p><strong>$umgekehrte_reihenfolge</strong>: Das Gegenteil der aktuellen Richtung - für den Link der aktiven Spalte.</p>
            <div class="code-example">// Wenn aktuell 'asc' -> Link zeigt 'desc'
// Wenn aktuell 'desc' -> Link zeigt 'asc'</div>
            <div class="highlight">
                <strong>Beispiel:</strong> Tabelle ist nach "Name aufsteigend" sortiert. Der Name-Link enthält jetzt "desc", damit ein Klick zu "Name absteigend" wechselt.
            </div>
        `
    },
    'spalten-array': {
        title: 'Assoziatives Array für Spalten',
        content: `
            <p>Ein <strong>assoziatives Array</strong> speichert Werte unter selbst gewählten Schlüsseln (Keys) statt unter Zahlen.</p>
            <div class="code-example">$spalten = [
    'name' => 'Name',           // Key => Value
    'spezialitaet' => 'Spezialität',
    ...
];</div>
            <p><strong>Key (links)</strong>: Der Spaltenname in der Datenbank<br>
            <strong>Value (rechts)</strong>: Der Anzeigetitel für die Benutzer</p>
            <div class="info">
                <strong>Vorteil:</strong> Alle Spalten-Infos an einem Ort. Wenn eine Spalte hinzukommt, muss man nur das Array erweitern - nicht mehrere Code-Stellen ändern.
            </div>
        `
    },
    'ternary': {
        title: 'Ternärer Operator (Kurzform für if/else)',
        content: `
            <p>Der <strong>ternäre Operator</strong> ist eine Kurzform für einfache if/else-Entscheidungen:</p>
            <div class="code-example">$ergebnis = (bedingung) ? wert_wenn_true : wert_wenn_false;</div>
            <p><strong>Ausgeschrieben wäre das:</strong></p>
            <div class="code-example">if ($reihenfolge == 'asc') {
    $pfeil = '&amp;nbsp;&#8593;';  // Pfeil nach oben
} else {
    $pfeil = '&amp;nbsp;&#8595;';  // Pfeil nach unten
}</div>
            <p><strong>&amp;nbsp;</strong> ist ein geschütztes Leerzeichen in HTML - es verhindert, dass der Pfeil direkt am Text klebt.</p>
            <div class="warning">
                <strong>Achtung:</strong> Ternäre Operatoren nur für einfache Fälle verwenden! Bei komplexer Logik wird der Code schnell unlesbar.
            </div>
        `
    },
    'foreach': {
        title: 'foreach-Schleife mit Key-Value',
        content: `
            <p>Die <strong>foreach-Schleife</strong> durchläuft jedes Element des Arrays:</p>
            <div class="code-example">foreach ($spalten as $spalte => $anzeigename) {
    // $spalte = Key (z.B. 'name')
    // $anzeigename = Value (z.B. 'Name')
}</div>
            <p>In der Schleife erstellen wir <strong>zwei neue Arrays</strong>:</p>
            <ul>
                <li><strong>$links[]</strong> - Die URL für jede Spaltenüberschrift</li>
                <li><strong>$titel[]</strong> - Der Anzeigetext (mit Pfeil bei aktiver Spalte)</li>
            </ul>
            <div class="highlight">
                <strong>Logik:</strong><br>
                Ist die Spalte aktiv? → Link mit umgekehrter Reihenfolge + Pfeil<br>
                Ist die Spalte inaktiv? → Link mit Standard-Reihenfolge, kein Pfeil
            </div>
        `
    },
    'css': {
        title: 'CSS-Styling der Tabelle',
        content: `
            <p>Das CSS definiert das Aussehen der Tabelle:</p>
            <ul>
                <li><strong>border-collapse: collapse</strong> - Keine doppelten Rahmenlinien</li>
                <li><strong>.katzen-tabelle th</strong> - Blaue Kopfzeile mit weißer Schrift</li>
                <li><strong>th a</strong> - Links in Überschriften sind weiß (passend zum Hintergrund)</li>
                <li><strong>tr:nth-child(even)</strong> - Jede zweite Zeile leicht grau (Zebra-Streifen)</li>
                <li><strong>tr:hover</strong> - Hellblauer Hintergrund beim Überfahren</li>
            </ul>
            <div class="info">
                <strong>Warum im &lt;style&gt;-Tag?</strong><br>
                Für kleine Projekte ist eingebettetes CSS praktisch. Bei größeren Projekten sollte man eine separate CSS-Datei verwenden.
            </div>
        `
    },
    'html-output': {
        title: 'Tabellenkopf ausgeben',
        content: `
            <p><strong>echo</strong> gibt Text aus, der an den Browser gesendet wird - hier HTML-Code.</p>
            <p>Die <strong>foreach-Schleife</strong> erstellt die Überschriften dynamisch:</p>
            <div class="code-example">foreach ($spalten as $spalte => $anzeigename) {
    echo "&lt;th&gt;&lt;a href='" . $links[$spalte] . "'&gt;"
         . $titel[$spalte] . "&lt;/a&gt;&lt;/th&gt;";
}</div>
            <p><strong>Ergebnis im HTML:</strong></p>
            <div class="code-example">&lt;th&gt;&lt;a href='?sortierung=name&reihenfolge=desc'&gt;Name &#8595;&lt;/a&gt;&lt;/th&gt;
&lt;th&gt;&lt;a href='?sortierung=spezialitaet&reihenfolge=desc'&gt;Spezialität&lt;/a&gt;&lt;/th&gt;
...</div>
            <div class="info">
                <strong>Punkt (.) Operator:</strong> Verkettet Strings. Sehr häufig verwendet, um Variablen in HTML einzubauen.
            </div>
        `
    },
    'while-loop': {
        title: 'while-Schleife: Daten ausgeben',
        content: `
            <p>Die <strong>while-Schleife</strong> holt Zeile für Zeile aus dem Abfrageergebnis:</p>
            <div class="code-example">while ($katze = mysqli_fetch_array($result)) {
    // $katze enthält eine Zeile als Array
    echo $katze['name'];  // z.B. "Whiskers"
}</div>
            <p><strong>mysqli_fetch_array()</strong> gibt bei jedem Aufruf die nächste Zeile zurück. Wenn keine Zeilen mehr da sind, gibt sie <strong>false</strong> zurück und die Schleife endet.</p>
            <p><strong>Zugriff auf Spalten:</strong></p>
            <ul>
                <li><strong>$katze['name']</strong> - Spalte "name"</li>
                <li><strong>$katze['spezialitaet']</strong> - Spalte "spezialitaet"</li>
            </ul>
            <div class="highlight">
                <strong>Merke:</strong> Die Schleife läuft so oft, wie Zeilen im Ergebnis sind. Bei 5 Katzen in der Datenbank = 5 Durchläufe.
            </div>
        `
    },
    'cleanup': {
        title: 'Ressourcen freigeben',
        content: `
            <p>Am Ende sollten wir aufräumen:</p>
            <p><strong>mysqli_free_result($result)</strong> gibt den Speicher frei, der für das Abfrageergebnis reserviert wurde.</p>
            <p><strong>mysqli_close($conn)</strong> schließt die Datenbankverbindung.</p>
            <div class="code-example">mysqli_free_result($result);
mysqli_close($conn);</div>
            <div class="info">
                <strong>Ist das nötig?</strong><br>
                PHP räumt am Skriptende automatisch auf. Trotzdem ist es guter Stil, Ressourcen explizit freizugeben - besonders bei längeren Skripten oder wenn mehrere Abfragen ausgeführt werden.
            </div>
        `
    }
};

// Event-Listener für Code-Blöcke
document.querySelectorAll('.code-block').forEach(block => {
    block.addEventListener('mouseenter', function() {
        // Alle aktiven Blöcke deaktivieren
        document.querySelectorAll('.code-block.active').forEach(b => b.classList.remove('active'));

        // Alle Blöcke mit gleichem data-section aktivieren
        const section = this.dataset.section;
        document.querySelectorAll(`[data-section="${section}"]`).forEach(b => b.classList.add('active'));

        // Erklärung anzeigen
        const explanation = explanations[section];
        if (explanation) {
            document.getElementById('explanation-content').innerHTML = `
                <h3>${explanation.title}</h3>
                ${explanation.content}
            `;
        }
    });
});

// Optional: Erklärung behalten wenn Maus das Code-Panel verlässt
// (damit man in der Sidebar lesen kann)
</script>

</body>
</html>
