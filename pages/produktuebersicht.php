<!DOCTYPE html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleProduktuebersicht.css">
    <title>Unsere Flotte</title>
</head>
 
<body>
<?php
include('../includes/header.html'); // include header
include('../includes/dbConnection.php'); // connect database
include('../includes/functions.php'); // get functions
?>

<form method="post" action= <?php $_SERVER["PHP_SELF"]?>>
    <div class="filterBox">
    <h1> Filter: </h1>
        <div class="itemBox">
            <label for="location">Standort:</label><br>
            <select id="location" name="Standort">
                <?php 
                $location=getCities();
                foreach($location as $city){
                    echo "<option value='$city'>$city</option>";
                }
                ?>
            </select>
        </div>
        <div class="itemBox">
            <label for="pickUpDate">Abholdatum:</label>
                    <input type="date" name="pickUpDate" value="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="itemBox">
            <label for ="returnDate">R&uuml;ckgabedatum:</label>
                <input type="date" name="returnDate" value="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="itemBox">
            <lable for="category">Fahrzeugkategorie: </lable><br>
            <?php 
            $categories=selectDistinctColumn("Typ", "CarType");
            foreach($categories as $category){
                echo "<input type='checkbox' id='".$category."' name='".$category." value='".$category."'>";
                echo "<label for '".$category."'>".$category."</label><br>";
            }
            ?>
        </div>
        <div class="itemBox">
            <label for="vendor">Hersteller:</label><br>
            <select id="vendor" name="vendor">
                <?php 
                $vendors=selectColumn("Abbreviation", "Vendor");
                foreach($vendors as $vendor){
                    echo "<option value='$vendor'>$vendor</option>";
                }
                ?>
            </select>
        </div>
        <div class="itemBox">
            <label for "seats">Sitze:</label><br>
            <?php
            $seats=selectMinAndMaxFromColumn("Seats", "CarType");
            echo "<input type='range' min='".$seats['min']."' max='".$seats['max']."' value='5' class='slider' id='seats'>";
            //evtl mit Jquery Funktion einbauen, dass aktueller Wert angezeigt wird
            ?>
        </div>
        <div class="itemBox">
            <label for "doors">T&uuml;ren:</label><br>
            <?php
            $doors=selectMinAndMaxFromColumn("Doors", "CarType");
            echo "<input type='range' min='".$doors['min']."' max='".$doors['max']."' value='5' class='slider' id='doors'>";
            //evtl mit Jquery Funktion einbauen, dass aktueller Wert angezeigt wird
            ?>
        </div>
        <div class="itemBox">
            <label for "age">Alter:</label><br>
            <?php
            $age=selectMinAndMaxFromColumn("Min_Age", "CarType");
            echo "<input type='range' min='".$age['min']."' max='".$age['max']."' value='18' class='slider' id='doors'>";
            //Funktion einbauen, dass Slider Altersgrenzen anzeigt (18+, 21+, 25+)            ?>
        </div>
        <div class="itemBox">
            <label for="drive">Antrieb:</label><br>
            <select id="drive" name="drive">
                <option value="all">Alle auswählen</option>
                <?php 
                $drives=selectDistinctColumn("Drive", "CarType");
                foreach($drives as $drive){
                    echo "<option value='$drive'>$drive</option>";
                }
                ?>
            </select>
        </div>
        <div class="itemBox">
            <label for"automatic">Nur Automatik</label>
            <label class="switch">
                <input type="checkbox">
                <span class="sliderRound"></span>
            </label>
        </div>
        <div class="itemBox">
            <label for"AC">Klima</label>
            <label class="switch">
                <input type="checkbox">
                <span class="sliderRound"></span>
            </label>
        </div>
        <div class="itemBox">
            <label for"gps">GPS</label>
            <label class="switch">
                <input type="checkbox">
                <span class="sliderRound"></span>
            </label>
        </div>
    </div>
</form>

<div class="resultBox">
    <h1> Ergebnisse: </h1>
    <div class="resultItemBox">
        // Output messages
    </div>
</div>

<?php
include('../includes/footer.html'); // Einbinden des Footers
?>

</body>
</html>