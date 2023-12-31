<?php
// filters
// Clear session variables except location and date
function unsetSessions()
{
    if (isset($_POST['resetButton'])) {
        unset($_SESSION['categories']);
        unset($_SESSION['vendor']);
        unset($_SESSION['seats']);
        unset($_SESSION['doors']);
        unset($_SESSION['age']);
        unset($_SESSION['drive']);
        unset($_SESSION['transmission']);
        unset($_SESSION['ac']);
        unset($_SESSION['gps']);
        unset($_SESSION['minPrice']);
        unset($_SESSION['maxPrice']);
    }
}

// Get a list of cities from the database
function getCities()
{
    include('dbConnection.php');
    $stmtGetCities = $conn->query("SELECT City FROM Location");
    while ($row = $stmtGetCities->fetch()) {
        $location[] = $row['City'];
    }
    return $location;
}

// Reusable database functions for retrieving values from a specified column 
// Select values from a column in the database 
function selectColumn($column, $table)
{
    include('dbConnection.php');
    $result = array();
    $stmt = $conn->query("SELECT $column FROM $table");
    while ($row = $stmt->fetch()) {
        $result[] = $row[$column];
    }
    return $result;
}

// Select distinct values from a column in the database
function selectDistinctColumn($column, $table)
{
    include('dbConnection.php');
    $result = array();
    $stmt = $conn->query("SELECT DISTINCT $column FROM $table");
    while ($row = $stmt->fetch()) {
        $array[] = $row[$column];
    }
    return $array;
}

// Select the minimum and maximum values from a column in the database
function selectMinAndMaxFromColumn($column, $table)
{
    include('dbConnection.php');
    $result = array();
    $stmt = $conn->query("SELECT MIN($column), MAX($column) FROM $table");
    $row = $stmt->fetch();
    $result['min'] = $row['MIN(' . $column . ')'];
    $result['max'] = $row['MAX(' . $column . ')'];
    return $result;
}

// Display car images
function showImage($CarType_ID)
{
    include('dbConnection.php');
    $image = $conn->prepare("SELECT Image FROM CarType WHERE CarType_ID=:CarTypeIdent");
    $image->bindParam(':CarTypeIdent', $CarType_ID);
    $image->execute();

    if ($image->rowCount() > 0) {
        echo "<div class='pictureBox'>";
        while ($row = $image->fetch()) {
            echo "<img src='data:image/png;charset=utf8;base64," . base64_encode($row['Image']) . "'>";
        }
        echo "</div>";
    } else {
        echo "<div class='pictureBox'>Image(s) not found...</div>";
    }
}

// Get car model information
function getModel($CarType_ID){
    include('dbConnection.php');
    $getModel = $conn->query("SELECT Vendor.Abbreviation AS Brand, CarType.Name AS Model FROM CarType JOIN Vendor ON CarType.Vendor_ID = Vendor.Vendor_ID WHERE CarType.CarType_ID = $CarType_ID");
    // no prepared statement needed since there is no user input
    while ($row = $getModel->fetch()) {
        $model[] = $row['Brand'];
        $model[] = $row['Model'];
    }
    return $model;
}

// get sql statement for displaying results
function getResultsQuery()
{
    include('dbConnection.php');

    // build select statement
    $stmt = "SELECT CarType_ID FROM CarType JOIN Vendor ON CarType.Vendor_ID = Vendor.Vendor_ID WHERE 1=1";
    // category filter
    $categories = implode("', '", $_SESSION['categories']);  // put elements of array in string 
    $stmt .= " AND Type IN ('" . $categories . "')";
    // vendor filter
    if (!empty($_SESSION['vendor']) && $_SESSION['vendor'] != 'all') {
        $stmt .= " AND Vendor.Abbreviation = '" . $_SESSION['vendor'] . "'";
    }   
    // seats filter
    if (isset($_SESSION['seats'])) {
        $stmt .= " AND Seats >= " . $_SESSION['seats'];
    }
    // doors filter
    if (isset($_SESSION['doors'])) {
        $stmt .= " AND Doors >= " . $_SESSION['doors'];
    }
    // age filter
    if (isset($_SESSION['age'])) {
        $stmt .= " AND Min_Age <= " . $_SESSION['age'];
    }
    // drive filter
    if (isset($_SESSION['drive']) && $_SESSION['drive'] != 'all') {
        $stmt .= " AND Drive = '" . $_SESSION['drive'] . "'";
    }
    // transmission filter
    if (isset($_SESSION['transmission']) && $_SESSION['transmission'] == 'on') {
        $stmt .= " AND Gear = 'automatic'";
    }
    // ac filter
    if (isset($_SESSION['ac']) && $_SESSION['ac'] == 'on') {
        $stmt .= " AND Air_Condition = 1";
    }
    // GPS filter
    if (isset($_SESSION['gps']) && $_SESSION['gps'] == 'on') {
        $stmt .= " AND GPS = 1";
    }
    // Price filter
    if (isset($_SESSION['minPrice']) or $_SESSION['maxPrice']) {
        $stmt .= " AND Price BETWEEN '" . $_SESSION['minPrice'] . "' AND '" . $_SESSION['maxPrice'] . "'";
    }

    // add order
    $stmt .= " ORDER BY";
    if ($_SESSION['sort'] == 'alphabetic') {
        $stmt .= " Vendor.Abbreviation, CarType.Name ASC";
    } elseif ($_SESSION['sort'] == 'priceAscending') {
        $stmt .= " Price ASC";
    } elseif ($_SESSION['sort'] == 'priceDescending') {
        $stmt .= " Price DESC";
    }

    return $stmt;
}

