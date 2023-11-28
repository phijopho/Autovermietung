<?php 
include('./includes/functions.php');
$location=getCities();
?>

<div class="BackgroundAudi">
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
</div>