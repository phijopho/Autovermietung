<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsere Flotte</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php
include('../includes/header.html'); // Einbindung des Headers
?>


 <div class="fixedBox">
    
        <!--Ort-->
        <p style="padding-top: 30px;">Ort</p>
        <button style="margin-left: 30px; width: 290px; text-align: left;">Hamburg</button>


        <!--Zeitraum-->     <!--AirBnb website vorlage-->
        <p style="padding-top: 30px;">Zeitraum</p>

            <!--Buttons Abholdatum--> 
            <button class="button_abholdatum">
                <a>Abholdatum<br><input type="date" id="abholdatuminput"></a>
            </button>
       
            <!--Buttons Rückgabedatum--> 
            <button class="button_rückgabedatum">
                <a>Rückgabedatum<br><input type="date" id="rückgabedatuminput"></a>
            </button>

        
        <!--Fahrzeugkategorie-->
        <div class="fahrzeugkategorie">
            <p>Fahrzeugkategorie</p>
            <!--Klasse erstellen evt.-->
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
            <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>
        </div>


        <!--Hersteller-->
        <p style="padding-top: 30px;">Hersteller</p>
        <button style="margin-left: 30px; width: 290px; text-align: left;">xxx</button>


        <!--Sitze-->
        <p style="padding-top: 30px;">Sitze</p>

        <div class="slider-container">
            <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
        </div>
        

        <!--Türen-->
        <p style="padding-top: 30px;">Türen</p>

        <div class="slider-container">
            <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
        </div>


        <!--Getriebe-->
        <p style="padding-top: 30px;">Getriebe</p>
        
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="leftClick()">Automatik</button>
                <button type="button" class="toggle-btn" onclick="rightClick()">Manuell</button>
            </div>
        </div> 
        <script src="Produktdetaillseite.js"></script>



        <!--Klimaanlage-->
        <p style="padding-top: 30px;">Klimaanlage</p>
        

        
        <!--GPS-->
        <p style="padding-top: 30px;">GPS</p>


        <!--Alter-->   <!--Fahreralter!!-->
        <p style="padding-top: 30px;">Alter</p>

        <div class="slider-container">
            <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
        </div>


        <!--Kofferraumgröße-->  <!--Gepäcksttücke-->
        <p style="padding-top: 30px;">Kofferraumgröße</p>

        <div class="slider-container">
            <input type="range" min="0" max="100" value="50" class="slider" id="mySlider">
        </div>


         <!--Preis-->
         <p style="padding-top: 30px;">Preis</p>

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