// Display search results
function displayResults($stmt)
{
    include('dbConnection.php');

    // execute the SQL statement
    $result = $conn->query($stmt);

    // check if there are results
    if ($result->rowCount() > 0) {
        echo "<div class='resultWrapBox'>";

        $hasUnavailableModels = false; // variable to see if the second while-loop needs to be executed
        $hasAvailableModels = false; // variable to see if no cars match user filters

        // loop through each available result and display it
        while ($row = $result->fetch()) {
            $carType_ID = $row['CarType_ID'];
            $availableCarsModel = getAvailableCarsForModel($carType_ID);
            if ($availableCarsModel > 0) {
                $hasAvailableModels = true;
                echo "<a href='pages/productDetails.php?carType_ID=$carType_ID'>";
                    echo "<div class='resultItemBox'>";
                        echo "<div class='modelBox'>";
                            // Use the getModel and showImage functions to display car information
                            $model = getModel($carType_ID);
                            echo "<label>" . $model[0] . " " . $model[1] . "</label>";
                            echo "<label>Verf&uuml;gbar: " . $availableCarsModel . "</label>";
                        echo "</div>";
                        showImage($carType_ID);
                        echo "<div class='carDataBox'>";
                            echo "<div>";
                                // Use the getCarProperty and getTotalPrice functions to display car prices
                                $price = getCarProperty($carType_ID, 'Price');
                                echo "Preis pro Tag: " . $price . " &euro;<br>";
                                echo "Preis f&uuml;r den gew&auml;hlten Zeitraum: " . getTotalPrice($price) . " &euro;<br>";
                            echo "</div>";
                            // see if the user is old enough for this car, if not change font color of min age to red
                            $minAge=getCarProperty($carType_ID, 'Min_Age');
                            if (isset($_SESSION['User_ID'])){
                                $userAge = getUserAge();
                                if ($userAge < $minAge){
                                    echo "<div class='minAgeTooYoungBox'>"; // font in red as warning
                                } else {
                                    echo "<div>"; // normal font
                                }
                            } else {
                                echo "<div>";  
                            }
                            echo "Mindestalter: ".$minAge;
                            echo "</div>";  
                        echo "</div>";
                    echo "</div>";
                echo "</a>";
            } else {
                $hasUnavailableModels=true;
            } 
        }
        if ($hasAvailableModels==false){
            echo "<p>Keine Modelle f&uuml;r Ihre Filterung verf&uuml;gbar.</p>";
        }
        // loop through each for the selected location or time unavailable result and display it with same logix as above
        if($hasUnavailableModels==true){
            $result = $conn->query($stmt);
            echo "<div class='separatingBox'> Nicht verf&uuml;gbare Modelle: </div>";
            while ($row = $result->fetch()) {
                $carType_ID = $row['CarType_ID'];
                $availableCarsModel = getAvailableCarsForModel($carType_ID);
                if ($availableCarsModel == 0) {
                    echo "<a href='pages/productDetails.php?carType_ID=$carType_ID'>";
                        echo "<div class='resultItemBox'>";
                            echo "<div class='modelBox'>";
                                // Use the getModel and showImage functions to display car information
                                $model = getModel($carType_ID);
                                echo "<label>" . $model[0] . " " . $model[1] . "</label>";
                                echo "<label>Verf&uuml;gbar: " . $availableCarsModel . "</label>";
                            echo "</div>";
                            showImage($carType_ID);
                            echo "<div class='carDataBox'>";
                                echo "<div>";
                                    // Use the getPrice function to display car prices
                                    $price = getCarProperty($carType_ID, 'Price');
                                    echo "Preis pro Tag: " . $price . " &euro;<br>";
                                    echo "Preis f&uuml;r den gew&auml;hlten Zeitraum: " . getTotalPrice($price) . " &euro;<br>";
                                echo "</div>";
                                $minAge=getCarProperty($carType_ID, 'Min_Age');
                                if (isset($_SESSION['User_ID'])){
                                    $userAge = getUserAge();
                                    if ($userAge < $minAge){
                                        echo "<div class='minAgeTooYoungBox'>";
                                    } else {
                                        echo "<div>";
                                    }
                                } else {
                                    echo "<div>";  
                                }
                                echo "Mindestalter: ".$minAge;   
                                echo "</div>";  
                            echo "</div>";
                        echo "</div>";
                    echo "</a>";
                }
            }
        }
        echo "</div>";
        } else {
            echo "<p>Keine Ergebnisse gefunden.</p>";
        }
}

