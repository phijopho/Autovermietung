<?php 
function getCities(){
    include('dbConnection.php');
    $default="Hamburg";
    $location = array($default);
    $stmtGetCities = $conn->prepare("SELECT City FROM Location WHERE City!=:cityIdent");
    $stmtGetCities->bindParam(':cityIdent', $default);
    $stmtGetCities->execute();
    while($row = $stmtGetCities->fetch()){
        $location[] = $row['City'];
    }
    return $location;    
}

function selectDistinctColumn($column, $table){
    include('dbConnection.php');  
    $result=array();  
    $stmt = $conn->query("SELECT DISTINCT $column FROM $table");
    while($row = $stmt->fetch()){
        $array[] = $row[$column];
    }
    return $array;    
}

function selectMinAndMaxFromColumn($column, $table){
    include('dbConnection.php');
    $result=array();
    $stmt = $conn->query("SELECT MIN($column), MAX($column) FROM $table");
    $row = $stmt->fetch();
        $result['min'] = $row['MIN('.$column.')'];
        $result['max'] = $row['MAX('.$column.')'];
    return $result;    

}

function selectColumn($column, $table){
    include('dbConnection.php');
    $result=array();
    $stmt = $conn->query("SELECT $column FROM $table");
    while($row = $stmt->fetch()){
        $result[] = $row[$column];
    }
    return $result;    
}

function showImage($CarType_ID){
    include('dbConnection.php');
    $image=$conn->prepare("SELECT Image FROM CarType WHERE CarType_ID=:CarTypeIdent");
    $image->bindParam(':CarTypeIdent', $CarType_ID);
    $image->execute();

    if($image->rowCount()>0){ 
        echo "<div class='pictureBox'>";
            while($row=$image->fetch()){
                echo "<img src='data:image/png;charset=utf8;base64,".base64_encode($row['Image'])."'>";
            }
        echo "</div>";
    } else { 
        echo "<div class='pictureBox'>Image(s) not found...</div>";
    }
}

function getPrice($CarType_ID){
    include('dbConnection.php');
    $getPrice=$conn->prepare("SELECT Price FROM CarType WHERE CarType_ID=:CarTypeIdent");
    $getPrice->bindParam(':CarTypeIdent', $CarType_ID);
    $getPrice->execute();
    while($row=$getPrice->fetch()){
        $price[]=$row['Price'];
    }
    return $price;    
}

function getModel($CarType_ID){
    include('dbConnection.php');
    $getModel=$conn->prepare("SELECT Vendor.Abbreviation AS Brand, CarType.Name AS Model FROM CarType JOIN Vendor ON CarType.Vendor_ID = Vendor.Vendor_ID WHERE CarType.CarType_ID = :CarTypeIdent");
    $getModel->bindParam(':CarTypeIdent', $CarType_ID);
    $getModel->execute();
    while($row=$getModel->fetch()){
        $model[]=$row['Brand'];
        $model[]=$row['Model'];
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
            echo "<div class='resultItemBox'>";
                echo "<div class='modelBox'>";
                    // Use the getModel and showImage functions to display car information
                    $model = getModel($carType_ID);
                    echo "<label>".$model[0]." ".$model[1]."</label>";
                echo "</div>";
                showImage($carType_ID);
                echo "<div class='carDataBox'>";            
                    // Use the getPrice function to display car prices
                    $price = getPrice($carType_ID);
                    echo "Preis pro Tag: ".$price[0]." €<br>";
                    // Tage multiplizieren
                    echo "Preis für den gewählten Zeitraum: ".$price[0]." € <br>";
                echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>Keine Ergebnisse gefunden.</p>";
    }
}