<!DOCTYPE html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleProduktuebersichtsseite.css">
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
            $vendors=getVendors();
            foreach($vendors as $vendor){
                echo "<input type='checkbox' id='".$vendor."' name='".$vendor." value='".$vendor."'>";
                echo "<label for '".$vendor."'>".$vendor."</label><br>";
            }
            ?>
        </div>
        <div class="itemBox">
            <label for="vendor">Hersteller:</label><br>
            <select id="vendor" name="vendor">
                <?php 
                $vendors=getVendors();
                foreach($vendors as $vendor){
                    echo "<option value='$vendor'>$vendor</option>";
                }
                ?>
            </select>
        </div>
        <div class="itemBox">
            <label for "seats">Sitze:</label><br>
            <?php
            $seats=getSeats();
            echo "<input type='range' min='".$seats['min']."' max='".$seats['max']."' value='5' class='slider' id='seats'>";
            //evtl mit Jquery Funktion einbauen, dass aktueller Wert angezeigt wird
            ?>
        </div>
        <div class="itemBox">
            <label for "doors">T&uuml;ren:</label><br>
            <?php
            $doors=getDoors();
            echo "<input type='range' min='".$doors['min']."' max='".$doors['max']."' value='5' class='slider' id='doors'>";
            //evtl mit Jquery Funktion einbauen, dass aktueller Wert angezeigt wird
            ?>
        </div>
        <div class="itemBox">
            <label for "age">Alter:</label><br>
            <?php
            $doors=getAge();
            echo "<input type='range' min='".$age['min']."' max='".$age['max']."' value='18' class='slider' id='doors'>";
            //evtl mit Jquery Funktion einbauen, dass aktueller Wert angezeigt wird
            ?>
        </div>

</form>

        </div>
    </div>
    <div class="resultBox">
        <h1> Ergebnisse: </h1>
        <div class="resultItemBox">
        
        <?php
// Output messages

/
}
?>
    </div>

<?php
include('../includes/footer.html'); // Einbinden des Footers
?>

</body>
</html>