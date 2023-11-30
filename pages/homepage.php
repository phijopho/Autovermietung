<?php 
include('./includes/functions.php');
$location=getCities();
?>

<div class="BackgroundAudi">
    <div class="divContentContainer">
        <div class="containerBookingForm">
            <!-- <h1>Buchung</h1> -->
            <!-- Link zur Produktübersichtseite statt index -->
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
                <input type="submit" value="Suchen">
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