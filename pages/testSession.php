<?php 
session_start();
include('../includes/htmlhead.php');
include('../includes/dbConnection.php'); // connect database
include('../includes/functions.php'); // get functions

if (isset($_REQUEST['quickSearch'])){
    $_SESSION['location']=$_REQUEST['location'];
    $_SESSION['pickUpDate']=$_REQUEST['pickUpDate'];
    $_SESSION['returnDate']=$_REQUEST['returnDate'];
} else {
    echo "Session Variablen nicht definiert.";
}
print_r($_SESSION)."<br>";
?>