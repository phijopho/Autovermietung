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

// function showImage($CarType_ID){
//     include('dbConnection.php');
//     $image=$conn->prepare("SELECT Image FROM CarType WHERE CarType_ID=:CarTypeIdent");
//     $image->bindParam(':CarTypeIdent', $CarType_ID);
//     $image->execute();
// }
?>
