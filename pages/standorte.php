<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Einbinden der style.css -->
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/styleStandorte.css">
    <title>Standorte</title>
    <base href="/Autovermietung/">

</head>
<body>

<?php

include('../includes/header.php'); // Including the header
?>


<div class="map-heading">
        <h1> </h1> <br>
        <h1>Unsere Standorte</h1>
    </div>
    <div class="map-container">
        <div class="ger-map">
            <img src="images/Deutschlandkarte.png" alt="map" >
            
            <div class="pin hamburg" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Hamburg</span>
            <</div>

            <div class="pin berlin" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Berlin</span>
            </div>

            <div class="pin paderborn" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Paderborn</span>
            </div>

            <div class="pin rostock" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Rostock</span>
            </div>

            <div class="pin bielefeld" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Bielefeld</span>
            </div>

            <div class="pin bochum" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Bochum</span>
            </div>

            <div class="pin bremen" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Bremen</span>
            </div>

            <div class="pin dortmund" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Dortmund</span>
            </div>

            <div class="pin dresden" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Dresden</span>
            </div>

            <div class="pin freiburg" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Freiburg</span>
            </div>

            <div class="pin koeln" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Köln</span>
            </div>

            <div class="pin leipzig" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Leipzig</span>
            </div>

            <div class="pin muenchen" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>München</span>
            </div>

            <div class="pin nuernberg" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                <span>Nürnberg</span>
            </div>
        </div>
    </div>


<?php
// Integrating the footer
include('../includes/footer.html');
?>

</body>
</html>
