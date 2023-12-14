<!DOCTYPE html>
<html lang="en">

<head>
    <?php
      include('../includes/htmlhead.php')
    ?>

    <!-- html page specifics -->
    <link rel="stylesheet" href="css/styleRegistration.css">
    <link rel="stylesheet" href="css/styleFooter.css">

    <title>Mein Profil</title>
</head>

<?php
    include('../includes/header.php'); // Einbinden des Headers
?>
<body>
    <!--Benutzerdaten abrufen und in $user speichern-->
    <?php
        $userID = $_SESSION['User_ID'];

        // Benutzerdaten abrufen und in $user speichern
        $query = $conn->prepare("SELECT * FROM user WHERE User_ID = :userID");
        $query->bindParam(':userID', $userID);
        $query->execute();

        // Holen der Ergebnisse als assoziatives Array
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Datenbankverbindung schließen
        $conn = null;
    ?>


<div class="contentBox">
    <div class="gif1">
        <img src="./images/neonlightsrev.gif">
    </div>
    
    <form>
        <h1>Mein Profil</h1>
            <div class="inputbox">
                <input type="text" required placeholder="Vorname" value="<?php echo $user['FirstName']; ?>">
                <input type="text" required placeholder="Nachname" value="<?php echo $user['LastName']; ?>">
                <input type="text" required placeholder="Alter" value="<?php echo $user['Age']; ?>">
                <input type="email" required placeholder="Email" value="<?php echo $user['EMail']; ?>">
                <input type= "text" required placeholder="Username" value="<?php echo $user['Username']; ?>">
                <input type="text" required placeholder="Password" value="<?php echo $user['Password']; ?>">
                
                <button type="submit">Bearbeiten</button>
          </div>


   
</body>

</html>
