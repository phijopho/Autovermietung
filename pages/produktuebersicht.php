<?php 
// session_start(); 
// show error messages
error_reporting(E_ALL);
ini_set('display_errors', 1);
// session_unset();
// session_destroy();
?>

<html lang="en">
<head>
<!-- include html head -->
<?php
include('../includes/htmlhead.php'); // include head
include('../includes/dbConnection.php'); // connect database
include('../includes/functions.php'); // get functions

// Sessions and variables

//Quick Search Filters: Location, pick-up date, return date
$today=date("Y-m-d");
$tomorrow=date("Y-m-d", strtotime($today . " +2 day"));
// set default values if nothing else is specified
if(!isset($_SESSION['location'], $_SESSION['pickUpDate'], $_SESSION['returnDate'])){
    $_SESSION['location']="Hamburg";
    $_SESSION['pickUpDate']=$today;
    $_SESSION['returnDate']=$tomorrow;
}

// use user input 
if (isset($_POST['quickSearch'])){
     $_SESSION['location']=$_POST['location'];
     $_SESSION['pickUpDate']=$_POST['pickUpDate'];
     $_SESSION['returnDate']=$_POST['returnDate'];
}


$location=getCities();
$categories=selectDistinctColumn("Type", "CarType");

//category checkbox filter
$checkedCategories=array();
    // if first visit on site check no boxes but select all categories
if(!isset($_SESSION['categories'])){
    $checkedCategories=array();
    $_SESSION['categories'] = $categories;
}

    // if filter is set add categories to session
if (isset($_POST['filter'])){
    $_SESSION['categories']=array();
    foreach($categories as $category){
        if (isset($_POST[$category])){
            $_SESSION['categories'][] = $category;
            $checkedCategories[]=$category;
        }
    }
    // if no categories were checked add all to session
    if(empty($_SESSION['categories'])){
        $_SESSION['categories'] = $categories;
    }
}

// car brand dropdown filter
if (isset($_POST['filter'])){
    $_SESSION['vendor']=$_POST['vendor'];
}
// seats slider filter 
if (isset($_POST['filter'])) {
    $_SESSION['seats'] = $_POST['seats'];
}

// doors slider filter
if (isset($_POST['filter'])) {
    $_SESSION['doors'] = $_POST['doors'];
}

// age slider filter
if (isset($_POST['filter'])) {
    $_SESSION['age'] = $_POST['age'];
}

// drive dropdown filter
if (isset($_POST['filter'])){
    $_SESSION['drive']=$_POST['drive'];
}

// transmission toggle filter
if (isset($_POST['filter'])) {
    // If the checkbox is checked, set the session variable to 'on', otherwise, set it to 'off'
    if (isset($_POST['transmission'])) {
        $_SESSION['transmission'] = 'on';
    } else {
        $_SESSION['transmission'] = 'off';
    }
}

// AC toggle filter
if (isset($_POST['filter'])) {
    // If the checkbox is checked, set the session variable to 'on', otherwise, set it to 'off'
    if (isset($_POST['ac'])) {
        $_SESSION['ac'] = 'on';
    } else {
        $_SESSION['ac'] = 'off';
    }
}

// GPS toggle filter
if (isset($_POST['filter'])) {
    // If the checkbox is checked, set the session variable to 'on', otherwise, set it to 'off'
    if (isset($_POST['gps'])) {
        $_SESSION['gps'] = 'on';
    } else {
        $_SESSION['gps'] = 'off';
    }
}

// Check Arrays:
//  echo "<br><br><br><br>";
//  echo "Session Categories: ";
//  print_r($_SESSION['categories']);
//  echo "<br> Checked Categories: ";
//  echo var_dump($checkedCategories);
?>

<!-- page specific head elements -->
<title>Unsere Flotte</title>
<link rel="stylesheet" href="css/styleProduktuebersicht.css">    
</head>

