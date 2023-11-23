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
?>