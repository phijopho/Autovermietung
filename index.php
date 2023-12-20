<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('includes/htmlhead.php');
    include('includes/dbConnection.php'); // connect database
    include('./includes/functions.php');
    ?>
    <title>Homepage</title>
    <!-- Einbinden der style.css -->
    <link rel="stylesheet" href="css/styleHomepage.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="includes/karussell-slider.js"></script>
    <script src="includes/functions.js"></script>
</head>


<?php
include('includes/header.php'); // include header
?>

<body>

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

    <div class="BackgroundKia">
        <div class="section1">
            <div class="containerBookingForm">
                <form action="pages/produktuebersicht.php" method="post" class="formContainer">
                    <select class="selectLocation" id="location" name="location">
                        <?php //aus Datenbank ziehen, außer HH
                        foreach ($location as $city) {
                            if ($_SESSION['location'] == $city) {
                                echo "<option value='$city' selected>$city</option>";
                            } else {
                                echo "<option value='$city'>$city</option>";
                            }
                        }
                        $_SESSION['location'] = "Hamburg";
                        ?>
                    </select>
                    <input type="date" name="pickUpDate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $_SESSION['pickUpDate']; ?>" oninput="setMinReturnDate()" id="pickUpDate"/>
                    <span class="dateArrow">&#8594;</span>
                    <input type="date" name="returnDate" value="<?php echo $_SESSION['returnDate']; ?>" id="returnDate"/>
                    <input type="submit" value="Suchen" name="quickSearch">
                </form>
            </div>
            <!-- Anker for scrolling from header -->
            <div id="anker"></div>
        </div>
    </div>
    <script>
        setMinReturnDate(); // calling function on page load to avoid irregular return date when pick up date isnt changed
    </script>
    <div class="section2">
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
        <div class="section3" id="section3">
            <div class="map-container">
                <div class="ger-map">
                    <img src="images/Deutschlandkarte.png" alt="map">

                    <div class="pin hamburg" onclick="submitFormWithCity('Hamburg');">
                        <span>Hamburg</span>
                    </div>

                    <div class="pin berlin" onclick="submitFormWithCity('Berlin');">
                        <span>Berlin</span>
                    </div>

                    <div class="pin paderborn" onclick="submitFormWithCity('Paderborn');">
                        <span>Paderborn</span>
                    </div>

                    <div class="pin rostock" onclick="submitFormWithCity('Rostock');">
                        <span>Rostock</span>
                    </div>

                    <div class="pin bielefeld" onclick="submitFormWithCity('Bielefeld');">
                        <span>Bielefeld</span>
                    </div>

                    <div class="pin bochum" onclick="submitFormWithCity('Bochum');">
                        <span>Bochum</span>
                    </div>

                    <div class="pin bremen" onclick="submitFormWithCity('Bremen');">
                        <span>Bremen</span>
                    </div>

                    <div class="pin dortmund" onclick="submitFormWithCity('Dortmund');">
                        <span>Dortmund</span>
                    </div>

                    <div class="pin dresden" onclick="submitFormWithCity('Dresden');">
                        <span>Dresden</span>
                    </div>

                    <div class="pin freiburg" onclick="submitFormWithCity('Freiburg');">
                        <span>Freiburg</span>
                    </div>

                    <div class="pin koeln" onclick="submitFormWithCity('Koeln');">
                        <span>Köln</span>
                    </div>

                    <div class="pin leipzig" onclick="submitFormWithCity('Leipzig');">
                        <span>Leipzig</span>
                    </div>

                    <div class="pin muenchen" onclick="submitFormWithCity('Muenchen');">
                        <span>München</span>
                    </div>

                    <div class="pin nuernberg" onclick="submitFormWithCity('Nuernberg');">
                        <span>Nürnberg</span>
                    </div>
                </div>
            </div>
            <div class="aboutUs">
                <div class="txtBox1">
                    <h1>14 Standorte</h1>
                </div>
                <div class="txtBox2">
                    <h1>64 Modelle</h1>
                </div>
                <div class="txtBox3">
                    <h1>230 Mietwagen</h1>
                </div>
                <a href="pages/aboutus.php">
                    <div class="txtBox4">
                        <h2>Erfahren Sie mehr</h2>
                    </div>
                </a>

            </div>
        </div>
    </div>
</body>

<script>
    function submitFormWithCity(city) {
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "http://localhost/Autovermietung/pages/produktuebersicht.php";

        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "selectedLocation";
        input.value = city;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
</script>

<?php
include('includes/footer.html');
?>

</html>