// Availability
// get all available cars
function getAvailableCars()
{
    include('dbConnection.php');

    // Retrieve session variables
    $startDate = $_SESSION['pickUpDate'];
    $endDate = $_SESSION['returnDate'];
    $location = $_SESSION['location'];
    $categories = implode("', '", $_SESSION['categories']);  // put elements of array in string 

    // Build the SQL query to count available cars
    $stmt = "SELECT COUNT(Car.Car_ID) AS AvailableCars
            FROM Car
            INNER JOIN CarType ON Car.CarType_ID = CarType.CarType_ID
            INNER JOIN Location ON Car.Location_ID = Location.Location_ID
            LEFT JOIN Rental ON Car.Car_ID = Rental.Car_ID
            JOIN Vendor ON CarType.Vendor_ID = Vendor.Vendor_ID
            WHERE (Rental.Rent_ID IS NULL OR NOT (Rental.StartDate <= :endDate AND Rental.EndDate >= :startDate))
                AND Location.City = :location";

    //category filter
    $stmt .= " AND Type IN ('" . $categories . "')";
    // vendor filter
    if (!empty($_SESSION['vendor']) && $_SESSION['vendor'] != 'all') {
        $stmt .= " AND Vendor.Abbreviation = '" . $_SESSION['vendor'] . "'";
    }   
    // seats filter
    if (isset($_SESSION['seats'])) {
        $stmt .= " AND Seats >= " . $_SESSION['seats'];
    }
    // doors filter
    if (isset($_SESSION['doors'])) {
        $stmt .= " AND Doors >= " . $_SESSION['doors'];
    }
    // age filter
    if (isset($_SESSION['age'])) {
        $stmt .= " AND Min_Age <= " . $_SESSION['age'];
    }
    // drive filter
    if (isset($_SESSION['drive']) && $_SESSION['drive'] != 'all') {
        $stmt .= " AND Drive = '" . $_SESSION['drive'] . "'";
    }
    // transmission filter
    if (isset($_SESSION['transmission']) && $_SESSION['transmission'] == 'on') {
        $stmt .= " AND Gear = 'automatic'";
    }
    // ac filter
    if (isset($_SESSION['ac']) && $_SESSION['ac'] == 'on') {
        $stmt .= " AND Air_Condition = 1";
    }
    // GPS filter
    if (isset($_SESSION['gps']) && $_SESSION['gps'] == 'on') {
        $stmt .= " AND GPS = 1";
    }
    // Price filter
    if (isset($_SESSION['minPrice']) or $_SESSION['maxPrice']) {
        $stmt .= " AND Price BETWEEN '" . $_SESSION['minPrice'] . "' AND '" . $_SESSION['maxPrice'] . "'";
    }


    // Prepare and execute the query
    $stmt = $conn->prepare($stmt);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':location', $location);

    $stmt->execute();

    $row = $stmt->fetch();

    return $row['AvailableCars'];
}

