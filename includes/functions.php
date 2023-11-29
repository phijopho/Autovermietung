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



function selectCarType($Type, $CarType){
    include('dbConnection.php');  
    $result = array();  
    $stmt = $conn->query("SELECT DISTINCT $Type FROM $CarType WHERE Type=TypeIdent");
    while($row = $stmt->fetch()){
        $result[] = $row[$Type];
    }
    return $result;    
}

?>