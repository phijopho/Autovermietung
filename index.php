<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Include necessary PHP files
    include('includes/htmlheadindex.php'); 
    include('includes/dbConnection.php'); // connect to database
    include('./includes/functions.php');
    ?>
    <title>Homepage</title>
    <!-- external CSS files for styling --> 
    <link rel="stylesheet" href="css/styleHomepage.css">
    <link rel="stylesheet" href="css/styleFooter.css">
     <!-- jQuery library for Carousel functionality -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="includes/functions.js"></script>
</head>


<?php
include('includes/header.php'); // include header
?>

<body>
    <?php 
        displayLogoutSuccess();
    ?>
    
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
    <!-- Section 1 with booking form -->
    <div class="BackgroundKia">
        <div class="section1">
            <div class="containerBookingForm">
                 <!-- Booking form -->
                <form action="pages/productOverview.php" method="post" class="formContainer">
                    <!-- Location selection dropdown -->
                    <select class="selectLocation" id="location" name="location">
                        <?php 
                        // Populate options from the database, excluding Hamburg
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
                    <!-- Date pickers for pick-up and return dates -->
                    <input type="date" name="pickUpDate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $_SESSION['pickUpDate']; ?>" oninput="setMinReturnDate()" id="pickUpDate" required/>
                    <span class="dateArrow">&#8594;</span>
                    <input type="date" name="returnDate" value="<?php echo $_SESSION['returnDate']; ?>" id="returnDate" required/>
                     <!-- Search button -->
                    <input type="submit" value="Suchen" name="quickSearch">
                </form>
            </div>
            <!-- Anchor for smooth scrolling from header -->
            <div id="anker"></div>
        </div>
    </div>
    <!-- Promotional call-to-action section -->
    <div class="call">
        <h1>ECONOMY BEZAHLEN.<br>PREMIUM AUTOS MIETEN.</h1>
    </div>
    <!-- JavaScript to set minimum return date -->
    <script>
        setMinReturnDate(); // calling function on page load to avoid irregular return date when pick up date isnt changed
    </script>
    <!-- Section 2 with Car category slider  -->
    <div class="section2">
        <div class="cslider">
            <div class="cslider-carousel">
                <!-- Item 1 -->
                <div class="cslider-item">
                    <a href="pages/productOverview.php?carouselCategory=Limousine">
                        <img src="images/category images/limousine_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Limousine</h2>
                            <p> ab <?php echo getPriceForCategory('Limousine'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Item 2 -->
                <div class="cslider-item">
                    <a href="pages/productOverview.php?carouselCategory=Combi">
                        <img src="images/category images/combi_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Combi</h2>
                            <p> ab <?php echo getPriceForCategory('Combi'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Item 3 -->
                <div class="cslider-item">
                    <a href="pages/productOverview.php?carouselCategory=Cabrio">
                        <img src="images/category images/cabrio_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Cabrio</h2>
                            <p> ab <?php echo getPriceForCategory('Cabrio'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Item 4 -->
                <div class="cslider-item">
                    <a href="pages/productOverview.php?carouselCategory=SUV">
                        <img src="images/category images/suv_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>SUV</h2>
                            <p> ab <?php echo getPriceForCategory('SUV'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Item 5 -->
                <div class="cslider-item">
                    <a href="pages/productOverview.php?carouselCategory=Mehrsitzer">
                        <img src="images/category images/mehrsitzer_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Mehrsitzer</h2>
                            <p> ab <?php echo getPriceForCategory('Mehrsitzer'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
                <!-- Item 6 -->
                <div class="cslider-item">
                    <a href="pages/productOverview.php?carouselCategory=Coupe">
                        <img src="images/category images/coupe_aqua.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h2>Coupe</h2>
                            <p> ab <?php echo getPriceForCategory('Coupe'); ?> &euro;</p>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Carousel controls -->
            <div class="cslider-controls">
                <div class="cslider-prev"></div>
                <div class="cslider-next"></div>
            </div>
        </div>
    </div>
    <!-- Section 3 with interactive map and site information -->
    <div class="BackgroundAudi">
        <div class="section3" id="section3">
            <div class="map-container">
                <div class="ger-map">
                    <img src="images/Deutschlandkarte.png" alt="map">
                    <!-- Map pins with onclick event to submit form with selected city -->
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
            <!-- About Us section with brief site statistics and a link to learn more -->
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
                    <div class="txtBox4">
                    <a href="pages/aboutus.php">

                        <h2>Erfahren Sie mehr</h2>
                        </a>

                    </div>

            </div>
        </div>
    </div>
</body>

<!-- JavaScript function to submit form with selected city from the map -->
<script>
    function submitFormWithCity(city) {
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "http://localhost/Autovermietung/pages/productOverview.php";

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
// Include the footer component
include('includes/footer.html');
?>

</html>