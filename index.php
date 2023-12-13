<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // include functions and db connection because of different folder location as in head
    include('includes/functions.php');
    include('includes/dbConnection.php');    
    include('includes/htmlhead.php');
    ?>
    <script> src="includes/functions.js"</script>
    <script src="path/to/scrollFunction.js"></script>

    <!-- sessions and variables -->
    <?php
    $location = getCities();

    $today = date("Y-m-d");
    $tomorrow = date("Y-m-d", strtotime($today . " +2 day"));
    if (!isset($_SESSION['location'], $_SESSION['pickUpDate'], $_SESSION['returnDate'])) {
        $_SESSION['location'] = "Hamburg";
        $_SESSION['pickUpDate'] = $today;
        $_SESSION['returnDate'] = $tomorrow;
    }
    ?>

    <!-- html page specifis -->
    <link rel="stylesheet" href="css/styleHomepage.css">
    <title>SWIFT rentals</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="includes/karussell-slider.js"></script>
    <script src="includes/functions.js"></script>
</head>

<?php
include('includes/header.php'); // include header
?>
<body>
    <div class="BackgroundKia">
        <div class="section1">
            <div class="containerBookingForm">
                <form action="pages/produktuebersicht.php" method="post">
                    <label for="location">Standort:</label>
                    <select class="selectLocation" id="location" name="location">
                        <?php //aus Datenbank ziehen, außer HH
                        foreach ($location as $city) {
                            if ($_SESSION['location'] == $city) {
                                echo "<option value='$city' selected>$city</option>";
                            } else {
                                echo "<option value='$city'>$city</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for "pickUpDate">Abholdatum:</label>
                    <input type="date" name="pickUpDate" value="<?php echo $_SESSION['pickUpDate']; ?>" />
                    <label for "returnDate">R&uuml;ckgabedatum:</label>
                    <input type="date" name="returnDate" value="<?php echo $_SESSION['returnDate']; ?>" /><br><br>
                    <input type="submit" value="Suchen" name="quickSearch">
                </form>
            </div>
        </div>
    </div>
    <div id="section2" class="section2">
        <div class="cslider">
            <div class="cslider-carousel">
                <!-- Einheit 1 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php?carouselCategory=Limousine">
                        <img src="images/category images/limousine_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Limousine</h2>
                            <p> ab <?php echo getPriceForCategory('Limousine'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 2 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php?carouselCategory=Combi">
                        <img src="images/category images/combi_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Combi</h2>
                            <p> ab <?php echo getPriceForCategory('Combi'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 3 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php?carouselCategory=Cabrio">
                        <img src="images/category images/cabrio_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Cabrio</h2>
                            <p> ab <?php echo getPriceForCategory('Cabrio'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 4 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php?carouselCategory=SUV">
                        <img src="images/category images/suv_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>SUV</h2>
                            <p> ab <?php echo getPriceForCategory('SUV'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 5 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php?carouselCategory=Mehrsitzer">
                        <img src="images/category images/mehrsitzer_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Mehrsitzer</h2>
                            <p> ab <?php echo getPriceForCategory('Mehrsitzer'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 6 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php?carouselCategory=Coupe">
                        <img src="images/category images/coupe_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Coupe</h2>
                            <p> ab <?php echo getPriceForCategory('Coupe'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="cslider-controls">
                <div class="cslider-prev"></div>
                <div class="cslider-next"></div>
            </div>
        </div>
    </div>
    <div class="BackgroundAudi">
        <div class="section3">
            <div class="map-container" id="map-container">
                <div class="ger-map">
                    <img src="images/Deutschlandkarte.png" alt="map">

                    <div class="pin hamburg" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Hamburg</span>
                    </div>

                    <div class="pin berlin" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Berlin</span>
                    </div>

                    <div class="pin paderborn" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Paderborn</span>
                    </div>

                    <div class="pin rostock" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Rostock</span>
                    </div>

                    <div class="pin bielefeld" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Bielefeld</span>
                    </div>

                    <div class="pin bochum" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Bochum</span>
                    </div>

                    <div class="pin bremen" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Bremen</span>
                    </div>

                    <div class="pin dortmund" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Dortmund</span>
                    </div>

                    <div class="pin dresden" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Dresden</span>
                    </div>

                    <div class="pin freiburg" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Freiburg</span>
                    </div>

                    <div class="pin koeln" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Köln</span>
                    </div>

                    <div class="pin leipzig" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Leipzig</span>
                    </div>

                    <div class="pin muenchen" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>München</span>
                    </div>

                    <div class="pin nuernberg" onclick="window.location.href='http://localhost/Autovermietung/pages/produktuebersicht.php';">
                        <span>Nürnberg</span>
                    </div>
                </div>
            </div>
            <div class="aboutUs">
                <div class="txtBox1">
                    <h1>12 Standorte</h1>
                </div>
                <div class="txtBox2">
                    <h1>64 Modelle</h1>
                </div>
                <div class="txtBox3">
                    <h1>256 Mietwagen</h1>
                </div>
                <div class="txtBox4">
                    <h2>Erfahren Sie mehr -></h2>
                </div>

            </div>
        </div>
    </div>
</body>
<?php
include('includes/footer.html');
?>

</html>