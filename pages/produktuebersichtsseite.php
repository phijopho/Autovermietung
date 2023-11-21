<!DOCTYPE html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsere Flotte</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleProduktuebersichtsseite.css">
</head>
 

<body>
<?php
include('../includes/header.html'); // Einbindung des Headers
?>


<div class="fixedBox">

    <!-- Ort -->
    <p class="custom-paragraph">Ort</p>
    <button class="custom-button">Hamburg</button>

    <!-- Zeitraum -->
    <p class="custom-paragraph">Zeitraum</p>

    <!-- Buttons Abholdatum -->
    <button class="button_abholdatum">
        <a>Abholdatum<br><input type="date" id="abholdatuminput"></a>
    </button>

    <!-- Buttons Rückgabedatum -->
    <button class="button_rückgabedatum">
        <a>Rückgabedatum<br><input type="date" id="rückgabedatuminput"></a>
    </button>

    <!-- Fahrzeugkategorie -->
    <div class="fahrzeugkategorie">
        <p class="custom-paragraph">Fahrzeugkategorie</p>
        <button class="custom-button">xxx</button>
        <button class="custom-button">xxx</button>
        <button class="custom-button">xxx</button>
        <button class="custom-button">xxx</button>
        <button class="custom-button">xxx</button>
        <button class="custom-button">xxx</button>
        <button class="custom-button">xxx</button>
        <button class="custom-button">xxx</button>
        <button class="custom-button">xxx</button>
    </div>

    <!-- Hersteller -->
    <p class="custom-paragraph">Hersteller</p>
    <button class="custom-button">xxx</button>

    <!-- Sitze -->
    <p class="custom-paragraph">Sitze</p>
    <div class="slider-container">
        <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
    </div>

    <!-- Türen -->
    <p class="custom-paragraph">Türen</p>
    <div class="slider-container">
        <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
    </div>

    <!-- Getriebe -->
    <p class="custom-paragraph">Getriebe</p>
    <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="leftClick()">Automatik</button>
            <button type="button" class="toggle-btn" onclick="rightClick()">Manuell</button>
        </div>
    </div>
    <script src="Produktdetaillseite.js"></script>

    <!-- Klimaanlage -->
    <p class="custom-paragraph">Klimaanlage</p>

    <!-- GPS -->
    <p class="custom-paragraph">GPS</p>

    <!-- Alter -->
    <p class="custom-paragraph">Alter</p>
    <div class="slider-container">
        <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
    </div>

    <!-- Kofferraumgröße -->
    <p class="custom-paragraph">Kofferraumgröße</p>
    <div class="slider-container">
        <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
    </div>

    <!-- Preis -->
    <p class="custom-paragraph">Preis</p>
    <div class="slider-container">
        <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
    </div>

    https://www.youtube.com/watch?v=vfFSoTvJsV4

</div>

<?php
include('../includes/footer.html'); // Einbindung des Footers
?>
</body>

</html>