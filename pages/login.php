<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- add font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Einbinden der style.css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <title>Anmelden</title>
    <base href="/Autovermietung/">

</head>

<body>
    <?php
    include('../includes/dbConnection.php');
    include('../includes/header.php');

    // prevent logged in users from entering login page
    if (isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"])) {
        header("Location: ../index.php");
    }
    ?>

    <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
        <h1>Anmelden</h1>

        <?php // if login is hit: check if user exists in database, verify password
        if (isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $stmt = $conn->prepare("SELECT * FROM User WHERE Username=:username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $existingUser = $stmt->fetchAll();

            if (!empty($existingUser)) {
                $passwordHash = $existingUser[0]["Password"];
                $checkPassword = password_verify($password, $passwordHash);

                if ($checkPassword) {
                    session_start();
                    $_SESSION["firstName"] = $existingUser[0]["FirstName"];
                    header("Location: ../index.php");
                } else {
        ?>
                    <div class="error">
                        <p class="textError"> Falscher Username oder falsches Passwort </p>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="error">
                    <p class="textError"> Falscher Username oder falsches Passwort </p>
                </div>
        <?php
            }
        } ?>

        <div class="inputbox">
            <input type="text" required autofocus placeholder="Username" name="username">
            <input type="password" required placeholder="Password" name="password">
        </div>
        <button name="login">Login</button>
    </form>

    <?php
    include('../includes/footer.html'); // Einbindung des Footers
    ?>
</body>