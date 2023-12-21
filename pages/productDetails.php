<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include('../includes/htmlhead.php'); ?>

    <!-- sessions and variables -->
    <?php
    if (isset($_GET['carType_ID'])) {
        // CarType ID
        $_SESSION['carType_ID'] = $_GET['carType_ID'];
        // Availabe Cars of that type
        $_SESSION['availableCarsModel'] = getAvailableCarsForModel($_SESSION['carType_ID']);
    } else {
        echo "Ung&uuml;ltige Abfrage";
    }
    ?>
    
    <title>Produktdetails: <?php $model = getModel($_SESSION['carType_ID']); echo $model[0] . ' ' . $model[1]; ?></title>

    <!-- html page specifics -->
    <link rel="stylesheet" href="css/styleProductDetails.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <script src="includes/functions.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="includes/karussell-slider.js"></script>
    <!-- <link rel="stylesheet" href="css/styleHomepage.css"> -->


</head>

<?php
include('../includes/header.php'); // Einbindung des Headers
?>

<body>
    <?php
    // get car infos
    $model = getModel($_SESSION['carType_ID']);

    ?>
    <!-- back to overview button -->
    <div class="buttonBackContainer">
        <a href="./pages/productOverview.php" class="buttonBack">Zur&uuml;ck zur Produkt&uuml;bersicht</a>
    </div>
    <br>
    <div class="divbody">
        <div class="divgallery">
            <h1> <?php echo $model[0] . " " . $model[1]; ?></h1>

            <div class="foto">
                <?php
                $carInfo = getCarInfo($_SESSION['carType_ID']);
                echo $carInfo['image'];

                ?>
                <!-- text above toggle button -->
                <div class="toggleText"> Modellinformationen einblenden</div>
                <!-- triangle button -->
                <button class="buttonToggle" onclick="togglemenu()">&#9660;</button>
                <!-- content of toggle menu -->
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
                            <th>Anzahl T&uuml;ren</th>
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
        <!-- box on the right side with selected dates and prices -->
        <div class="divinfo">
            <div class="divText">
                <h2> Zusammenfassung </h2><br>
                <h3>Ihr ausgew&auml;hlter Zeitraum: </h3>
                <p><?php echo formatDate($_SESSION['pickUpDate']) ?> bis <?php echo formatDate($_SESSION['returnDate']) ?></p>
                <?php
                    if($_SESSION['availableCarsModel']==0){
                        echo "<h3> Standort: </h3>";
                        echo "<p>";
                            $locations=getCarLocations($_SESSION['carType_ID']); 
                            echo implode(', ',$locations); 
                        echo "</p>";
                    } else {
                        echo "<h3> Ihr ausgew&auml;hlter Standort: </h3>";
                        echo "<p>".$_SESSION['location']."</p>";      
                    }
                ?>
                <h3>Mindestalter: </h3>
                <p> <?php $minAge = getCarProperty($_SESSION['carType_ID'], 'Min_Age');
                    echo $minAge; ?></p>
                <h3>Preis pro Tag: <?php $price = getCarProperty($_SESSION['carType_ID'], 'Price');
                                    echo number_format($price, 2, ',', '.'); ?> &euro;</h3>
                <h3>Gesamtpreis: <?php $totalPrice = getTotalPrice($price);
                                    echo number_format($totalPrice, 2, ',', '.') ?> &euro;</h3>
                <?php
                    if ($_SESSION['availableCarsModel'] == 0) {
                        echo "<p> Dieses Modell ist in " . $_SESSION['location'] . " im gew&auml;hlten Zeitraum nicht verf&uuml;gbar. </p>";
                    } elseif ($_SESSION['availableCarsModel'] == 1) {
                        echo "<p> Von diesem Modell ist in " . $_SESSION['location'] . " nur noch 1 verf&uuml;gbar.</p>";
                    } else {
                        echo "<p>Von diesem Modell sind nur noch " . $_SESSION['availableCarsModel'] . " Autos in Ihrem gew&auml;hlten Zeitraum verf&uuml;gbar. </p>";
                    }
                ?>
            </div>
        </div>

