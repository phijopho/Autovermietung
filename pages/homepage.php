<?php 
session_start();

include('./includes/functions.php');
$location=getCities();

$today=date("Y-m-d");
$tomorrow=date("Y-m-d", strtotime($today . " +2 day"));

if(!isset($_SESSION['location'], $_SESSION['pickUpDate'], $_SESSION['returnDate'])){
    $_SESSION['location']="Hamburg";
    $_SESSION['pickUpDate']=$today;
    $_SESSION['returnDate']=$tomorrow;
}
?>

<div class="BackgroundAudi">
    <div class="divContentContainer">
        <div class="containerBookingForm">
            <form action="pages/produktuebersicht.php" method="post"> 
                <label for="location">Standort:</label>
                    <select id="location" name="location">
                        <?php //aus Datenbank ziehen, außer HH
                        foreach ($location as $city) {
                            if ($_SESSION['location'] == $city) {
                                echo "<option value='$city' selected>$city</option>";
                            } else {
                                echo "<option value='$city'>$city</option>";
                            }
                        }
                        ?>
                    </select>
                <label for "pickUpDate">Abholdatum:</label>
                    <input type="date" name="pickUpDate" value="<?php echo $_SESSION['pickUpDate']; ?>" />
                <label for "returnDate">R&uuml;ckgabedatum:</label>
                    <input type="date" name="returnDate" value="<?php echo $_SESSION['returnDate']; ?>" /><br><br>
                <input type="submit" value="Suchen" name="quickSearch">
            </form>
        </div>

        <div class="divAboutUs">
            <div class="divGoal1">
                <p> Every single detail of  SWIFT rentals  is
                    measured against our continuing goal: to
                    enhance costumer enjoyment.
                </p>
            </div>

            <div class="divGoal2">
                <p> Every single detail of  SWIFT rentals  is
                    measured against our continuing goal: to
                    enhance costumer enjoyment.
                </p>
            </div>

            <div class="divGoal3">
                <p> Every single detail of  SWIFT rentals  is
                    measured against our continuing goal: to
                    enhance costumer enjoyment.
                </p>
            </div>

            <div class="divGoal4">
                <p> Every single detail of  SWIFT rentals  is
                    measured against our continuing goal: to
                    enhance costumer enjoyment.
                </p>
            </div>
            <br>
            <!-- When click on button, then AboutUs page opens -->
            <div class="divbutton">
                <a href="http://localhost/Autovermietung/pages/aboutus.php" class="button">Discover more</a>
            </div>
            
        </div>
    </div>
</div>