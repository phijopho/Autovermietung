<html>
<html lang="en">
<head>
<!-- include html head -->
<?php
include('../includes/htmlhead.php')
?>
<!-- page specific head elements -->
<title>Unsere Flotte</title>
<link rel="stylesheet" href="css/styleProduktuebersicht.css">    

</head>
 
<body>
<?php
include('../includes/header.html'); // include header
include('../includes/dbConnection.php'); // connect database
include('../includes/functions.php'); // get functions
?>

<form method="post" action= <?php $_SERVER["PHP_SELF"]?>>
    <div class="filterBox">
        <div class="itemBox">
            <label for="location">Standort:</label><br>
            <select class="customSelect" name="Standort">
                <?php 
                $location=getCities();
                foreach($location as $city){
                    echo "<option value='$city'>$city</option>";
                }
                ?>
            </select>
        </div>
        <div class="twoSidedBox">
            <label for="pickUpDate">Abholdatum:</label>
                    <input type="date" name="pickUpDate" value="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="twoSidedBox">
            <label for ="returnDate">R&uuml;ckgabedatum:</label>
                <input type="date" name="returnDate" value="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="itemBox">
            <lable for="category">Fahrzeugkategorie: </lable><br>
                <?php 
                $categories=selectDistinctColumn("Typ", "CarType");
                foreach($categories as $category){
                    echo "<input type='checkbox' name='".$category." value='".$category."'>";
                    echo "<label for '".$category."'>".$category."</label><br>";
                }
                ?>
        </div>
        <div class="itemBox">
            <label for="vendor">Hersteller:</label><br>
            <select class="customSelect" name="vendor">
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
            <select class="customSelect" name="drive">
                <option value="all">Alle auswählen</option>
                <?php 
                $drives=selectDistinctColumn("Drive", "CarType");
                foreach($drives as $drive){
                    echo "<option value='$drive'>$drive</option>";
                }
                ?>
            </select>
        </div>
        <div class="twoSidedBox">
            <label for"automatic">Nur Automatik</label>
            <label class="switch">
                <input type="checkbox">
                <span class="sliderRound"></span>
            </label>
        </div>
        <div class="twoSidedBox">
            <label for"AC">Klima</label>
            <label class="switch">
                <input type="checkbox">
                <span class="sliderRound"></span>
            </label>
        </div>
        <div class="twoSidedBox">
            <label for"gps">GPS</label>
            <label class="switch">
                <input type="checkbox">
                <span class="sliderRound"></span>
            </label>
        </div>
    </div>
</form>

<div class="resultBox">
    <div class="topBox">
        <label for="available">Verf&uuml;gbare Fahrzeuge: 10</label>
        <div class="sortBox">
            <label for="sort" >Sortierung: </label>
            <select class="customSelectSort" name="sort">
                <option value="alphabetic">Alphabetisch</option>
                <option value="priceExpensive">Preis aufsteigend</option>
                <option value="priceCheap">Preis absteigend</option>
            </select>
        </div>
    </div>
    <div class="resultItemBox">
        <div class="modelBox">
            <label>Fahrzeugmodell</label>
        </div>
        <?php
            $currentTypeID=25; // Wert aus Filter ziehen
            $image=$conn->prepare("SELECT Image FROM CarType WHERE CarType_ID=:CarTypeIdent");
            $image->bindParam(':CarTypeIdent', $currentTypeID);
            $image->execute();

            if($result->rowCount()>0){ ?>
                <div class="pictureBox">
                    <?php while($row=$result->fetch()){ ?>
                        <img src="data:image/png;charset=utf8;base64, <?php echo base64_encode($row['Image']); ?>"/>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="pictureBox">Image(s) not found...</div>
            <?php } 
        ?>
        </div>

    </div>
</div>

<?php
include('../includes/footer.html'); // Einbinden des Footers
?>

</body>
</html>