<!-- php and html for different buttons (if user is logged-in, not old enough or if user can book) -->
        <?php
            if ($_SESSION['availableCarsModel'] > 0) {
                if (isset($_SESSION['User_ID'])) {
                    $UserAge = getUserAge();
                    if ($UserAge < $minAge) {
                        echo "<div class='divbutton'>";
                        echo "<div class='buttonNotOldEnough'>Altersbeschr&auml;nkung</div>";
                        echo "</div>";
                    } else { ?>
                <div class='divbutton'>
                    <button class='button' onclick='displayModal()'>Jetzt Buchen</button>
                </div>
            
                <!-- Modalbox -->
                <div id='myModal' class='modal' style='display: none;'>
                    <div class='modal-content'>
                        <span class='close' onclick='closeModal()'> <h1>&times; </h1></span>
                            <br>
                                <h3 class="booking-title">Bitte bestätigen Sie folgende Buchung:</h3>
                                <p class="booking-details"><?php echo $model[0]." ".$model[1]." vom ".formatDate($_SESSION['pickUpDate'])." bis ".formatDate($_SESSION['returnDate'])." für ".number_format($totalPrice, 2, ',', '.')." &euro;. ";?></p>
                            <br>
                        <!-- bookingform shown in modal -->
                        <form id='bookingForm' class="modalForm" action='pages/myBookings.php' method='post'>
                            <div class="buttondiv">
                                <input type='hidden' name='carType_ID' value='<?php echo $_SESSION['carType_ID'] ?>'>
                                <input type='submit' class='buttonModal' value='Jetzt Buchen' name='addBooking'>
                            </div>
                            <div class="buttonModalLink">
                                <a href='./pages/productDetails.php'>Buchung abbrechen</a>
                            </div>
                        </form>                
                    </div>                
                </div>
                <!-- button if user is not signed in with redirect to login page -->
            <?php }
            } else {
                echo "<div class='divbutton'>";
                echo "<a href='pages/login.php?carType_ID_Login=".$_SESSION['carType_ID']."'>";
                echo "<div class='buttonNotSignedIn'>Bitte anmelden</div>";
                echo "</a>";
                echo "</div>";
            }
        // button if car is not available anymore
        } else {
            echo "<div class='divbutton'>";
            echo "<div class='buttonNotOldEnough'>Nicht verf&uuml;gbar</div>";
            echo "</div>";
        }
        ?>
    </div>
    <!-- slider with similar models to selected car. Always shows cars of the same Type -->
    <div class="similarModels">
        <h1 class="similarModels">Verwandte Autos zu dieser Buchung</h1>
    </div>
    
    <!-- <div id="section2" class="section2"> -->
    <div class="cslider">

        <div class="cslider-carousel">
            <?php
            // check category in session
            $category = $carInfo['type'];

            // prepare SQL-statemet, so select cars of a distinct type
            $query = $conn->prepare("SELECT CarType_ID, Name, Image, Price FROM CarType WHERE Type = :category");
            $query->bindParam(':category', $category);

            // execute SQL-statement
            $query->execute();

            // // Get results
            // $result = $query->get_result();

            // dynamic carousel, get model and price
            while ($row = $query->fetch()) {
                $modelInfo = getModel($row['CarType_ID']);
                echo '<div class="cslider-item">';
                echo "<a href='pages/productDetails.php?carType_ID=" . $row['CarType_ID'] . "'>";
                    showImage($row['CarType_ID']);
                echo '<div class="cslider-text">';
                echo '<h2>' . htmlspecialchars($modelInfo[0]) . ' ' . htmlspecialchars($modelInfo[1]) . '</h2>';
                echo '<p> ab ' . $row['Price'] . ' €</p>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
        <!-- prev. and next buttons within slider -->
        <div class="cslider-controls">
            <div class="cslider-prev"></div>
            <div class="cslider-next"></div>
        </div>
    </div>
    <script>
        cSlider();
    </script>
</body>

<?php
include('../includes/footer.html');
?>

</html>