<?php
include('../includes/header.php'); // include header
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
                <label for="category">Fahrzeugkategorie: </label><br>
                    <?php 
                        foreach($categories as $category){
                            if(in_array($category, $checkedCategories)){
                                echo "<input type='checkbox' name=".$category." value='".$category."' checked>";
                                echo "<label for '".$category."'>".$category."</label><br>"; 
                            } else {
                                echo "<input type='checkbox' name=".$category." value='".$category."'>";
                                echo "<label for '".$category."'>".$category."</label><br>";    
                            }    
                        }
                    ?>
            </div>
            <div class="itemBox">
                <label for="vendor">Hersteller:</label><br>
                <select class="customSelect" name="vendor">
                    <?php 
                    $vendors=selectColumn("Abbreviation", "Vendor");
                    foreach($vendors as $vendor){
                        if($_SESSION['vendor'] == $vendor){
                            echo "<option value='$vendor' selected>$vendor</option>";
                        } else {
                        echo "<option value='$vendor'>$vendor</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="itemBox">
                <label for="seats">Sitze:</label><br>
                <?php
                $seats=selectMinAndMaxFromColumn("Seats", "CarType");
                $selectedSeats=5;
                if(isset($_SESSION['seats'])){
                    $selectedSeats=$_SESSION['seats'];
                }
                echo "<input type='range' min='".$seats['min']."' max='".$seats['max']."' class='slider' value='".$selectedSeats."' name='seats'>";
                //evtl mit Jquery Funktion einbauen, dass aktueller Wert angezeigt wird
                ?>
            </div>
            <div class="itemBox">
                <label for="doors">T&uuml;ren:</label><br>
                <?php
                $doors=selectMinAndMaxFromColumn("Doors", "CarType");
                $selectedDoors=5;
                if(isset($_SESSION['doors'])){
                    $selectedDoors=$_SESSION['doors'];
                }
                echo "<input type='range' min='".$doors['min']."' max='".$doors['max']."' class='slider' value='".$selectedDoors."' name='doors'>";
                //evtl mit Jquery Funktion einbauen, dass aktueller Wert angezeigt wird
                ?>
            </div>
            <div class="itemBox">
                <label for="age">Alter:</label><br>
                <?php
                $age=selectMinAndMaxFromColumn("Min_Age", "CarType");
                $selectedAge=18;
                if(isset($_SESSION['age'])){
                    $selectedAge=$_SESSION['age'];
                }
                echo "<input type='range' min='".$age['min']."' max='".$age['max']."' class='slider' value='".$selectedAge."' name='age'>";
                //Funktion einbauen, dass Slider Altersgrenzen anzeigt (18+, 21+, 25+)
                ?>
            </div>
            <div class="itemBox">
                <label for="drive">Antrieb:</label><br>
                <select class="customSelect" name="drive">
                    <option value="all">Alle auswählen</option>
                    <?php 
                    $drives=selectDistinctColumn("Drive", "CarType");
                    foreach($drives as $drive){
                        if($_SESSION['drive'] == $drive){
                            echo "<option value='$drive' selected>$drive</option>";
                        } else {
                        echo "<option value='$drive'>$drive</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="twoSidedBox">
                <label for="transmission">Nur Automatik</label>
                <label class="switch">
                    <input type="checkbox" name="transmission" 
                    <?php 
                        if (isset($_SESSION['transmission']) && $_SESSION['transmission'] == 'on') {
                                echo 'checked';
                        }
                    ?>>
                    <span class="sliderRound"></span>
                </label>
            </div>
            <div class="twoSidedBox">
                <label for="AC">Klima</label>
                <label class="switch">
                <input type="checkbox" name="ac" 
                    <?php 
                        if (isset($_SESSION['ac']) && $_SESSION['ac'] == 'on') {
                                echo 'checked';
                        }
                    ?>>                    
                    <span class="sliderRound"></span>
                </label>
            </div>
            <div class="twoSidedBox">
                <label for="gps">GPS</label>
                <label class="switch">
                <input type="checkbox" name="gps" 
                    <?php 
                        if (isset($_SESSION['gps']) && $_SESSION['gps'] == 'on') {
                                echo 'checked';
                        }
                    ?>>                    
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