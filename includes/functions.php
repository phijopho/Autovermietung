<?php 
function unsetSessions() {
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

function getCities(){
    include('dbConnection.php');
    $stmtGetCities = $conn->query("SELECT City FROM Location");
    while($row = $stmtGetCities->fetch()){
        $location[] = $row['City'];
    }
    return $location;
}

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

function selectMinAndMaxFromColumn($column, $table)
{
    include('dbConnection.php');
    $result = array();
    $stmt = $conn->query("SELECT MIN($column), MAX($column) FROM $table");
    $row = $stmt->fetch();
        $result['min'] = $row['MIN('.$column.')'];
        $result['max'] = $row['MAX('.$column.')'];
    return $result;    
}

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

function getModel($CarType_ID){
    include('dbConnection.php');
    $getModel = $conn->prepare("SELECT Vendor.Abbreviation AS Brand, CarType.Name AS Model FROM CarType JOIN Vendor ON CarType.Vendor_ID = Vendor.Vendor_ID WHERE CarType.CarType_ID = :CarTypeIdent");
    $getModel->bindParam(':CarTypeIdent', $CarType_ID);
    $getModel->execute();
    while ($row = $getModel->fetch()) {
        $model[] = $row['Brand'];
        $model[] = $row['Model'];
    }
    return $model;
}
// pickUpDate and returnDate hinzufügen (mit gebuchten Autos verknüpfen)
function getResultsQuery(){
    include('dbConnection.php');

    // build select statement
    $stmt="SELECT CarType_ID FROM CarType JOIN Vendor ON CarType.Vendor_ID = Vendor.Vendor_ID WHERE 1=1";
        // location filter
    // $stmt .= " AND Location = '".$_SESSION['location'];
        // category filter
    $categories = implode("', '", $_SESSION['categories']);  // put elements of array in string 
    $stmt .= " AND Type IN ('".$categories."')";
        // vendor filter (AND hinzufügen)
    if (!empty($_SESSION['vendor']) && $_SESSION['vendor'] != 'all') {
        $stmt .= " AND Vendor.Abbreviation = '".$_SESSION['vendor']."'";
    }
        // seats filter
    if (isset($_SESSION['seats'])) {
        $stmt .= " AND Seats >= ".$_SESSION['seats'];
    }
        // doors filter
    if (isset($_SESSION['doors'])) {
        $stmt .= " AND Doors >= ".$_SESSION['doors'];
    }
        // age filter
    if (isset($_SESSION['age'])) {
        $stmt .= " AND Min_Age <= ".$_SESSION['age'];
    }
        // drive filter
    if (isset($_SESSION['drive']) && $_SESSION['drive'] != 'all') {
        $stmt .= " AND Drive = '".$_SESSION['drive']."'";
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
    if (isset($_SESSION['minPrice']) OR $_SESSION['maxPrice']){
        $stmt .= " AND Price BETWEEN '".$_SESSION['minPrice']."' AND '".$_SESSION['maxPrice']."'";
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

function displayResults($stmt){
    include('dbConnection.php');
    // execute the SQL statement
    $result = $conn->query($stmt);
    // check if there are results
    if ($result->rowCount() > 0) {
        echo "<div class='resultWrapBox'>";
        // loop through each result and display it
        while ($row = $result->fetch()){
            $carType_ID = $row['CarType_ID'];
            echo "<a href='pages/produktdetailseite.php?carType_ID=$carType_ID'>";
                echo "<div class='resultItemBox'>";
                    echo "<div class='modelBox'>";
                        // Use the getModel and showImage functions to display car information
                        $model = getModel($carType_ID);
                        echo "<label>".$model[0]." ".$model[1]."</label>";
                        $stmtAvailableCarsModel=getAvailableCarsForModelQuery($carType_ID);
                        $availableCarsModel=getAvailableCarsForModel($stmtAvailableCarsModel);
                        echo "<label>Verf&uuml;gbar: ".$availableCarsModel."</label>";
                    echo "</div>";
                    showImage($carType_ID);
                    echo "<div class='carDataBox'>";            
                        // Use the getPrice function to display car prices
                        $price = getCarProperty($carType_ID, 'Price');
                        echo "Preis pro Tag: ".$price." &euro;<br>";
                        // Tage multiplizieren
                        echo "Preis für den gewählten Zeitraum: ".getTotalPrice($price)." &euro;<br>";
                    echo "</div>";
                echo "</div>";
            echo "</a>";
        }
        echo "</div>";
    } else {
        echo "<p>Keine Ergebnisse gefunden.</p>";
    }
}

function getAvailableCarsQuery() {
    // build sql statement
    $stmt = "SELECT COUNT(Car.Car_ID) FROM Car INNER JOIN CarType ON Car.CarType_ID=CarType.CarType_ID INNER JOIN Location ON Location.Location_ID=Car.Location_ID"; 
    $stmt .= " WHERE Location.City='".$_SESSION['location']."'";
    return $stmt;
}

function getAvailableCars($stmt){
    include('dbConnection.php');
    // execute statement
    $availableCars=0;
    $stmt = $conn->query($stmt);
    while($row=$stmt->fetch()){
        $availableCars=$row['COUNT(Car.Car_ID)'];
    }
    return $availableCars;  
}

function getAvailableCarsForModelQuery($CarType_ID){
    // build sql statement
    $stmt = "SELECT COUNT(Car.Car_ID) FROM Car INNER JOIN CarType ON Car.CarType_ID=CarType.CarType_ID INNER JOIN Location ON Location.Location_ID=Car.Location_ID";
    $stmt .= " WHERE Car.CarType_ID=".$CarType_ID;

    return $stmt;
}

function getAvailableCarsForModel($stmt){
    include('dbConnection.php');
    // execute statement
    $availableCarsModel=0;
    $stmt = $conn->query($stmt);
    while($row=$stmt->fetch()){
        $availableCarsModel=$row['COUNT(Car.Car_ID)'];
    }
    return $availableCarsModel;  
}

function formatDate($date){
    $newDate = date('d.m.Y', strtotime($date));
    return $newDate;
}

function getCarProperty($CarType_ID, $column){
    include('dbConnection.php');
    $stmt = $conn->query("SELECT $column FROM CarType WHERE CarType_ID=$CarType_ID");
    while($row = $stmt->fetch()){
        $result = $row[$column];
    }
    return $result;    
}

function getTotalPrice($price) {
     // create new instance of class DateTime to convert session into a date
    $pickUpDate = new DateTime($_SESSION['pickUpDate']);
    $returnDate = new DateTime($_SESSION['returnDate']);     

    $interval = $pickUpDate->diff($returnDate); // calculate difference between dates
    $numberOfDays = $interval->days; // get difference in number of days
    $totalPrice=$numberOfDays*$price;

    return $totalPrice; 
}

function getPriceForCategory($category){
    include('dbConnection.php');
    $stmt = $conn->prepare("SELECT MIN(Price) FROM CarType WHERE Type =:category");
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    $row = $stmt->fetch();

    if ($row) {
        // Wenn ein Ergebnis vorhanden ist, gib den Preis zurück
        return $row['MIN(Price)'];
    } else {
        // Wenn kein Ergebnis vorhanden ist, gib einen Hinweis zurück
        return "Preis nicht verfügbar";
    }
}

function preventEnterIfLoggedIn()
{
    if (isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"])) {
        header("Location: ../index.php");
    }
}

// functions for meineBuchungen
function getNumberOfBookings($User_ID) {
    include('dbConnection.php');
    $stmt = $conn->prepare("SELECT COUNT(User_ID) FROM `Rental` WHERE User_ID=:user_id");
    $stmt->bindParam(':user_id', $User_ID);
    $stmt->execute();

    $row = $stmt->fetch();
    return $row['COUNT(User_ID)'];
}

//Functions for Produktdetailseite
function getCarInfo($carTypeID) {
    include('dbConnection.php');
    $carInfo = [
        'image' => showImage($carTypeID),
        'type' => selectSpecificColumn('Type', 'CarType', $carTypeID),
        'gear' => selectSpecificColumn('Gear', 'CarType', $carTypeID),
        'seats' => selectSpecificColumn('Seats', 'CarType', $carTypeID),
        'gps' => selectSpecificColumn('GPS', 'CarType', $carTypeID),
        'doors' => selectSpecificColumn('Doors', 'CarType', $carTypeID),
        'airCondition' => selectSpecificColumn('Air_Condition', 'CarType', $carTypeID)
    ];

    return $carInfo;
}

function selectSpecificColumn($column, $table, $carTypeID) {
    include('dbConnection.php');

    $stmt = $conn->query("SELECT $column FROM $table WHERE CarType_ID=$carTypeID");
    $result = null;

    while($row = $stmt->fetch()) {
        $result = $row[$column];
    }

    return $result;
}


?>
