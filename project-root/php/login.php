<?php
// Hier könnt ihr die Benutzerdaten überprüfen (z.B. in einer Datenbank).
// In diesem Beispiel lasse ich es einfach und zeige nur die eingegebenen Daten an.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    echo "Benutzername: " . $username . "<br>";
    echo "Passwort: " . $password;
}
?>
