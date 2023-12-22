<?php
// Connection database
$username = "admin";
$password = "sicheresPasswort";
$servername = "localhost";
$dbname = "Autovermietung";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
