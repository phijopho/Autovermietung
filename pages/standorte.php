<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Einbinden der style.css -->
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/styleStandorte.css">
    <link rel="stylesheet" href="../css/styleFooter.css">
    <title>Standorte</title>
    <base href="/Autovermietung/">
</head>
<body>

<?php

include('../includes/header.html'); // Including the header
?>

<script>
    function redirectToProductOverview(city) {
        window.location.href = '/Autovermietung/pages/produktuebersicht.php'
    }
</script>


<div class="map-heading">
        <h1> </h1> <br>
        <h1>Unsere Standorte</h1>
    </div>
    <div class="map-container">
        
        <!--Klasse um die Karte auf der Seite zu positionieren-->
        <div class="ger-map">
            <img src="images/Deutschlandkarte.png" alt="map" >
            
            <!--Klasse für jede Stadt,um die Pins genau auszurichten-->
            <div class="pin hamburg" onclick="redirectToProductOverview('Hamburg');">
                <span>Hamburg</span>
            </div>

            <div class="pin berlin" onclick="redirectToProductOverview('Berlin');">
                <span>Berlin</span>
            </div>

            <div class="pin paderborn" onclick="redirectToProductOverview('Paderborn');">
                <span>Paderborn</span>
            </div>

            <div class="pin rostock" onclick="redirectToProductOverview('Rostock');">
                <span>Rostock</span>
            </div>

            <div class="pin bielefeld" onclick="redirectToProductOverview('Bielefeld');">
                <span>Bielefeld</span>
            </div>

            <div class="pin bochum" onclick="redirectToProductOverview('Bochum');">
                <span>Bochum</span>
            </div>

            <div class="pin bremen" onclick="redirectToProductOverview('Bremen');">
                <span>Bremen</span>
            </div>

            <div class="pin dortmund" onclick="redirectToProductOverview('Dortmund');">
                <span>Dortmund</span>
            </div>

            <div class="pin dresden" onclick="redirectToProductOverview('Dresden');">
                <span>Dresden</span>
            </div>

            <div class="pin freiburg" onclick="redirectToProductOverview('Freiburg');">
                <span>Freiburg</span>
            </div>

            <div class="pin koeln" onclick="redirectToProductOverview('Köln');">
                <span>Köln</span>
            </div>

            <div class="pin leipzig" onclick="redirectToProductOverview('Leipzig');">
                <span>Leipzig</span>
            </div>

            <div class="pin muenchen" onclick="redirectToProductOverview('München');">
                <span>München</span>
            </div>

            <div class="pin nuernberg" onclick="redirectToProductOverview('Nürnberg');">
                <span>Nürnberg</span>
            </div>
        </div>
    </div>

</body>

<?php
// Integrating the footer
include('../includes/footer.html');
?>

</html>
