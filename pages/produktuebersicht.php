<?php session_start(); 
session_unset();
session_destroy();
?>

<html lang="en">
<head>
<!-- include html head -->
<?php
include('../includes/htmlhead.php');
include('../includes/dbConnection.php'); // connect database
include('../includes/functions.php'); // get functions

$today=date("Y-m-d");
$tomorrow=date("Y-m-d", strtotime($today . " +2 day"));
if(!isset($_SESSION['location'], $_SESSION['pickUpDate'], $_SESSION['returnDate'])){
    $_SESSION['location']="Hamburg";
    $_SESSION['pickUpDate']=$today;
    $_SESSION['returnDate']=$tomorrow;
}

if (isset($_POST['quickSearch'])){
     $_SESSION['location']=$_POST['location'];
     $_SESSION['pickUpDate']=$_POST['pickUpDate'];
     $_SESSION['returnDate']=$_POST['returnDate'];
} else {
         echo "Session Variablen nicht definiert.";
}

$location=getCities();
$categories=selectDistinctColumn("Type", "CarType");
echo "<br><br><br><br>";

if (isset($_POST['filter'])){
    echo "filter isset <br>";
    $_SESSION['categories']=array();
    foreach($categories as $category){
        if (isset($_POST[$category])){
            $_SESSION['categories'][] = $_POST[$category];
            echo $category." isset <br>";
        }
    }   
} else {
    echo "filter not posted <br>";
}

if (empty($_SESSION['categories'])){
    $_SESSION['categories'] = $categories;
}

print_r($_SESSION);

?>

<!-- page specific head elements -->
<title>Unsere Flotte</title>
<link rel="stylesheet" href="css/styleProduktuebersicht.css">    
</head>

<?php
include('../includes/header.html'); // include header
?>
<body>

<div class="contentBox">
    <form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
        <div class="filterBox">
            <div class="itemBox">
                <label for="location">Standort:</label><br>
                <select class="customSelect" name="location">
                    <?php 
                    foreach ($location as $city) {
                        if ($_SESSION['location'] == $city) {
                            echo "<option value='$city' selected>$city</option>";
                        } else {
                            echo "<option value='$city'>$city</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="twoSidedBox">
                <label for="pickUpDate">Abholdatum:</label>
                        <input type="date" name="pickUpDate" value="<?php echo $_SESSION['pickUpDate']; ?>" />
            </div>
            <div class="twoSidedBox">
                <label for="returnDate">R&uuml;ckgabedatum:</label>
                    <input type="date" name="returnDate" value="<?php echo $_SESSION['returnDate']; ?>" />
            </div>
            <div class="itemBox">
                <lable for="category">Fahrzeugkategorie: </lable><br>
                    <?php 
                    foreach($categories as $category){
                        echo "<input type='checkbox' name=".$category." value='".$category."'>";
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
            <br><br>
            <input type="submit" value="Filtern" name="filter">
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
        
        <div class="resultWrapBox">
            <div class="resultItemBox">
                <div class="modelBox">
                    <label>
                        <?php 
                            $model=getModel("25");
                            echo $model[0]." ".$model[1];
                        ?>
                    </label>
                </div>
                <?php
                    showImage("25");
                ?>
                <div class="carDataBox">
                    <?php $price=getPrice("25"); ?>
                    Preis pro Tag: <?php echo $price[0]; ?> €<br>
                    Preis f&uuml;r den gew&auml;hlten Zeitraum: <?php echo $price[0]; ?> € <br>
                </div>
            </div>
            <div class="resultItemBox">
                <div class="modelBox">
                    <label>                    
                        <?php 
                            $model=getModel("32");
                            echo $model[0]." ".$model[1];
                        ?>
                    </label>
                </div>
                <?php
                    showImage("32");
                ?>
                <div class="carDataBox">
                    <?php $price=getPrice("32"); ?>
                    Preis pro Tag: <?php echo $price[0]; ?> €<br>
                    Preis f&uuml;r den gew&auml;hlten Zeitraum: <?php echo $price[0]; ?> € <br>
                </div>
            </div>
            <div class="resultItemBox">
                <div class="modelBox">
                    <label>
                        <?php 
                            $model=getModel("57");
                            echo $model[0]." ".$model[1];
                        ?>
                    </label>
                </div>
                <?php
                    showImage("57");
                ?>
                <div class="carDataBox">
                    <?php $price=getPrice("57"); ?>
                    Preis pro Tag: <?php echo $price[0]; ?> €<br>
                    Preis f&uuml;r den gew&auml;hlten Zeitraum: <?php echo $price[0]; ?> € <br>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('../includes/footer.html'); // Einbinden des Footers
?>

</body>
</html>