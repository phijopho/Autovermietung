<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Meine Webseite</title>
    <style>
        /* Stilisierung für bessere Optik (optional) */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .content {
            border: 1px solid #ccc;
            margin: 10px 0;
            padding: 20px;
            text-align: center;
        }

        /* Neuer Stil für das erste div */
        .BackgroundAudi {
            background-color: #f0f0f0;
            padding: 40px;
            text-align: left;
        }

        .containerBookingForm {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Neuer Stil für das zweite div */
        #myCarousel {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .carousel-inner > .carousel-item > img {
        width: 70%;
        margin: auto;
        color: black;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="content BackgroundAudi" id="div1">
            <div class="containerBookingForm">
                <!-- <h1>Buchung</h1> -->
                <!-- Link zur Produktübersichtseite statt index -->
                <form action="pages/produktuebersicht.php" method="post"> 
                    <label for="location">Standort:</label>
                        <select id="location" name="Standort">
                            <?php //aus Datenbank ziehen, außer HH
                            foreach($location as $city){
                                echo "<option value='$city'>$city</option>";
                            }
                            ?>
                        </select>
                    <label for="pickUpDate">Abholdatum:</label>
                        <input type="date" name="pickUpDate" value="<?php echo date('Y-m-d'); ?>" />
                    <label for="returnDate">R&uuml;ckgabedatum:</label>
                        <input type="date" name="returnDate" value="<?php echo date('Y-m-d'); ?>" /><br><br>
                    <input type="submit" value="Suchen">
                </form>
            </div>
        </div>

        <div class="content" id="div2">
            <div class="container">
                <br>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="images/audi-a3-sportback-blau-2020.png" alt="Chania" width="460" height="345">
                            <div class="carousel-caption">
                                <h3>Chania</h3>
                                <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="images/audi-a3-sportback-blau-2020.png" alt="Chania" width="460" height="345">
                            <div class="carousel-caption">
                                <h3>Chania</h3>
                                <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="img_flower.jpg" alt="Flower" width="460" height="345">
                            <div class="carousel-caption">
                                <h3>Flowers</h3>
                                <p>Beautiful flowers in Kolymbari, Crete.</p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="images/audi-a3-sportback-blau-2020.png" alt="Flower" width="460" height="345">
                            <div class="carousel-caption">
                                <h3>Flowers</h3>
                                <p>Beautiful flowers in Kolymbari, Crete.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="content" id="div3">
            <!-- Hier kann der Inhalt für das dritte div eingefügt werden -->
        </div>

        <div class="content" id="div4">
            <!-- Hier kann der Inhalt für das vierte div eingefügt werden -->
        </div>
    </div>

</body>
</html>
