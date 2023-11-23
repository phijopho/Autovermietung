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

function getDoors(){
    include('dbConnection.php');
    $doors=array();
    $stmtGetDoors = $conn->query("SELECT MIN(Doors), MAX(Doors) FROM CarType");
    $row = $stmtGetDoors->fetch();
        $seats['min'] = $row['MIN(Doors)'];
        $seats['max'] = $row['MAX(Doors)'];
    return $doors;    
}

function getAge(){
    include('dbConnection.php');
    $age=array();
    $stmtGetAge = $conn->query("SELECT MIN(Min_Age), MAX(Min_Age) FROM CarType");
    $row = $stmtGetAge->fetch();
        $seats['min'] = $row['MIN(Min_Age)'];
        $seats['max'] = $row['MAX(Min_Age)'];
    return $age;    
}

function getPrice(){
    include('dbConnection.php');
    $price=array();
    $stmtGetPrice = $conn->query("SELECT MIN(price), MAX(price) FROM CarType");
    $row = $stmtGetPrice->fetch();
        $price['min'] = $row['MIN(price)'];
        $price['max'] = $row['MAX(price)'];
    return $price;
}

function getDrive(){
    include('dbConnection.php');
    $drives=array();
    $stmtGetDrive = $conn->query("SELECT DISTINCT Drive FROM CarType");
    while($row = $stmtGetDrive->fetch()){
        $drives[] = $row['Drive'];
    }
    return $drives;    
}
?>