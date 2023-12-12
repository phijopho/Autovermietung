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
    <link rel="stylesheet" href="../css/styleFooter.css">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <title>Anmelden</title>
    <base href="/Autovermietung/">

</head>

<body>
    <?php
    include('../includes/dbConnection.php');
    include('../includes/header.html'); // Einbinden des Headers

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $stmt = $conn->prepare("SELECT * FROM User WHERE Username=:username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $existingUser = $stmt->fetchAll();
        var_dump($existingUser);

        $passwordHash = $existingUser[0]["Password"];
        $checkPassword = password_verify($password, $passwordHash);

        if ($checkPassword) {
            session_start();
            $_SESSION["username"] = $existingUser[0]["Username"];

            header("Location: ../index.php");
        } else {
            // error
        }
    }

    ?>

    <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
        <h1>Anmelden</h1>
        <div class="inputbox">
            <input type="text" required autofocus placeholder="Username" name="username">
            <input type="password" required placeholder="Password" name="password">
        </div>
        <button name="login" a href="">Login</button>
    </form>

</body>




</html>