// Function to get available cars for a specific car type
function getAvailableCarsForModel($carType_ID)
{
    include('dbConnection.php');

    $startDate = $_SESSION['pickUpDate'];
    $endDate = $_SESSION['returnDate'];
    $location = $_SESSION['location'];

    // Build the SQL query to count available cars
    $stmt = "SELECT COUNT(Car.Car_ID) AS AvailableCarsForModel
            FROM Car
            INNER JOIN CarType ON Car.CarType_ID = CarType.CarType_ID
            INNER JOIN Location ON Car.Location_ID = Location.Location_ID
            LEFT JOIN Rental ON Car.Car_ID = Rental.Car_ID
            WHERE (Rental.Rent_ID IS NULL OR NOT (Rental.StartDate <= :endDate AND Rental.EndDate >= :startDate))
                AND Location.City = :location AND CarType.CarType_ID = :carType_ID";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($stmt);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':carType_ID', $carType_ID);

    $stmt->execute();

    $row = $stmt->fetch();

    return $row['AvailableCarsForModel'];
}

// Function to format a date into German date
function formatDate($date)
{
    $newDate = date('d.m.Y', strtotime($date));
    return $newDate;
}

// Car Details
// Function to get a car property by car type ID and column name
function getCarProperty($CarType_ID, $column)
{
    include('dbConnection.php');
    $stmt = $conn->query("SELECT $column FROM CarType WHERE CarType_ID=$CarType_ID");
    while ($row = $stmt->fetch()) {
        $result = $row[$column];
    }
    return $result;
}

// Function to calculate the total price when price is already pulled from database
function getTotalPrice($price)
{
    // create new instance of class DateTime to convert session into a date
    $pickUpDate = new DateTime($_SESSION['pickUpDate']);
    $returnDate = new DateTime($_SESSION['returnDate']);
    $returnDate->modify('+1 day'); // add one day to count the pick-up day as well

    $interval = $pickUpDate->diff($returnDate); // calculate difference between dates
    $numberOfDays = $interval->days; // get difference in number of days
    $totalPrice = $numberOfDays * $price;

    return $totalPrice;
}

// Carousel
// Function to get the minimum price for a car category
function getPriceForCategory($category)
{
    include('dbConnection.php');
    $stmt = $conn->prepare("SELECT ROUND(MIN(Price),0) AS Price FROM CarType WHERE Type =:category");
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    $row = $stmt->fetch();

    if ($row) {
        // if there is a price return it
        return $row['Price'];
    } else {
        // display info if no price available
        return "Preis nicht verf&uuml;gbar";
    }
}

// login
// Function to prevent entering certain pages if the user is logged in
function preventEnterIfLoggedIn()
{
    if (isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"])) {
        header("Location: ../index.php");
    }
}

