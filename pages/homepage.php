<?php 
include('dbConnection.php');

$pickUpLocation=array("Hamburg");
$stmtGetCities = $conn->query("SELECT City FROM Location");
while($row = $stmtGetCities->fetch()){
    $pickUpLocation[]=$row;
}
?>

<div class="BackgroundAudi">
    <div class="containerBookingForm">
        <h1>Buchung</h1>
        <form action="produktuebersichtsseite.php" method="post">
            <label for="Abholort">Abholort:</label>
                <select id="Abholort" name="Abholort">
                <?php //aus Datenbank ziehen, außer HH
                foreach($pickUpLocation as $city){
                    echo "<option value=".$city.">$city</option>";
                }?>
                </select>
            
            
        </form>
    </div>
</div>
