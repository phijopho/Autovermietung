<!DOCTYPE html>
<html lang="de">

<head>
    <?php include('../includes/htmlhead.php') ?>
    <link rel="stylesheet" href="css/styleMeinProfil.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <title>Mein Profil</title>
</head>


<!--Userdaten updaten-->
<?php
include('../includes/header.php');
include('db_connection.php');

$userID = $_SESSION['User_ID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedFirstName = $_POST['firstName'];
    $updatedLastName = $_POST['lastName'];
    $updatedAge = $_POST['age'];
    $updatedEmail = $_POST['email'];
    $updatedUsername = $_POST['username'];
    $updatedPassword = $_POST['password'];

    $query = $conn->prepare("
        UPDATE user
        SET FirstName = :firstName, LastName = :lastName, Age = :age,
                EMail = :email, Username = :username, Password = :password
        WHERE User_ID = :userID
    ");
    $query->bindParam(':firstName', $updatedFirstName);
    $query->bindParam(':lastName', $updatedLastName);
    $query->bindParam(':age', $updatedAge);
    $query->bindParam(':email', $updatedEmail);
    $query->bindParam(':username', $updatedUsername);
    $query->bindParam(':password', $updatedPassword);
    $query->bindParam(':userID', $userID);

    // Update-Abfrage 
    if (!$query->execute()) {
        echo 'Fehler beim Aktualisieren des Benutzers: ' . implode(' ', $query->errorInfo());
        exit();
    }
    //Message wenn User Daten geändert hat
    echo '<script>alert("Ihre Profildaten wurden erfolreich geändert!");</script>';
}

$query = $conn->prepare("SELECT * FROM user WHERE User_ID = :userID");
$query->bindParam(':userID', $userID);
$query->execute();

$user = $query->fetch(PDO::FETCH_ASSOC);

$conn = null;
?>

<body>
    <div class="contentBox">
        <div class="gif1">
            <img src="./images/neonlightsrev.gif">
        </div>

        <!--Boxen wo der User seine Daten einsehen und verändern kann-->
        <form action="pages/meinProfil.php" method="post">
            <h1>Mein Profil</h1>
            <div class="inputbox">
                <input type="text" name="firstName" required placeholder="Vorname" value="<?php echo $user['FirstName']; ?>">
                <input type="text" name="lastName" required placeholder="Nachname" value="<?php echo $user['LastName']; ?>">
                <input type="text" name="age" required placeholder="Alter" value="<?php echo $user['Age']; ?>">
                <input type="email" name="email" required placeholder="Email" value="<?php echo $user['EMail']; ?>">
                <input type="text" name="username" required placeholder="Username" value="<?php echo $user['Username']; ?>">
                <input type="text" name="password" required placeholder="Password" value="<?php echo $user['Password']; ?>">
                <button type="submit">Bearbeiten</button>
            </div>
        </form>
    </div>
</body>
<?php
include('../includes/footer.html');
?>

</html>