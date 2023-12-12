<?php 
    session_start(); 
    include('../includes/functions.php');
    // show error messages
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if(isset($_GET['carType_ID'])) {
        // CarType ID
        $_SESSION['carType_ID']=$_GET['carType_ID'];
        // Availabe Cars of that type
        $stmt=getAvailableCarsForModelQuery($_SESSION['carType_ID']);
        $_SESSION['availableCarsModel']=getAvailableCarsForModel($stmt);
    } else {
        echo "Ungültige Abfrage";
    }


    // checks
    echo "<br> <br>";
    echo "CarType_ID from Session: ".$_SESSION['carType_ID'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('../includes/htmlhead.php');
    ?>
    <link rel="stylesheet" href="css/styleProduktdetailseite.css">
    <script src="includes/functions.js"></script> 
    <title>Produktdetails</title> 
</head>
<header>
<?php
    include('../includes/header.php'); // Einbindung des Headers
?>
</header> 

<body>
<?php
    // get car infos
    $model=getModel($_SESSION['carType_ID']);
?>
<div class="divbody">
    <div class="divgallery">
        <h1> <?php echo $model[0]." ".$model[1]; ?></h1>

        <div class="foto">
            <?php
                $carInfo = getCarInfo($_SESSION['carType_ID']);
                echo $carInfo['image']; 
    
            ?>  
            <!-- create button with triangle -->
            <button class="buttonToggle" onclick="togglemenu()">&#9660;</button>
        
            <div class="desc" id="desc">
                <table>
                    <tr>
                        <th>Fahrzeugtyp</th>
                        <td><?php echo $carInfo['type']; ?></td>
                        <th>Getriebe</th>
                        <td>
                            <?php
                                echo $carInfo['gear'];  
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Anzahl Sitze</th>
                        <td>    
                            <?php
                                echo $carInfo['seats'];  
                            ?>
                        </td>
                        <th>GPS</th>
                        <td>
                            <?php
                                echo $carInfo['gps'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Anzahl Türen</th> 
                        <td>
                            <?php
                                echo $carInfo['doors'];
                            ?>
                        </td>
                        <th>Klimaanlage</th>
                        <td>
                            <?php
                                echo $carInfo['airCondition'];
                            ?>
                        </td>    
                    </tr>
                </table>
                </div>
            </div>
    </div>
    <div class="divinfo">
        <div class="divText">
            <h2> Zusammenfassung </h2><br>
            <h3>Ihr ausgewählter Zeitraum: </h3>
            <p><?php echo formatDate($_SESSION['pickUpDate']) ?> bis <?php echo formatDate($_SESSION['returnDate']) ?></p>
            <h3> Standort des Fahrzeugs: </h3> <p> <?php echo $_SESSION['location'] ?> </p>
            <h3>Mindestalter: </h3><p> <?php echo getCarProperty($_SESSION['carType_ID'], 'Min_Age') ?></p>
            <h3>Preis pro Tag: <?php $price=getCarProperty($_SESSION['carType_ID'], 'Price'); echo number_format($price, 2, ',', '.'); ?> &euro;</h3>
            <br>
            <h3>Gesamtpreis: <?php $totalPrice=getTotalPrice($price); echo number_format($totalPrice, 2, ',', '.') ?> &euro;</h3>
            <p>Von diesem Modell sind nur noch<?php  echo " ".$_SESSION['availableCarsModel']; ?> Autos in Ihrem gewählten Zeitraum verfügbar</p>
        </div>
    </div>
    
    <!-- User is Old enough and signed in. -->
    <div class="divbutton">
            <a href="pages/meineBuchungen.php" class="button">Jetzt Buchen</a>
    </div>
</div>

</body>

<footer>
<?php 
    include('../includes/footer.html'); // Einbindung des Footers
?>
</footer>
</html>
 
