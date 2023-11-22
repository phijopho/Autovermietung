<?php
    // Connection Datenbank
    $username="admin";
    $password="sicheresPasswort";
    $servername="localhost";
    $dbname="Autovermietung";

    try {
        $conn=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "<br>"."Connected successfully"."<br>"; //moeglich machen über log message 
    } catch(PDOException $e){
        echo "Error: ".$e->getMessage();
    }
?>
