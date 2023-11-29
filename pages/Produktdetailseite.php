<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Einbinden der Schriftart -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <!-- Einbinden der style.css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleProduktdetailseite.css">
    <title>Unsere Flotte</title> 
</head>
 
<body>
<?php
include('../includes/header.html'); // Einbindung des Headers
?>

<div class="divbody">
    <div class="divgallery">
        <h1>"Fahrzeugmodell"</h1>
        <div class="foto">
  
        <img src="images/cabrio-mercedes-benz-2845333_1920.png" alt="Auto">
            <div class="desc">
                <h2>Vollständige Fahrzeugdaten</h2>
                <table>
                    <tr>
                        <th>Fahrzeugtyp</th>
                        <td>"Variable"</td>
                        <th>Getriebe</th>
                        <td>"Variable"</td>
                    </tr>
                    <tr>
                        <th>Anzahl Sitze</th>
                        <td>"Variable"</td>
                        <th>GPS</th>
                        <td>"Variable"</td>
                    </tr>
                    <tr>
                        <th>Anzahl Türen</th> 
                        <td>"Variable"</td>
                        <th>Klimaanlage</th>
                        <td>"Variable"</td>    
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="divInfo">
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
                <label for="Abholort">Abholort: </label> <br>
                    <select id="Abholort" name="Abholort">
                        <?php //aus Datenbank ziehen, außer HH
                        foreach($pickUpLocation as $city){
                        echo "<option value='$city'>$city</option>";
                        }
                        ?>
                        
                    </select>
                    <br>
                    <br>
                <label for "Abholdatum">Abholdatum:  </label> 
                    <input type="date" name="Abholdatum " value="<?php echo date('Y-m-d'); ?>" />
                    <br><br><label for "Rueckgabedatum">R&uuml;ckgabedatum: </label> <br>
                    <input type="date" name="Rueckgabedatum " value="<?php echo date('Y-m-d'); ?>" /><br><br>
                    <br><input type="submit" value="Suchen">
            </form>
        </div>

        <div class="divText">
            <h3>Inklusivkilometer: 400 km | Zusatzkilometer: 0,27 € / km</h3>
            <br>
            <h3>INKLUSIVE: </h3> <br>
            <p>Basic-Schutzpaket: </p>
            <p>Selbstbeteiligung: 950,00 € </p>
            <p>Vollkaskoschutz </p>
            <p>Diebstahlschutz </p>
        </div>

    </div>
</div>

<?php include('../includes/footer.html'); // Einbindung des Footers
?>
</body>
</html>
 
 