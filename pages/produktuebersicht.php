<?php
// show error messages
error_reporting(E_ALL);
ini_set('display_errors', 1);
//  session_unset();
//  session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../includes/htmlhead.php');
    ?>
    <!-- jquery range slider -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="includes/functions.js"></script>
    
    <!-- sessions and variables -->
    <?php
        // Reset filters (except location and date)
        if (isset($_POST['resetButton'])) {
            unsetSessions();
        }

        //Quick Search Filters: Location, pick-up date, return date
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime($today . " +2 day"));
        // set default values if nothing else is specified
        if (!isset($_SESSION['location'], $_SESSION['pickUpDate'], $_SESSION['returnDate'])) {
            $_SESSION['location'] = "Hamburg";
            $_SESSION['pickUpDate'] = $today;
            $_SESSION['returnDate'] = $tomorrow;
        }

        // use user input
        if (isset($_POST['quickSearch']) or isset($_POST['filter'])) {
            $_SESSION['location'] = $_POST['location'];
            $_SESSION['pickUpDate'] = $_POST['pickUpDate'];
            $_SESSION['returnDate'] = $_POST['returnDate'];
        }


        $location = getCities();
        $categories = selectDistinctColumn("Type", "CarType");

        //category checkbox filter
        $checkedCategories = array();

        // if user chose category via carousel on homepage
        if (isset($_GET['carouselCategory'])) {
            $_SESSION['categories'] = array();
            $_SESSION['categories'][] = $_GET['carouselCategory'];
            $_SESSION['checkedCategories'] = $_SESSION['categories'];
        }

        // if first visit on site check no boxes but select all categories
        if (!isset($_SESSION['categories']) or empty($_SESSION['categories'])) {
            $_SESSION['checkedCategories'] = array();
            $_SESSION['categories'] = $categories;
        }

        // if filter is set add categories to session
        if (isset($_POST['filter'])) {
            $_SESSION['categories'] = array();
            foreach ($categories as $category) {
                if (isset($_POST[$category])) {
                    $_SESSION['categories'][] = $category;
                    $_SESSION['checkedCategories'][] = $category;
                } else {
                    // if checkbox is not set remove the category from checkedCategories
                    $_SESSION['checkedCategories'] = array_diff($_SESSION['checkedCategories'], [$category]);
                }
            }
            // if no categories were checked add all to session
            if (empty($_SESSION['categories'])) {
                $_SESSION['categories'] = $categories;
                $_SESSION['checkedCategories'] = array();
            }
        }

        // car brand dropdown filter
        if (isset($_POST['filter'])) {
            $_SESSION['vendor'] = $_POST['vendor'];
        }
        // seats slider filter
        if (isset($_POST['filter'])) {
            $_SESSION['seats'] = $_POST['seats'];
        }

        // doors slider filter
        if (isset($_POST['filter'])) {
            $_SESSION['doors'] = $_POST['doors'];
        }

        // age slider filter
        if (isset($_POST['filter'])) {
            $_SESSION['age'] = $_POST['age'];
        }
    
        // drive dropdown filter
        if (isset($_POST['filter'])) {
            $_SESSION['drive'] = $_POST['drive'];
        }

        // transmission toggle filter
        if (isset($_POST['filter'])) {
            // If the checkbox is checked, set the session variable to 'on', otherwise, set it to 'off'
            if (isset($_POST['transmission'])) {
                $_SESSION['transmission'] = 'on';
            } else {
                $_SESSION['transmission'] = 'off';
            }
        }

        // AC toggle filter
        if (isset($_POST['filter'])) {
            // If the checkbox is checked, set the session variable to 'on', otherwise, set it to 'off'
            if (isset($_POST['ac'])) {
                $_SESSION['ac'] = 'on';
            } else {
                $_SESSION['ac'] = 'off';
            }
        }

        // GPS toggle filter
        if (isset($_POST['filter'])) {
            // If the checkbox is checked, set the session variable to 'on', otherwise, set it to 'off'
            if (isset($_POST['gps'])) {
                $_SESSION['gps'] = 'on';
            } else {
                $_SESSION['gps'] = 'off';
            }
        }
        ?>

        <script>
            <?php
            // price range filter
            if (isset($_POST['filter'])) {
                $_SESSION['minPrice'] = $_POST['minPrice'];
                $_SESSION['maxPrice'] = $_POST['maxPrice'];
            }
            // save minPrice or assign a default value
            if (isset($_SESSION['minPrice'])) {
                $minPrice = $_SESSION['minPrice'];
            } else {
                $minPrice = 0;
                $_SESSION['minPrice'] = $minPrice;
            }
            // save maxPrice or assign a default value
            if (isset($_SESSION['maxPrice'])) {
                $maxPrice = $_SESSION['maxPrice'];
            } else {
                $maxPrice = 1000;
                $_SESSION['maxPrice'] = $maxPrice;
            }
            ?>
            $(function() {
                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: 1000,
                    values: [<?php echo $minPrice; ?>, <?php echo $maxPrice; ?>],
                    slide: function(event, ui) {
                        $("#amount").val("Preisspanne: " + ui.values[0] + " € - " + ui.values[1] + " €");
                        // update hidden fields
                        $("#minPrice").val(ui.values[0]);
                        $("#maxPrice").val(ui.values[1]);
                    }
                });
                // initialize hidden fields
                $("#amount").val("Preisspanne: " + $("#slider-range").slider("values", 0) + " € - " + $("#slider-range").slider("values", 1) + " €");
                $("#minPrice").val($("#slider-range").slider("values", 0));
                $("#maxPrice").val($("#slider-range").slider("values", 1));
            });
        </script>

        <?php
        // sort
        // default
        if (!isset($_SESSION['sort'])) {
            $_SESSION['sort'] = "alphabetic";
        }
        // use user input
        if (isset($_POST["sort"])) {
            $_SESSION["sort"] = $_POST["sort"];
        }

        // Checks:
        // echo "<br><br><br><br><br><br><br>";
        // $stmt=getAvailableCarsQuery();
        // $availableCars=getAvailableCars($stmt);
        // echo $stmt." -> ".$availableCars;

        // echo getResultsQuery();
        // echo "Session Categories: ";
        // print_r($_SESSION['categories']);
        // echo "<br> Checked Categories: ";
        // echo var_dump($_SESSION['checkedCategories']);
        // echo "<br> Session:";
        // print_r($_SESSION);
    ?>
    <!-- html page specifics -->
    <title>Unsere Flotte</title>
    <link rel="stylesheet" href="css/styleProduktuebersicht.css">
    <link rel="stylesheet" href="css/styleFooter.css">
