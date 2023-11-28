<!DOCTYPE html>
<html lang="en">

<head>
<?php 
include('includes/dbConnection.php');
include("./includes/functions.php");
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Einbinden der style.css -->
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/styleHomepage.css">
    <title>SWIFT rentals</title>
    <base href="/Autovermietung/">

</head>


</head>
<body>

<div class="BackgroundAudi"> 
    <div class="divContentContainer">
        <!-- <div class="divBookingForm"> -->
            <div class="containerBookingForm">
                <!-- <h1>Buchung</h1> -->
                <h1>Buchung</h1>
                    <?php 
                    $pickUpLocation = array("Hamburg");
                    $default="Hamburg";
                    $stmtGetCities = $conn->prepare("SELECT City FROM Location WHERE City!=:cityIdent");
                    $stmtGetCities->bindParam(':cityIdent', $default);
                    $stmtGetCities->execute();
                    while($row = $stmtGetCities->fetch()){
                        $pickUpLocation[] = $row['City'];
                    }
                    ?>
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


    <div class="divModels">

        <div class="gallery">
            <?php 
            $type=array("Cabrio", "Combi", "Mehrt&uuml;rer");
            for ($i=1; $i<=6; $i++){
                echo "<div class='imageContainer'>";
                    echo "<img src='images/cabrio-mercedes-benz-2845333_1920.png' alt='Bild 1'>";
                        echo "<div class='caption'>";
                        $MinPrice=getMinMaxPrice($type[$i-1]);
                        echo $type[$i-1]." ab: ".$MinPrice['min']." &euro;";
                        echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div> 

</div>
</div>

</body>

</html>
