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

<!--Benutzerdaten abrufen und in $user speichern-->
<?php

// Überprüfen der Verbindung
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Nehmen wir an, dass die Benutzer-ID in einer Session gespeichert ist.
$userID = $_SESSION['User_ID'];

// Benutzerdaten abrufen und in $user speichern
$query = $conn->prepare("SELECT * FROM user WHERE User_ID = :userID");
$query->bindParam(':userID', $userID);
$query->execute();

// Holen der Ergebnisse als assoziatives Array
$user = $query->fetch(PDO::FETCH_ASSOC);

// Datenbankverbindung schließen (wichtig am Ende jeder PHP-Datei)
$conn = null;
?>
