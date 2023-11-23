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

function getCategories(){
    include('dbConnection.php');
    $categories=array();
    $stmtGetCategories = $conn->query("SELECT DISTINCT Type FROM Vendor");
    while($row = $stmtGetCategories->fetch()){
        $categories[] = $row['Type'];
    }
    return $categories;    
}

function getVendors(){
    include('dbConnection.php');
    $vendors=array();
    $stmtGetVendors = $conn->query("SELECT Abbreviation FROM Vendor");
    while($row = $stmtGetVendors->fetch()){
        $vendors[] = $row['Abbreviation'];
    }
    return $vendors;    
}

function getSeats(){
    include('dbConnection.php');
    $seats=array();
    $stmtGetSeats = $conn->query("SELECT MIN(Seats), MAX(Seats) FROM CarType");
    $row = $stmtGetSeats->fetch();
        $seats['min'] = $row['MIN(Seats)'];
        $seats['max'] = $row['MAX(Seats)'];
    return $seats;    
}
?>