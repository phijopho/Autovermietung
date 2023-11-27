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
    $getPrice = $conn->prepare("SELECT Price FROM CarType WHERE CarType_ID=:CarTypeIdent");
    $getPrice->bindParam(':CarTypeIdent', $CarType_ID);
    $getPrice->execute();
    while($row=$getPrice->fetch()){
        $price[]=$row['Price'];
    }
    return $price;    
}