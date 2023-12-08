<?php 
session_start(); 
// show error messages
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
// session_unset();
// session_destroy();
?>
// Änderung

<html lang="en">
<head>
<!-- include html head -->
<?php
include('../includes/htmlhead.php'); // include head
include('../includes/dbConnection.php'); // connect database
include('../includes/functions.php'); // get functions

// Sessions and variables
// Reset filters (except location and date)
if (isset($_POST['resetButton'])) {
    unset($_SESSION['categories']);
    unset($_SESSION['vendor']);
    unset($_SESSION['seats']);
    unset($_SESSION['doors']);
    unset($_SESSION['age']);
    unset($_SESSION['drive']);
    unset($_SESSION['transmission']);
    unset($_SESSION['ac']);
    unset($_SESSION['gps']);
}

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
    // if first visit on site check no boxes but select all categories
if(!isset($_SESSION['categories']) OR empty($_SESSION['categories'])){
    $_SESSION['checkedCategories']=array();
    $_SESSION['categories'] = $categories;
}

    // if filter is set add categories to session
if (isset($_POST['filter'])){
    $_SESSION['categories']=array();
    foreach($categories as $category){
        if (isset($_POST[$category])){
            $_SESSION['categories'][] = $category;
            $_SESSION['checkedCategories'][]=$category;
        }
    }
    // if no categories were checked add all to session
    if(empty($_SESSION['categories'])){
        $_SESSION['categories'] = $categories;
        $_SESSION['checkedCategories']=array();
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

    // sort
    // default
if (!isset($_SESSION['sort'])){
    $_SESSION['sort']="alphabetic";
}
    // use user input
if (isset($_POST["sort"])) {
    $_SESSION["sort"] = $_POST["sort"];
}

// Check Arrays:
// echo "<br><br><br><br>";
// echo getResultsQuery();
// echo "Session Categories: ";
// print_r($_SESSION['categories']);
// echo "<br> Checked Categories: ";
// echo var_dump($_SESSION['checkedCategories']);
// print_r($_SESSION);
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
    <div class="filterBox">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>" id="filter">
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
                            if(in_array($category, $_SESSION['checkedCategories'])){
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
                    <option value="all">Alle auswählen</option>
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
                $selectedSeats=2;
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
                $selectedDoors=2;
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
                $selectedAge=25;
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
                            if($drive=='Combuster'){
                                $driveGerman='Verbrenner';
                            }elseif($drive=='Electric'){
                                $driveGerman='Elektro';
                            }
                            echo "<option value='$drive' selected>$driveGerman</option>";
                        } else {
                            if($drive=='Combuster'){
                                $driveGerman='Verbrenner';
                            }elseif($drive=='Electric'){
                                $driveGerman='Elektro';
                            }
                            echo "<option value='$drive'>$driveGerman</option>";
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
            <br>
            <input type="submit" value="Filtern" name="filter">
        </form>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">     
            <input type="submit" value="Filter zurücksetzen" name="resetButton"> 
        </form>
    </div>

    <div class="resultBox">
        <div class="topBox">
            <label for="available">Verf&uuml;gbare Fahrzeuge: 10</label>
            <div class="sortBox">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>" id="sortForm">
                    <label for="sort" >Sortierung: </label>
                    <select class="customSelectSort" name="sort" onchange="submitForm()">
                        <option value="alphabetic"
                        <?php 
                            if($_SESSION['sort']=='alphabetic'){
                                echo "selected";
                            }
                        ?>
                        >Alphabetisch</option>
                        <option value="priceAscending"
                        <?php 
                            if($_SESSION['sort']=='priceAscending'){
                                echo "selected";
                            }
                        ?>
                        >Preis aufsteigend</option>
                        <option value="priceDescending"
                        <?php 
                            if($_SESSION['sort']=='priceDescending'){
                                echo "selected";
                            }
                        ?>
                        >Preis absteigend</option>
                    </select>
                </form>
                <!-- Use JS event handler to submit form whenever sort is changed -->
                <script>
                    function submitForm(){
                        document.getElementById("sortForm").submit();
                    }
                </script>
            </div>
        </div>
        <?php
        $stmt = getResultsQuery();
        displayResults($stmt);
        ?>
    </div>
</div>
<?php
include('../includes/footer.html'); // Einbinden des Footers
?>

</body>
</html>
