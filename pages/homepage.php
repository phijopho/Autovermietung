<?php 
include('../includes/dbConnection.php');

$pickUpLocation = array("Hamburg");
$default="Hamburg";
$stmtGetCities = $conn->prepare("SELECT City FROM Location WHERE City!=:cityIdent");
$stmtGetCities->bindParam(':cityIdent', $default);
$stmtGetCities->execute();
while($row = $stmtGetCities->fetch()){
    $pickUpLocation[] = $row['City'];
}
?>

<div class="BackgroundAudi">
    <div class="containerBookingForm">
        <!-- <h1>Buchung</h1> -->
        <!-- Link zur Produktübersichtseite statt index -->
        <form action="./index.php" method="post"> 
            <label for="Abholort">Abholort:</label>
                <select id="Abholort" name="Abholort">
                    <?php //aus Datenbank ziehen, außer HH
                    foreach($pickUpLocation as $city){
                        echo "<option value='$city'>$city</option>";
                    }
                    ?>
                </select>
            <label for "Abholdatum">Abholdatum:</label>
                <input type="date" name="Abholdatum" value="<?php echo date('Y-m-d'); ?>" />
            <label for "Rueckgabedatum">R&uuml;ckgabedatum:</label>
                <input type="date" name="Rueckgabedatum" value="<?php echo date('Y-m-d'); ?>" /><br><br>
            <input type="submit" value="Suchen">
        </form>
    </div>
</div>