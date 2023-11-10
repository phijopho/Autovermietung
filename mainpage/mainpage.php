<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autovermietung</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header/header.php'; ?>

    <!-- Content -->
    <main>
        <!-- Ort und Zeitraum auswählen -->
        <section id="auswahl">
            <h1>Autovermietung in 14 Städten</h1>
            <label for="stadt">Stadt:</label>
            <select id="stadt">
                <!-- Hier sollten die 14 Städte als Optionen eingefügt werden -->
            </select>
            <label for="startdatum">Startdatum:</label>
            <input type="date" id="startdatum">
            <label for "enddatum">Enddatum:</label>
            <input type="date" id="enddatum">
            <button id="suchen">Suchen</button>
        </section>

        <!-- Teaser für Autokategorien -->
        <section id="teaser">
            <!-- Hier sollten Teaser für verschiedene Autokategorien erstellt werden -->
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div id="impressum"><a href="footer/impressum.html">Impressum</a></div>
        <div id="datenschutz"><a href="footer/datenschutz.html">Datenschutz</a></div>
        <div id="agb"><a href="footer/agb.html">AGB</a></div>
    </footer>
</body>
</html>
