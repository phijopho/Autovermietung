<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include('includes/htmlhead.php');
            include('includes/dbConnection.php'); // connect database
            include('./includes/functions.php');

        ?>
        <!-- Einbinden der style.css -->
        <link rel="stylesheet" href="css/styleHomepage.css">

        <title>SWIFT rentals</title>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="includes/karussell-slider.js"></script>

        <?php 
            session_start();

            $location=getCities();

            $today=date("Y-m-d");
            $tomorrow=date("Y-m-d", strtotime($today . " +2 day"));
            if(!isset($_SESSION['location'], $_SESSION['pickUpDate'], $_SESSION['returnDate'])){
                $_SESSION['location']="Hamburg";
                $_SESSION['pickUpDate']=$today;
                $_SESSION['returnDate']=$tomorrow;
            }
        ?>

    </head>
    <?php
         include('includes/header.html'); // include header
    ?>
    <body>
    <div class="BackgroundKia">
    
            <div class="section1">
                <div class="containerBookingForm">
                    <form action="pages/produktuebersicht.php" method="post"> 
                        <label for="location">Standort:</label>
                            <select id="location" name="location">
                                <?php //aus Datenbank ziehen, außer HH
                                foreach ($location as $city){
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
    <div class="section2">
        <div class="cslider">
            <div class="cslider-carousel">
                <!-- Einheit 1 -->
                <div class="cslider-item">
                <a href="pages/produktuebersicht.php" onclick="submitCategory('Limousine')">                        
                <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Limousine</h3>
                            <p>Jeder Lord, f&auml;hrt einen Ford.</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 2 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php" onclick="submitCategory('Combi')">                        
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Combi</h3>
                            <p>Combi Schlombie, sach ich immer</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 3 -->
                <div class="cslider-item">
                <a href="pages/produktuebersicht.php" onclick="submitCategory('Cabrio')">                        
                        <img src="images/cars/vw-touran-van-weiss-2016.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Cabrio</h3>
                            <p>Für mehr Kopffreiheit...</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 4 -->
                <div class="cslider-item">
                <a href="pages/produktuebersicht.php" onclick="submitCategory('SUV')">                        
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>SUV</h3>
                            <p>Fuer alle, die auf Off-Road in der Stadt nicht verzichten koennen.</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 5 -->
                <div class="cslider-item">
                <a href="pages/produktuebersicht.php" onclick="submitCategory('Mehrsitzer')">                        
                        <img src="images/cars/bmw-x4-m40i-5d-schwarz-2019-1.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Mehrsitzer</h3>
                            <p>Für Ihre Kinder</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 6 -->
                <div class="cslider-item">
                <a href="pages/produktuebersicht.php" onclick="submitCategory('Coupe')">                        
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Coup&eacute;</h3>
                            <p>Für die Autobahn</p>
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
            <div class="map-container">
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
    include('includes/footer.html'); // include footers
    ?>

</html>
