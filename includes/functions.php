<?php 
function locationDropdown(){
    include('dbConnection.php');

    $location = array("Hamburg");
    $default="Hamburg";
    $stmtGetCities = $conn->prepare("SELECT City FROM Location WHERE City!=:cityIdent");
    $stmtGetCities->bindParam(':cityIdent', $default);
    $stmtGetCities->execute();
    while($row = $stmtGetCities->fetch()){
        $location[] = $row['City'];
    }    
}
?>
