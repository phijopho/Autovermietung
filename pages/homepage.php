<?php 
session_start();
include('./includes/functions.php');
$location=getCities();

$today=date("d.m.Y");
$tomorrow=date("d.m.Y", strtotime($today . " +1 day"));

$_SESSION["location"]="Hamburg";
$_SESSION["pickUpDate"]=$today;
$_SESSION["returnDate"]=$tomorrow;

if (isset($_REQUEST['quickSearch'])){
    $_SESSION['location']=$_REQUEST['location'];
    $_SESSION['pickUpDate']=$_REQUEST['pickUpDate'];
    $_SESSION['returnDate']=$_REQUEST['returnDate'];
}
?>

<div class="BackgroundAudi">
    <div class="divContentContainer">
        <div class="containerBookingForm">
            <form action="pages/produktuebersicht.php" method="post"> 
                <label for="location">Standort:</label>
                    <select id="location" name="Standort">
                        <?php //aus Datenbank ziehen, außer HH
                        foreach($location as $city){
                            echo "<option value='$city'>$city</option>";
                        }
                        ?>
                    </select>
                <label for "pickUpDate">Abholdatum:</label>
                    <input type="date" name="pickUpDate" value="<?php echo date('Y-m-d'); ?>" />
                <label for "returnDate">R&uuml;ckgabedatum:</label>
                    <input type="date" name="returnDate" value="<?php echo date('Y-m-d'); ?>" /><br><br>
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