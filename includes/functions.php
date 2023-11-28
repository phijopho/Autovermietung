<?php
function getMinMaxPrice($Type) {
    include('dbConnection.php');
    $stmt = $conn->prepare("SELECT MIN(Price), MAX(Price) FROM CarType WHERE Type=:TypeIdent");
    $stmt->bindParam(':TypeIdent', $Type);
    $stmt->execute();
    $row = $stmt->fetch();
        $result['min'] = $row['MIN(Price)'];
        $result['max'] = $row['MAX(Price)'];
    return $result; 
}

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

// function showImage($CarType_ID){
//     include('dbConnection.php');
//     $image=$conn->prepare("SELECT Image FROM CarType WHERE CarType_ID=:CarTypeIdent");
//     $image->bindParam(':CarTypeIdent', $CarType_ID);
//     $image->execute();
// }
?>
