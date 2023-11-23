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
}
?>