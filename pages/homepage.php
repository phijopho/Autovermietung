<?php 
include('dbConnection.php');

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
        <form action="produktuebersichtsseite.php" method="post">
            <label for="Abholort">Abholort:</label>
                <select id="Abholort" name="Abholort">
                    <?php //aus Datenbank ziehen, außer HH
                    foreach($pickUpLocation as $city){
                        echo "<option value='$city'>$city</option>";
                    }
                    ?>
                </select>
            <label for "Abholdatum">Abholdatum:</label>
                <input type: "date" id="Abholdatum" name="Abholdatum">
        </form>
    </div>
</div>

<!-- <div class="BackgroundAudi">
    <div class="containerBookingForm">
        <h1>Buchung</h1>
        <form action="#" method="post">
            <label>Abholort:</label>
            <select name="pickup-location">
                <option value="Hamburg">Hamburg</option>
                <option value="Berlin">Berlin</option>
                <option value="München">München</option>
            </select>
            <label>Abholdatum</label>
            <input type="date" name="pickup-date" value="
            <label>Rückgabedatum</label>
            <input type="date" name="return-date" value="
            <button type="button">Mietwagen suchen</button>
        </form>
    </div>
</div> -->