</head>

<?php
include('../includes/header.php'); // include header
?>

<body>
    <div class="contentBox">
        <div class="filterBox">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" id="filter">
                <div class="itemBox">
                    <label for="location">Standort:</label><br>
                    <select class="customSelect" name="location">
                        <?php 
                        foreach ($location as $city) {
                            if ($_SESSION['location'] == $city) {
                                echo "<option value='$city' selected>$city</option>";
                            } else {
                                echo "<option value='$city'>$city</option>";
                            }}


                            foreach ($location as $city) {
                            echo "<option value='$city' ";
                            if (isset($_POST['selectedLocation']) && $_POST['selectedLocation'] == $city) {
                            echo "selected";
                            }
                            echo ">$city</option>";
                            }
                            ?>
                    </select>
                </div>
                <div class="twoSidedBox">
                    <label for="pickUpDate">Abholung:</label>
                    <input type="date" name="pickUpDate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $_SESSION['pickUpDate']; ?>" oninput="setMinReturnDate()" id="pickUpDate"/>
                </div>
                <div class="twoSidedBox">
                    <label for="returnDate">R&uuml;ckgabe:</label>
                    <input type="date" name="returnDate" value="<?php echo $_SESSION['returnDate']; ?>" id="returnDate"/>
                </div>

                <script>
                    setMinReturnDate();
                </script>

                <div class="categoryBox">
                    <label for="category">Fahrzeugkategorie: </label><br>
                    <?php
                    foreach ($categories as $category) {
                        echo "<div class='checkbox-container'>";
                        if (in_array($category, $_SESSION['checkedCategories'])) {
                            echo "<input type='checkbox' id=" . $category . " name=" . $category . " value='" . $category . "' checked>";
                        } else {
                            echo "<input type='checkbox' id=" . $category . " name=" . $category . " value='" . $category . "'>";
                        }
                        echo "<label class='categoryLabel' for='" . $category . "'>";
                        echo "<span class='iconCheckbox$category'></span> ";
                        echo "$category</label>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <div class="itemBox">
                    <label for="vendor">Hersteller:</label><br>
                    <select class="customSelect" name="vendor">
                        <option value="all">Alle auswählen</option>
                        <?php
                        $vendors = selectColumn("Abbreviation", "Vendor");
                        foreach ($vendors as $vendor) {
                            if ($_SESSION['vendor'] == $vendor) {
                                echo "<option value='$vendor' selected>$vendor</option>";
                            } else {
                                echo "<option value='$vendor'>$vendor</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="itemBox">
                    <?php
                    $seats = selectMinAndMaxFromColumn("Seats", "CarType");
                    $selectedSeats = 2;
                    if (isset($_SESSION['seats'])) {
                        $selectedSeats = $_SESSION['seats'];
                    }
                    echo "<input type='range' min='" . $seats['min'] . "' max='" . $seats['max'] . "' oninput='this.nextElementSibling.value = this.value' class='slider' value='" . $selectedSeats . "' name='seats' id='seatsRange'>";
                    echo "Sitze: <output>" . $selectedSeats . "</output>+";
                    ?>
                </div>
                <div class="itemBox">
                    <?php
                    $doors = selectMinAndMaxFromColumn("Doors", "CarType");
                    $selectedDoors = 2;
                    if (isset($_SESSION['doors'])) {
                        $selectedDoors = $_SESSION['doors'];
                    }
                    echo "<input type='range' min='" . $doors['min'] . "' max='" . $doors['max'] . "' oninput='this.nextElementSibling.value = this.value' class='slider' value='" . $selectedDoors . "' name='doors' id='doorsRange'>";
                    echo "T&uuml;ren: <output>" . $selectedDoors . "</output>+";
                    ?>
                </div>
                <div class="itemBox">
                    <?php
                        $age = selectMinAndMaxFromColumn("Min_Age", "CarType");
                        if(isset($_SESSION['User_ID'])){
                            $selectedAge=getUserAge();
                        } else {
                            $selectedAge = 25;
                        }
                        if (isset($_SESSION['age'])) {
                            $selectedAge = $_SESSION['age'];
                        }
                        echo "<input type='range' min='" . $age['min'] . "' max='" . $age['max'] . "' oninput='this.nextElementSibling.value = this.value' class='slider' value='" . $selectedAge . "' name='age' id='ageRange'>";
                        echo "Alter: <output>" . $selectedAge . "</output>+";
                    ?>
                </div>
                <div class="itemBox">
                    <label for="drive">Antrieb:</label><br>
                    <select class="customSelect" name="drive">
                        <option value="all">Alle auswählen</option>
                        <?php
                        $drives = selectDistinctColumn("Drive", "CarType");
                        foreach ($drives as $drive) {
                            if ($_SESSION['drive'] == $drive) {
                                if ($drive == 'Combuster') {
                                    $driveGerman = 'Verbrenner';
                                } elseif ($drive == 'Electric') {
                                    $driveGerman = 'Elektro';
                                }
                                echo "<option value='$drive' selected>$driveGerman</option>";
                            } else {
                                if ($drive == 'Combuster') {
                                    $driveGerman = 'Verbrenner';
                                } elseif ($drive == 'Electric') {
                                    $driveGerman = 'Elektro';
                                }
                                echo "<option value='$drive'>$driveGerman</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="twoSidedBox">
                    <label for="transmission">Nur Automatik</label>
                    <label class="switch">
                        <input type="checkbox" name="transmission" <?php
                                                                    if (isset($_SESSION['transmission']) && $_SESSION['transmission'] == 'on') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>
                        <span class="sliderRound"></span>
                    </label>
                </div>
                <div class="twoSidedBox">
                    <label for="AC">Klima</label>
                    <label class="switch">
                        <input type="checkbox" name="ac" <?php
                                                            if (isset($_SESSION['ac']) && $_SESSION['ac'] == 'on') {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                        <span class="sliderRound"></span>
                    </label>
                </div>
                <div class="twoSidedBox">
                    <label for="gps">GPS</label>
                    <label class="switch">
                        <input type="checkbox" name="gps" <?php
                                                            if (isset($_SESSION['gps']) && $_SESSION['gps'] == 'on') {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                        <span class="sliderRound"></span>
                    </label>
                </div>
                <div class="itemBox">
                    <input type="text" id="amount" name="amount">
                    <div id="slider-range"></div>
                    <input type="hidden" name="minPrice" id="minPrice">
                    <input type="hidden" name="maxPrice" id="maxPrice">
                </div>
                <br>
                <input class="filterButton" type="submit" value="Filtern" name="filter">
            </form>
            <?php
            if(isset($_POST['filter'])){ ?>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <input class="resetButton" type="submit" value="Filter zurücksetzen" name="resetButton">
                </form>
            <?php } ?>
        </div>

        <div class="resultBox">
            <div class="topBox">
                <label for="available">Verf&uuml;gbare Fahrzeugmodelle: <?php echo getAvailableCars(); ?></label>
                <div class="sortBox">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" id="sortForm">
                        <label for="sort">Sortierung: </label>
                        <select class="customSelect" name="sort" onchange="submitForm()">
                            <option value="alphabetic" <?php
                                                        if ($_SESSION['sort'] == 'alphabetic') {
                                                            echo "selected";
                                                        }
                                                        ?>>Alphabetisch</option>
                            <option value="priceAscending" <?php
                                                            if ($_SESSION['sort'] == 'priceAscending') {
                                                                echo "selected";
                                                            }
                                                            ?>>Preis aufsteigend</option>
                            <option value="priceDescending" <?php
                                                            if ($_SESSION['sort'] == 'priceDescending') {
                                                                echo "selected";
                                                            }
                                                            ?>>Preis absteigend</option>
                        </select>
                    </form>
                    <!-- Use JS event handler to submit form whenever sort is changed -->
                    <script>
                        function submitForm() {
                            document.getElementById("sortForm").submit();
                        }
                    </script>
                </div>
            </div>
            <?php
            $stmt = getResultsQuery();
            displayResults($stmt);
            ?>
        </div>
    </div>
</body>

<div class="footer">
<?php
include('../includes/footer.html'); // Einbinden des Footers
?>
</div>

</html>