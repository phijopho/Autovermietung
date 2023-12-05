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

    </head>
    <?php
         include('includes/header.html'); // include header
    ?>
    <body>
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
                    <a href="pages/produktuebersicht.php">
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Limousine</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing...</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 2 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php">
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Cabrio</h3>
                            <p>Für mehr Kopffreiheit...</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 3 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php">
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Mehrsitzer</h3>
                            <p>Für ihre Kinder</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 4 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php">
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Coupé</h3>
                            <p>Für die Autobahn</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 5 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php">
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>SUV</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing...</p>
                        </div>
                    </a>
                </div>
                <!-- Einheit 6 -->
                <div class="cslider-item">
                    <a href="pages/produktuebersicht.php">
                        <img src="images/mercedes.png" alt="Slider Image" />
                        <div class="cslider-text">
                            <h3>Lorem Ipsum</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing...</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="cslider-controls">
            <div class="cslider-prev"></div>
            <div class="cslider-next"></div>
        </div>
    </div>        
    <div class="BackgroundAudi">
        <div class="section3">

        </div>
        <div class="blocker">
    
        </div>            
        <div class="section4">
            <div class="au1">
                <h2> About Us </h2>
            </div>

                    <div class="au2">
                        <p> Every single detail of  SWIFT rentals  is
                            measured against our continuing goal: to
                            enhance costumer enjoyment.
                        </p>
                    </div>

                    <div class="daul3">
                        <p> Every single detail of  SWIFT rentals  is
                            measured against our continuing goal: to
                            enhance costumer enjoyment.
                        </p>
                    </div>

                    <div class="divGoal4">
                        <p> Every single detail of  SWIFT rentals  is
                            measured against our continuing goal: to
                            enhance costumer enjoyment.
                        </p>
                    </div>
                    <br>
                    <!-- When click on button, then AboutUs page opens -->
                    <div class="divbutton">
                        <a href="http://localhost/Autovermietung/pages/aboutus.php" class="button">Discover more</a>
                    </div>
                    
        </div>
    
    </div>
    
    </body>

    <?php
    include('includes/footer.html'); // include footers
    ?>

</html>