// Function to prevent entering certain pages if the user is logged out
function preventEnterIfLoggedOut()
{
    if (!(isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"]))) {
        header("Location: ../index.php");
    }
}

// logout success message
function displayLogoutSuccess()
{
    if (!(isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"]))) {
        if (isset($_GET["loggedOut"]) && $_GET["loggedOut"] == 1)
        {
        ?>
            <div class="logOutSuccess">
                <p class="textLogOutSuccess">Erfolgreich abgemeldet!</p>
            </div>
        <?php
        }
    }
}

// My bookings
// function to retrieve user id from db 
function getUserID()
{ // username is unique and User_ID is assigned within the database logic so it must be deducted from the db
    include('dbConnection.php');
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT User_ID FROM User WHERE Username=:username"); // prepared statement needed because username is a text input field where user can write something in
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['User_ID'];
}

// Function to get user age
function getUserAge()
{
    include('dbConnection.php');
    $stmt = $conn->prepare("SELECT Age FROM User WHERE USER_ID=:user_id");
    $stmt->bindParam('user_id', $_SESSION['User_ID']);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['Age'];
}

// Function to get the number of bookings for a user
function getNumberOfBookings()
{
    include('dbConnection.php');
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT COUNT(Rental.User_ID) FROM `Rental` JOIN User ON User.User_ID=Rental.User_ID WHERE Username=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['COUNT(Rental.User_ID)'];
}

// Function to get booking information for a user
function getBookingInfos($User_ID)
{
    include('dbConnection.php');
    $stmt = $conn->query(
        "SELECT Rental.Rent_ID, Rental.BookingDate, Rental.StartDate, Rental.EndDate, Vendor.Abbreviation AS Brand, CarType.Name AS Model, Location.City AS CarLocation, ROUND(DATEDIFF(Rental.EndDate, Rental.StartDate) * CarType.Price + CarType.Price,2) AS TotalPrice 
    FROM Rental             
    JOIN Car ON Rental.Car_ID = Car.Car_ID             
    JOIN CarType ON Car.CarType_ID = CarType.CarType_ID             
    JOIN Vendor ON CarType.Vendor_ID = Vendor.Vendor_ID             
    JOIN Location ON Car.Location_ID = Location.Location_ID             
    WHERE Rental.User_ID = $User_ID"
    );

    // save infos in two-dimensional array
    while ($row = $stmt->fetch()) {
        $result[] = array(
            'Rent_ID' => $row['Rent_ID'],
            'BookingDate' => formatDate($row['BookingDate']),
            'StartDate' => formatDate($row['StartDate']),
            'EndDate' => formatDate($row['EndDate']),
            'Brand' => $row['Brand'],
            'Model' => $row['Model'],
            'CarLocation' => $row['CarLocation'],
            'TotalPrice' => $row['TotalPrice']
        );
    }
    return $result;
}

// Function to get available car IDs for a specific car type to select a random one from it later
function getAvailableCarIDs($carType_ID)
{
    include('dbConnection.php');

    // Retrieve session variables
    $startDate = $_SESSION['pickUpDate'];
    $endDate = $_SESSION['returnDate'];
    $location = $_SESSION['location'];

    // Build the SQL query to get available car IDs for a specific car type
    $stmt = "SELECT Car.Car_ID AS AvailableCarIDs
            FROM Car
            INNER JOIN CarType ON Car.CarType_ID = CarType.CarType_ID
            INNER JOIN Location ON Car.Location_ID = Location.Location_ID
            LEFT JOIN Rental ON Car.Car_ID = Rental.Car_ID
            WHERE (Rental.Rent_ID IS NULL OR NOT (Rental.StartDate < :endDate AND Rental.EndDate > :startDate))
                AND Location.City = :location AND CarType.CarType_ID = :carType_ID";

    // Prepare and execute the query
    $stmt = $conn->prepare($stmt);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':carType_ID', $carType_ID);

    $stmt->execute();

    $IDs = array();
    while ($row = $stmt->fetch()) {
        $IDs[] = $row['AvailableCarIDs'];
    }

    return $IDs;
}

// Functions for Productdetails
// show car locations to display when car is not available for filtered location 
function getCarLocations($CarType_ID){
    include('dbConnection.php');
    $stmt=$conn->query("SELECT DISTINCT City FROM Location
    JOIN Car on Car.Location_ID=Location.Location_ID
    JOIN CarType on CarType.CarType_ID=Car.CarType_ID
    WHERE Car.CarType_ID=$CarType_ID");

    $result=array();
    while ($row = $stmt->fetch()) {
        $result[] = $row['City'];
    }
    return $result;
}

// function to retrieve car infos
function getCarInfo($carTypeID)
{
    include('dbConnection.php');
    // Function to convert 0/1 to "Nein"/"Ja"
    function booleanToJaNein($value)
    {
        return $value == 1 ? 'Ja' : 'Nein';
    }

    // Function to convert 'gear' to 'Manuell' or 'Automatik'
    function gearToText($value)
    {
        return $value == 'manually' ? 'Manuell' : 'Automatik';
    }

    // save infos to two-dimensional array
    $carInfo = [
        'image' => showImage($carTypeID),
        'type' => selectSpecificColumn('Type', 'CarType', $carTypeID),
        'gear' => gearToText(selectSpecificColumn('Gear', 'CarType', $carTypeID)), 
        'seats' => selectSpecificColumn('Seats', 'CarType', $carTypeID),
        'gps' => booleanToJaNein(selectSpecificColumn('GPS', 'CarType', $carTypeID)), 
        'doors' => selectSpecificColumn('Doors', 'CarType', $carTypeID),
        'airCondition' => booleanToJaNein(selectSpecificColumn('Air_Condition', 'CarType', $carTypeID)) 
    ];

    return $carInfo;
}

// Function to select a specific column from a table by car type ID
function selectSpecificColumn($column, $table, $carTypeID)
{
    include('dbConnection.php');

    $stmt = $conn->query("SELECT $column FROM $table WHERE CarType_ID=$carTypeID");
    $result = null;

    while ($row = $stmt->fetch()) {
        $result = $row[$column];
    }

    return $result;
}
