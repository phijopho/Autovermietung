<?php 
function getCities(){
    include('dbConnection.php');
    $stmtGetCities = $conn->query("SELECT City FROM Location");
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
function showResults(){
    include('dbConnection.php');

    // build select statement
    $stmt="SELECT CarType_ID FROM CarType JOIN Vendor ON CarType.Vendor_ID = Vendor.Vendor_ID WHERE ";
        // location filter
    $stmt .= "Location = '".$_SESSION['location']."' ";
        // category filter
    $categories = implode("', '", $_SESSION['categories']);  // put elements of array in string 
    $stmt .= "AND Category IN ('".$categories."') ";

        // vendor filter
    if (!empty($_SESSION['vendor'])) {
        $stmt .= "AND Vendor.Abbreviation = '".$_SESSION['vendor']."' ";
    }
        // seats filter
    if (isset($_SESSION['seats'])) {
        $stmt .= "AND Seats >= ".$_SESSION['seats']." ";
    }
        // doors filter
    if (isset($_SESSION['doors'])) {
        $stmt .= "AND Doors >= ".$_SESSION['doors']." ";
    }
        // age filter
    if (isset($_SESSION['age'])) {
        $stmt .= "AND Min_Age <= ".$_SESSION['age']." ";
    }
        // drive filter
    if (isset($_SESSION['drive']) && $_SESSION['drive'] != 'all') {
        $stmt .= "AND Drive = '".$_SESSION['drive']."' ";
    }
        // transmission filter
    if (isset($_SESSION['transmission']) && $_SESSION['transmission'] == 'on') {
        $stmt .= "AND Gear = 'automatic' "; 
    }
        // ac filter
    if (isset($_SESSION['ac']) && $_SESSION['ac'] == 'on') {
        $stmt .= "AND Air_Condition = 1 ";
    }
        // GPS filter
    if (isset($_SESSION['gps']) && $_SESSION['gps'] == 'on') {
        $stmt .= "AND GPS = 1 ";
    }

    // add order
    // $stmt .= "ORDER BY ";
    // if ($_POST['sort'] == 'alphabetic') {
    //     $stmt .= "model ASC";
    // } elseif ($_POST['sort'] == 'priceExpensive') {
    //     $stmt .= "price_per_day DESC";
    // } elseif ($_POST['sort'] == 'priceCheap') {
    //     $stmt .= "price_per_day ASC";
    // }

    return $stmt;
}